@extends('layouts.app')

@section('title', 'Buat Infografis Gempabumi')

@push('style')
    {{-- (Tidak ada perubahan di bagian style) --}}
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        /* (Tidak ada perubahan di bagian style) */
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

        .arrow-wave {
            display: inline-block;
            font-size: 2rem;
            animation: wave 1s infinite;
        }

        @keyframes wave {
            0% {
                transform: translateY(0);
                opacity: 1;
            }

            50% {
                transform: translateY(10px);
                opacity: 0.5;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* css untuk modal salin gambar */
        .modal-overlay {
            display: none;
            /* Tersembunyi secara default */
            position: fixed;
            z-index: 1050;
            /* Pastikan di atas elemen lain */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            max-width: 720px;
            /* Sedikit lebih besar dari infografis */
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
        }

        .modal-close-button:hover,
        .modal-close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Generate Infografis Gempabumi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Gempabumi</a></div>
                    <div class="breadcrumb-item">Info Gempa</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        <div class="container rounded shadow p-4 my-2 " style="background-color: rgb(98, 116, 143)">
                            <div class="text-center mb-4">
                                <div class="d-flex flex-column align-items-center">
                                    <img src="/img/logo-bmkg.png" alt="logo" style="max-height: 100px" />
                                    <h1 class="h4 mt-4 fw-bold text-dark">Generator Infografis Gempabumi BMKG-BKB</h1>
                                    <p class="text-white mt-2">Masukkan informasi gempa dari BMKG dan buat infografis secara
                                        otomatis</p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="infoText" class="form-label fw-medium text-center w-100 text-white">Format
                                    Parameter Gempa</label>
                                <p class="fw-medium text-center text-white">Teks Berikut Sesuai Dengan Info Dari EXDX</p>
                                <h6 class="text-center mx-auto mb-3 text-dark" style="width: 70%;">
                                    Contoh: Info Gempa Mag:3.2, 08-Jun-25 00:00:16 WIB, Lok:0.68 LU,118.62 BT (141 km
                                    TimurLaut BONTANG-KALTIM), Kedlmn:6 Km ::BMKG-BKB
                                </h6>
                                <h6 class="text-center mx-auto mb-3 text-danger" style="width: 70%;">
                                    Mohon sesuaikan waktu dalam WIB
                                </h6>
                                <textarea id="infoText" rows="4" class="form-control mx-auto" style="width: 70%"
                                    placeholder="Masukkan teks info gempa..."></textarea>
                            </div>

                            <div class="text-end mb-4 d-flex justify-content-center gap-2">
                                <button class="btn btn-danger d-none mx-2" id="resetButton" onclick="resetForm()"><i
                                        class="fa-solid fa-arrow-rotate-right"></i></button>
                                <button class="btn btn-primary" id="generateButton" onclick="generateInfographic()">
                                    <span class="spinner-border spinner-border-sm d-none" role="status"
                                        aria-hidden="true"></span>
                                    <span class="button-text">Buat Infografis</span>
                                </button>
                            </div>

                            <div id="infografisCard" class="d-none text-center w-100">
                                <div class="bg-info text-white fw-bold p-4 text-center mb-3">
                                    <h6>Hasil Infografis Gempa</h6>
                                </div>
                                <div class="text-white fw-bold p-2 text-center mb-5" style="background-color: #b71c1c;">
                                    <span class="arrow-wave">⬇️</span>
                                    Jangan Lupa Simpan Data
                                    <span class="arrow-wave">⬇️</span>
                                </div>
                                <div id="infografisBody" class="card border-info mx-auto" style="max-width: 700px;">
                                    <div class="card-header d-flex justify-content-center align-items-center p-3 rounded-top"
                                        style="background-color: #ffffff;">
                                        <img src="/img/logo-bmkg.png" alt="Logo BMKG" style="height: 48px;" class="mx-5">
                                        <div class="text-end">
                                            <h5 class="text-dark mb-1 fw-semibold">INFORMASI GEMPABUMI WILAYAH KALIMANTAN
                                            </h5>
                                            <h6 class="text-dark mb-1">STASIUN GEOFISIKA BALIKPAPAN</h6>
                                        </div>
                                    </div>
                                    <div id="map" style="height: 500px; overflow: hidden;">
                                        <div class="legend-gempa">
                                            <div class="legend-item">
                                                <div class="legend-icon-red"></div>
                                                <span>Titik Pusat Gempa</span>
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
                                    <div class="" id="parameterOutput"></div>
                                </div>
                                <div class="justify-content-center">
                                    <button class="btn btn-info d-none mx-2" id="saveButton" onclick="saveAsImage()">
                                        <span class="spinner-border spinner-border-sm d-none" role="status"
                                            aria-hidden="true"></span>
                                        <span class="button-text"><i class="fa-solid fa-download"></i> Simpan Gambar</span>
                                    </button>
                                    <button class="btn btn-warning d-none mx-2" id="copyButton" onclick="prepareForCopy()">
                                        <span class="spinner-border spinner-border-sm d-none" role="status"
                                            aria-hidden="true"></span>
                                        <span class="button-text"><i class="fa-solid fa-copy"></i> Salin Gambar</span>
                                    </button>
                                    <button class="btn btn-success d-none glow mx-2" id="createButton"
                                        onclick="submitForm()"><i class="fa-solid fa-save"></i> Simpan Data</button>
                                    <form id="gempaForm" method="POST" action="{{ route('gempabumi.store') }}">
                                        @csrf
                                        <input type="hidden" name="magnitudo" id="inputMagnitudo">
                                        <input type="hidden" name="tanggal" id="inputTanggal">
                                        <input type="hidden" name="waktu" id="inputWaktu">
                                        <input type="hidden" name="lintang" id="inputLintang">
                                        <input type="hidden" name="bujur" id="inputBujur">
                                        <input type="hidden" name="jarak" id="inputJarak">
                                        <input type="hidden" name="kedalaman" id="inputKedalaman">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div id="imageModal" class="modal-overlay">
        <div class="modal-content">
            <span class="modal-close-button">&times;</span>
            <p style="text-align: center; font-weight: bold;">Gambar Siap Disalin</p>
            <img src="" id="modalImage" style="max-width: 100%; border: 1px solid #ddd;" />
            <p style="text-align: center; margin-top: 15px; font-size: 0.9rem;">
                <strong>Desktop:</strong> Klik kanan > "Salin Gambar"<br>
                <strong>Ponsel:</strong> Tekan dan tahan > "Salin Gambar"
            </p>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Library Scripts --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://unpkg.com/leaflet-image/leaflet-image.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>

    {{-- Helper Functions --}}
    <script>
        function submitForm() {
            document.getElementById('gempaForm').submit();
        }

        function resetForm() {
            document.getElementById("infoText").value = "";
            document.getElementById("parameterOutput").innerHTML = "";
            document.getElementById("infografisCard").classList.add("d-none");
            document.getElementById("resetButton").classList.add("d-none");
            document.getElementById("saveButton").classList.add("d-none");
            document.getElementById("copyButton").classList.add("d-none");
            document.getElementById("createButton").classList.add("d-none");
            if (window.gempaMap) {
                window.gempaMap.remove();
                window.gempaMap = null;
            }
        }
    </script>

    {{-- Logic Functions --}}
    <script>
        function tambahLayerSesar(map) {
            // Menghapus fungsi yang redundant, hanya menyisakan satu versi yang lebih baik
            return fetch('/fault/sesar_indonesia.geojson')
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    const canvasRenderer = L.canvas({
                        padding: 0.5
                    });
                    L.geoJSON(data, {
                        renderer: canvasRenderer,
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
                    }).addTo(map);
                })
                .catch(error => console.error('Gagal memuat sesar:', error));
        }

        /**
         * Mengubah sudut derajat (bearing) menjadi 8 arah mata angin.
         * @param {number} bearing - Sudut dalam derajat (-180 hingga 180).
         * @returns {string} - Teks arah mata angin (e.g., "Tenggara").
         */
        function bearingToDirection(bearing) {
            const directions = ['Utara', 'Timur Laut', 'Timur', 'Tenggara', 'Selatan', 'Barat Daya', 'Barat', 'Barat Laut'];
            // Ubah rentang -180/180 menjadi 0-360 derajat
            const degree = (bearing + 360) % 360;
            // Tentukan segmen 45 derajat mana yang cocok
            const index = Math.floor((degree + 22.5) / 45) % 8;
            return directions[index];
        }

        // =================================================================
        // === FUNGSI BARU: Untuk mencari kecamatan berdasarkan koordinat ===
        // =================================================================
        // Gantikan fungsi findDistrictFromCoordinates dengan yang ini
        // Hapus fungsi getProvinceCode() yang lama. Ganti analyzeAffectedArea() dengan yang ini.

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

        // =================================================================
        // === FUNGSI UTAMA: generateInfographic ===
        // =================================================================
        // Ganti fungsi generateInfographic Anda dengan versi yang sudah disempurnakan ini

        async function generateInfographic() {

            // Ambil elemen tombol
            const generateBtn = document.getElementById('generateButton');
            const spinner = generateBtn.querySelector('.spinner-border');
            const btnText = generateBtn.querySelector('.button-text');

            // Tampilkan loader dan nonaktifkan tombol
            generateBtn.disabled = true;
            spinner.classList.remove('d-none');
            btnText.textContent = 'Memproses...';
            try {
                const input = document.getElementById("infoText").value.trim();
                const output = document.getElementById("parameterOutput");
                const card = document.getElementById("infografisCard");

                if (!input) {
                    alert("Masukkan info gempa terlebih dahulu.");
                    return;
                }

                const regex =
                    /Mag:(?<magnitudo>[\d.]+),\s*(?<tanggal>\d{2}-\w{3}-\d{2})\s+(?<waktu>\d{2}:\d{2}:\d{2})\s+WIB,\s*Lok:\s*(?<lintang>[\d.\-]+\s*(LU|LS))\s*[,–-]\s*(?<bujur>[\d.\-]+\s*(BT|BB))\s*\((?<jarak>[^)]+)\),\s*Kedlmn:\s*(?<kedalaman>\d+)\s*Km\s*::(?<sumber>.+)$/i;
                const match = input.match(regex);

                if (!match || !match.groups) {
                    output.innerHTML =
                        `<div class="text-danger p-3">Format tidak sesuai. Harap periksa kembali input Anda.</div>`;
                    card.classList.remove("d-none");
                    return;
                }

                const {
                    magnitudo,
                    tanggal,
                    waktu,
                    lintang,
                    bujur,
                    jarak,
                    kedalaman
                } = match.groups;
                const lat = parseFloat(lintang.replace(/[^\d.-]/g, ''));
                const lon = parseFloat(bujur.replace(/[^\d.-]/g, ''));
                const latFix = /LU/.test(lintang) ? lat : -lat;
                const lonFix = /BT/.test(bujur) ? lon : -lon;

                const analysisResult = await analyzeAffectedArea(latFix, lonFix);

                if (window.gempaMap) window.gempaMap.remove();

                window.gempaMap = L.map('map', {
                    preferCanvas: true
                }).setView([latFix, lonFix], 7);
                L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                    maxZoom: 17,
                    opacity: 0.7,
                    attribution: '© OpenTopoMap'
                }).addTo(window.gempaMap);

                const redIcon = L.divIcon({
                    className: '',
                    html: `<svg width="120" height="120" viewBox="0 0 120 120"><circle cx="60" cy="60" r="60" fill="rgba(182,25,13,0.1)" /><circle cx="60" cy="60" r="30" fill="rgba(182,25,13,0.2)" /><circle cx="60" cy="60" r="8" fill="white" /><circle cx="60" cy="60" r="7" fill="rgb(182,25,13)" /></svg>`,
                    iconSize: [120, 120],
                    iconAnchor: [60, 60]
                });
                L.marker([latFix, lonFix], {
                    icon: redIcon
                }).addTo(window.gempaMap).bindPopup(
                    `<strong>Gempa ${magnitudo}</strong><br>${jarak}<br>Kedalaman ${kedalaman} Km`);

                setTimeout(() => window.gempaMap.invalidateSize(), 200);

                let locationHtml = '';
                if (analysisResult && analysisResult.nearest.length > 0) {

                    const nearestHtml = analysisResult.nearest.map(loc => {
                        const distance = loc.distance.toFixed(2);
                        const direction = loc
                            .direction; // Data arah mata angin yang benar dari 'analyzeAffectedArea'
                        const district = loc.district;
                        const regency = loc.regency;
                        return `<strong>${distance} km arah ${direction}</strong> Kec. ${district} ( ${regency})`;
                    }).join('<br>');

                    locationHtml = `
                <div class="col-12 mt-2">
                    <i class="bi bi-compass me-2 text-success"></i>
                    <h6 class="d-inline">Kecamatan Terdekat dari Pusat Gempa:</h6>
                    <div class="ms-4 fw-semibold" style="line-height: 1.6;">${nearestHtml}</div>
                </div>
            `;
                } else {
                    locationHtml =
                        `<div class="col-12 mt-2"><i class="bi bi-exclamation-triangle-fill me-2 text-warning"></i><h6 class="d-inline">Informasi Wilayah Tidak Tersedia</h6></div>`;
                }

                output.innerHTML = `
                    <div class="d-flex flex-wrap w-100">
                        <div class="text-white text-center d-flex flex-column justify-content-center align-items-center p-4" style="width: 25%; background-color: #CB0404;">
                            <h4 class="fw-bold text-uppercase" style="font-weight: 900;">Magnitudo</h4>
                            <h1 class="display-3 fw-bold mb-0" style="font-weight: 900;">${magnitudo}</h1>
                        </div>
                        <div class="p-4 text-dark" style="width: 75%; background-color: #ffffff;">
                            <div class="row">
                                <div class="col-md-3">
                                    <i class="bi bi-calendar-event me-2"></i><h6 class="d-inline"> Waktu:</h6>
                                    <h6 class="ms-1 fw-semibold">${tanggal} <br> ${waktu} WIB</h6>
                                </div>
                                <div class="col-5">
                                    <i class="bi bi-geo-alt-fill me-2 text-danger"></i><h6 class="d-inline"> Lokasi:</h6>
                                    <h6 class="ms-1 fw-semibold">${lintang}, ${bujur}<br>${jarak}</h6>
                                </div>
                                <div class="col-md-4">
                                    <i class="bi bi-graph-down me-2"></i><h6 class="d-inline"> Kedalaman:</h6>
                                    <h6 class="ms-1 fw-semibold">${kedalaman} Km</h6>
                                </div>
                                ${locationHtml}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center px-3 py-2 text-white" style="background-color: #002147;">
                        <span><i class="bi bi-instagram"></i> stageof.balikpapan.bmkg</span>
                        <span><i class="bi bi-heart-fill text-danger"></i> Stasiun Geofisika Balikpapan</span>
                        <span><i class="bi bi-whatsapp"></i> 0811-5926-543</span>
                    </div>`;

                tambahLayerSesar(window.gempaMap);
                card.classList.remove("d-none");
                document.getElementById("resetButton").classList.remove("d-none");
                document.getElementById("saveButton").classList.remove("d-none");
                document.getElementById("copyButton").classList.remove("d-none");
                document.getElementById("createButton").classList.remove("d-none");

                document.getElementById("inputMagnitudo").value = magnitudo;
                document.getElementById("inputTanggal").value = tanggal;
                document.getElementById("inputWaktu").value = waktu;
                document.getElementById("inputLintang").value = lintang;
                document.getElementById("inputBujur").value = bujur;
                document.getElementById("inputJarak").value = jarak;
                document.getElementById("inputKedalaman").value = kedalaman.trim();

                setTimeout(() => {
                    document.getElementById("infografisCard").scrollIntoView({
                        behavior: "smooth"
                    });
                }, 300);

            } catch (error) {
                console.error("Terjadi error saat generate infografis:", error.message);
                if (error.message !== "Input kosong" && error.message !== "Format tidak sesuai") {
                    alert("Terjadi kesalahan saat memproses data. Silakan coba lagi.");
                }
            } finally {
                generateBtn.disabled = false;
                spinner.classList.add('d-none');
                btnText.textContent = 'Buat Infografis';
            }
        }
    </script>

    {{-- Screenshot Function --}}
    <script>
        function saveAsImage() {
            const card = document.getElementById("infografisBody");

            // Ambil elemen tombol
            const saveBtn = document.getElementById('saveButton');
            const spinner = saveBtn.querySelector('.spinner-border');

            // Tampilkan loader dan nonaktifkan tombol
            saveBtn.disabled = true;
            spinner.classList.remove('d-none');

            // Ambil tanggal untuk nama file
            const tanggalRaw = document.getElementById("inputTanggal").value || "";
            let formattedDate = "unknown";
            const match = tanggalRaw.match(/(\d{2})-(\w{3})-(\d{2})/);
            if (match) {
                const [_, day, month, year] = match;
                formattedDate = `${year.toLowerCase()}${month.toLowerCase()}${day}`;
            }

            const jamRaw = document.getElementById("inputWaktu").value || "";

            setTimeout(() => {
                html2canvas(card, {
                        useCORS: true,
                        backgroundColor: null,
                        scale: 2
                    })
                    .then(canvas => {
                        const link = document.createElement("a");
                        link.download = `infografis-gempa-${formattedDate}-${jamRaw}.png`;
                        link.href = canvas.toDataURL("image/png");
                        link.click();
                    })
                    .catch(err => {
                        console.error("Gagal menyimpan gambar:", err);
                        alert("Gagal menyimpan gambar. Silakan coba lagi.");
                    })
                    .finally(() => {
                        // Sembunyikan loader dan aktifkan kembali tombol setelah selesai (baik berhasil maupun gagal)
                        saveBtn.disabled = false;
                        spinner.classList.add('d-none');
                    });
            }, 500); // Penundaan singkat untuk render peta
        }
    </script>

    {{-- ▼▼▼ FUNGSI UNTUK SALIN GAMBAR ▼▼▼ --}}
    <script>
        // --- Fungsi baru untuk fitur "Salin Gambar" ---
        function prepareForCopy() {
            const card = document.getElementById("infografisBody");
            const copyBtn = document.getElementById('copyButton');
            const spinner = copyBtn.querySelector('.spinner-border');

            // Tampilkan loader
            copyBtn.disabled = true;
            spinner.classList.remove('d-none');

            html2canvas(card, {
                    useCORS: true,
                    backgroundColor: null,
                    scale: 2
                })
                .then(canvas => {
                    const modal = document.getElementById('imageModal');
                    const modalImg = document.getElementById('modalImage');

                    // Masukkan gambar hasil render ke dalam modal
                    modalImg.src = canvas.toDataURL('image/png');

                    // Tampilkan modal
                    modal.style.display = 'block';
                })
                .catch(err => {
                    console.error("Gagal membuat gambar untuk disalin:", err);
                    alert("Terjadi kesalahan saat menyiapkan gambar.");
                })
                .finally(() => {
                    // Sembunyikan loader
                    copyBtn.disabled = false;
                    spinner.classList.add('d-none');
                });
        }

        // --- Logika untuk mengontrol modal (buka/tutup) ---
        document.addEventListener('DOMContentLoaded', (event) => {
            const modal = document.getElementById('imageModal');
            const closeBtn = document.querySelector('.modal-close-button');

            // Fungsi untuk menutup modal
            function closeModal() {
                modal.style.display = 'none';
            }

            // Tutup modal jika tombol close (x) diklik
            closeBtn.onclick = closeModal;

            // Tutup modal jika area gelap di luar gambar diklik
            window.onclick = function(event) {
                if (event.target == modal) {
                    closeModal();
                }
            }
        });
    </script>
@endpush
