<?php

namespace App\Controllers\Site;

use App\Models\ActivityModel;
use App\Models\ArticleModel;
use App\Models\InsightModel;
use App\Models\RecipeModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Model;

class Explore extends SiteBaseController
{
    /** @var array<string,array{label:string,baseUrl:string}> Shared nav for the "Jenis Explore" sidebar. */
    private const TYPES = [
        'insight'  => ['label' => 'Baking Insight', 'baseUrl' => 'explore/insight'],
        'recipe'   => ['label' => 'Recipe', 'baseUrl' => 'explore/recipe'],
        'article'  => ['label' => 'Article', 'baseUrl' => 'explore/article'],
        'activity' => ['label' => 'Activity', 'baseUrl' => 'explore/activity'],
    ];

    public function index()
    {
        // Old/cached/bookmarked links such as explore?type=recipe should land
        // straight on the dedicated type page, not the generic hub.
        $type = $this->request->getGet('type');
        if ($type && isset(self::TYPES[$type])) {
            return redirect()->to(site_url(self::TYPES[$type]['baseUrl']));
        }

        $search = $this->request->getGet('q');

        if ($search) {
            $this->data['title']   = 'Hasil Pencarian: ' . $search;
            $this->data['results'] = [
                'insight'  => (new InsightModel())->where('status', 'published')->like('title', $search)->findAll(6),
                'recipe'   => (new RecipeModel())->where('status', 'published')->like('title', $search)->findAll(6),
                'article'  => (new ArticleModel())->where('status', 'published')->like('title', $search)->findAll(6),
                'activity' => (new ActivityModel())->where('status', 'published')->like('title', $search)->findAll(6),
            ];

            return view('site/explore/search', $this->data);
        }

        $this->data['title']     = 'Explore';
        $this->data['seo']       = ['title' => 'Explore'];
        $this->data['insights']   = (new InsightModel())->where('status', 'published')->orderBy('id', 'desc')->findAll(4);
        $this->data['recipes']    = (new RecipeModel())->where('status', 'published')->orderBy('id', 'desc')->findAll(4);
        $this->data['articles']   = (new ArticleModel())->where('status', 'published')->orderBy('id', 'desc')->findAll(4);
        $this->data['activities'] = (new ActivityModel())->where('status', 'published')->orderBy('id', 'desc')->findAll(4);

        return view('site/explore/index', $this->data);
    }

    public function insights()
    {
        return $this->listing(new InsightModel(), 'insight', 'Baking Insight', 'site/explore/insights');
    }

    public function insight($slug)
    {
        return $this->detail(new InsightModel(), $slug, 'insight', 'Article');
    }

    public function recipes()
    {
        return $this->listing(new RecipeModel(), 'recipe', 'Recipe', 'site/explore/recipes');
    }

    public function recipe($slug)
    {
        return $this->detail(new RecipeModel(), $slug, 'recipe', 'Recipe');
    }

    public function articles()
    {
        return $this->listing(new ArticleModel(), 'article', 'Article', 'site/explore/articles');
    }

    public function article($slug)
    {
        return $this->detail(new ArticleModel(), $slug, 'article', 'Article');
    }

    public function activities()
    {
        return $this->listing(new ActivityModel(), 'activity', 'Activity', 'site/explore/activities');
    }

    public function activity($slug)
    {
        return $this->detail(new ActivityModel(), $slug, 'activity', 'Article');
    }

    /**
     * Shared listing page for the 4 explore types: search + month/year
     * archive filter + the "Jenis Explore" sidebar nav.
     */
    private function listing(Model $model, string $typeKey, string $title, string $view)
    {
        $search = $this->request->getGet('q');
        $month  = $this->request->getGet('month');
        $year   = $this->request->getGet('year');

        $builder = $model->where('status', 'published');
        if ($search) {
            $builder->like('title', $search);
        }
        if ($year) {
            $builder->where('YEAR(published_at)', (int) $year);
        }
        if ($month) {
            $builder->where('MONTH(published_at)', (int) $month);
        }

        $this->data['title']      = $title;
        $this->data['seo']        = ['title' => $title];
        $this->data['items']      = $builder->orderBy('id', 'desc')->paginate(8);
        $this->data['pager']      = $model->pager;
        $this->data['baseUrl']    = self::TYPES[$typeKey]['baseUrl'];
        $this->data['typeKey']    = $typeKey;
        $this->data['types']      = self::TYPES;
        $this->data['archives']   = $this->archivesFor(get_class($model));
        $this->data['activeMonth'] = $month;
        $this->data['activeYear']  = $year;
        $this->data['q']           = $search;

        return view($view, $this->data);
    }

    /** Month/year groups with counts, newest first, for the Archives sidebar block. */
    private function archivesFor(string $modelClass): array
    {
        $model = new $modelClass();
        $rows  = $model->select("DATE_FORMAT(published_at, '%Y-%m') AS ym, COUNT(*) AS total", false)
            ->where('status', 'published')
            ->where('published_at IS NOT NULL')
            ->groupBy('ym')
            ->orderBy('ym', 'desc')
            ->findAll(24);

        $monthNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $archives = [];
        foreach ($rows as $row) {
            if (empty($row['ym'])) {
                continue;
            }
            [$year, $month] = explode('-', $row['ym']);
            $archives[] = [
                'year'  => (int) $year,
                'month' => (int) $month,
                'label' => $monthNames[(int) $month] . ' ' . $year,
                'total' => (int) $row['total'],
            ];
        }

        return $archives;
    }

    private function detail(Model $model, string $slug, string $typeKey, string $schemaType)
    {
        $item = $model->where('slug', $slug)->where('status', 'published')->first();

        if ($item === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $related  = $model->where('id !=', $item['id'])->where('status', 'published')->orderBy('id', 'desc')->findAll(8);
        $baseUrl  = self::TYPES[$typeKey]['baseUrl'];
        $hubLabel = self::TYPES[$typeKey]['label'];

        $this->data['title']    = $item['title'];
        $this->data['seo']      = ['title' => $item['title'], 'description' => strip_tags((string) $item['content']), 'image' => $item['featured_image']];
        $this->data['schemas']  = [schema_json($schemaType, ['headline' => $item['title']])];
        $this->data['item']     = $item;
        $this->data['related']  = $related;
        $this->data['baseUrl']  = $baseUrl;
        $this->data['hubLabel'] = $hubLabel;
        $this->data['hubUrl']   = $baseUrl;
        $this->data['typeKey']  = $typeKey;
        $this->data['types']    = self::TYPES;
        $this->data['archives'] = $this->archivesFor(get_class($model));
        $this->data['activeMonth'] = null;
        $this->data['activeYear']  = null;
        $this->data['q']           = null;
        $this->data['embedUrl']      = $typeKey === 'recipe' ? $this->toEmbedUrl((string) ($item['video_url'] ?? '')) : null;
        $this->data['embedIsTall']   = $typeKey === 'recipe' && $this->data['embedUrl'] && str_contains($this->data['embedUrl'], 'instagram.com');

        return view('site/explore/detail', $this->data);
    }

    /** Best-effort conversion of a YouTube/Instagram share link into an embeddable URL. */
    private function toEmbedUrl(string $url): ?string
    {
        $url = trim($url);
        if ($url === '') {
            return null;
        }

        if (preg_match('#youtu\.be/([a-zA-Z0-9_-]+)#', $url, $m) || preg_match('#youtube\.com/watch\?v=([a-zA-Z0-9_-]+)#', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // Instagram posts/reels embed fine as a plain iframe via /embed —
        // no JS widget script needed.
        if (preg_match('#instagram\.com/(reel|p|tv)/([A-Za-z0-9_-]+)#', $url, $m)) {
            return 'https://www.instagram.com/' . $m[1] . '/' . $m[2] . '/embed';
        }

        return $url;
    }
}
