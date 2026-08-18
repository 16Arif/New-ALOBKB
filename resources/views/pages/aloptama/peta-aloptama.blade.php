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
                                        <polygon points="11,1 21,19 1,19" fill="#ff7800" stroke="#000" stroke-width="2"/>
                                    </svg>
                                    Seismograph ({{ count($seismographs) }})
                                </label>

                                <!-- Accelerograph -->
                                <label class="filter-badge-toggle" for="filterAcc">
                                    <input type="checkbox" id="filterAcc" class="layer-filter-checkbox" data-layer="acc" checked>
                                    <svg width="14" height="12" viewBox="0 0 22 20" class="mr-1">
                                        <polygon points="11,1 21,19 1,19" fill="#00e676" stroke="#000" stroke-width="2"/>
                                    </svg>
                                    Accelerograph ({{ count($accelerographs) }})
                                </label>

                                <!-- LD -->
                                <label class="filter-badge-toggle" for="filterLd">
                                    <input type="checkbox" id="filterLd" class="layer-filter-checkbox" data-layer="ld" checked>
                                    <svg width="14" height="12" viewBox="0 0 22 20" class="mr-1">
                                        <polygon points="11,1 21,19 1,19" fill="#00b0ff" stroke="#000" stroke-width="2"/>
                                    </svg>
                                    Lightning Detector ({{ count($lightningDetectors) }})
                                </label>

                                <!-- WRS NG -->
                                <label class="filter-badge-toggle" for="filterWrs">
                                    <input type="checkbox" id="filterWrs" class="layer-filter-checkbox" data-layer="wrs" checked>
                                    <svg width="14" height="12" viewBox="0 0 22 20" class="mr-1">
                                        <polygon points="11,1 21,19 1,19" fill="#ffea00" stroke="#000" stroke-width="2"/>
                                    </svg>
                                    WRS NG ({{ count($wrsNgs) }})
                                </label>

                                <!-- Magnet Prekursor -->
                                <label class="filter-badge-toggle" for="filterMagnet">
                                    <input type="checkbox" id="filterMagnet" class="layer-filter-checkbox" data-layer="magnet" checked>
                                    <svg width="14" height="12" viewBox="0 0 22 20" class="mr-1">
                                        <polygon points="11,1 21,19 1,19" fill="#ff1744" stroke="#000" stroke-width="2"/>
                                    </svg>
                                    Magnet Prekursor ({{ count($magnetPrekursors) }})
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
                                                <td class="legend-count-cell">{{ count($seismographs) }}</td>
                                            </tr>

                                            <!-- 2. Accelerograph -->
                                            <tr id="legendRowAcc">
                                                <td class="legend-symbol-cell">
                                                    <svg width="22" height="19" viewBox="0 0 22 20">
                                                        <polygon points="11,1 21,19 1,19" fill="#00e676" stroke="#000000" stroke-width="2"/>
                                                    </svg>
                                                </td>
                                                <td class="legend-text-cell">Accelerograph</td>
                                                <td class="legend-count-cell">{{ count($accelerographs) }}</td>
                                            </tr>

                                            <!-- 3. Lightning Detector (LD) -->
                                            <tr id="legendRowLd">
                                                <td class="legend-symbol-cell">
                                                    <svg width="22" height="19" viewBox="0 0 22 20">
                                                        <polygon points="11,1 21,19 1,19" fill="#00b0ff" stroke="#000000" stroke-width="2"/>
                                                    </svg>
                                                </td>
                                                <td class="legend-text-cell">Lightning Detector</td>
                                                <td class="legend-count-cell">{{ count($lightningDetectors) }}</td>
                                            </tr>

                                            <!-- 4. WRS-NG -->
                                            <tr id="legendRowWrs">
                                                <td class="legend-symbol-cell">
                                                    <svg width="22" height="19" viewBox="0 0 22 20">
                                                        <polygon points="11,1 21,19 1,19" fill="#ffea00" stroke="#000000" stroke-width="2"/>
                                                    </svg>
                                                </td>
                                                <td class="legend-text-cell">WRS NG</td>
                                                <td class="legend-count-cell">{{ count($wrsNgs) }}</td>
                                            </tr>

                                            <!-- 5. Magnet Prekursor -->
                                            <tr id="legendRowMagnet">
                                                <td class="legend-symbol-cell">
                                                    <svg width="22" height="19" viewBox="0 0 22 20">
                                                        <polygon points="11,1 21,19 1,19" fill="#ff1744" stroke="#000000" stroke-width="2"/>
                                                    </svg>
                                                </td>
                                                <td class="legend-text-cell">Magnet Prekursor</td>
                                                <td class="legend-count-cell">{{ count($magnetPrekursors) }}</td>
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
        // Data dari Controller
        var dataSeismographs = @json($seismographs);
        var dataAccelerographs = @json($accelerographs);
        var dataLightningDetectors = @json($lightningDetectors);
        var dataWrsNgs = @json($wrsNgs);
        var dataMagnetPrekursors = @json($magnetPrekursors);

        // Layer Groups
        var layerGroupSeismo = L.layerGroup();
        var layerGroupAcc = L.layerGroup();
        var layerGroupLd = L.layerGroup();
        var layerGroupWrs = L.layerGroup();
        var layerGroupMagnet = L.layerGroup();

        // Bounds collector
        var allLatLngs = [];

        // 1. Helper SVG Triangle Icons (Semua Segitiga dengan Warna Berbeda)
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

        // 2. Initialize Leaflet Map
        var map = L.map('mapAloptama', {
            center: [-0.5, 114.5],
            zoom: 6,
            zoomControl: true,
            attributionControl: true
        });

        // Add Base Tile Layer (CartoDB Positron / OpenStreetMap with CORS support)
        var osmTile = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            crossOrigin: true,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add Scale Control
        L.control.scale({
            position: 'bottomleft',
            metric: true,
            imperial: false
        }).addTo(map);

        // Mouse coordinates tracker
        map.on('mousemove', function(e) {
            var lat = e.latlng.lat.toFixed(5);
            var lng = e.latlng.lng.toFixed(5);
            document.getElementById('coordText').innerText = `Lat: ${lat}° , Long: ${lng}°`;
        });

        // 3. Populate Markers (Hanya Segitiga Bersih, Tooltip saat Hover, Popup saat Klik)
        // 3.1 Seismograph Markers
        dataSeismographs.forEach(function(item) {
            var lat = parseFloat(item.latitude);
            var lng = parseFloat(item.longitude);
            if (!isNaN(lat) && !isNaN(lng)) {
                allLatLngs.push([lat, lng]);
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
                layerGroupSeismo.addLayer(marker);
            }
        });

        // 3.2 Accelerograph Markers
        dataAccelerographs.forEach(function(item) {
            var lat = parseFloat(item.latitude);
            var lng = parseFloat(item.longitude);
            if (!isNaN(lat) && !isNaN(lng)) {
                allLatLngs.push([lat, lng]);
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
                layerGroupAcc.addLayer(marker);
            }
        });

        // 3.3 Lightning Detector Markers
        dataLightningDetectors.forEach(function(item) {
            var lat = parseFloat(item.latitude);
            var lng = parseFloat(item.longitude);
            if (!isNaN(lat) && !isNaN(lng)) {
                allLatLngs.push([lat, lng]);
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
                layerGroupLd.addLayer(marker);
            }
        });

        // 3.4 WRS-NG Markers
        dataWrsNgs.forEach(function(item) {
            var lat = parseFloat(item.latitude);
            var lng = parseFloat(item.longitude);
            if (!isNaN(lat) && !isNaN(lng)) {
                allLatLngs.push([lat, lng]);
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
                layerGroupWrs.addLayer(marker);
            }
        });

        // 3.5 Magnet Prekursor Markers
        dataMagnetPrekursors.forEach(function(item) {
            var lat = parseFloat(item.latitude);
            var lng = parseFloat(item.longitude);
            if (!isNaN(lat) && !isNaN(lng)) {
                allLatLngs.push([lat, lng]);
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
                layerGroupMagnet.addLayer(marker);
            }
        });

        // Add all layer groups to map by default
        layerGroupSeismo.addTo(map);
        layerGroupAcc.addTo(map);
        layerGroupLd.addTo(map);
        layerGroupWrs.addTo(map);
        layerGroupMagnet.addTo(map);

        // Auto fit all points
        if (allLatLngs.length > 0) {
            map.fitBounds(L.latLngBounds(allLatLngs), { padding: [40, 40] });
        }

        // 4. Interactive Layer Checkboxes Toggle (From Top Bar & Synchronize Right Legend)
        $('.layer-filter-checkbox').on('change', function() {
            var layerName = $(this).data('layer');
            var isChecked = $(this).is(':checked');

            if (layerName === 'seismo') {
                if (isChecked) {
                    map.addLayer(layerGroupSeismo);
                    $('#legendRowSeismo').show();
                } else {
                    map.removeLayer(layerGroupSeismo);
                    $('#legendRowSeismo').hide();
                }
            } else if (layerName === 'acc') {
                if (isChecked) {
                    map.addLayer(layerGroupAcc);
                    $('#legendRowAcc').show();
                } else {
                    map.removeLayer(layerGroupAcc);
                    $('#legendRowAcc').hide();
                }
            } else if (layerName === 'ld') {
                if (isChecked) {
                    map.addLayer(layerGroupLd);
                    $('#legendRowLd').show();
                } else {
                    map.removeLayer(layerGroupLd);
                    $('#legendRowLd').hide();
                }
            } else if (layerName === 'wrs') {
                if (isChecked) {
                    map.addLayer(layerGroupWrs);
                    $('#legendRowWrs').show();
                } else {
                    map.removeLayer(layerGroupWrs);
                    $('#legendRowWrs').hide();
                }
            } else if (layerName === 'magnet') {
                if (isChecked) {
                    map.addLayer(layerGroupMagnet);
                    $('#legendRowMagnet').show();
                } else {
                    map.removeLayer(layerGroupMagnet);
                    $('#legendRowMagnet').hide();
                }
            }
        });

        // 5. Region Filters
        var currentRegionCode = 'all';
        var regionBounds = {
            'all': [[-4.5, 108.5], [4.5, 119.5]],
            'kalbar': [[-3.1, 108.5], [2.1, 114.2]],
            'kaltim': [[-2.5, 115.5], [2.6, 119.3]],
            'kaltara': [[1.0, 115.2], [4.5, 118.0]],
            'kalsel': [[-4.2, 114.2], [-1.2, 116.6]],
            'kalteng': [[-3.6, 111.0], [0.8, 116.0]]
        };

        function filterRegion(regionKey, btnElement, regionTitleText) {
            currentRegionCode = regionKey;
            $('.btn-region').removeClass('active');
            $(btnElement).addClass('active');
            $('#regionTitle').text(regionTitleText);

            if (regionBounds[regionKey]) {
                map.flyToBounds(regionBounds[regionKey], {
                    padding: [30, 30],
                    duration: 1.2
                });
            }
        }

        function resetMapView() {
            currentRegionCode = 'all';
            $('.btn-region').removeClass('active');
            $('.btn-region').first().addClass('active');
            $('#regionTitle').text('Wilayah Kalimantan & Sekitarnya');

            // re-enable all layer checkboxes and show all legend rows
            $('.layer-filter-checkbox').prop('checked', true).trigger('change');

            if (allLatLngs.length > 0) {
                map.flyToBounds(L.latLngBounds(allLatLngs), { padding: [40, 40], duration: 1.0 });
            } else {
                map.flyTo([-0.5, 114.5], 6, { duration: 1.0 });
            }
        }

        // 6. Download Map as PNG Image using html2canvas
        function downloadMapImage() {
            var btn = $('#btnDownloadMap');
            var originalHtml = btn.html();
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Memproses Unduhan...');

            var mapContainer = document.getElementById('gisMapContainer');

            // Set temporary styles for high-fidelity export
            var opt = {
                useCORS: true,
                allowTaint: true,
                scale: 2, // 2x resolution for crisp graphics
                logging: false,
                backgroundColor: '#ffffff'
            };

            html2canvas(mapContainer, opt).then(function(canvas) {
                // Generate Timestamp YYYYMMDD_HHMMSS
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

                // Trigger browser download
                var link = document.createElement('a');
                link.download = filename;
                link.href = canvas.toDataURL('image/png');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Restore button
                btn.prop('disabled', false).html(originalHtml);
            }).catch(function(error) {
                console.error('Download map error:', error);
                alert('Terjadi kendala saat mengunduh gambar peta. Silakan coba kembali.');
                btn.prop('disabled', false).html(originalHtml);
            });
        }
    </script>
@endpush
