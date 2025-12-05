@extends('layouts.app')

@section('title', 'Buat Narasi Gempabumi')

@push('style')
    <style>
        .editable-input {
            display: inline-block;
            min-width: 50px;
            padding: 0 4px;
            border-bottom: 1px dashed #aaa;
            background-color: #e9ecef;
            /* Warna penanda area edit manual */
            outline: none;
            cursor: text;
        }

        .editable-input:focus {
            background-color: #fff;
            border-bottom: 1px solid #007bff;
        }

        /* Style untuk tabel input dampak */
        .border-dashed {
            border-style: dashed !important;
        }

        .narasi-header {
            /* Penanda Judul Sub-bab */
        }

        .v1-only-content {
            /* Penanda Konten khusus V1 */
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Buat Narasi Gempabumi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('gempabumi.index') }}">Data Gempa</a></div>
                    <div class="breadcrumb-item">Buat Narasi</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-md-5">

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Parameter Gempa</h4>
                            </div>
                            <div class="card-body pb-2">
                                <h5 class="text-danger">Magnitudo {{ $gempa->magnitudo }}</h5>
                                <p class="mb-1"><strong>Waktu:</strong> {{ $gempa->tanggal->format('d-m-Y') }} |
                                    {{ $gempa->waktu }} WIB</p>
                                <p class="mb-1"><strong>Lokasi:</strong> {{ $gempa->formatted_lintang }},
                                    {{ $gempa->formatted_bujur }}</p>
                                <p class="mb-1"><strong>Kedalaman:</strong> {{ $gempa->kedalaman }} Km</p>
                                <p class="mb-1"><strong>Jarak:</strong> {{ $gempa->jarak }}</p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4>Input Dampak Dirasakan</h4>
                            </div>
                            <div class="card-body p-3">
                                <div class="alert alert-info border small py-2 mb-2">
                                    <i class="fas fa-magic"></i> Masukkan wilayah satu per satu. Sistem akan otomatis
                                    menggabungkan wilayah dengan MMI yang sama.
                                </div>

                                <div class="table-responsive mb-3">
                                    <table class="table table-sm table-bordered mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th width="55%">Wilayah / Lokasi</th>
                                                <th width="35%">Intensitas</th>
                                                <th width="10%" class="text-center">Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dampak-tbody">
                                        </tbody>
                                    </table>
                                </div>

                                <button onclick="addNewRow()" class="btn btn-outline-primary btn-sm w-100 border-dashed">
                                    <i class="fas fa-plus"></i> Tambah Baris Wilayah
                                </button>
                            </div>
                        </div>

                    </div>


                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h4>Preview Narasi</h4>
                            </div>
                            <div class="card-body">

                                <div class="alert alert-light border mb-4">
                                    <label class="fw-bold mb-2">Pilih Format Output:</label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check me-4">
                                            <input class="form-check-input" type="radio" name="format_mode" id="modeV1"
                                                value="v1" checked onchange="changeMode()">
                                            <label class="form-check-label" for="modeV1">
                                                <strong>Versi 1 (Lengkap)</strong><br>
                                                <small class="text-muted">Dengan Sub-Judul & Rekomendasi Panjang</small>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="format_mode" id="modeV2"
                                                value="v2" onchange="changeMode()">
                                            <label class="form-check-label" for="modeV2">
                                                <strong>Versi 2 (Ringkas)</strong><br>
                                                <small class="text-muted">Tanpa Sub-Judul & Rekomendasi Pendek</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="border rounded p-4 shadow-sm" id="narrationText" style="background: #fff;">

                                    <h5 class="text-dark fw-bold mb-4" style="text-transform: uppercase;">
                                        GEMPA BUMI TEKTONIK M{{ $gempa->magnitudo }} DIRASAKAN DI
                                        <span contenteditable="true" class="editable-input">BIDUK-BIDUK, BERAU, KALIMANTAN
                                            TIMUR</span>
                                    </h5>

                                    <h6 class="fw-bold mb-1 narasi-header">*Kejadian dan Parameter Gempa Bumi*</h6>
                                    <p class="mb-3 narasi-content text-justify">
                                        Hari
                                        <strong>{{ \Carbon\Carbon::parse($gempa->tanggal)->translatedFormat('l, d F Y') }}</strong>
                                        pukul <strong>{{ $gempa->waktu }} WIB</strong>, wilayah
                                        <span contenteditable="true" class="editable-input">Biduk-Biduk</span>
                                        diguncang gempa bumi tektonik. Hasil analisis BMKG menunjukkan bahwa gempa bumi
                                        memiliki parameter dengan magnitudo <strong>{{ $gempa->magnitudo }}</strong>.
                                        Episenter gempabumi terletak pada koordinat <strong>{{ $gempa->formatted_lintang }}
                                            dan {{ $gempa->formatted_bujur }}</strong>,
                                        atau tepatnya berlokasi
                                        <span contenteditable="true" class="editable-input">di darat / di laut</span>
                                        pada jarak <strong>{{ $gempa->jarak }}</strong> pada kedalaman
                                        <strong>{{ $gempa->kedalaman }} km</strong>.
                                    </p>

                                    <h6 class="fw-bold mb-1 narasi-header">*Jenis dan Mekanisme Gempa Bumi*</h6>
                                    <p class="mb-3 narasi-content text-justify">
                                        Dengan memperhatikan lokasi episenter dan kedalaman hiposenternya, gempa bumi yang
                                        terjadi merupakan jenis gempabumi
                                        <span contenteditable="true" class="editable-input">kedalaman dangkal</span>
                                        akibat aktivitas <span contenteditable="true" class="editable-input">Sesar
                                            Aktif</span>.
                                    </p>

                                    <h6 class="fw-bold mb-1 narasi-header">*Dampak Gempa Bumi*</h6>
                                    <p class="mb-3 narasi-content text-justify">
                                        Berdasarkan laporan masyarakat, gempa bumi ini dirasakan di
                                        <span id="dynamic-dampak-text" style="background-color: #fff3cd; padding: 2px;">
                                            ... (Input data dampak di panel kiri) ...
                                        </span>.
                                        Hingga saat ini <span contenteditable="true" class="editable-input">tidak terdapat
                                            laporan dampak kerusakan yang ditimbulkan</span>.
                                    </p>

                                    <h6 class="fw-bold mb-1 narasi-header">*Gempa Bumi Susulan*</h6>
                                    <p class="mb-3 narasi-content text-justify">
                                        Hingga pukul <span contenteditable="true"
                                            class="editable-input">{{ \Carbon\Carbon::parse($gempa->waktu)->addHour()->format('H:i') }}
                                            WIB</span>,
                                        hasil monitoring BMKG <span contenteditable="true" class="editable-input">belum
                                            menunjukkan adanya aktivitas gempa bumi susulan (aftershock)</span>.
                                    </p>

                                    <h6 class="fw-bold mb-1 narasi-header">*Rekomendasi*</h6>
                                    <p class="mb-3 narasi-content text-justify">
                                        <span class="v1-only-content">
                                            Kepada masyarakat dihimbau agar tetap tenang dan tidak terpengaruh oleh isu yang
                                            tidak dapat dipertanggungjawabkan kebenarannya. Agar menghindari dari bangunan
                                            yang retak atau rusak diakibatkan oleh gempa. Periksa dan pastikan bangunan
                                            tempat tinggal anda cukup tahan gempa, ataupun tidak ada kerusakan akibat
                                            getaran gempa yang membahayakan kestabilan bangunan sebelum anda kembali ke
                                            dalam rumah.
                                            <br><br>
                                        </span>
                                        Pastikan informasi resmi hanya bersumber dari BMKG yang disebarkan melalui kanal
                                        komunikasi resmi yang telah terverifikasi
                                        (@infoBMKG, http://www.bmkg.go.id, inatews.bmkg.go.id, Mobile Apps: wrs-bmkg /
                                        infobmkg).
                                    </p>

                                    <div class="mt-5 tanda-tangan">
                                        <p class="mb-0">Balikpapan,
                                            {{ \Carbon\Carbon::parse($gempa->tanggal)->translatedFormat('d F Y') }}</p>
                                        <p class="mb-0 fw-bold">Kepala Stasiun Geofisika Balikpapan</p>
                                        <p class="mb-0 fw-bold">Rasmid, M.Si</p>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-center mt-4">
                                    <button onclick="copyNarration()" class="btn btn-primary btn-lg shadow">
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
    <script>
        // ==========================================
        // 1. DATA DESKRIPSI MMI (LENGKAP)
        // ==========================================
        const mmiDescriptions = {
            'I': 'Getaran tidak dirasakan kecuali dalam keadaan luar biasa oleh beberapa orang.',
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
            'IX': 'Kerusakan pada bangunan yang kuat, rangka-rangka rumah menjadi tidak lurus, banyak retak. Rumah tampak agak berpindah dari pondamennya. Pipa-pipa dalam rumah putus.',
            'X': 'Bangunan dari kayu yang kuat rusak, rangka rumah lepas dari pondamennya, tanah terbelah rel melengkung, tanah longsor di tiap-tiap sungai dan di tanah-tanah yang curam.',
            'XI': 'Bangunan-bangunan hanya sedikit yang tetap berdiri. Jembatan rusak, terjadi lembah. Pipa dalam tanah tidak dapat dipakai sama sekali, tanah terbelah, rel melengkung sekali.',
            'XII': 'Hancur sama sekali, Gelombang tampak pada permukaan tanah. Pemandangan menjadi gelap. Benda-benda terlempar ke udara.'
        };

        // ==========================================
        // 2. LOGIKA TABEL INPUT (AUTO GROUPING)
        // ==========================================

        // Fungsi Tambah Baris Tabel
        function addNewRow() {
            const tbody = document.getElementById('dampak-tbody');
            const rowId = Date.now();

            const tr = document.createElement('tr');
            tr.id = `row-${rowId}`;

            tr.innerHTML = `
                <td class="p-1">
                    <input type="text" class="form-control form-control-sm lokasi-input" 
                           placeholder="Nama Wilayah..." oninput="generateNarrativeFromTable()">
                </td>
                <td class="p-1">
                    <select class="form-select form-select-sm mmi-select" onchange="generateNarrativeFromTable()">
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="II-III">II-III</option>
                        <option value="III" selected>III</option>
                        <option value="III-IV">III-IV</option>
                        <option value="IV">IV</option>
                        <option value="IV-V">IV-V</option>
                        <option value="V">V</option>
                        <option value="V-VI">V-VI</option>
                        <option value="VI">VI</option>
                        <option value="VI-VII">VI-VII</option>
                        <option value="VII">VII</option>
                        <option value="VII-VIII">VII-VIII</option>
                        <option value="VIII">VIII</option>
                        <option value="IX">IX</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </td>
                <td class="text-center p-1 align-middle">
                    <button onclick="deleteRow('${rowId}')" class="btn btn-danger btn-sm py-0 px-1">
                        <i class="fas fa-times"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
            // Auto focus ke input baru
            setTimeout(() => tr.querySelector('.lokasi-input').focus(), 100);
        }

        // Fungsi Hapus Baris
        function deleteRow(rowId) {
            const row = document.getElementById(`row-${rowId}`);
            if (row) {
                row.remove();
                generateNarrativeFromTable();
            }
        }

        // FUNGSI INTI: Baca Tabel -> Grouping MMI -> Tulis Narasi
        function generateNarrativeFromTable() {
            const tbody = document.getElementById('dampak-tbody');
            const rows = tbody.querySelectorAll('tr');
            const narrativeSpan = document.getElementById('dynamic-dampak-text');

            // Cek jika kosong
            let hasData = false;
            rows.forEach(r => {
                if (r.querySelector('.lokasi-input').value.trim()) hasData = true;
            });

            if (!hasData) {
                narrativeSpan.innerHTML =
                    '<span class="text-muted fst-italic" style="background:#fff3cd">... (Input data dampak di panel kiri) ...</span>';
                return;
            }

            // A. Pengelompokan Data { 'III': ['Lokasi A', 'Lokasi B'] }
            let groupedData = {};

            rows.forEach(row => {
                const lokasiVal = row.querySelector('.lokasi-input').value.trim();
                const mmiVal = row.querySelector('.mmi-select').value;

                if (lokasiVal) {
                    if (!groupedData[mmiVal]) groupedData[mmiVal] = [];
                    groupedData[mmiVal].push(lokasiVal);
                }
            });

            // B. Buat Kalimat
            let sentenceParts = [];
            for (const [mmi, lokasiArray] of Object.entries(groupedData)) {
                let lokasiString = lokasiArray.join(', ');
                let deskripsi = mmiDescriptions[mmi] || '';
                sentenceParts.push(`${lokasiString} dengan intensitas ${mmi} MMI (${deskripsi})`);
            }

            // C. Output
            narrativeSpan.innerText = sentenceParts.join(', ');
        }

        // ==========================================
        // 3. LOGIKA TAMPILAN (V1 vs V2)
        // ==========================================
        function changeMode() {
            const isV2 = document.getElementById('modeV2').checked;

            // Toggle Header Sub-bab
            document.querySelectorAll('.narasi-header').forEach(el => {
                el.style.display = isV2 ? 'none' : 'block';
            });

            // Toggle Konten Rekomendasi Panjang
            document.querySelectorAll('.v1-only-content').forEach(el => {
                el.style.display = isV2 ? 'none' : 'inline';
            });
        }

        // ==========================================
        // 4. LOGIKA COPY PASTE (CLEAN & SMART)
        // ==========================================
        function copyNarration() {
            const container = document.getElementById("narrationText");
            const isV2 = document.getElementById('modeV2').checked;

            // A. Clone Element (Supaya tidak merusak tampilan asli)
            const clone = container.cloneNode(true);

            // B. Bersihkan Elemen Sesuai Mode
            if (isV2) {
                // Hapus Header & Konten V1 jika mode V2
                clone.querySelectorAll('.narasi-header').forEach(el => el.remove());
                clone.querySelectorAll('.v1-only-content').forEach(el => el.remove());
            }

            // Hapus attribut contenteditable & style background
            clone.querySelectorAll('.editable-input').forEach(span => {
                span.removeAttribute('contenteditable');
                // Kita biarkan text di dalamnya tetap ada
            });

            let finalString = "";

            // C. Ambil Judul
            const title = clone.querySelector('h5').innerText.replace(/\s+/g, ' ').trim();
            finalString += title + "\n\n";

            // D. Loop Isi Paragraph
            const elements = clone.querySelectorAll('.narasi-header, .narasi-content');

            elements.forEach(el => {
                // Flatten text (Hapus enter di tengah kalimat)
                let cleanText = el.innerText.replace(/[\r\n]+/g, " ").replace(/\s+/g, " ").trim();

                if (!cleanText) return;

                if (el.classList.contains('narasi-header')) {
                    finalString += cleanText + "\n"; // Header: 1 Enter
                } else if (el.classList.contains('narasi-content')) {
                    finalString += cleanText + "\n\n"; // Content: 2 Enter
                }
            });

            // E. Footer (Tanggal & TTD Rapat)
            const footerDiv = clone.querySelector('.tanda-tangan');
            if (footerDiv) {
                let lines = [];
                footerDiv.querySelectorAll('p').forEach(p => {
                    // Hapus spasi berlebih di tengah kalimat (Penting buat Tanggal)
                    let cleanLine = p.innerText.replace(/\s+/g, ' ').trim();
                    if (cleanLine) lines.push(cleanLine);
                });
                finalString += lines.join('\n');
            }

            // F. Eksekusi Salin
            navigator.clipboard.writeText(finalString).then(() => {
                let version = isV2 ? "Versi 2 (Ringkas)" : "Versi 1 (Lengkap)";
                alert(`✅ Narasi ${version} berhasil disalin!`);
            }).catch(err => {
                alert('❌ Gagal menyalin. Izin browser mungkin ditolak.');
            });
        }

        // Init: Tambah 1 baris kosong saat load
        document.addEventListener('DOMContentLoaded', () => {
            addNewRow();
        });
    </script>
@endpush
