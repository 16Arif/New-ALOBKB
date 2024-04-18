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
                                    <p><span>ALO BKB V2.0.0</span> saat ini dikembangkan menggunakan framework Laravel 10
                                        dan merupakan hasil pengembangan dari ALO BKB V1.0.0 yang dibuat menggunakan
                                        framework
                                        CodeIgniter 4 pada tahun 2021</p>
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
