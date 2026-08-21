@extends('layouts.app')

@section('title', 'Peta Sebaran Aloptama')

@push('style')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* Cartographic GIS Frame Styling inspired by BMKG Layout */
        .gis-container {
            background: #ffffff;
            border: 4px double #1a237e;
            border-radius: 6px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            overflow: hidden;
        }

        .gis-map-box {
            position: relative;
            height: 760px;
            width: 100%;
            border-right: 3px solid #1a237e;
            background: #eef2f6;
        }

        @media (max-width: 991.98px) {
            .gis-map-box {
                height: 520px;
                border-right: none;
                border-bottom: 3px solid #1a237e;
            }
        }

        .gis-sidebar {
            height: 760px;
            overflow-y: auto;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .gis-section-box {
            border-bottom: 2px solid #1a237e;
            padding: 14px;
        }

        .gis-section-box:last-child {
            border-bottom: none;
        }

        /* Compass Rose Styling */
        .compass-rose {
            width: 80px;
            height: 80px;
            display: inline-block;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.15));
        }

        /* Static Clean GIS Legend */
        .gis-legend-table {
            width: 100%;
            border-collapse: collapse;
        }
        .gis-legend-table tr {
            border-bottom: 1px dashed #e2e8f0;
            transition: all 0.2s ease;
        }
        .gis-legend-table tr:last-child {
            border-bottom: none;
        }
        .gis-legend-table td {
            padding: 8px 4px;
            vertical-align: middle;
        }
        .legend-symbol-cell {
            width: 32px;
            text-align: center;
        }
        .legend-text-cell {
            font-size: 12px;
            font-weight: 600;
            color: #1e293b;
        }
        .legend-count-cell {
            text-align: right;
            font-size: 11px;
            color: #64748b;
            font-weight: bold;
        }

        /* Coordinates Bar */
        .coordinates-bar {
            position: absolute;
            bottom: 6px;
            left: 10px;
            z-index: 999;
            background: rgba(255, 255, 255, 0.92);
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-family: monospace;
            font-weight: bold;
            color: #1e293b;
            border: 1px solid #cbd5e1;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        /* Custom Popup Styling */
        .leaflet-popup-content-wrapper {
            border-radius: 6px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,0.25);
        }
        .leaflet-popup-content {
            margin: 0 !important;
            line-height: 1.5;
            min-width: 250px;
            max-width: 320px;
        }
        .popup-header {
            padding: 10px 14px;
            color: #ffffff;
            font-weight: 700;
            font-size: 13px;
        }
        .popup-body {
            padding: 12px 14px;
            font-size: 12px;
            background: #ffffff;
        }
        .popup-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            border-bottom: 1px dashed #f1f5f9;
            padding-bottom: 3px;
        }
        .popup-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .popup-label {
            color: #64748b;
            font-weight: 600;
            margin-right: 8px;
        }
        .popup-val {
            color: #0f172a;
            font-weight: 600;
            text-align: right;
        }

        /* Top Filter Bar */
        .top-filter-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 16px 20px;
            margin-bottom: 18px;
        }

        .filter-badge-toggle {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            margin-right: 8px;
            margin-bottom: 8px;
            user-select: none;
            transition: all 0.2s ease;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            color: #334155;
        }
        .filter-badge-toggle:hover {
            background: #edf2f7;
        }
        .filter-badge-toggle input {
            margin-right: 7px;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Peta Sebaran Aloptama</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('aloptama.index') }}">Aloptama</a></div>
                    <div class="breadcrumb-item">Peta Sebaran</div>
                </div>
            </div>

            <div class="section-body">
                <!-- TOP CONTROL BAR (FILTER WILAYAH, FILTER ALOPTAMA & BUTTON DOWNLOAD) -->
                <div class="top-filter-card">
                    <div class="row align-items-center">
                        <!-- 1. Filter Fokus Wilayah -->
                        <div class="col-lg-4 col-md-12 mb-3 mb-lg-0">
                            <label class="font-weight-bold text-dark text-uppercase small mb-2 d-block">
                                <i class="fas fa-map-location-dot text-primary mr-1"></i> Filter Fokus Wilayah:
                            </label>
                            <div class="btn-group btn-group-sm flex-wrap" role="group">
                                <button type="button" class="btn btn-outline-primary active btn-region font-weight-600 mb-1" onclick="filterRegion('all', this, 'Wilayah Kalimantan & Sekitarnya')">
                                    Semua
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-region font-weight-600 mb-1" onclick="filterRegion('kalbar', this, 'Wilayah Kalimantan Barat')">
                                    Kalbar
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-region font-weight-600 mb-1" onclick="filterRegion('kaltim', this, 'Wilayah Kalimantan Timur & IKN')">
                                    Kaltim
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-region font-weight-600 mb-1" onclick="filterRegion('kaltara', this, 'Wilayah Kalimantan Utara')">
                                    Kaltara
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-region font-weight-600 mb-1" onclick="filterRegion('kalsel', this, 'Wilayah Kalimantan Selatan')">
                                    Kalsel
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-region font-weight-600 mb-1" onclick="filterRegion('kalteng', this, 'Wilayah Kalimantan Tengah')">
                                    Kalteng
                                </button>
                            </div>
                        </div>

                        <!-- 2. Filter Jenis Peralatan (Aloptama) -->
                        <div class="col-lg-5 col-md-8 mb-3 mb-md-0">
                            <label class="font-weight-bold text-dark text-uppercase small mb-2 d-block">
                                <i class="fas fa-filter text-primary mr-1"></i> Filter Tampilan Alat:
                            </label>
                            <div class="d-flex flex-wrap align-items-center">
                                <!-- Seismograph -->
                                <label class="filter-badge-toggle" for="filterSeismo">
                                    <input type="checkbox" id="filterSeismo" class="layer-filter-checkbox" data-layer="seismo" checked>
                                    <svg width="14" height="12" viewBox="0 0 22 20" class="mr-1">
                                        <polygon points="11,1 21,19 1,19" fill="#ff7800" stroke="#00" stroke-width="2"/>
                                    </svg>
                                    <span id="badgeCountSeismo">Seismograph ({{ count($seismographs) }})</span>
                                </label>

                                <!-- Accelerograph -->
                                <label class="filter-badge-toggle" for="filterAcc">
                                    <input type="checkbox" id="filterAcc" class="layer-filter-checkbox" data-layer="acc" checked>
                                    <svg width="14" height="12" viewBox="0 0 22 20" class="mr-1">
                                        <polygon points="11,1 21,19 1,19" fill="#00e676" stroke="#00" stroke-width="2"/>
                                    </svg>
                                    <span id="badgeCountAcc">Accelerograph ({{ count($accelerographs) }})</span>
                                </label>

                                <!-- LD -->
                                <label class="filter-badge-toggle" for="filterLd">
                                    <input type="checkbox" id="filterLd" class="layer-filter-checkbox" data-layer="ld" checked>
                                    <svg width="14" height="12" viewBox="0 0 22 20" class="mr-1">
                                        <polygon points="11,1 21,19 1,19" fill="#00b0ff" stroke="#00" stroke-width="2"/>
                                    </svg>
                                    <span id="badgeCountLd">Lightning Detector ({{ count($lightningDetectors) }})</span>
                                </label>

                                <!-- WRS NG -->
                                <label class="filter-badge-toggle" for="filterWrs">
                                    <input type="checkbox" id="filterWrs" class="layer-filter-checkbox" data-layer="wrs" checked>
                                    <svg width="14" height="12" viewBox="0 0 22 20" class="mr-1">
                                        <polygon points="11,1 21,19 1,19" fill="#ffea00" stroke="#00" stroke-width="2"/>
                                    </svg>
                                    <span id="badgeCountWrs">WRS NG ({{ count($wrsNgs) }})</span>
                                </label>

                                <!-- Magnet Prekursor -->
                                <label class="filter-badge-toggle" for="filterMagnet">
                                    <input type="checkbox" id="filterMagnet" class="layer-filter-checkbox" data-layer="magnet" checked>
                                    <svg width="14" height="12" viewBox="0 0 22 20" class="mr-1">
                                        <polygon points="11,1 21,19 1,19" fill="#ff1744" stroke="#00" stroke-width="2"/>
                                    </svg>
                                    <span id="badgeCountMagnet">Magnet Prekursor ({{ count($magnetPrekursors) }})</span>
                                </label>
                            </div>
                        </div>

                        <!-- 3. Tombol Aksi (Download PNG & Reset Peta) -->
                        <div class="col-lg-3 col-md-4 text-md-right mt-2 mt-md-0">
                            <button type="button" id="btnDownloadMap" class="btn btn-success btn-sm font-weight-600 mb-1" onclick="downloadMapImage()">
                                <i class="fas fa-download mr-1"></i> Download Peta (PNG)
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm font-weight-600 mb-1 ml-1" onclick="resetMapView()">
                                <i class="fas fa-arrows-rotate mr-1"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- BINGKAI KARTOGRAFIS GIS (INSPIRASI KALBAR.PNG & TARGET DOWNLOAD) -->
                <div class="gis-container" id="gisMapContainer">
                    <div class="row no-gutters">
                        <!-- 1. MAP CANVAS (SISI KIRI) -->
                        <div class="col-lg-9 col-md-8">
                            <div id="mapAloptama" class="gis-map-box">
                                <!-- Coordinates tracker badge -->
                                <div id="mouseCoordinates" class="coordinates-bar">
                                    <i class="fas fa-crosshairs text-primary mr-1"></i>
                                    <span id="coordText">Lat: - , Long: -</span>
                                </div>
                            </div>
                        </div>

                        <!-- 2. SIDEBAR KARTOGRAFIS (SISI KANAN - MURNI LEGENDA & KOP, BERSIH UNTUK EXPORT) -->
                        <div class="col-lg-3 col-md-4">
                            <div class="gis-sidebar">
                                <!-- BOX 1: JUDUL PETA -->
                                <div class="gis-section-box text-center">
                                    <h6 class="font-weight-bold text-dark mb-1 text-uppercase" style="letter-spacing: 0.5px; font-size: 13px;">
                                        PETA SEBARAN LOKASI
                                    </h6>
                                    <h5 class="font-weight-bold text-primary mb-1 text-uppercase" style="font-size: 13.5px; line-height: 1.3;">
                                        ALAT OPERASIONAL UTAMA (ALOPTAMA)
                                    </h5>
                                    <small class="font-weight-bold text-secondary text-uppercase" id="regionTitle">
                                        Wilayah Kalimantan & Sekitarnya
                                    </small>
                                </div>

                                <!-- BOX 2: KOP RESMI BMKG -->
                                <div class="gis-section-box text-center py-3">
                                    <img src="{{ asset('img/logo-bmkg.png') }}" alt="Logo BMKG" class="img-fluid mb-2" style="max-height: 58px;">
                                    <h6 class="font-weight-bold mb-0 text-dark" style="font-size: 10.5px; letter-spacing: 0.3px;">
                                        BADAN METEOROLOGI KLIMATOLOGI DAN GEOFISIKA
                                    </h6>
                                    <div class="font-weight-bold text-primary" style="font-size: 11.5px;">
                                        STASIUN GEOFISIKA BALIKPAPAN
                                    </div>
                                    <p class="mb-0 text-muted" style="font-size: 9.5px; line-height: 1.3;">
                                        Jl. Marsma R. Iswahyudi No. 354 Sepinggan Balikpapan<br>
                                        Telp/Fax: 0542-764053 / 762862<br>
                                        Email: stageof.balikpapan@bmkg.go.id
                                    </p>
                                </div>

                                <!-- BOX 3: KOMPAS & SKALA -->
                                <div class="gis-section-box text-center py-2">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <!-- SVG Wind Rose Compass -->
                                        <svg class="compass-rose" viewBox="0 0 100 100">
                                            <circle cx="50" cy="50" r="45" fill="none" stroke="#1a237e" stroke-width="1.5" stroke-dasharray="2,2"/>
                                            <circle cx="50" cy="50" r="38" fill="none" stroke="#1a237e" stroke-width="0.8"/>
                                            <!-- Star Points -->
                                            <!-- North -->
                                            <polygon points="50,6 55,45 50,50 45,45" fill="#1a237e"/>
                                            <polygon points="50,6 45,45 50,50" fill="#3949ab"/>
                                            <!-- South -->
                                            <polygon points="50,94 55,55 50,50 45,55" fill="#9e9e9e"/>
                                            <!-- East -->
                                            <polygon points="94,50 55,55 50,50 55,45" fill="#757575"/>
                                            <!-- West -->
                                            <polygon points="6,50 45,55 50,50 45,45" fill="#757575"/>
                                            <!-- Diagonal points -->
                                            <polygon points="81,19 54,46 50,50 50,50" fill="#bdbdbd"/>
                                            <polygon points="19,19 46,46 50,50 50,50" fill="#bdbdbd"/>
                                            <polygon points="81,81 54,54 50,50 50,50" fill="#bdbdbd"/>
                                            <polygon points="19,81 46,54 50,50 50,50" fill="#bdbdbd"/>
                                            <!-- Letters -->
                                            <text x="50" y="4" text-anchor="middle" font-size="9" font-weight="bold" fill="#1a237e">N</text>
                                            <text x="50" y="100" text-anchor="middle" font-size="8" font-weight="bold" fill="#424242">S</text>
                                            <text x="99" y="53" text-anchor="middle" font-size="8" font-weight="bold" fill="#424242">E</text>
                                            <text x="1" y="53" text-anchor="middle" font-size="8" font-weight="bold" fill="#424242">W</text>
                                        </svg>
                                    </div>
                                </div>

                                <!-- BOX 4: KETERANGAN / LEGENDA MURNI (MENYESUAIKAN FILTER AKTIF SECARA OTOMATIS) -->
                                <div class="gis-section-box">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="font-weight-bold text-dark text-uppercase" style="font-size: 11.5px;">
                                             KETERANGAN / LEGENDA :
                                        </span>
                                    </div>

                                    <table class="gis-legend-table">
                                        <tbody>
                                            <!-- 1. Seismograph -->
                                            <tr id="legendRowSeismo">
                                                <td class="legend-symbol-cell">
                                                    <svg width="22" height="19" viewBox="0 0 22 20">
                                                        <polygon points="11,1 21,19 1,19" fill="#ff7800" stroke="#000000" stroke-width="2"/>
                                                    </svg>
                                                </td>
                                                <td class="legend-text-cell">Seismograph</td>
                                                <td class="legend-count-cell" id="legendCountSeismo">{{ count($seismographs) }}</td>
                                            </tr>

                                            <!-- 2. Accelerograph -->
                                            <tr id="legendRowAcc">
                                                <td class="legend-symbol-cell">
                                                    <svg width="22" height="19" viewBox="0 0 22 20">
                                                        <polygon points="11,1 21,19 1,19" fill="#00e676" stroke="#000000" stroke-width="2"/>
                                                    </svg>
                                                </td>
                                                <td class="legend-text-cell">Accelerograph</td>
                                                <td class="legend-count-cell" id="legendCountAcc">{{ count($accelerographs) }}</td>
                                            </tr>

                                            <!-- 3. Lightning Detector (LD) -->
                                            <tr id="legendRowLd">
                                                <td class="legend-symbol-cell">
                                                    <svg width="22" height="19" viewBox="0 0 22 20">
                                                        <polygon points="11,1 21,19 1,19" fill="#00b0ff" stroke="#000000" stroke-width="2"/>
                                                    </svg>
                                                </td>
                                                <td class="legend-text-cell">Lightning Detector</td>
                                                <td class="legend-count-cell" id="legendCountLd">{{ count($lightningDetectors) }}</td>
                                            </tr>

                                            <!-- 4. WRS-NG -->
                                            <tr id="legendRowWrs">
                                                <td class="legend-symbol-cell">
                                                    <svg width="22" height="19" viewBox="0 0 22 20">
                                                        <polygon points="11,1 21,19 1,19" fill="#ffea00" stroke="#000000" stroke-width="2"/>
                                                    </svg>
                                                </td>
                                                <td class="legend-text-cell">WRS NG</td>
                                                <td class="legend-count-cell" id="legendCountWrs">{{ count($wrsNgs) }}</td>
                                            </tr>

                                            <!-- 5. Magnet Prekursor -->
                                            <tr id="legendRowMagnet">
                                                <td class="legend-symbol-cell">
                                                    <svg width="22" height="19" viewBox="0 0 22 20">
                                                        <polygon points="11,1 21,19 1,19" fill="#ff1744" stroke="#000000" stroke-width="2"/>
                                                    </svg>
                                                </td>
                                                <td class="legend-text-cell">Magnet Prekursor</td>
                                                <td class="legend-count-cell" id="legendCountMagnet">{{ count($magnetPrekursors) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- html2canvas JS for Map Image Export -->
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <script>
        // Raw Data dari Controller
        var dataSeismographs = @json($seismographs);
        var dataAccelerographs = @json($accelerographs);
        var dataLightningDetectors = @json($lightningDetectors);
        var dataWrsNgs = @json($wrsNgs);
        var dataMagnetPrekursors = @json($magnetPrekursors);

        // Layer Groups untuk masing-masing jenis aloptama
        var layerGroupSeismo = L.layerGroup();
        var layerGroupAcc = L.layerGroup();
        var layerGroupLd = L.layerGroup();
        var layerGroupWrs = L.layerGroup();
        var layerGroupMagnet = L.layerGroup();

        // 1. Helper SVG Triangle Icons
        function createTriangleIcon(color, stroke = '#000000') {
            var svgHtml = `
                <svg width="22" height="20" viewBox="0 0 22 20" style="filter: drop-shadow(0 2px 3px rgba(0,0,0,0.35));">
                    <polygon points="11,1 21,19 1,19" fill="${color}" stroke="${stroke}" stroke-width="2" stroke-linejoin="round"/>
                </svg>
            `;
            return L.divIcon({
                html: svgHtml,
                className: 'custom-leaflet-triangle-marker',
                iconSize: [22, 20],
                iconAnchor: [11, 10],
                popupAnchor: [0, -10]
            });
        }

        var iconSeismo = createTriangleIcon('#ff7800'); // 🔶 Oranye
        var iconAcc = createTriangleIcon('#00e676');    // 🟢 Hijau Terang
        var iconLd = createTriangleIcon('#00b0ff');     // 🔷 Biru Terang / Cyan
        var iconWrs = createTriangleIcon('#ffea00');    // 🟡 Kuning
        var iconMagnet = createTriangleIcon('#ff1744'); // 🔴 Merah

        // Custom Leaflet Scale Rounding untuk mendukung skala 75 km dan 150 km
        L.Control.Scale.prototype._getRoundNum = function (num) {
            var pow10 = Math.pow(10, (Math.floor(num) + '').length - 1),
                d = num / pow10;

            d = d >= 10 ? 10 :
                d >= 7.5 ? 7.5 :
                d >= 5 ? 5 :
                d >= 3 ? 3 :
                d >= 2 ? 2 :
                d >= 1.5 ? 1.5 : 1;

            return pow10 * d;
        };

        // 2. Initialize Leaflet Map dengan Zoom Step yang Lebih Halus
        var map = L.map('mapAloptama', {
            center: [-0.5, 114.5],
            zoom: 6,
            zoomDelta: 0.5,
            zoomSnap: 0.25,
            wheelPxPerZoomLevel: 120,
            zoomControl: true,
            attributionControl: true
        });

        // --- 2.1 Definisi Pilihan Basemap ---
        // 1. Esri National Geographic (Topografi kontras hijau-zaitun, batas tegas)
        var baseNatGeo = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 16,
            crossOrigin: true,
            attribution: 'Tiles &copy; Esri &mdash; National Geographic, DeLorme, NAVTEQ, UNEP-WCMC, USGS, NASA, ESA, METI, NRCAN, GEBCO, NOAA, iPC'
        });

        // 2. Esri World Imagery (Citra Satelit Foto Udara Resolusi Tinggi)
        var baseSatellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 18,
            crossOrigin: true,
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        });

        // 3. Esri World Topo Map (Topografi & Garis Kontur Klasik)
        var baseTopo = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 18,
            crossOrigin: true,
            attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong)'
        });

        // 4. OpenStreetMap Standar (Peta Wilayah Sangat Jelas & Detail Lengkap)
        var baseOsm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            crossOrigin: true,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        // 5. OpenTopoMap (Topografi Kontur Lengkap)
        var baseOpenTopo = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            maxZoom: 17,
            crossOrigin: true,
            attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
        });

        // Pasang Default Basemap (OpenTopoMap)
        baseOpenTopo.addTo(map);

        // Pasang Kontrol Pemilih Basemap di Pojok Kanan Atas
        var baseMaps = {
            "⛰️ OpenTopoMap (Default)": baseOpenTopo,
            "🗺️ OpenStreetMap Standar": baseOsm,
            "🌍 Topografi NatGeo": baseNatGeo,
            "🛰️ Citra Satelit": baseSatellite,
            "🏔️ Topografi Esri": baseTopo
        };

        L.control.layers(baseMaps, null, {
            position: 'topright',
            collapsed: true
        }).addTo(map);

        // Add Scale Control dengan dukungan skala 75km & 150km
        L.control.scale({
            position: 'bottomleft',
            maxWidth: 125,
            metric: true,
            imperial: false
        }).addTo(map);

        // Mouse coordinates tracker
        map.on('mousemove', function(e) {
            var lat = e.latlng.lat.toFixed(5);
            var lng = e.latlng.lng.toFixed(5);
            document.getElementById('coordText').innerText = `Lat: ${lat}° , Long: ${lng}°`;
        });

        // Add all layer groups to map
        layerGroupSeismo.addTo(map);
        layerGroupAcc.addTo(map);
        layerGroupLd.addTo(map);
        layerGroupWrs.addTo(map);
        layerGroupMagnet.addTo(map);

        // 3. Helper Klasifikasi Wilayah (Geografis + Teks Lokasi Presisi)
        function detectRegion(item) {
            var lat = parseFloat(item.latitude);
            var lng = parseFloat(item.longitude);
            var text = ((item.lokasi || '') + ' ' + (item.nama_site || '') + ' ' + (item.nama || '')).toLowerCase();

            // 1. Prioritas Kata Kunci Spesifik Wilayah
            // 1.1 Kaltim & IKN
            if (text.includes('kaltim') || text.includes('kalimantan timur') || text.includes('balikpapan') || text.includes('stageof balikpapan') || text.includes('samarinda') || text.includes('berau') || text.includes('tanjung redeb') || text.includes('tanjung redep') || text.includes('redep') || text.includes('redeb') || text.includes('kalimarau') || text.includes('talisayan') || text.includes('biduk') || text.includes('derawan') || text.includes('maratua') || text.includes('sangkulirang') || text.includes('wahau') || text.includes('kutai') || text.includes('kukar') || text.includes('kubar') || text.includes('kutim') || text.includes('bontang') || text.includes('paser') || text.includes('penajam') || text.includes('ppu') || text.includes('ikn') || text.includes('mahakam') || text.includes('sanga-sanga') || text.includes('sangasanga') || text.includes('sangatta') || text.includes('tenggarong') || text.includes('tanah grogot') || text.includes('muara jawa') || text.includes('sepaku') || text.includes('samboja') || text.includes('trd')) {
                return 'kaltim';
            }

            // 1.2 Kaltara
            if (text.includes('kaltara') || text.includes('kalimantan utara') || text.includes('tarakan') || text.includes('bulungan') || text.includes('nunukan') || text.includes('malinau') || text.includes('tana tidung') || text.includes('tideng pale') || text.includes('sebatik') || text.includes('tanjung selor') || text.includes('tanjung palas') || text.includes('juwata') || text.includes('trk')) {
                return 'kaltara';
            }

            // 1.3 Kalbar
            if (text.includes('kalbar') || text.includes('kalimantan barat') || text.includes('pontianak') || text.includes('singkawang') || text.includes('sambas') || text.includes('mempawah') || text.includes('sanggau') || text.includes('ketapang') || text.includes('sintang') || text.includes('kapuas hulu') || text.includes('bengkayang') || text.includes('landak') || text.includes('sekadau') || text.includes('melawi') || text.includes('kayong') || text.includes('kubu raya') || text.includes('kuburaya') || text.includes('putussibau') || text.includes('pangsuma')) {
                return 'kalbar';
            }

            // 1.4 Kalsel
            if (text.includes('kalsel') || text.includes('kalimantan selatan') || text.includes('banjarmasin') || text.includes('banjarbaru') || text.includes('martapura') || text.includes('tanah laut') || text.includes('pelaihari') || text.includes('kotabaru') || text.includes('tanah bumbu') || text.includes('batulicin') || text.includes('barito kuala') || text.includes('marabahan') || text.includes('tapin') || text.includes('rantau') || text.includes('hulu sungai') || text.includes('kandangan') || text.includes('barabai') || text.includes('amuntai') || text.includes('tabalong') || text.includes('tanjung tabalong') || text.includes('kota tanjung') || text.includes('balangan') || text.includes('paringin') || text.includes('syamsudin noor') || text.includes('bjm')) {
                return 'kalsel';
            }

            // 1.5 Kalteng
            if (text.includes('kalteng') || text.includes('kalimantan tengah') || text.includes('palangka raya') || text.includes('palangkaraya') || text.includes('kotawaringin') || text.includes('pangkalan bun') || text.includes('sampit') || text.includes('kuala kapuas') || text.includes('barito selatan') || text.includes('buntok') || text.includes('barito utara') || text.includes('muara teweh') || text.includes('sukamara') || text.includes('lamandau') || text.includes('nanga bulik') || text.includes('seruyan') || text.includes('kuala pembuang') || text.includes('katingan') || text.includes('kasongan') || text.includes('pulang pisau') || text.includes('gunung mas') || text.includes('kuala kurun') || text.includes('barito timur') || text.includes('tamiang layang') || text.includes('murung raya') || text.includes('puruk cahu') || text.includes('iskandar') || text.includes('pky')) {
                return 'kalteng';
            }

            // 2. Evaluasi Geografis Ketat (Bounding Coordinate Box)
            if (!isNaN(lat) && !isNaN(lng)) {
                // Kaltara: Bagian paling utara (lat >= 2.5 atau lat >= 1.5 jika lng > 116)
                if (lat >= 2.5 || (lat >= 2.2 && lng >= 115.5 && lng <= 118.5)) {
                    return 'kaltara';
                }
                // Kalbar: Bagian barat (lng <= 114.2)
                if (lng <= 114.2 && lat >= -3.1 && lat <= 2.2) {
                    return 'kalbar';
                }
                // Kalsel: Pojok tenggara (lat <= -1.1 dan lng >= 114.3)
                if (lat <= -1.1 && lng >= 114.3 && lng <= 116.8) {
                    return 'kalsel';
                }
                // Kalteng: Bagian tengah-barat
                if (lng >= 111.0 && lng <= 115.6 && lat >= -3.6 && lat <= 0.8) {
                    return 'kalteng';
                }
                // Kaltim: Bagian timur
                if (lng >= 115.3 && lng <= 119.5 && lat >= -2.5 && lat <= 2.5) {
                    return 'kaltim';
                }
            }

            // Default
            return 'kaltim';
        }

        // 4. Struktur Master Data Marker
        var allMarkersList = [];
        var allLatLngs = [];

        // 4.1 Registrasi Seismograph Markers
        dataSeismographs.forEach(function(item) {
            var lat = parseFloat(item.latitude);
            var lng = parseFloat(item.longitude);
            if (!isNaN(lat) && !isNaN(lng)) {
                allLatLngs.push([lat, lng]);
                var region = detectRegion(item);
                var popupContent = `
                    <div class="popup-header bg-warning text-dark">
                        <i class="fas fa-satellite-dish mr-1"></i> SEISMOGRAPH
                    </div>
                    <div class="popup-body">
                        <h6 class="font-weight-bold text-dark mb-1">${item.nama_site}</h6>
                        <p class="text-muted small mb-2">${item.lokasi}</p>
                        <div class="popup-row">
                            <span class="popup-label">Koordinat:</span>
                            <span class="popup-val">${lat.toFixed(5)}, ${lng.toFixed(5)}</span>
                        </div>
                        <div class="popup-row">
                            <span class="popup-label">Seismometer:</span>
                            <span class="popup-val">${item.seismometer || '-'}</span>
                        </div>
                        <div class="popup-row">
                            <span class="popup-label">Accelerometer:</span>
                            <span class="popup-val">${item.accelerometer || '-'}</span>
                        </div>
                        <div class="popup-row">
                            <span class="popup-label">Digitizer:</span>
                            <span class="popup-val">${item.digitizer || '-'}</span>
                        </div>
                    </div>
                `;
                var marker = L.marker([lat, lng], { icon: iconSeismo })
                    .bindTooltip(`<b>Seismograph:</b> ${item.nama_site} (${item.lokasi})`, { direction: 'top' })
                    .bindPopup(popupContent);

                allMarkersList.push({
                    type: 'seismo',
                    region: region,
                    marker: marker,
                    lat: lat,
                    lng: lng,
                    data: item
                });
            }
        });

        // 4.2 Registrasi Accelerograph Markers
        dataAccelerographs.forEach(function(item) {
            var lat = parseFloat(item.latitude);
            var lng = parseFloat(item.longitude);
            if (!isNaN(lat) && !isNaN(lng)) {
                allLatLngs.push([lat, lng]);
                var region = detectRegion(item);
                var popupContent = `
                    <div class="popup-header bg-success text-white">
                        <i class="fas fa-wave-square mr-1"></i> ACCELEROGRAPH NON COLOCATED
                    </div>
                    <div class="popup-body">
                        <h6 class="font-weight-bold text-dark mb-1">${item.nama}</h6>
                        <p class="text-muted small mb-2">${item.lokasi}</p>
                        <div class="popup-row">
                            <span class="popup-label">Koordinat:</span>
                            <span class="popup-val">${lat.toFixed(5)}, ${lng.toFixed(5)}</span>
                        </div>
                        <div class="popup-row">
                            <span class="popup-label">Merk:</span>
                            <span class="popup-val">${item.merk || '-'}</span>
                        </div>
                        <div class="popup-row">
                            <span class="popup-label">Tipe Sensor:</span>
                            <span class="popup-val">${item.tipe_accelerometer || '-'}</span>
                        </div>
                        <div class="popup-row">
                            <span class="popup-label">Digitizer:</span>
                            <span class="popup-val">${item.digitizer || '-'}</span>
                        </div>
                    </div>
                `;
                var marker = L.marker([lat, lng], { icon: iconAcc })
                    .bindTooltip(`<b>Accelerograph:</b> ${item.nama} (${item.lokasi})`, { direction: 'top' })
                    .bindPopup(popupContent);

                allMarkersList.push({
                    type: 'acc',
                    region: region,
                    marker: marker,
                    lat: lat,
                    lng: lng,
                    data: item
                });
            }
        });

        // 4.3 Registrasi Lightning Detector Markers
        dataLightningDetectors.forEach(function(item) {
            var lat = parseFloat(item.latitude);
            var lng = parseFloat(item.longitude);
            if (!isNaN(lat) && !isNaN(lng)) {
                allLatLngs.push([lat, lng]);
                var region = detectRegion(item);
                var popupContent = `
                    <div class="popup-header text-white" style="background: #0288d1;">
                        <i class="fas fa-bolt-lightning mr-1"></i> LIGHTNING DETECTOR (LD)
                    </div>
                    <div class="popup-body">
                        <h6 class="font-weight-bold text-dark mb-1">${item.nama_site}</h6>
                        <p class="text-muted small mb-2">${item.lokasi}</p>
                        <div class="popup-row">
                            <span class="popup-label">Koordinat:</span>
                            <span class="popup-val">${lat.toFixed(5)}, ${lng.toFixed(5)}</span>
                        </div>
                        <div class="popup-row">
                            <span class="popup-label">Sensor:</span>
                            <span class="popup-val">${item.sensor || '-'}</span>
                        </div>
                        <div class="popup-row">
                            <span class="popup-label">Receiver:</span>
                            <span class="popup-val">${item.receiver || '-'}</span>
                        </div>
                    </div>
                `;
                var marker = L.marker([lat, lng], { icon: iconLd })
                    .bindTooltip(`<b>Lightning Detector:</b> ${item.nama_site} (${item.lokasi})`, { direction: 'top' })
                    .bindPopup(popupContent);

                allMarkersList.push({
                    type: 'ld',
                    region: region,
                    marker: marker,
                    lat: lat,
                    lng: lng,
                    data: item
                });
            }
        });

        // 4.4 Registrasi WRS-NG Markers
        dataWrsNgs.forEach(function(item) {
            var lat = parseFloat(item.latitude);
            var lng = parseFloat(item.longitude);
            if (!isNaN(lat) && !isNaN(lng)) {
                allLatLngs.push([lat, lng]);
                var region = detectRegion(item);
                var popupContent = `
                    <div class="popup-header bg-warning text-dark">
                        <i class="fas fa-tower-broadcast mr-1"></i> WARNING RECEIVER SYSTEM (WRS NG)
                    </div>
                    <div class="popup-body">
                        <h6 class="font-weight-bold text-dark mb-1">${item.nama_site}</h6>
                        <p class="text-muted small mb-2">${item.lokasi}</p>
                        <div class="popup-row">
                            <span class="popup-label">Koordinat:</span>
                            <span class="popup-val">${lat.toFixed(5)}, ${lng.toFixed(5)}</span>
                        </div>
                        <div class="popup-row">
                            <span class="popup-label">Tipe:</span>
                            <span class="popup-val">Diseminasi Peringatan Dini</span>
                        </div>
                    </div>
                `;
                var marker = L.marker([lat, lng], { icon: iconWrs })
                    .bindTooltip(`<b>WRS NG:</b> ${item.nama_site}`, { direction: 'top' })
                    .bindPopup(popupContent);

                allMarkersList.push({
                    type: 'wrs',
                    region: region,
                    marker: marker,
                    lat: lat,
                    lng: lng,
                    data: item
                });
            }
        });

        // 4.5 Registrasi Magnet Prekursor Markers
        dataMagnetPrekursors.forEach(function(item) {
            var lat = parseFloat(item.latitude);
            var lng = parseFloat(item.longitude);
            if (!isNaN(lat) && !isNaN(lng)) {
                allLatLngs.push([lat, lng]);
                var region = detectRegion(item);
                var popupContent = `
                    <div class="popup-header bg-danger text-white">
                        <i class="fas fa-compass mr-1"></i> MAGNET PREKURSOR
                    </div>
                    <div class="popup-body">
                        <h6 class="font-weight-bold text-dark mb-1">${item.nama_site}</h6>
                        <p class="text-muted small mb-2">${item.lokasi}</p>
                        <div class="popup-row">
                            <span class="popup-label">Koordinat:</span>
                            <span class="popup-val">${lat.toFixed(5)}, ${lng.toFixed(5)}</span>
                        </div>
                        <div class="popup-row">
                            <span class="popup-label">Tahun:</span>
                            <span class="popup-val">${item.tahun_instalasi || '-'}</span>
                        </div>
                        <div class="popup-row">
                            <span class="popup-label">Sensor:</span>
                            <span class="popup-val">${item.sensor || '-'}</span>
                        </div>
                        <div class="popup-row">
                            <span class="popup-label">Digitizer:</span>
                            <span class="popup-val">${item.digitizer || '-'}</span>
                        </div>
                    </div>
                `;
                var marker = L.marker([lat, lng], { icon: iconMagnet })
                    .bindTooltip(`<b>Magnet Prekursor:</b> ${item.nama_site} (${item.lokasi})`, { direction: 'top' })
                    .bindPopup(popupContent);

                allMarkersList.push({
                    type: 'magnet',
                    region: region,
                    marker: marker,
                    lat: lat,
                    lng: lng,
                    data: item
                });
            }
        });

        // 5. Region Bounds Mapping
        var currentRegionCode = 'all';
        var regionBounds = {
            'all': [[-4.5, 108.5], [4.5, 119.5]],
            'kalbar': [[-3.1, 108.5], [2.1, 114.2]],
            'kaltim': [[-2.5, 115.3], [2.6, 119.5]],
            'kaltara': [[1.0, 115.2], [4.5, 118.0]],
            'kalsel': [[-4.2, 114.2], [-1.2, 116.6]],
            'kalteng': [[-3.6, 111.0], [0.8, 116.0]]
        };

        // 6. Master Filter Engine (Menggabungkan Wilayah & Checkbox Jenis Alat Aktif)
        function applyMapFilters() {
            var targetRegion = currentRegionCode;
            var showSeismo = $('#filterSeismo').is(':checked');
            var showAcc = $('#filterAcc').is(':checked');
            var showLd = $('#filterLd').is(':checked');
            var showWrs = $('#filterWrs').is(':checked');
            var showMagnet = $('#filterMagnet').is(':checked');

            // Kosongkan layer grup peta
            layerGroupSeismo.clearLayers();
            layerGroupAcc.clearLayers();
            layerGroupLd.clearLayers();
            layerGroupWrs.clearLayers();
            layerGroupMagnet.clearLayers();

            var countSeismo = 0;
            var countAcc = 0;
            var countLd = 0;
            var countWrs = 0;
            var countMagnet = 0;
            var activeFilteredLatLngs = [];

            // Evaluasi setiap marker
            allMarkersList.forEach(function(item) {
                var matchesRegion = (targetRegion === 'all' || item.region === targetRegion);

                if (matchesRegion) {
                    // Hitung total peralatan di region tersebut
                    if (item.type === 'seismo') {
                        countSeismo++;
                        if (showSeismo) {
                            layerGroupSeismo.addLayer(item.marker);
                            activeFilteredLatLngs.push([item.lat, item.lng]);
                        }
                    } else if (item.type === 'acc') {
                        countAcc++;
                        if (showAcc) {
                            layerGroupAcc.addLayer(item.marker);
                            activeFilteredLatLngs.push([item.lat, item.lng]);
                        }
                    } else if (item.type === 'ld') {
                        countLd++;
                        if (showLd) {
                            layerGroupLd.addLayer(item.marker);
                            activeFilteredLatLngs.push([item.lat, item.lng]);
                        }
                    } else if (item.type === 'wrs') {
                        countWrs++;
                        if (showWrs) {
                            layerGroupWrs.addLayer(item.marker);
                            activeFilteredLatLngs.push([item.lat, item.lng]);
                        }
                    } else if (item.type === 'magnet') {
                        countMagnet++;
                        if (showMagnet) {
                            layerGroupMagnet.addLayer(item.marker);
                            activeFilteredLatLngs.push([item.lat, item.lng]);
                        }
                    }
                }
            });

            // Update Counter di Badge Top Filter
            $('#badgeCountSeismo').text(`Seismograph (${countSeismo})`);
            $('#badgeCountAcc').text(`Accelerograph (${countAcc})`);
            $('#badgeCountLd').text(`Lightning Detector (${countLd})`);
            $('#badgeCountWrs').text(`WRS NG (${countWrs})`);
            $('#badgeCountMagnet').text(`Magnet Prekursor (${countMagnet})`);

            // Update Counter di Tabel Legenda GIS Sidebar
            $('#legendCountSeismo').text(countSeismo);
            $('#legendCountAcc').text(countAcc);
            $('#legendCountLd').text(countLd);
            $('#legendCountWrs').text(countWrs);
            $('#legendCountMagnet').text(countMagnet);

            // Tampilkan / Sembunyikan baris legenda berdasarkan checkbox yang aktif
            if (showSeismo) $('#legendRowSeismo').show(); else $('#legendRowSeismo').hide();
            if (showAcc) $('#legendRowAcc').show(); else $('#legendRowAcc').hide();
            if (showLd) $('#legendRowLd').show(); else $('#legendRowLd').hide();
            if (showWrs) $('#legendRowWrs').show(); else $('#legendRowWrs').hide();
            if (showMagnet) $('#legendRowMagnet').show(); else $('#legendRowMagnet').hide();

            return activeFilteredLatLngs;
        }

        // Jalankan inisialisasi filter pertama kali
        applyMapFilters();
        if (allLatLngs.length > 0) {
            map.fitBounds(L.latLngBounds(allLatLngs), { padding: [40, 40] });
        }

        // 7. Interactive Event Listeners
        // 7.1 Filter Wilayah Click Handler
        function filterRegion(regionKey, btnElement, regionTitleText) {
            currentRegionCode = regionKey;
            $('.btn-region').removeClass('active');
            $(btnElement).addClass('active');
            $('#regionTitle').text(regionTitleText);

            var activePoints = applyMapFilters();

            if (regionBounds[regionKey]) {
                map.flyToBounds(regionBounds[regionKey], {
                    padding: [30, 30],
                    duration: 1.2
                });
            } else if (activePoints.length > 0) {
                map.flyToBounds(L.latLngBounds(activePoints), {
                    padding: [40, 40],
                    duration: 1.2
                });
            }
        }

        // 7.2 Checkbox Tampilan Alat Handler
        $('.layer-filter-checkbox').on('change', function() {
            applyMapFilters();
        });

        // 7.3 Reset Map View Handler
        function resetMapView() {
            currentRegionCode = 'all';
            $('.btn-region').removeClass('active');
            $('.btn-region').first().addClass('active');
            $('#regionTitle').text('Wilayah Kalimantan & Sekitarnya');

            // Centang ulang semua checkbox
            $('.layer-filter-checkbox').prop('checked', true);

            applyMapFilters();

            if (allLatLngs.length > 0) {
                map.flyToBounds(L.latLngBounds(allLatLngs), { padding: [40, 40], duration: 1.0 });
            } else {
                map.flyTo([-0.5, 114.5], 6, { duration: 1.0 });
            }
        }

        // 8. Download Map as PNG Image using html2canvas
        function downloadMapImage() {
            var btn = $('#btnDownloadMap');
            var originalHtml = btn.html();
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Memproses Unduhan...');

            var mapContainer = document.getElementById('gisMapContainer');

            var opt = {
                useCORS: true,
                allowTaint: true,
                scale: 2,
                logging: false,
                backgroundColor: '#ffffff'
            };

            html2canvas(mapContainer, opt).then(function(canvas) {
                var now = new Date();
                var pad = function(n) { return n < 10 ? '0' + n : n; };
                var timestamp = now.getFullYear() +
                    pad(now.getMonth() + 1) +
                    pad(now.getDate()) + '_' +
                    pad(now.getHours()) +
                    pad(now.getMinutes()) +
                    pad(now.getSeconds());

                var regionName = currentRegionCode.toUpperCase();
                var filename = 'Peta_Sebaran_Aloptama_BMKG_' + regionName + '_' + timestamp + '.png';

                var link = document.createElement('a');
                link.download = filename;
                link.href = canvas.toDataURL('image/png');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                btn.prop('disabled', false).html(originalHtml);
            }).catch(function(error) {
                console.error('Download map error:', error);
                alert('Terjadi kendala saat mengunduh gambar peta. Silakan coba kembali.');
                btn.prop('disabled', false).html(originalHtml);
            });
        }
    </script>
@endpush
