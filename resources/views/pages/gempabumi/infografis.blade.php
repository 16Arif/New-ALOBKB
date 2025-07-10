@extends('layouts.app')

@section('title', 'Infografis Gempabumi')

@push('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            width: 90vw;
            height: 90vw;
            /* Square based on viewport */
            max-width: 600px;
            max-height: 600px;
            margin: 0 auto;
        }

        .card-gempa {
            transition: transform 0.2s ease-in-out;
            border-left: 5px solid #0d6efd;
        }

        .card-gempa:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        #infografis-kegempaan {
            max-width: 75%;
            margin: 0 auto;

        }

        .map-legend {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            font-size: 13px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
            line-height: 1.6;
            z-index: 999;
        }

        .legend-box {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-left: 5px solid #0d6efd;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .legend-box h6 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #0d6efd;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
            font-size: 13px;
        }

        .legend-bar {
            font-family: 'Segoe UI', sans-serif;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }


        @media (max-width: 576px) {
            .legend-box {
                min-width: 100%;
                text-align: center;
            }
        }
    </style>

    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Infografis Gempabumi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('gempabumi.index') }}">← Kembali</a></div>
                    <div class="breadcrumb-item active">Infografis</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row justify-content-center mb-4">
                    <div class="col-12">
                        <div class="container bg-white rounded shadow p-4 my-2">
                            {{-- RINGKASAN --}}
                            <div class="alert alert-info shadow-sm">
                                <div class="row">
                                    <div class="col">
                                        <strong>Statistik:</strong>
                                        Menampilkan <strong>{{ $data->count() }}</strong> data |
                                        Magnitudo Terkecil: <strong>{{ $data->min('magnitudo') }}</strong> |
                                        Terbesar: <strong>{{ $data->max('magnitudo') }}</strong>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <button class="btn btn-sm btn-light" onclick="resetMap()">🔄 Refresh
                                            Peta</button>
                                    </div>
                                </div>
                            </div>

                            {{-- PETA DAN LEGENDA --}}
                            <div id="infografis-kegempaan" class="card mb-3 mt-2 mx-auto" style="max-width: 750px;">
                                <!-- HEADER -->
                                <div class="card-header d-flex align-items-center justify-content-center gap-3 p-3 rounded-top"
                                    style="background-color: #63a7f570;">
                                    <img src="/img/logo-bmkg.png" alt="Logo BMKG" style="height: 68px;" class="ms-2" />

                                    <div class="text-start mx-4">
                                        <h5 class="text-dark mb-1 fw-semibold">Peta Seismisitas Kalimantan dan Sekitarnya
                                        </h5>
                                        <h6 class="text-dark mb-1">Stasiun Geofisika Balikpapan</h6>
                                        <p class="text-dark mb-0">
                                            Periode
                                            {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} –
                                            {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
                                        </p>

                                    </div>
                                </div>

                                <!-- MAP -->
                                <div id="map-container" class="d-flex justify-content-center">
                                    <div id="map" style="width: 100%; max-width: 750px; height: 600px;"></div>

                                    <!-- Loader -->
                                    <div id="map-loader"
                                        style="position: absolute; top: 0; left: 0; right: 0; bottom: 0;
                                        background: rgba(255, 255, 255, 0.7); z-index: 999;
                                        display: flex; justify-content: center; align-items: center; display: none;">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden"></span>
                                        </div>
                                    </div>
                                </div>


                                <!-- LEGEND BAR -->
                                <div class="legend-bar border border-dark rounded px-3 py-3 mx-auto text-center w-100"
                                    style="background: rgb(238, 237, 237); font-size: 13px;">


                                    {{-- Baris 1: Kedalaman --}}
                                    <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 mb-2">
                                        <div class="d-flex align-items-center gap-1 mx-2">
                                            <span style="color:red;">●</span> Dangkal (0–60 km)
                                        </div>
                                        <div class="d-flex align-items-center gap-1 mx-2">
                                            <span style="color:gold;">●</span> Menengah (60–300 km)
                                        </div>
                                        <div class="d-flex align-items-center gap-1 mx-2">
                                            <span style="color:green;">●</span> Dalam (> 300 km)
                                        </div>
                                    </div>

                                    {{-- Baris 2: Magnitudo dan Dirasakan --}}
                                    <div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
                                        @for ($i = 2; $i <= 6; $i++)
                                            <div class="d-flex align-items-center gap-1 mx-2">
                                                <svg width="{{ $i * 2 + 2 }}" height="{{ $i * 2 + 2 }}">
                                                    <circle cx="{{ $i + 1 }}" cy="{{ $i + 1 }}"
                                                        r="{{ $i }}" stroke="black" stroke-width="1"
                                                        fill="white" />
                                                </svg>
                                                M{{ $i }}
                                            </div>
                                        @endfor
                                        <div class="d-flex align-items-center gap-1 ml-2 mx-2">
                                            <img src="{{ asset('img/red-star.png') }}" width="14"
                                                alt="bintang putih"> Dirasakan
                                        </div>
                                        <div class="d-flex align-items-center gap-1 mx-2">
                                            <svg width="20" height="10">
                                                <line x1="0" y1="5" x2="20" y2="5"
                                                    stroke="#A16D28" stroke-width="2" stroke-dasharray="5,5" />
                                            </svg>
                                            Garis Sesar
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-info" id="saveButton" onclick="saveAsImage()"><i
                                        class="fa-solid fa-download"></i> Simpan
                                    Gambar</button>
                            </div>
                        </div>
                    </div>
                </div>







                {{-- INFOGRAFIS --}}
                <div class="row">
                    @foreach ($data as $gempa)
                        @php
                            $color =
                                $gempa->magnitudo >= 5 ? 'danger' : ($gempa->magnitudo >= 3 ? 'warning' : 'success');
                        @endphp
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card card-gempa shadow-sm border-start border-4 border-{{ $color }}">
                                <div class="card-body">
                                    <h5 class="card-title text-{{ $color }}">M{{ $gempa->magnitudo }}</h5>
                                    <p class="card-text mb-1"><strong>Tanggal:</strong> {{ $gempa->tanggal }}</p>
                                    <p class="card-text mb-1"><strong>Waktu (WIB):</strong> {{ $gempa->waktu }}</p>
                                    <p class="card-text mb-1"><strong>Lokasi:</strong> {{ $gempa->lintang }},
                                        {{ $gempa->bujur }}</p>
                                    <p class="card-text mb-1"><strong>Kedalaman:</strong> {{ $gempa->kedalaman }} km</p>
                                    <p class="card-text mb-1"><strong>Jarak:</strong> {{ $gempa->jarak }}</p>
                                    <p class="card-text mb-1"><strong>Dirasakan:</strong> {{ $gempa->dirasakan ?: '-' }}
                                    </p>
                                    <p class="card-text"><strong>Keterangan:</strong> {!! $gempa->keterangan !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <script>
        const map = L.map('map').setView([0.5, 117.5], 6);

        function getRadiusByMagnitude(mag) {
            if (mag <= 1) return 2;
            if (mag <= 2) return 3;
            if (mag <= 3) return 5;
            if (mag <= 4) return 7;
            if (mag <= 5) return 9;
            if (mag <= 6) return 11;
            return 12;
        }


        L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}", {
            // attribution: "Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ",
            maxZoom: 9,
        }).addTo(map);

        const starIcon = L.icon({
            iconUrl: '{{ asset('img/red-star.png') }}', // <- pastikan file ini ada
            iconSize: [24, 24],
            iconAnchor: [12, 12],
            popupAnchor: [0, -10]
        });

        function getColorByDepth(depth) {
            if (depth <= 60) return 'red';
            if (depth <= 300) return 'gold';
            return 'blue';
        }

        @foreach ($data as $gempa)
        @php
            $lat = floatval($gempa->lintang);
            $lng = floatval($gempa->bujur);
            $kedalaman = $gempa->kedalaman;
            $popup = "<strong>M{$gempa->magnitudo}</strong><br>{$gempa->tanggal} {$gempa->waktu}<br>Kedalaman: {$kedalaman} km";
        @endphp

        @if (strtoupper(trim($gempa->dirasakan)) === 'DIRASAKAN')
            L.marker([{{ $lat }}, {{ $lng }}], { icon: starIcon })
                .addTo(map)
                .bindPopup(`{!! $popup !!}`);
        @elseif (strtoupper(trim($gempa->dirasakan)) === 'TIDAK DIRASAKAN')
            L.circleMarker([{{ $lat }}, {{ $lng }}], {
                radius: getRadiusByMagnitude({{ $gempa->magnitudo }}),
                fillColor: getColorByDepth({{ $kedalaman }}),
                color: "#000",
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8
            }).addTo(map)
            .bindPopup(`{!! $popup !!}`);
        @else
    // Jika ada status lain, tetap tampilkan sebagai circleMarker (opsional)
            L.circleMarker([{{ $lat }}, {{ $lng }}], {
                radius: getRadiusByMagnitude({{ $gempa->magnitudo }}),
                fillColor: getColorByDepth({{ $kedalaman }}),
                color: "#000",
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8
            }).addTo(map)
            .bindPopup(`{!! $popup !!}`);
        @endif @endforeach

        // sesar



        function resetMap() {
            // Tampilkan loader
            document.getElementById('map-loader').style.display = 'flex';

            // Reset posisi map
            map.setView([0.5, 117.5], 6);

            // Sembunyikan loader setelah map selesai "dipindahkan"
            setTimeout(() => {
                document.getElementById('map-loader').style.display = 'none';
            }, 800); // durasi animasi (disesuaikan)
        }
    </script>

    <script>
        // Load file geojson sesar Kalimantan
        fetch('/fault/sesar_kalimantan.geojson')
            .then(response => response.json())
            .then(data => {
                const faultLine = L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#A16D28',
                            weight: 2,
                            dashArray: '5,5'
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        if (feature.properties && feature.properties.name) {
                            layer.bindPopup("Sesar: " + feature.properties.name);
                        }
                    }
                }).addTo(map);
            })
            .catch(error => {
                console.error('Gagal memuat file sesar:', error);
            });
    </script>

    <script>
        function saveAsImage() {
            const card = document.getElementById("infografis-kegempaan");

            // Tambahkan class agar hasil tangkapan lebih presisi
            card.classList.add('shadow');

            html2canvas(card, {
                useCORS: true, // jika ada logo eksternal
                scale: 2, // kualitas gambar
                backgroundColor: null
            }).then(canvas => {
                // Buat link untuk download
                const link = document.createElement("a");
                link.download = "Peta_Seismisitas_Kalimantan_dan_Sekitarnya.png";
                link.href = canvas.toDataURL("image/png");
                link.click();
            }).catch(err => {
                console.error("Gagal menyimpan gambar:", err);
                alert("Terjadi kesalahan saat menyimpan gambar.");
            });
        }
    </script>
@endpush
