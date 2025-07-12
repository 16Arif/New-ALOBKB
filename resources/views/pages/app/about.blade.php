@extends('layouts.app')

@section('title', 'Tentang')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tentang</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Info</a></div>
                    <div class="breadcrumb-item">Tentang</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">

                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tentang Aplikasi Logbook Operasional</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <p>ALO BKB merupakan Aplikasi untuk mengelola logbook yang ada pada operasional Stasiun
                                        Geofisika Balikpapan</p>
                                    <p><span>ALO BKB V1.0.0</span> dikembangkan pertama kali menggunakan framework
                                        CodeIgniter 4 dengan tujuan untuk membantu proses ditigalisasi pengisian logobook di
                                        lingkungan operasional Stageof Balikpapan</p>
                                    <p><span>ALO BKB V2.0.0</span> dikembangkan menggunakan framework Laravel 10
                                        dan merupakan hasil pengembangan dari ALO BKB V1.0.0 yang dibuat menggunakan
                                        framework
                                        CodeIgniter 4 pada tahun 2021</p>
                                    <p><span>ALO BKB V2.1.0</span> telah mendapatkan pembaharuan untuk mengelola data
                                        logbook
                                        lebih mudah, dimana user dapat mengunduh data yang sudah disimpan ke website</p>
                                    <p><span>ALO BKB V2.2.0</span> telah mendapatkan pembaharuan untuk mengelola data
                                        parameter gempa. Data ini dapat disimpan menggunakan inputan teks dari website
                                        pertukaran data gempa EXDX. Terdapat fitur generate infografis yang dapat membantu
                                        diseminasi informasi kepada masyarakat</p>
                                    <p><span>ALO BKB V2.2.1</span> telah mendapatkan pembaharuan untuk mengelola data
                                        logbook.</p>
                                    <ol>
                                        <li>
                                            Sekarang user hanya perlu mengisi tanggal dinas, jam mulai dinas, siapa
                                            saja yang dinas, serta catatan penting yang diperlukan. Poin lainnya akan
                                            lansung
                                            ditambahkan oleh sistem karena poin-poin yang lain cenderung berulang.
                                        </li>
                                        <li>
                                            Terdapat pembaharuan untuk pilihan mengunduh data, sekarang user dapat mengunduh
                                            data logbook berdasarkan rentang waktu tertentu.
                                        </li>
                                        <p>
                                            Harapannya dapat membantu pegawai Stageof Balikpapan untuk mengisi logbook
                                            harian
                                        </p>
                                    </ol>
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
@endpush
