@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush



@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard </h1>
            </div>
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body pt-2 pb-2">
                            {{-- Tabel untuk cek data terbaru tiap shift --}}
                            @include('components.logbook-petir')
                            @include('components.logbook-gempa')
                            @include('components.logbook-peralatan')
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pegawai</h4>
                        </div>
                        <div class="card-body">
                            <div class="row pb-2">
                                @foreach ($users as $user)
                                    <div class="col-6 col-sm-3 col-lg-3 mb-md-0 mb-4">
                                        <div class="avatar-item mb-4">

                                            @if ($user->image)
                                                <div style="width: 120px; height: 120px;">
                                                    <img src="{{ asset('storage/' . $user->image) }}"
                                                        class="img-fluid img-thumbnail rounded mx-3 " alt="bg-card"
                                                        title="{{ $user->name }}">
                                                </div>
                                            @else
                                                <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                    class="img-fluid img-thumbnail rounded" alt="bg-card"
                                                    title="{{ $user->name }}">
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <div class="float-right mt-3">
                                    {{ $users->withQueryString()->links() }}
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
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
@endpush
