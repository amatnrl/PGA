<?= $this->extend('site/layouts/main') ?>

<?= $this->section('head') ?>
<?php if (! empty($clusters)): ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
<?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= view('site/partials/page-header', ['pageTitle' => 'Tentang Kami', 'pageSubtitle' => $site['tagline'] ?? '']) ?>

<div class="max-w-7xl mx-auto px-6 pt-10">
    <?= view('components/breadcrumb', ['breadcrumbs' => [['label' => 'Home', 'url' => site_url('/')], ['label' => 'About']]]) ?>
</div>

<!-- Profil Perusahaan -->
<section class="relative overflow-hidden bg-white py-14 px-6">
    <div class="section-motif bg-motif-dots-dark opacity-30"></div>
    <div class="relative mx-auto max-w-site grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="about-profile-img relative" data-aos="fade-right">
            <div class="pointer-events-none absolute -bottom-6 -left-6 -z-10 h-24 w-24 rounded-full border-[8px] border-primary/10"></div>
            <img src="<?= ! empty($site['companyPhoto']) ? base_url($site['companyPhoto']) : 'https://placehold.co/700x520?text=PGA' ?>"
                alt="<?= esc($site['companyName'] ?? 'PGA') ?>" loading="lazy"
                class="relative h-72 w-full rounded-3xl object-cover lg:h-[420px]">
        </div>
        <div data-aos="fade-left">
            <h2 class="font-heading font-bold text-2xl sm:text-3xl mb-3"><?= esc($site['companyName'] ?? 'PT. Pancaran Gemilang Abadi') ?></h2>
            <?php if (! empty($about['history'])): ?>
                <div class="prose prose-sm text-gray-600"><?= $about['history'] ?></div>
            <?php else: ?>
                <p class="text-gray-500 leading-relaxed"><?= esc($site['tagline'] ?? '') ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if (! empty($about['vision']) || ! empty($about['missionList'])): ?>
    <section class="relative overflow-hidden bg-[#FBF7F2] py-16 px-6">
        <div class="section-motif bg-motif-dots opacity-30"></div>
        <div class="relative mx-auto max-w-site grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="vision-mission-card group" data-aos="fade-up">
                <span class="vision-mission-icon">
                    <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                        <path d="M12 5C6.5 5 2.7 8.4 1 12c1.7 3.6 5.5 7 11 7s9.3-3.4 11-7c-1.7-3.6-5.5-7-11-7Zm0 11.5A4.5 4.5 0 1 1 12 7.5a4.5 4.5 0 0 1 0 9Zm0-7A2.5 2.5 0 1 0 12 14a2.5 2.5 0 0 0 0-5Z" />
                    </svg>
                </span>
                <h3 class="font-heading font-bold text-xl mb-3 text-primary">Visi</h3>
                <p class="text-sm text-gray-600 leading-relaxed"><?= esc($about['vision'] ?? '') ?></p>
            </div>
            <div class="vision-mission-card group" data-aos="fade-up" data-aos-delay="100">
                <span class="vision-mission-icon">
                    <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                        <path d="m9 16.2-3.5-3.5L4 14.2l5 5 11-11-1.4-1.4L9 16.2Z" />
                    </svg>
                </span>
                <h3 class="font-heading font-bold text-xl mb-3 text-primary">Misi</h3>
                <ul class="text-sm text-gray-600 space-y-2.5">
                    <?php foreach (array_filter(explode("\n", $about['missionList'] ?? '')) as $m): ?>
                        <li class="flex items-start gap-2">
                            <svg viewBox="0 0 24 24" class="mt-0.5 h-4 w-4 shrink-0 fill-primary">
                                <path d="m9 16.2-3.5-3.5L4 14.2l5 5 11-11-1.4-1.4L9 16.2Z" />
                            </svg>
                            <span><?= esc(trim($m)) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (! empty($clusters)): ?>
    <section class="relative overflow-hidden bg-white py-16 px-6">
        <div class="section-motif bg-motif-dots-dark opacity-30"></div>
        <div class="relative mx-auto max-w-site">
            <div class="text-center mb-10" data-aos="fade-up">
                <span class="text-xs font-bold uppercase tracking-wider text-primary">Jangkauan Kami</span>
                <h2 class="font-heading font-bold text-2xl sm:text-3xl mt-2">Peta Jalur Distribusi</h2>
                <p class="text-gray-500 mt-2 max-w-xl mx-auto">Klik salah satu titik atau wilayah di bawah untuk melihat daerah mana saja yang kami jangkau.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="100">
                <div class="lg:col-span-3">
                    <div id="distribution-map" class="h-[360px] w-full overflow-hidden rounded-3xl border border-gray-100 shadow-sm sm:h-[420px] lg:h-[480px]"></div>
                </div>
                <div class="lg:col-span-1">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-wider text-gray-400">Wilayah</p>
                    <div class="flex flex-col gap-2 max-h-[360px] overflow-y-auto pr-1 lg:max-h-[480px]">
                        <?php foreach ($clusters as $i => $c): ?>
                            <button type="button" class="region-chip flex items-center gap-2.5 rounded-xl border border-gray-100 bg-white px-3.5 py-2.5 text-left text-sm font-medium text-gray-700 transition hover:border-primary/30 hover:bg-primary/5" data-cluster-index="<?= $i ?>">
                                <span class="h-2.5 w-2.5 shrink-0 rounded-full" style="background:<?= esc($c['color']) ?>"></span>
                                <span class="min-w-0 flex-1 truncate"><?= esc($c['region']) ?></span>
                                <span class="shrink-0 rounded-full bg-gray-100 px-2 py-0.5 text-[11px] font-semibold text-gray-500"><?= count($c['cities']) ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="distribution-modal" class="distribution-modal fixed inset-0 z-[1100] flex items-center justify-center bg-black/60 px-4" aria-hidden="true">
        <div class="distribution-modal-card w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl">
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-3">
                    <span id="distribution-modal-dot" class="h-3.5 w-3.5 shrink-0 rounded-full"></span>
                    <h3 id="distribution-modal-title" class="font-heading font-bold text-lg text-gray-900">Wilayah</h3>
                </div>
                <button type="button" id="distribution-modal-close" class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-gray-400 transition hover:bg-gray-100 hover:text-gray-700" aria-label="Tutup">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current">
                        <path d="m13.4 12 5-5-1.4-1.4-5 5-5-5L5.6 7l5 5-5 5L7 18.4l5-5 5 5 1.4-1.4-5-5Z" />
                    </svg>
                </button>
            </div>
            <p class="mt-1 text-sm text-gray-400">Jalur distribusi PGA menjangkau daerah berikut:</p>
            <div id="distribution-modal-cities" class="mt-4 flex flex-wrap gap-2"></div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>

<?php if (! empty($clusters)): ?>
    <?= $this->section('scripts') ?>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var clusters = <?= json_encode(array_map(static fn($c) => [
                                'region' => $c['region'],
                                'match'  => $c['match'],
                                'color'  => $c['color'],
                                'lat'    => $c['lat'],
                                'lng'    => $c['lng'],
                                'cities' => $c['cities'],
                            ], $clusters)) ?>;

            var mapEl = document.getElementById('distribution-map');
            if (!mapEl || typeof L === 'undefined') return;

            var clusterByMatch = {};
            clusters.forEach(function(c) {
                clusterByMatch[c.match] = c;
            });

            function normalizeName(name) {
                return String(name || '')
                    .toLowerCase()
                    .replace(/^(dki|di|provinsi|prov\.?)\s+/, '')
                    .replace(/[^a-z0-9]/g, '');
            }

            // Indonesia bagian timur saja (Sulawesi s/d Papua) — peta dikunci & di-zoom ke area ini.
            var EASTERN_BOUNDS = L.latLngBounds([-7, 106.5], [3.5, 141.5]);

            var map = L.map('distribution-map', {
                scrollWheelZoom: true,
                maxBounds: EASTERN_BOUNDS.pad(0.25),
                maxBoundsViscosity: 0.7,
                minZoom: 6,
                zoomSnap: 0.25,
            }).fitBounds(EASTERN_BOUNDS, {
                padding: [4, 4]
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 18,
            }).addTo(map);

            var modal = document.getElementById('distribution-modal');
            var modalDot = document.getElementById('distribution-modal-dot');
            var modalTitle = document.getElementById('distribution-modal-title');
            var modalCities = document.getElementById('distribution-modal-cities');
            var layerByMatch = {};
            var geoLayer;

            function openModal(cluster) {
                modalDot.style.background = cluster.color;
                modalTitle.textContent = cluster.region;
                modalCities.innerHTML = '';
                cluster.cities.forEach(function(city, i) {
                    var chip = document.createElement('span');
                    chip.className = 'distribution-chip inline-flex items-center rounded-full bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-700';
                    chip.style.animationDelay = (i * 0.045) + 's';
                    chip.textContent = city;
                    modalCities.appendChild(chip);
                });
                modal.classList.add('is-open');
                modal.setAttribute('aria-hidden', 'false');
            }

            function closeModal() {
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden', 'true');
            }

            document.getElementById('distribution-modal-close').addEventListener('click', closeModal);
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeModal();
            });

            function styleFor(feature) {
                var cluster = clusterByMatch[normalizeName(feature.properties.NAME_1)];
                return cluster ? {
                    color: '#fff',
                    weight: 1.5,
                    fillColor: cluster.color,
                    fillOpacity: 0.55
                } : {
                    color: '#fff',
                    weight: 1,
                    fillColor: '#D9DCE2',
                    fillOpacity: 0.45
                };
            }

            fetch('<?= base_url('data/id-provinces.geojson') ?>')
                .then(function(res) {
                    return res.json();
                })
                .then(function(geojson) {
                    geoLayer = L.geoJSON(geojson, {
                        style: styleFor,
                        onEachFeature: function(feature, layer) {
                            var key = normalizeName(feature.properties.NAME_1);
                            var cluster = clusterByMatch[key];

                            if (cluster) {
                                layerByMatch[key] = layer;
                                layer.bindTooltip(cluster.region + ' — ' + cluster.cities.length + ' daerah', {
                                    sticky: true
                                });
                                layer.on('click', function() {
                                    openModal(cluster);
                                });
                            } else {
                                layer.bindTooltip(feature.properties.NAME_1, {
                                    sticky: true
                                });
                            }

                            layer.on('mouseover', function() {
                                layer.setStyle({
                                    weight: 2.5,
                                    fillOpacity: cluster ? 0.8 : 0.55
                                });
                            });
                            layer.on('mouseout', function() {
                                geoLayer.resetStyle(layer);
                            });
                        },
                    }).addTo(map);

                    // Provinces not present in this older boundary set (e.g. the
                    // newest Papua splits) still get a fallback colored dot so no
                    // data silently disappears from the map.
                    clusters.forEach(function(cluster) {
                        if (layerByMatch[cluster.match]) return;
                        var marker = L.circleMarker([cluster.lat, cluster.lng], {
                            radius: 10,
                            color: '#fff',
                            weight: 2,
                            fillColor: cluster.color,
                            fillOpacity: 0.85,
                        }).addTo(map);
                        marker.bindTooltip(cluster.region + ' — ' + cluster.cities.length + ' daerah', {
                            direction: 'top'
                        });
                        marker.on('click', function() {
                            openModal(cluster);
                        });
                        layerByMatch[cluster.match] = marker;
                    });
                });

            document.querySelectorAll('.region-chip').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var idx = parseInt(btn.getAttribute('data-cluster-index'), 10);
                    var cluster = clusters[idx];
                    if (!cluster) return;
                    openModal(cluster);

                    var layer = layerByMatch[cluster.match];
                    if (!layer) return;
                    if (layer.getBounds) {
                        map.fitBounds(layer.getBounds(), {
                            padding: [40, 40]
                        });
                    } else if (layer.getLatLng) {
                        map.flyTo(layer.getLatLng(), 6, {
                            duration: 0.6
                        });
                    }
                    layer.openTooltip();
                });
            });
        });
    </script>
    <?= $this->endSection() ?>
<?php endif; ?>