@extends('layouts.app')

@section('title', 'Peta Sebaran Aloptama')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Peta Sebaran Aloptama</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Aloptama</div>
                    <div class="breadcrumb-item">Peta Sebaran Aloptama</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Peta Sebaran Aloptama</h2>
                <p class="section-lead">Halaman pemetaan dan sebaran geografis Aloptama.</p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Peta Sebaran Aloptama</h4>
                            </div>
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-map-location-dot"></i>
                                    </div>
                                    <h2>Halaman Peta Sebaran Aloptama</h2>
                                    <p class="lead">
                                        Halaman ini siap untuk diintegrasikan dengan peta interaktif (misal Leaflet/GIS) untuk menampilkan sebaran Aloptama.
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
