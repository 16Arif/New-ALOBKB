@extends('layouts.app')

@section('title', 'Infografis Gempabumi')

@push('style')
    {{-- Mempertahankan Style Persis Kode Asli --}}
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        /* Mempertahankan seluruh CSS asli kamu termasuk animasi */
        .legend-gempa {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 4px;
            gap: 6px;
        }

        .legend-icon-red {
            width: 14px;
            height: 14px;
            background-color: red;
            border-radius: 50%;
            border: 2px solid white;
        }

        @keyframes glow {

            0%,
            50%,
            100% {
                box-shadow: 0 0 5px #28a745, 0 0 15px #28a745, 0 0 30px #28a745;
            }

            50% {
                box-shadow: 0 0 2px #28a745, 0 0 5px #28a745, 0 0 10px #28a745;
            }
        }

        .glow {
            animation: glow 1s infinite;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }

        #modal-content-image {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            max-width: 720px;
            border-radius: 8px;
            position: relative;
        }

        .modal-close-button {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.7;
            }

            50% {
                transform: scale(1.05);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 0.7;
            }
        }

        .reminder-pulse {
            animation: pulse 2s infinite;
        }

        .modal-image-preview {
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }

        .modal-textarea {
            width: 100%;
            padding: 10px;
            font-size: 12px;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Infografis Gempabumi</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="container rounded shadow p-4 my-2" style="background-color: rgb(98, 116, 143)">

                            {{-- Container Tombol - Langsung Muncul karena data sudah ada --}}
                            <div id="infografisCard" class="text-center w-100">
                                <div id="reminderText" class="text-white fw-bold reminder-pulse mb-3">
                                    <i class="fa-solid fa-arrow-down"></i> Review Infografis Sebelum Dibagikan <i
                                        class="fa-solid fa-arrow-down"></i>
                                </div>

                                <div class="d-flex justify-content-center my-3" style="gap: 20px;">
                                    <button class="btn btn-light border" onclick="resetMap()">
                                        <i class="fa-solid fa-arrows-rotate"></i> Refresh Peta
                                    </button>

                                    <button class="btn btn-info" id="saveButton" onclick="saveAsImage()">
                                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                                        <span class="button-text"><i class="fa-solid fa-download"></i> Simpan Gambar</span>
                                    </button>

                                    <button class="btn btn-warning" id="copyAndShare" onclick="prepareForCopy()">
                                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                                        <span class="button-text"><i class="fa-solid fa-share-alt"></i> Salin &
                                            Bagikan</span>
                                    </button>

                                    <a href="{{ route('gempabumi.index') }}" class="btn btn-danger"><i
                                            class="fa-solid fa-arrow-left"></i> Kembali</a>
                                </div>

                                {{-- Template Infografis - Persis Kode Kamu --}}
                                <div id="infografisBody" class="card border-info mx-auto" style="max-width: 700px;">
                                    <div class="card-header d-flex justify-content-between align-items-center p-3 rounded-top"
                                        style="background-color: #e7ebff;">
                                        <img class="ml-5" src="/img/logo-bmkg.png" alt="Logo BMKG" style="height: 65px;">
                                        <div class="mr-5">
                                            <h5 class="text-dark mb-1" style="font-weight: 900;">INFORMASI GEMPABUMI
                                                WILAYAH KALIMANTAN</h5>
                                            <h5 class="text-dark mb-1 fw-semibold">PUSAT GEMPA REGIONAL XI</h5>
                                            <p class="text-dark mb-1 fw-normal">STASIUN GEOFISIKA BALIKPAPAN</p>
                                        </div>
                                    </div>
                                    <div id="map" style="height: 500px; overflow: hidden; position: relative;">
                                        <div class="legend-gempa">
                                            <div class="legend-item">
                                                <div class="legend-icon-red"></div><span>Titik Pusat Gempa</span>
                                            </div>
                                            <div class="legend-item">
                                                <svg width="20" height="10">
                                                    <line x1="0" y1="5" x2="20" y2="5"
                                                        stroke="#393E46" stroke-width="2" stroke-dasharray="5,5" />
                                                </svg>
                                                <span>Garis Sesar</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="parameterOutput">
                                        {{-- Akan diisi via JS --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Modal Salin Gambar Persis Kode Kamu --}}
    <div id="imageModal" class="modal-overlay">
        <div class="modal-content" id="modal-content-image">
            <span class="modal-close-button" onclick="closeModal()">&times;</span>
            <p class="modal-title fw-bold">Siap Dibagikan</p>
            <p class="modal-instructions small"><strong>Untuk Gambar:</strong> Klik kanan > "Salin Gambar"</p>
            <img src="" id="modalImage" class="modal-image-preview" />
            <p class="modal-instructions fw-bold small">Untuk Teks:</p>
            <textarea id="modalText" class="modal-textarea" readonly rows="5"></textarea>
            <button id="copyTextButton" class="btn btn-primary btn-sm mt-2">Salin Teks</button>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>

    <script>
        // 1. Variabel Global (Data Awal)
        const g = @json($gempa);

        // 2. Variabel Global (Wadah Map)
        let infografisMap = null;
        let epicenterCoords = null;

        document.addEventListener('DOMContentLoaded', function() {
            initInfographic();
        });

        async function initInfographic() {
            // Mapping koordinat
            const latRaw = parseFloat(g.lintang.replace(/[^\d.-]/g, ''));
            const lonRaw = parseFloat(g.bujur.replace(/[^\d.-]/g, ''));
            const lat = /LS/.test(g.lintang) ? -latRaw : latRaw;
            const lon = /BB/.test(g.bujur) ? -lonRaw : lonRaw;

            // SIMPAN KOORDINAT KE VARIABEL GLOBAL
            epicenterCoords = [lat, lon];

            // GUNAKAN VARIABEL GLOBAL (Hapus 'const' agar mengisi infografisMap di atas)
            infografisMap = L.map('map', {
                preferCanvas: true,
                zoomControl: false
            }).setView(epicenterCoords, 7); // Gunakan epicenterCoords

            L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                opacity: 0.7
            }).addTo(infografisMap);

            const redIcon = L.divIcon({
                className: '',
                html: `<svg width="120" height="120" viewBox="0 0 120 120"><circle cx="60" cy="60" r="60" fill="rgba(182,25,13,0.1)" /><circle cx="60" cy="60" r="30" fill="rgba(182,25,13,0.2)" /><circle cx="60" cy="60" r="8" fill="white" /><circle cx="60" cy="60" r="7" fill="rgb(182,25,13)" /></svg>`,
                iconSize: [120, 120],
                iconAnchor: [60, 60]
            });

            L.marker(epicenterCoords, {
                icon: redIcon
            }).addTo(infografisMap);

            // Layer Sesar
            fetch('/fault/sesar_indonesia.geojson').then(r => r.json()).then(data => {
                L.geoJSON(data, {
                    style: {
                        color: '#393E46',
                        weight: 2,
                        dashArray: '5,5',
                        opacity: 0.8
                    }
                }).addTo(map);
            });

            // --- FETCH SESAR (GARIS SESAR INDONESIA) ---
            fetch('/fault/sesar_indonesia.geojson')
                .then(response => {
                    if (!response.ok) throw new Error('Gagal memuat data sesar');
                    return response.json();
                })
                .then(data => {
                    L.geoJSON(data, {
                        style: {
                            color: '#393E46',
                            weight: 2,
                            dashArray: '5,5',
                            opacity: 0.8
                        },
                        onEachFeature: (feature, layer) => {
                            if (feature.properties && feature.properties.name) {
                                layer.bindPopup(`Sesar: ${feature.properties.name}`);
                            }
                        }
                    }).addTo(infografisMap);
                })
                .catch(error => console.error('Error Sesar:', error));

            // Analisis Spasial
            const analysis = await analyzeAffectedArea(lat, lon);
            const nearestHtml = analysis.nearest.map(loc =>
                `<strong>${loc.distance.toFixed(2)} km ${loc.direction}</strong> Kec. ${loc.district} (${loc.regency})`
            ).join('<br>');

            // Output Parameter - PERSIS STRUKTUR KODE ASLI KAMU
            document.getElementById("parameterOutput").innerHTML = `
                <div class="d-flex flex-wrap w-100">
                    <div class="text-white text-center d-flex flex-column justify-content-center align-items-center p-4" style="width: 25%; background-color: #CB0404;">
                        <h4 class="fw-bold text-uppercase" style="font-weight: 900;">Magnitudo</h4>
                        <h1 class="display-3 fw-bold mb-0" style="font-weight: 900;">${g.magnitudo}</h1>
                    </div>
                    <div class="p-4 text-dark text-center" style="width: 75%; background-color: #e7ebff;">
                        <div class="row">
                            <div class="col-md-3">
                                <i class="bi bi-calendar-event me-2"></i><h6 class="d-inline"> Waktu:</h6>
                                <h6 class="ms-1 fw-semibold">${g.tanggal.includes('T') ? g.tanggal.split('T')[0] : g.tanggal} <br> ${g.waktu} WIB</h6>
                            </div>
                            <div class="col-5">
                                <i class="bi bi-geo-alt-fill me-2 text-danger"></i><h6 class="d-inline"> Lokasi:</h6>
                                <h6 class="ms-1 fw-semibold">${g.lintang}, ${g.bujur}<br>${g.jarak}</h6>
                            </div>
                            <div class="col-md-4">
                                <i class="bi bi-graph-down me-2"></i><h6 class="d-inline"> Kedalaman:</h6>
                                <h6 class="ms-1 fw-semibold">${g.kedalaman} Km</h6>
                            </div>
                            <div class="col-12 mt-2">
                                <i class="bi bi-compass me-2 text-success"></i>
                                <h6 class="d-inline">Kecamatan Terdekat dari Pusat Gempa:</h6>
                                <div class="ms-4 fw-semibold" style="line-height: 1.5; font-size: 0.85rem">${nearestHtml}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center px-3 py-2 text-white" style="background-color: #002147; font-size: 12px;">
                    <span><i class="bi bi-instagram"></i> stageof.balikpapan.bmkg</span>
                    <span><i class="bi bi-heart-fill text-danger"></i> Stasiun Geofisika Balikpapan</span>
                    <span><i class="bi bi-facebook"></i> stageof.balikpapan.bmkg</span>
                </div>`;
        }

        // Fungsi screenshot & share persis aslinya
        function saveAsImage() {
            const saveBtn = document.getElementById('saveButton');
            saveBtn.disabled = true;
            saveBtn.querySelector('.spinner-border').classList.remove('d-none');

            html2canvas(document.getElementById("infografisBody"), {
                useCORS: true,
                scale: 2
            }).then(canvas => {
                const link = document.createElement("a");
                link.download = `Infografis_Gempa_${g.tanggal}.png`;
                link.href = canvas.toDataURL("image/png");
                link.click();
                saveBtn.disabled = false;
                saveBtn.querySelector('.spinner-border').classList.add('d-none');
            });
        }

        function prepareForCopy() {
            const copyBtn = document.getElementById('copyAndShare');
            copyBtn.disabled = true;
            copyBtn.querySelector('.spinner-border').classList.remove('d-none');

            html2canvas(document.getElementById("infografisBody"), {
                useCORS: true,
                scale: 2
            }).then(canvas => {
                document.getElementById('modalImage').src = canvas.toDataURL('image/png');
                document.getElementById('modalText').value =
                    `Info Gempa Mag: ${g.magnitudo}, ${g.tanggal} ${g.waktu} WIB, Lok: ${g.lintang}, ${g.bujur} (${g.jarak}), Kedlmn: ${g.kedalaman} Km ::BMKG-BKI`;
                document.getElementById('imageModal').style.display = 'block';
                copyBtn.disabled = false;
                copyBtn.querySelector('.spinner-border').classList.add('d-none');
            });
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        document.getElementById('copyTextButton').onclick = function() {
            navigator.clipboard.writeText(document.getElementById('modalText').value).then(() => {
                this.textContent = 'Tersalin!';
                setTimeout(() => this.textContent = 'Salin Teks', 2000);
            });
        };

        // Fungsi pendukung GIS
        function bearingToDirection(bearing) {
            const directions = ['Utara', 'Timur Laut', 'Timur', 'Tenggara', 'Selatan', 'Barat Daya', 'Barat', 'Barat Laut'];
            const degree = (bearing + 360) % 360;
            return directions[Math.floor((degree + 22.5) / 45) % 8];
        }

        async function analyzeAffectedArea(lat, lon) {
            const searchRadiusKm = 50;
            const earthquakePoint = turf.point([lon, lat]);
            const searchArea = turf.buffer(earthquakePoint, searchRadiusKm, {
                units: 'kilometers'
            });
            const provinceBounds = [{
                    code: '61',
                    bounds: [108.5, -3.5, 114.0, 2.2]
                }, {
                    code: '62',
                    bounds: [110.7, -3.6, 116.0, 1.7]
                },
                {
                    code: '63',
                    bounds: [114.3, -4.2, 116.6, -1.3]
                }, {
                    code: '64',
                    bounds: [113.8, -2.6, 119.0, 2.4]
                },
                {
                    code: '65',
                    bounds: [114.6, 1.3, 118.1, 4.2]
                }, {
                    code: '72',
                    bounds: [119.3, -3.8, 124.5, 2.0]
                },
                {
                    code: '76',
                    bounds: [118.7, -3.6, 120.0, -0.7]
                }
            ];

            let primaryProvinceCode = null;
            const candidateProvinces = [];
            for (const province of provinceBounds) {
                const provincePolygon = turf.bboxPolygon(province.bounds);
                if (turf.booleanPointInPolygon(earthquakePoint, provincePolygon)) {
                    primaryProvinceCode = province.code;
                }
                if (turf.booleanIntersects(searchArea, provincePolygon)) {
                    candidateProvinces.push(province.code);
                }
            }

            if (candidateProvinces.length === 0) {
                return {
                    containing: {
                        district: "Luar Cakupan Wilayah",
                        regency: ""
                    },
                    nearest: []
                };
            }

            try {
                const fetchPromises = candidateProvinces.map(code => fetch(`/districts/id${code}_district.geojson`)
                    .then(res => res.json()));
                const allGeojsonData = await Promise.all(fetchPromises);
                const allFeatures = allGeojsonData.flatMap(data => data.features);

                let containingDistrict = null;
                const allDistances = [];

                for (const feature of allFeatures) {
                    if (primaryProvinceCode && feature.properties.province_code === `id${primaryProvinceCode}`) {
                        if (!containingDistrict && turf.booleanPointInPolygon(earthquakePoint, feature.geometry)) {
                            containingDistrict = {
                                district: feature.properties.district,
                                regency: feature.properties.regency
                            };
                        }
                    }
                    const centroid = turf.centroid(feature.geometry);
                    const distance = turf.distance(earthquakePoint, centroid, {
                        units: 'kilometers'
                    });
                    allDistances.push({
                        district: feature.properties.district,
                        regency: feature.properties.regency,
                        distance: distance,
                        centroid: centroid // Penting: simpan centroid untuk perhitungan arah
                    });
                }

                const districtMap = new Map();
                for (const item of allDistances) {
                    const key = `${item.district}|${item.regency}`;
                    if (!districtMap.has(key) || item.distance < districtMap.get(key).distance) {
                        districtMap.set(key, item);
                    }
                }

                const uniqueDistricts = Array.from(districtMap.values());
                uniqueDistricts.sort((a, b) => a.distance - b.distance);

                const nearestDistricts = uniqueDistricts.slice(0, 3);

                // === TAMBAHAN BARU: Hitung dan tambahkan arah untuk 3 kecamatan teratas ===
                const finalNearestList = nearestDistricts.map(district => {
                    const bearing = turf.bearing(district.centroid, earthquakePoint);
                    const direction = bearingToDirection(bearing);
                    return {
                        ...district,
                        direction: direction
                    }; // Tambahkan properti 'direction'
                });
                // =======================================================================

                return {
                    containing: containingDistrict,
                    nearest: finalNearestList, // Kembalikan daftar yang sudah ada arahnya
                };

            } catch (error) {
                console.error('Gagal memproses data GeoJSON gabungan:', error);
                return null;
            }
        }


        function resetMap() {
            if (infografisMap && epicenterCoords) {
                // Kembalikan ke titik pusat dengan zoom level 8
                infografisMap.flyTo(epicenterCoords, 7, {
                    duration: 1.5 // Memberikan efek transisi halus saat berpindah
                });
            }
        }
    </script>
@endpush
