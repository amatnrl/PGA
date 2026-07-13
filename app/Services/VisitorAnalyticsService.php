<?php

namespace App\Services;

use App\Models\PageViewModel;

class VisitorAnalyticsService
{
    private PageViewModel $model;

    public function __construct()
    {
        $this->model = new PageViewModel();
    }

    public function recordVisit(string $url, ?string $ip, ?string $userAgent): void
    {
        $this->model->insert([
            'url'        => $url,
            'ip_address' => $ip,
            'user_agent' => $userAgent,
        ]);
    }

    public function totalVisitors(): int
    {
        return $this->model->countAllResults();
    }

    /**
     * @return array<string, int> date (Y-m-d) => count, oldest first.
     */
    public function dailyCounts(int $days = 14): array
    {
        $start = date('Y-m-d 00:00:00', strtotime('-' . ($days - 1) . ' days'));

        $rows = $this->model
            ->select('DATE(created_at) as day, COUNT(*) as total')
            ->where('created_at >=', $start)
            ->groupBy('day')
            ->findAll();

        $counts = [];
        foreach ($rows as $row) {
            $counts[$row['day']] = (int) $row['total'];
        }

        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date           = date('Y-m-d', strtotime("-{$i} days"));
            $result[$date] = $counts[$date] ?? 0;
        }

        return $result;
    }

    public function topPages(int $limit = 5): array
    {
        return $this->model
            ->select('url, COUNT(*) as total')
            ->groupBy('url')
            ->orderBy('total', 'desc')
            ->limit($limit)
            ->findAll();
    }
}
