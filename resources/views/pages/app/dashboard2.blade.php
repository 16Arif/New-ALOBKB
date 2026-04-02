@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <style>
        /* Custom styling agar avatar lebih rapi */
        .user-avatar-custom {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .card-statistic-custom {
            border-bottom: 4px solid #6777ef;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard Operasional</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger text-white"><i class="fas fa-globe"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Gempabumi</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalGempabumi }}
                                @if ($tanggalPertama)
                                    <div class="text-small text-muted mt-1" style="font-size: 10px; font-weight: 400;">
                                        Sejak {{ \Carbon\Carbon::parse($tanggalPertama)->translatedFormat('d F Y') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning text-white"><i class="fas fa-hands"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Gempa Dirasakan</h4>
                            </div>
                            <div class="card-body">
                                {{ $gempaDirasakan }}
                                @if ($tanggalPertama)
                                    <div class="text-small text-muted mt-1" style="font-size: 10px; font-weight: 400;">
                                        Sejak {{ \Carbon\Carbon::parse($tanggalPertama)->translatedFormat('d F Y') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tren Aktivitas Gempa</h4>
                            <div class="card-header-action">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" id="btnWeekly">Mingguan</button>
                                    <button type="button" class="btn btn-outline-primary" id="btnMonthly">Bulanan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="earthquakeTrendChart" height="300"></canvas>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card" style="min-height: 400px;">
                                <div class="card-header">
                                    <h4>Monitoring Logbook</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-pills mb-3" id="logbookTab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                href="#petir">Petir</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#gempa">Gempa</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                href="#peralatan">Peralatan</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="petir">@include('components.logbook-petir')
                                        </div>
                                        <div class="tab-pane fade" id="gempa">@include('components.logbook-gempa')</div>
                                        <div class="tab-pane fade" id="peralatan">@include('components.logbook-peralatan')</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card" style="min-height: 400px;">
                                <div class="card-header">
                                    <h4>Komposisi Data Logbook</h4>
                                </div>
                                <div class="card-body d-flex align-items-center">
                                    <canvas id="logbookPieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12">

                    <div class="card card-danger">
                        <div class="card-header">
                            <h4><i class="fas fa-bullseye text-danger"></i> Gempa Terakhir</h4>
                        </div>
                        <div class="card-body text-center pt-0">
                            @if ($latestGempa)
                                <div class="display-data mb-3">
                                    <h1 class="text-danger mb-0" style="font-size: 3.5rem; font-weight: 800;">
                                        {{ $latestGempa->magnitudo }}</h1>
                                    <div class="font-weight-bold text-uppercase small">Magnitudo</div>
                                </div>

                                <div class="text-left border-top pt-3">
                                    <p class="mb-2"><strong>Waktu:</strong><br>
                                        <small
                                            class="text-muted">{{ \Carbon\Carbon::parse($latestGempa->tanggal)->translatedFormat('d M Y') }}
                                            | {{ $latestGempa->waktu_wita }} WITA</small>
                                    </p>
                                    <p class="mb-2"><strong>Lokasi:</strong><br>
                                        <small class="text-dark font-weight-600">{{ $latestGempa->jarak }}</small>
                                    </p>
                                    <div class="row no-gutters mt-3">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Kedalaman</small>
                                            <span class="badge badge-info">{{ $latestGempa->kedalaman }} Km</span>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Status</small>
                                            @if ($latestGempa->dirasakan)
                                                <span class="badge badge-danger">Dirasakan</span>
                                            @else
                                                <span class="badge badge-secondary">Siknifikant</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted">Data tidak tersedia</p>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Pegawai</h4>
                        </div>
                        <div class="card-body p-0" style="max-height: 410px; overflow-y: auto;">
                            <table class="table table-striped table-sm mb-0">
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="pl-3 py-2">
                                                <img alt="image"
                                                    src="{{ $user->image ? asset('storage/' . $user->image) : asset('img/avatar1.svg') }}"
                                                    class="rounded-circle mr-2" width="30">
                                                <div class="d-inline-block">
                                                    <div class="font-weight-600"
                                                        style="font-size: 11px; line-height: 1.2;">
                                                        {{ Str::limit($user->name, 20) }}</div>
                                                    <div class="text-muted" style="font-size: 10px;">
                                                        {{ Str::limit($user->email, 20) }}</div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer p-2 text-center bg-white border-top">
                            <div class="small-pagination">
                                {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>

    <script>
        var ctx = document.getElementById("logbookPieChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut', // Doughnut terlihat lebih modern dari Pie biasa
            data: {
                datasets: [{
                    data: [
                        {{ $logbookpetirs->count() }},
                        {{ $logbookgempas->count() }},
                        {{ $logbookperalatans->count() }}
                    ],
                    backgroundColor: ['#ffa426', '#fc544b', '#6777ef'],
                }],
                labels: ['Petir', 'Gempa', 'Peralatan'],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom'
                },
            }
        });
    </script>

    <script>
        // Formatting label mingguan (Contoh: 2025-13 -> Mg 13 (2025))
        const weeklyLabels = @json(
            $weeklyStats->map(function ($item) {
                $parts = explode('-', $item->period);
                return 'Mg ' . $parts[1] . ' (' . $parts[0] . ')';
            }));
        const weeklyData = @json($weeklyStats->pluck('total'));

        // Formatting label bulanan (Contoh: 2025-01 -> January 2025)
        const monthlyLabels = @json(
            $monthlyStats->map(function ($item) {
                // Kita tambahkan -01 agar Carbon bisa membacanya sebagai tanggal valid
                return \Carbon\Carbon::parse($item->period . '-01')->translatedFormat('F Y');
            }));
        const monthlyData = @json($monthlyStats->pluck('total'));

        // --- Inisialisasi Chart.js ---
        var ctx = document.getElementById("earthquakeTrendChart").getContext('2d');
        var trendChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: weeklyLabels,
                datasets: [{
                    label: 'Total Kejadian',
                    data: weeklyData,
                    borderColor: '#fc544b',
                    backgroundColor: 'rgba(252, 84, 75, 0.1)',
                    borderWidth: 3,
                    pointRadius: 4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });

        // Logika ganti data (sama seperti sebelumnya)
        document.getElementById('btnWeekly').addEventListener('click', function() {
            updateChart('Mingguan', weeklyLabels, weeklyData, this, 'btnMonthly');
        });

        document.getElementById('btnMonthly').addEventListener('click', function() {
            updateChart('Bulanan', monthlyLabels, monthlyData, this, 'btnWeekly');
        });

        function updateChart(label, labels, data, activeBtn, inactiveBtnId) {
            activeBtn.classList.remove('btn-outline-primary');
            activeBtn.classList.add('btn-primary');
            const inactiveBtn = document.getElementById(inactiveBtnId);
            inactiveBtn.classList.add('btn-outline-primary');
            inactiveBtn.classList.remove('btn-primary');

            trendChart.data.labels = labels;
            trendChart.data.datasets[0].data = data;
            trendChart.update();
        }
    </script>
@endpush
