@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@php
    // Mendapatkan waktu saat ini
    $currentTime = now()->timezone('Asia/Makassar');
    // Menentukan batas waktu hingga jam 14:00 WITA
    $cutoffTime1 = now()->timezone('Asia/Makassar')->setHour(13)->setMinute(57)->setSecond(0);
    $cutoffTime2 = now()->timezone('Asia/Makassar')->setHour(13)->setMinute(59)->setSecond(0);
@endphp

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard </h1>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body pt-2 pb-2">
                            @if ($currentTime->lessThan($cutoffTime2))
                                @if ($logbookpetirs->count() > 0 && $logbookpetirs[0]->created_at->greaterThanOrEqualTo(now()->subDay()))
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">On Duty</th>
                                                <th scope="col">Kehadiran</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>{{ $logbookpetirs[0]->tanggal }}</td>
                                                <td>
                                                    <ul>
                                                        <li>{{ $logbookpetirs[0]->onduty1 }}</li>
                                                        <li>{{ $logbookpetirs[0]->onduty2 }}</li>
                                                        <li>{{ $logbookpetirs[0]->onduty3 }}</li>
                                                    </ul>
                                                </td>
                                                <td>{{ $logbookpetirs[0]->kehadiran }}</td>
                                                <td>{{ $logbookpetirs[0]->created_at->diffForHumans() }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <div class="d-flex justify-content-center">
                                        <div class="spinner-border" role="status"></div>
                                    </div>
                                    <p class="text-center">
                                        {{ $logbookpetirs->count() > 0 ? 'Data Belum Ditambahkan dalam 24 jam' : 'Tidak Ada Data' }}
                                    </p>
                                @endif
                            @else
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border" role="status"></div>
                                </div>
                                <p class="text-center">Data Logbook Petir belum ditambahkan Shift Malam</p>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Authors</h4>
                        </div>
                        <div class="card-body">
                            <div class="row pb-2">
                                @foreach ($users as $user)
                                    <div class="col-6 col-sm-3 col-lg-3 mb-md-0 mb-4">
                                        <div class="avatar-item mb-4">
                                            <img src="https://source.unsplash.com/400x400?news,water"
                                                class="img-fluid rounded-start" alt="bg-card" title="{{ $user->name }}">
                                            <div class="avatar-badge" title="Editor" data-toggle="tooltip"><i
                                                    class="fas fa-eye"></i></div>
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
@endpush
