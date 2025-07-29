@extends('layouts.app')

@section('title', 'Buat Infografis Gempabumi')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" /> />
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
                        <div class="container bg-white rounded shadow p-4 my-2 ">

                            <!-- Header -->
                            <div class="text-center mb-4">
                                <div class="d-flex flex-column align-items-center">
                                    <img src="/img/logo-bmkg.png" alt="logo" style="max-height: 100px" />
                                    <h1 class="h4 mt-4 fw-bold text-dark">
                                        Generator Infografis Gempabumi BMKG-BKB
                                    </h1>
                                    <p class="text-muted mt-2">Masukkan informasi gempa dari BMKG dan buat infografis secara
                                        otomatis</p>
                                </div>
                            </div>

                            <!-- Input -->
                            <div class="mb-4">
                                <label for="infoText" class="form-label fw-medium text-center w-100">Format Parameter
                                    Gempa</label>
                                <p class="fw-medium text-center">Teks Berikut Sesuai Dengan Info Dari EXDX</p>
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
                                <div class="bg-info text-white fw-bold p-4 text-center mb-5">
                                    Hasil Infografis Gempa
                                </div>
                                <div id="infografisBody" class="card border-info mx-auto" style="max-width: 700px;">

                                    <!-- Header Info Gempa -->
                                    <div class="card-header d-flex justify-content-between align-items-center p-3 rounded-top"
                                        style="background-color: #fff6e8;">
                                        <img src="/img/logo-bmkg.png" alt="Logo BMKG" style="height: 48px;" class="mx-5">
                                        <div class="text-end">
                                            <h4 class="fw-semibold text-dark">Info Gempabumi Kalimantan</h4>
                                            <h5 class="small">Stasiun Geofisika
                                                Balikpapan</h5>
                                        </div>
                                    </div>

                                    <div id="map" style="height: 500px; overflow: hidden;"></div>
                                    <small class="text-muted">
                                        Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ" — disesuaikan untuk
                                        keperluan infografis Stasiun
                                        Geofisika Balikpapan
                                    </small>

                                    <div class="" id="parameterOutput"></div>
                                </div>
                                <div class="justify-content-center">


                                    <button class="btn btn-info d-none" id="saveButton" onclick="saveAsImage()"><i
                                            class="fa-solid fa-download"></i> Simpan
                                        Gambar</button>


                                    {{-- bagian untuk simpan data ke database --}}
                                    <button class="btn btn-success d-none" id="createButton" onclick="submitForm()"><i
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
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://unpkg.com/leaflet-image/leaflet-image.js"></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        function generateInfographic() {
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
                    `<div class="text-danger">Format tidak sesuai. Harap ikuti contoh: <br><code>Info Gempa Mag:3.2, 08-Jun-25 00:00:16 WIB, Lok:0.68 LU,118.62 BT (141 km TimurLaut BONTANG-KALTIM), Kedlmn:6 Km ::BMKG-BKB</code></div>`;
                // Jangan tampilkan output card dan tombol
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
                kedalaman,
                sumber
            } = match.groups;

            output.innerHTML = `
                <div class="d-flex flex-wrap w-100">
                    <!-- Kolom Magnitudo -->
                    <div class=" text-white text-center d-flex flex-column justify-content-center align-items-center p-4" style="width: 25%; background-color: #CB0404;">
                        <small class="text-uppercase fw-bold">Magnitudo</small>
                        <h1 class="display-4 fw-bold mb-0">${magnitudo}</h1>
                    </div>

                    <!-- Kolom Informasi Detail -->
                    <div class="p-4" style="width: 75%; background-color: #f8f6ef;">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <i class="bi bi-calendar-event me-2"></i>
                                <strong>Waktu</strong><br>
                                ${tanggal} ${waktu} WIB
                            </div>
                            <div class="col-md-6 mb-2">
                                <i class="bi bi-graph-down me-2"></i>
                                <strong>Kedalaman</strong><br>
                                ${kedalaman} Km
                            </div>
                            <div class="col-12 mt-2">
                                <i class="bi bi-geo-alt-fill me-2 text-danger"></i>
                                <strong>Lokasi</strong><br>
                                ${lintang}, ${bujur}<br>
                                ${jarak}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="d-flex justify-content-between align-items-center px-3 py-2 text-white" style="background-color: #002147;">
                    <span><i class="bi bi-instagram"></i> @stageofbalikpapan</span>
                    <span><i class="bi bi-heart-fill text-danger"></i> Stasiun Geofisika Balikpapan</span>
                    <span><i class="bi bi-whatsapp"></i> 0811-5926-543</span>
                </div>
            `;


            // Map
            const lat = parseFloat(lintang.replace(/[^\d.-]/g, ''));
            const lon = parseFloat(bujur.replace(/[^\d.-]/g, ''));

            const latFix = /LU/.test(lintang) ? lat : -lat;
            const lonFix = /BT/.test(bujur) ? lon : -lon;

            if (window.gempaMap) {
                window.gempaMap.remove();
            }

            window.gempaMap = L.map('map').setView([latFix, lonFix], 8);

            // Paksa peta menghitung ulang ukuran (fix blank/grey bug)
            setTimeout(() => {
                window.gempaMap.invalidateSize();
            }, 200);

            // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            //     attribution: '&copy; OpenStreetMap contributors',
            // }).addTo(window.gempaMap);

            L.tileLayer(
                "https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}", {
                    // attribution: "Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ",
                    maxZoom: 29,
                }
            ).addTo(window.gempaMap);


            // // Tambahkan layer sesar lokal
            // fetch("/fault/sesar_kalimantan.geojson")
            //     .then((res) => res.json())
            //     .then((data) => {
            //         // Simpan ke window agar bisa dihapus sementara
            //         window.layerSesar = L.geoJSON(data, {
            //             style: {
            //                 color: "#8A2D3B",
            //                 weight: 2,
            //                 dashArray: "4, 4",
            //             },
            //             onEachFeature: function(feature, layer) {
            //                 if (feature.properties && feature.properties.name) {
            //                     layer.bindPopup("Sesar: " + feature.properties.name);
            //                 }
            //             },
            //         });

            //         window.layerSesar.addTo(window.gempaMap);
            //     })
            //     .catch((err) => {
            //         console.error("Gagal memuat sesar:", err);
            //     });


            const redIcon = L.divIcon({
                className: 'custom-icon',
                html: '<div style="width: 20px; height: 20px; background-color: red; border-radius: 70%; border: 3px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.5);"></div>',
                iconSize: [30, 30],
                iconAnchor: [10, 10]
            });

            L.marker([latFix, lonFix], {
                    icon: redIcon
                }).addTo(window.gempaMap)
                .bindPopup(`<strong>Gempa ${magnitudo}</strong><br>${jarak}<br>Kedalaman ${kedalaman} Km`);

            // Tampilkan kartu
            card.classList.remove("d-none");
            document.getElementById("resetButton").classList.remove("d-none");
            document.getElementById("saveButton").classList.remove("d-none");
            document.getElementById("createButton").classList.remove("d-none");

            // untuk store data ke database
            document.getElementById("inputMagnitudo").value = magnitudo;
            document.getElementById("inputTanggal").value = tanggal;
            document.getElementById("inputWaktu").value = waktu;
            document.getElementById("inputLintang").value = lintang;
            document.getElementById("inputBujur").value = bujur;
            document.getElementById("inputJarak").value = jarak;
            document.getElementById("inputKedalaman").value = kedalaman;


            document.getElementById("createButton").classList.remove("d-none");

            tambahLayerSesar();
        }




        // untuk menjalankan button store data ke database
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

        function saveAsImage() {
            const card = document.getElementById("infografisBody");

            // Sembunyikan garis sesar
            if (window.layerSesar && window.gempaMap.hasLayer(window.layerSesar)) {
                window.gempaMap.removeLayer(window.layerSesar);
            }

            // Tunggu sejenak agar layer sesar hilang dari DOM
            setTimeout(() => {
                html2canvas(card, {
                    useCORS: true,
                    backgroundColor: null,
                    scale: 2 // resolusi tinggi
                }).then(canvas => {
                    const link = document.createElement("a");
                    link.download = "infografis-gempa.png";
                    link.href = canvas.toDataURL("image/png");
                    link.click();

                    // Tampilkan kembali layer sesar
                    if (window.layerSesar) {
                        window.layerSesar.addTo(window.gempaMap);
                    }
                }).catch(err => {
                    alert("Gagal menyimpan gambar. Periksa konsol.");
                    console.error(err);

                    // Pastikan layer sesar dikembalikan meskipun gagal
                    if (window.layerSesar) {
                        window.layerSesar.addTo(window.gempaMap);
                    }
                });
            }, 300); // jeda sedikit untuk memastikan DOM update
        }

        function tambahLayerSesar() {
            fetch("/fault/sesar_kalimantan.geojson")
                .then((res) => res.json())
                .then((data) => {
                    window.layerSesar = L.geoJSON(data, {
                        style: {
                            color: "#8A2D3B",
                            weight: 2,
                            dashArray: "4, 4",
                        },
                        onEachFeature: function(feature, layer) {
                            if (feature.properties && feature.properties.name) {
                                layer.bindPopup("Sesar: " + feature.properties.name);
                            }
                        },
                    });
                    window.layerSesar.addTo(window.gempaMap);
                })
                .catch((err) => {
                    console.error("Gagal memuat sesar:", err);
                });
        }
    </script>
@endpush
