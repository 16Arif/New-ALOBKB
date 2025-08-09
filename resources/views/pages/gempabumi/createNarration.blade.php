@extends('layouts.app')

@section('title', 'Buat Narasi Gempabumi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush


<style>
    .editable-input {
        display: inline-block;
        min-width: 100px;
        padding: 2px 4px;
        border-bottom: 1px dashed #aaa;
        outline: none;
    }

    .editable-input:focus {
        background-color: #f5f5f5;
        border-bottom: 1px solid #555;
    }
</style>

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Buat Narasi Gempabumi</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('gempabumi.index') }}">Kelola Data Gempabumi</a></div>
                    <div class="breadcrumb-item">Buat Narasi</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Parameter Gempabumi</h4>
                            </div>
                            <div class="card-body">
                                <!-- Ringkasan Data Gempa -->
                                <h5 class="card-title text-danger">Magnitudo {{ $gempa->magnitudo }}</h5>
                                <p><strong>Tanggal & Waktu:</strong> {{ $gempa->tanggal->format('d-m-Y') }}
                                    {{ $gempa->waktu }} WIB
                                </p>
                                <p><strong>Lokasi:</strong> {{ $gempa->formatted_lintang }},
                                    {{ $gempa->formatted_bujur }}</p>
                                <p><strong>Kedalaman:</strong> {{ $gempa->kedalaman }} Km</p>
                                <p><strong>Jarak & Wilayah:</strong> {{ $gempa->jarak }}</p>
                                <p><strong>Dirasakan:</strong> {{ $gempa->dirasakan }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Narasi Gempabumi</h4>
                            </div>
                            <div class="card-body">
                                <div class=" shadow-sm  mb-4">
                                    <div class=" px-4 py-4" id="narrationText">
                                        <h5 class="text-dark fw-bold mb-3">
                                            GEMPABUMI TEKTONIK M={{ $gempa->magnitudo }} MENGGUNCANG WILAYAH
                                            <span contenteditable="true" class="editable-input"
                                                style="background-color: #d1d1d1">BIDUK-BIDUK</span>
                                        </h5>

                                        <h6 class="fw-semibold mb-2">Kejadian dan Parameter Gempabumi</h6>
                                        <p>
                                            Hari
                                            <strong>{{ \Carbon\Carbon::parse($gempa->tanggal)->translatedFormat('l, d F Y') }}</strong>
                                            pukul <strong>{{ $gempa->waktu }} WIB</strong>, wilayah
                                            <span contenteditable="true" class="editable-input"
                                                style="background-color: #d1d1d1">Biduk-Biduk</span>
                                            diguncang
                                            gempabumi tektonik. Hasil analisis BMKG menunjukkan bahwa gempabumi memiliki
                                            parameter
                                            <strong>M={{ $gempa->magnitudo }}</strong>.
                                            Episenter gempabumi terletak <span contenteditable="true" class="editable-input"
                                                style="background-color: #d1d1d1">di darat / di laut</span> pada
                                            koordinat
                                            <strong>{{ $gempa->formatted_lintang }} dan
                                                {{ $gempa->formatted_bujur }}</strong>
                                            , atau tepatnya
                                            berlokasi
                                            <strong>{{ $gempa->jarak }}</strong> pada kedalaman
                                            <strong>{{ $gempa->kedalaman }} km</strong>.
                                        </p>

                                        <h6 class="fw-semibold mb-2">Jenis dan Mekanisme Gempabumi</h6>
                                        <p>
                                            Dengan memperhatikan lokasi episenter dan kedalaman hiposenternya, gempabumi
                                            yang terjadi merupakan jenis
                                            gempabumi <span contenteditable="true" class="editable-input"
                                                style="background-color: #d1d1d1">kedalaman
                                                dangkal</span>
                                            akibat aktivitas <span contenteditable="true" class="editable-input"
                                                style="background-color: #d1d1d1">Sesar
                                                Aktif</span>.
                                        </p>

                                        <h6 class="fw-semibold mb-2">Dampak Gempabumi</h6>
                                        <p>
                                            Berdasarkan laporan masyarakat, gempabumi ini dirasakan di
                                            <span contenteditable="true" class="editable-input"
                                                style="background-color: #d1d1d1">Sangata</span>
                                            dengan intensitas
                                            <select id="mmi-level" class="form-select d-inline w-auto mx-2"
                                                onchange="updateMMIDescription()">
                                                <option value="I">I MMI</option>
                                                <option value="I-II">I-II MMI</option>
                                                <option value="II">II MMI</option>
                                                <option value="II-III">II-III MMI</option>
                                                <option value="III" selected>III MMI</option>
                                                <option value="III-IV">III-IV MMI</option>
                                                <option value="IV">IV MMI</option>
                                                <option value="IV-V">IV-V MMI</option>
                                                <option value="V">V MMI</option>
                                                <option value="V-VI">V-VI MMI</option>
                                                <option value="VI">VI MMI</option>
                                                <option value="VI-VII">VI-VII MMI</option>
                                                <option value="VII">VII MMI</option>
                                                <option value="VII-VIII">VII-VIII MMI</option>
                                                <option value="VIII">VIII MMI</option>
                                                <option value="VIII-IX">VIII-IX MMI</option>
                                                <option value="IX">IX MMI</option>
                                                <option value="IX-X">IX-X MMI</option>
                                                <option value="X">X MMI</option>
                                                <option value="XI">XI MMI</option>
                                                <option value="XII">XII MMI</option>
                                            </select>
                                            (<em id="mmi-description"> Getaran dirasakan nyata dalam rumah. Terasa
                                                getaran
                                                seakan-akan ada truk berlalu</em>).
                                            Hingga saat ini <span contenteditable="true" class="editable-input"
                                                style="background-color: #d1d1d1">tidak
                                                terdapat laporan dampak kerusakan yang ditimbulkan</span>.
                                        </p>


                                        <h6 class="fw-semibold mb-2">Gempabumi Susulan</h6>
                                        <p>
                                            Hingga hari
                                            {{ \Carbon\Carbon::parse($gempa->tanggal)->translatedFormat('l, d F Y') }}
                                            pukul <span contenteditable="true" class="editable-input"
                                                style="background-color: #d1d1d1">{{ \Carbon\Carbon::parse($gempa->waktu)->addHour()->format('H:i') }}
                                                WIB
                                            </span>,
                                            hasil monitoring <span contenteditable="true" class="editable-input"
                                                style="background-color: #d1d1d1">belum
                                                menunjukkan adanya aktivitas gempabumi susulan (aftershock)</span>.
                                        </p>

                                        <h6 class="fw-semibold mb-2">Rekomendasi</h6>
                                        <p>
                                            Kepada masyarakat di wilayah {{ $gempa->wilayah }} dan sekitarnya dihimbau agar
                                            tetap tenang dan tidak terpengaruh
                                            oleh isu yang tidak dapat dipertanggungjawabkan.
                                            Pastikan informasi resmi hanya bersumber dari BMKG yang disebarkan melalui kanal
                                            komunikasi resmi yang telah
                                            terverifikasi
                                            (<a href="https://www.instagram.com/infoBMKG" target="_blank">@infoBMKG</a>,
                                            <a href="https://twitter.com/infoBMKG" target="_blank">@infoBMKG</a>,
                                            <a href="http://www.bmkg.go.id" target="_blank">www.bmkg.go.id</a>,
                                            <a href="https://inatews.bmkg.go.id" target="_blank">inatews.bmkg.go.id</a>,
                                            Mobile Apps: <strong>wrs-bmkg</strong> / <strong>infobmkg</strong>).
                                        </p>

                                        <div class="mt-4">
                                            <p class="mb-0">Balikpapan,
                                                {{ \Carbon\Carbon::parse($gempa->tanggal)->translatedFormat('d F Y') }}</p>
                                            <p class="fw-semibold mb-0">Kepala Stasiun Geofisika Balikpapan</p>
                                            <p class="fw-bold">Rasmid, M.Si</p>
                                        </div>
                                    </div>


                                </div>
                                <div class="d-flex justify-content-center">
                                    <button onclick="copyNarration()" class="btn btn-primary mb-3 ">
                                        <i class="fas fa-copy"></i> Salin Narasi
                                    </button>
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
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <script>
        function updateMMIDescription() {
            const level = document.getElementById('mmi-level').value;
            const description = {
                'I': 'Getaran tidak dirasakan kecuali dalam keadaan luar biasa oleh beberapa orang.',
                'I-II': 'Getaran dirasakan oleh beberapa orang, benda-benda ringan yang digantung bergoyang.',
                'II': 'Getaran dirasakan oleh beberapa orang, benda-benda ringan yang digantung bergoyang.',
                'II-III': 'Getaran dirasakan nyata dalam rumah. Terasa seakan-akan ada truk berlalu.',
                'III': 'Getaran dirasakan nyata dalam rumah. Terasa seakan-akan ada truk berlalu.',
                'III-IV': 'Pada siang hari dirasakan oleh orang banyak dalam rumah, di luar oleh beberapa orang, gerabah pecah, jendela/pintu berderik, dan dinding berbunyi.',
                'IV': 'Pada siang hari dirasakan oleh orang banyak dalam rumah, di luar oleh beberapa orang, gerabah pecah, jendela/pintu berderik, dan dinding berbunyi.',
                'IV-V': 'Getaran dirasakan oleh hampir semua penduduk, orang banyak terbangun, gerabah pecah, barang-barang terpelanting, tiang-tiang, dan barang besar tampak bergoyang, bandul lonceng dapat berhenti.',
                'V': 'Getaran dirasakan oleh hampir semua penduduk, orang banyak terbangun, gerabah pecah, barang-barang terpelanting, tiang-tiang, dan barang besar tampak bergoyang, bandul lonceng dapat berhenti.',
                'V-VI': 'Getaran dirasakan oleh semua penduduk. Kebanyakan semua terkejut dan lari keluar, plester dinding jatuh dan cerobong asap pada pabrik rusak, kerusakan ringan.',
                'VI': 'Getaran dirasakan oleh semua penduduk. Kebanyakan semua terkejut dan lari keluar, plester dinding jatuh dan cerobong asap pada pabrik rusak, kerusakan ringan.',
                'VI-VII': 'Tiap-tiap orang keluar rumah. Kerusakan ringan pada rumah-rumah dengan bangunan dan konstruksi yang baik. Sedangkan pada bangunan yang konstruksinya kurang baik terjadi retak-retak bahkan hancur, cerobong asap pecah. Terasa oleh orang yang naik kendaraan.',
                'VII': 'Tiap-tiap orang keluar rumah. Kerusakan ringan pada rumah-rumah dengan bangunan dan konstruksi yang baik. Sedangkan pada bangunan yang konstruksinya kurang baik terjadi retak-retak bahkan hancur, cerobong asap pecah. Terasa oleh orang yang naik kendaraan.',
                'VII-VIII': 'Kerusakan ringan pada bangunan dengan konstruksi yang kuat. Retak-retak pada bangunan degan konstruksi kurang baik, dinding dapat lepas dari rangka rumah, cerobong asap pabrik dan monumen-monumen roboh, air menjadi keruh.',
                'VIII': 'Kerusakan ringan pada bangunan dengan konstruksi yang kuat. Retak-retak pada bangunan degan konstruksi kurang baik, dinding dapat lepas dari rangka rumah, cerobong asap pabrik dan monumen-monumen roboh, air menjadi keruh.',
                'VIII-IX': 'Kerusakan pada bangunan yang kuat, rangka-rangka rumah menjadi tidak lurus, banyak retak. Rumah tampak agak berpindah dari pondamennya. Pipa-pipa dalam rumah putus.',
                'IX': 'Kerusakan pada bangunan yang kuat, rangka-rangka rumah menjadi tidak lurus, banyak retak. Rumah tampak agak berpindah dari pondamennya. Pipa-pipa dalam rumah putus.',
                'IX-X': 'Bangunan dari kayu yang kuat rusak,rangka rumah lepas dari pondamennya, tanah terbelah rel melengkung, tanah longsor di tiap-tiap sungai dan di tanah-tanah yang curam.',
                'X': 'Bangunan dari kayu yang kuat rusak,rangka rumah lepas dari pondamennya, tanah terbelah rel melengkung, tanah longsor di tiap-tiap sungai dan di tanah-tanah yang curam.',
                'XI': 'Bangunan-bangunan hanya sedikit yang tetap berdiri. Jembatan rusak, terjadi lembah. Pipa dalam tanah tidak dapat dipakai sama sekali, tanah terbelah, rel melengkung sekali.',
                'XII': 'Hancur sama sekali, Gelombang tampak pada permukaan tanah. Pemandangan menjadi gelap. Benda-benda terlempar ke udara.'
            };

            document.getElementById('mmi-description').innerText = description[level] || '';
        }
    </script>

    <script>
        function copyNarration() {
            const range = document.createRange();
            const narration = document.getElementById("narrationText");

            range.selectNode(narration);
            window.getSelection().removeAllRanges(); // clear any current selection
            window.getSelection().addRange(range);

            try {
                const successful = document.execCommand('copy');
                if (successful) {
                    alert('✅ Narasi berhasil disalin ke clipboard.');
                } else {
                    alert('❌ Gagal menyalin narasi.');
                }
            } catch (err) {
                alert('❌ Browser tidak mendukung fitur salin otomatis.');
            }

            window.getSelection().removeAllRanges(); // clear selection
        }
    </script>
@endpush
