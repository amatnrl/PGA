<?php

namespace App\Services;

use App\Models\BranchModel;

/**
 * Groups the "Jalur Distribusi" (formerly "Cabang") data by region/wilayah
 * and attaches an approximate map coordinate + a distinct color per region,
 * so the About page can plot one colored cluster per wilayah on a Leaflet map.
 */
class DistributionMapService
{
    /** Approximate centroid [lat, lng] per Indonesian province/region — looked up by a loose name match. */
    private const COORDS = [
        'aceh'                  => [4.6951, 96.7494],
        'sumatera utara'        => [2.1154, 99.5451],
        'sumut'                 => [2.1154, 99.5451],
        'sumatera barat'        => [-0.7399, 100.8000],
        'sumbar'                => [-0.7399, 100.8000],
        'riau'                  => [0.5071, 101.4478],
        'kepulauan riau'        => [3.9457, 108.1428],
        'kepri'                 => [3.9457, 108.1428],
        'jambi'                 => [-1.6101, 103.6131],
        'sumatera selatan'      => [-3.3194, 103.9144],
        'sumsel'                => [-3.3194, 103.9144],
        'bangka belitung'       => [-2.7410, 106.4406],
        'babel'                 => [-2.7410, 106.4406],
        'bengkulu'              => [-3.7928, 102.2608],
        'lampung'               => [-4.5586, 105.4068],
        'banten'                 => [-6.4058, 106.0640],
        'dki jakarta'           => [-6.2088, 106.8456],
        'jakarta'               => [-6.2088, 106.8456],
        'jawa barat'            => [-6.9175, 107.6191],
        'jabar'                 => [-6.9175, 107.6191],
        'jawa tengah'           => [-7.1510, 110.1403],
        'jateng'                => [-7.1510, 110.1403],
        'di yogyakarta'         => [-7.7956, 110.3695],
        'yogyakarta'            => [-7.7956, 110.3695],
        'diy'                   => [-7.7956, 110.3695],
        'jawa timur'            => [-7.5360, 112.2384],
        'jatim'                 => [-7.5360, 112.2384],
        'bali'                  => [-8.4095, 115.1889],
        'nusa tenggara barat'   => [-8.6529, 117.3616],
        'ntb'                   => [-8.6529, 117.3616],
        'nusa tenggara timur'   => [-8.6573, 121.0794],
        'ntt'                   => [-8.6573, 121.0794],
        'kalimantan barat'      => [-0.2787, 111.4753],
        'kalbar'                => [-0.2787, 111.4753],
        'kalimantan tengah'     => [-1.6815, 113.3824],
        'kalteng'               => [-1.6815, 113.3824],
        'kalimantan selatan'    => [-3.0926, 115.2838],
        'kalsel'                => [-3.0926, 115.2838],
        'kalimantan timur'      => [0.5387, 116.4194],
        'kaltim'                => [0.5387, 116.4194],
        'kalimantan utara'      => [3.0731, 116.0414],
        'kaltara'               => [3.0731, 116.0414],
        'sulawesi utara'        => [1.4748, 124.8421],
        'sulut'                 => [1.4748, 124.8421],
        'gorontalo'             => [0.6999, 122.4467],
        'sulawesi tengah'       => [-1.4300, 121.4456],
        'sulteng'               => [-1.4300, 121.4456],
        'sulawesi barat'        => [-2.8441, 119.2321],
        'sulbar'                => [-2.8441, 119.2321],
        'sulawesi selatan'      => [-3.6688, 119.9741],
        'sulsel'                => [-3.6688, 119.9741],
        'sulawesi tenggara'     => [-4.1449, 122.1746],
        'sultra'                => [-4.1449, 122.1746],
        'maluku'                => [-3.2385, 130.1453],
        'maluku utara'          => [1.5709, 127.8087],
        'malut'                 => [1.5709, 127.8087],
        'papua'                 => [-4.2699, 138.0804],
        'papua barat'           => [-1.3361, 133.1747],
        'papua tengah'          => [-3.5, 136.5],
        'papua selatan'         => [-6.0, 139.5],
        'papua pegunungan'      => [-4.0, 138.8],
    ];

    /** Color palette cycled per distinct region, in a fixed friendly order. */
    private const PALETTE = [
        '#D60000', '#2563EB', '#059669', '#D97706', '#7C3AED',
        '#0891B2', '#DB2777', '#4F46E5', '#EA580C', '#0D9488',
    ];

    /**
     * @return array<int,array{region:string,match:string,color:string,lat:float,lng:float,cities:array<int,string>}>
     */
    public function clusters(): array
    {
        $branches = (new BranchModel())->where('status', 'active')->orderBy('region', 'asc')->orderBy('city', 'asc')->findAll();

        $grouped = [];
        foreach ($branches as $b) {
            $grouped[$b['region']][] = $b['city'];
        }

        $regions = array_keys($grouped);
        sort($regions, SORT_NATURAL | SORT_FLAG_CASE);

        $clusters = [];
        foreach ($regions as $i => $region) {
            [$lat, $lng] = $this->coordsFor($region);
            $clusters[]  = [
                'region' => $region,
                'match'  => $this->normalizeKey($region),
                'color'  => self::PALETTE[$i % count(self::PALETTE)],
                'lat'    => $lat,
                'lng'    => $lng,
                'cities' => $grouped[$region],
            ];
        }

        return $clusters;
    }

    /** @return array{0:float,1:float} */
    private function coordsFor(string $region): array
    {
        $key = mb_strtolower(trim($region));

        if (isset(self::COORDS[$key])) {
            return self::COORDS[$key];
        }

        foreach (self::COORDS as $name => $coord) {
            if (str_contains($key, $name) || str_contains($name, $key)) {
                return $coord;
            }
        }

        // Unrecognized region name — fall back to a central Indonesia point
        // so it's still plotted (roughly) instead of being silently dropped.
        return [-2.5, 118.0];
    }

    /**
     * Normalizes a region name into the same key shape as the province
     * GeoJSON's NAME_1 property (lowercase, no spaces/punctuation), so the
     * front-end can match a "wilayah" to its polygon and color it in.
     */
    private function normalizeKey(string $region): string
    {
        $key = mb_strtolower(trim($region));
        $key = preg_replace('/^(dki|di|provinsi|prov\.?)\s+/', '', $key);
        $key = preg_replace('/[^a-z0-9]/', '', $key);

        $aliases = [
            'jakarta' => 'jakartaraya',
        ];

        return $aliases[$key] ?? $key;
    }
}
