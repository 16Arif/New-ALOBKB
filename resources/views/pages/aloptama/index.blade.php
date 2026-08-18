@extends('layouts.app')

@section('title', 'Data Aloptama')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Aloptama</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Aloptama</div>
                    <div class="breadcrumb-item">Data Aloptama</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Aloptama</h2>
                <p class="section-lead">Halaman pengelolaan data Aloptama (Peralatan Operasional Utama).</p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Aloptama</h4>
                            </div>
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-satellite-dish"></i>
                                    </div>
                                    <h2>Halaman Data Aloptama</h2>
                                    <p class="lead">
                                        Halaman ini siap untuk diisi dengan konten tabel atau modul data Aloptama.
                                    </p>
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
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
