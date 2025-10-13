@extends('layouts.app')

@section('title', 'create2 Buat Infografis Gempabumi')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
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

        /* panah instruksi save  */
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

                            <!-- Header -->
                            <div class="text-center mb-4">
                                <div class="d-flex flex-column align-items-center">
                                    <img src="/img/logo-bmkg.png" alt="logo" style="max-height: 100px" />
                                    <h1 class="h4 mt-4 fw-bold text-dark">
                                        Generator Infografis Gempabumi BMKG-BKB
                                    </h1>
                                    <p class="text-white mt-2">Masukkan informasi gempa dari BMKG dan buat infografis secara
                                        otomatis</p>
                                </div>
                            </div>

                            <!-- Input -->
                            <div class="mb-4">
                                <label for="infoText" class="form-label fw-medium text-center w-100 text-white">Format
                                    Parameter
                                    Gempa</label>
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

                            <!-- Tombol -->
                            <div class="text-end mb-4 d-flex justify-content-center gap-2">

                                <button class="btn btn-danger d-none mx-2" id="resetButton" onclick="resetForm()"><i
                                        class="fa-solid fa-arrow-rotate-right"></i></button>

                                <button class="btn btn-primary" onclick="generateInfographic()">Buat Infografis</button>

                            </div>


                            <!-- Output -->
                            <div id="infografisCard" class="d-none text-center w-100">
                                <div class="bg-info text-white fw-bold p-4 text-center mb-3">
                                    <h6>
                                        Hasil Infografis Gempa
                                    </h6>
                                </div>

                                <div class="text-white fw-bold p-2 text-center mb-5" style="background-color: #b71c1c;">
                                    <span class="arrow-wave">⬇️</span>

                                    Jangan Lupa Simpan Data

                                    <span class="arrow-wave">⬇️</span>
                                </div>
                                <div id="infografisBody" class="card border-info mx-auto" style="max-width: 700px;">

                                    <!-- Header Info Gempa -->
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
                                    {{-- <small class="text-muted">
                                        Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ" — disesuaikan untuk
                                        keperluan infografis Stasiun
                                        Geofisika Balikpapan
                                    </small> --}}

                                    <div class="" id="parameterOutput"></div>
                                </div>
                                <div class="justify-content-center">


                                    <button class="btn btn-info d-none mx-4" id="saveButton" onclick="saveAsImage()"><i
                                            class="fa-solid fa-download"></i> Simpan
                                        Gambar</button>


                                    {{-- bagian untuk simpan data ke database --}}
                                    <button class="btn btn-success d-none glow" id="createButton" onclick="submitForm()"><i
                                            class="fa-solid fa-save"></i>
                                        Simpan
                                        Data</button>

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
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://unpkg.com/leaflet-image/leaflet-image.js"></script>


    {{--  Fungsi untuk reset form dan submit --}}
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
            document.getElementById("createButton").classList.add("d-none");

            if (window.gempaMap) {
                window.gempaMap.remove();
                window.gempaMap = null;
            }
        }
    </script>


    <script>
        function tambahLayerSesar(map) {
            fetch('/fault/sesar_indonesia.geojson')
                .then(response => response.json())
                .then(data => {
                    // Gunakan renderer canvas, bukan SVG
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
    </script>





    {{--  Fungsi utama generateInfographic --}}
    <script>
        async function generateInfographic() {


            const input = document.getElementById("infoText").value.trim();
            const output = document.getElementById("parameterOutput");
            const card = document.getElementById("infografisCard");

            if (!input) {
                alert("Masukkan info gempa terlebih dahulu.");
                return;
            }

            const regex =
                /Mag:(?<magnitudo>[\d.]+),\s*(?<tanggal>\d{2}-\w{3}-\d{2})\s+(?<waktu>\d{2}:\d{2}:\d{2})\s+WIB,\s*Lok:\s*(?<lintang>[\d.\-]+\s*(LU|LS))\s*[,–-]\s*(?<bujur>[\d.\-]+\s*(BT|BB))\s*\((?<jarak>[^)]+)\),\s*Kedlmn:\s*(?<kedalaman>\d+\s)Km\s*::(?<sumber>.+)$/i;

            const match = input.match(regex);

            if (!match || !match.groups) {
                output.innerHTML =
                    `<div class="text-danger">Format tidak sesuai. Harap ikuti contoh:<br><code>Info Gempa Mag:3.2, 08-Jun-25 00:00:16 WIB, Lok:0.68 LU,118.62 BT (141 km TimurLaut BONTANG-KALTIM), Kedlmn:6 Km ::BMKG-BKB</code></div>`;
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

            // parsing koordinat
            const lat = parseFloat(lintang.replace(/[^\d.-]/g, ''));
            const lon = parseFloat(bujur.replace(/[^\d.-]/g, ''));
            const latFix = /LU/.test(lintang) ? lat : -lat;
            const lonFix = /BT/.test(bujur) ? lon : -lon;

            // reset map jika sudah ada
            if (window.gempaMap) {
                window.gempaMap.remove();
            }

            // buat peta utama
            // window.gempaMap = L.map('map').setView([latFix, lonFix], 7);
            window.gempaMap = L.map('map', {
                preferCanvas: true
            }).setView([lat, lon], 7);


            L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                maxZoom: 17,
                opacity: 0.7,
                attribution: '© OpenTopoMap'
            }).addTo(window.gempaMap);

            // tambah marker gempa
            const redIcon = L.divIcon({
                className: '',
                html: `
                    <svg width="120" height="120" viewBox="0 0 120 120">
                        <circle cx="60" cy="60" r="60" fill="rgba(182,25,13,0.1)" />
                        <circle cx="60" cy="60" r="30" fill="rgba(182,25,13,0.2)" />
                        <circle cx="60" cy="60" r="8" fill="white" />
                        <circle cx="60" cy="60" r="7" fill="rgb(182,25,13)" />
                    </svg>`,
                iconSize: [120, 120],
                iconAnchor: [60, 60]
            });

            L.marker([latFix, lonFix], {
                    icon: redIcon
                })
                .addTo(window.gempaMap)
                .bindPopup(`<strong>Gempa ${magnitudo}</strong><br>${jarak}<br>Kedalaman ${kedalaman} Km`);

            // pastikan ukuran peta sudah valid
            setTimeout(() => window.gempaMap.invalidateSize(), 200);


            // tampilkan output parameter
            output.innerHTML = `
                <div class="d-flex flex-wrap w-100">
                    <div class="text-white text-center d-flex flex-column justify-content-center align-items-center p-4" style="width: 25%; background-color: #CB0404;">
                        <h4 class="fw-bold text-uppercase">Magnitudo</h4>
                        <h1 class="display-3 fw-bold mb-0">${magnitudo}</h1>
                    </div>
                    <div class="p-4 text-dark" style="width: 75%; background-color: #ffffff;">
                        <div class="row">
                            <div class="col-md-6">
                                <i class="bi bi-calendar-event me-2"></i>
                                <h5 class="d-inline">Waktu:</h5>
                                <h6 class="ms-1 fw-semibold">${tanggal} <br> ${waktu} WIB</h6>
                            </div>
                            <div class="col-md-6">
                                <i class="bi bi-graph-down me-2"></i>
                                <h5 class="d-inline">Kedalaman:</h5>
                                <h6 class="ms-1 fw-semibold">${kedalaman} Km</h6>
                            </div>
                            <div class="col-12">
                                <i class="bi bi-geo-alt-fill me-2 text-danger"></i>
                                <h5 class="d-inline">Lokasi:</h5>
                                <h6 class="ms-1 fw-semibold">${lintang}, ${bujur}<br>${jarak}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center px-3 py-2 text-white" style="background-color: #002147;">
                    <span><i class="bi bi-instagram"></i> stageof.balikpapan.bmkg</span>
                    <span><i class="bi bi-heart-fill text-danger"></i> Stasiun Geofisika Balikpapan</span>
                    <span><i class="bi bi-whatsapp"></i> 0811-5926-543</span>
                </div>`;

            tambahLayerSesar(window.gempaMap).then(() => {
                console.log('Layer sesar sudah siap');
            });


            // tampilkan tombol & card
            card.classList.remove("d-none");
            document.getElementById("resetButton").classList.remove("d-none");
            document.getElementById("saveButton").classList.remove("d-none");
            document.getElementById("createButton").classList.remove("d-none");

            // isi form untuk database
            document.getElementById("inputMagnitudo").value = magnitudo;
            document.getElementById("inputTanggal").value = tanggal;
            document.getElementById("inputWaktu").value = waktu;
            document.getElementById("inputLintang").value = lintang;
            document.getElementById("inputBujur").value = bujur;
            document.getElementById("inputJarak").value = jarak;
            document.getElementById("inputKedalaman").value = kedalaman;

            // scroll ke bawah
            setTimeout(() => {
                document.getElementById("infografisCard").scrollIntoView({
                    behavior: "smooth"
                });
            }, 300);
        }
    </script>

    <script>
        function tambahLayerSesar(map) {
            return fetch('/fault/sesar_indonesia.geojson')
                .then(res => res.json())
                .then(data => {
                    L.geoJSON(data, {
                        style: {
                            color: '#393E46',
                            weight: 2,
                            dashArray: '5,5'
                        }
                    }).addTo(map);
                });
        }
    </script>


    {{-- function untuk screenshoot infografis --}}
    <script>
        function saveAsImage() {
            const card = document.getElementById("infografisBody");

            // Ambil tanggal dari input tersembunyi form
            const tanggalRaw = document.getElementById("inputTanggal").value || "";

            // Parsing tanggal: contoh "08-Jun-25" → "25jun08"
            let formattedDate = "unknown";
            const match = tanggalRaw.match(/(\d{2})-(\w{3})-(\d{2})/);
            if (match) {
                const [_, day, month, year] = match;
                formattedDate = `${year.toLowerCase()}${month.toLowerCase()}${day}`;
            }

            // Tunggu sedikit agar layer sesar benar-benar dirender
            setTimeout(() => {
                html2canvas(card, {
                        useCORS: true,
                        backgroundColor: null,
                        scale: 2
                    })
                    .then(canvas => {
                        const link = document.createElement("a");
                        link.download = `infografis-gempa-${formattedDate}.png`;
                        link.href = canvas.toDataURL("image/png");
                        link.click();
                    })
                    .catch(err => {
                        console.error("Gagal menyimpan gambar:", err);
                    });
            }, 500);
        }
    </script>
@endpush
