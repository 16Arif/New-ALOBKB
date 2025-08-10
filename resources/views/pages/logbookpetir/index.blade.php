@extends('layouts.app')

@section('title', 'Logbook Petir')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">

                <h1>Stasiun Geofisika Balikpapan</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                    <div class="breadcrumb-item">Logbook Petir</div>
                </div>
            </div>
            <div class="section-body">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <h2 class="section-title ">Logbook Peralatan</h2>
                    <button id="toggleDownloadBtn" class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEditForm" aria-expanded="false" aria-controls="collapseEditForm">
                        <i class="fa-solid fa-download me-1"></i> Unduh Data
                    </button>
                </div>
                <div class="row ml-1">
                    <div class=" float-right">
                        <!-- Konten Collapse -->
                        <div class="collapse" id="collapseEditForm">
                            <div class="card bg-light shadow rounded p-3">
                                <!-- Download Semua Data -->
                                <div class="mb-3">
                                    <a href="{{ route('export.spatie_petir', ['start' => '1900-01-01', 'end' => now()->format('Y-m-d')]) }}"
                                        class="btn btn-outline-success w-100">
                                        <i class="fa-solid fa-file-excel"></i> Unduh Semua Data
                                    </a>
                                </div>
                                <hr>

                                <!-- Form Export Berdasarkan Tanggal -->
                                <form action="{{ route('export.spatie_petir') }}" method="GET"
                                    class="row g-2 align-items-end">
                                    <div class="col-md-5">
                                        <label class="form-label">Dari Tanggal</label>
                                        <input type="date" name="start" class="form-control" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label">Sampai Tanggal</label>
                                        <input type="date" name="end" class="form-control" required>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="fa-solid fa-download me-1"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Data Logbook Petir</h3>
                                <div class="section-header-button">

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <a href="{{ route('logbookpetir.create') }}" class="btn btn-sm btn-primary">Tambah
                                        Data</a>
                                </div>

                                <div class="float-right mb-3">
                                    <form method="GET" action="{{ route('logbookpetir.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari" name="search"
                                                value="{{ request('search') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jam Dinas</th>
                                            <th>On Duty</th>
                                            <th class="col-md-4">Tugas Tambahan</th>
                                            <th></th>
                                        </tr>

                                        @forelse ($logbookpetirs as $index => $lbp)
                                            <tr>
                                                <td>{{ $logbookpetirs->firstItem() + $index }}</td>
                                                </td>
                                                <td>{{ $lbp->tanggal }}
                                                </td>
                                                <td>
                                                    {{ $lbp->jam }} WITA
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>{{ $lbp->onduty1 }}</li>
                                                        <li>{{ $lbp->onduty2 }}</li>
                                                        <li>{{ $lbp->onduty3 }}</li>
                                                    </ul>
                                                </td>
                                                <td>{!! $lbp->note !!}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('logbookpetir.show', $lbp->id) }}"
                                                            target="_blank">

                                                            <div class="btn btn-sm btn-success btn-icon mx-2">

                                                                <i class="fa-solid fa-file-pdf"></i>
                                                            </div>
                                                        </a>
                                                        <a href="{{ route('logbookpetir.edit', $lbp->id) }}">
                                                            <div class="btn btn-sm btn-info btn-icon">
                                                                <i class="fas fa-edit"></i>
                                                            </div>
                                                        </a>
                                                        <form action="{{ route('logbookpetir.destroy', $lbp->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button class="btn btn-sm btn-danger btn-icon"
                                                                onclick="return confirmDelete({{ $lbp->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data ditemukan.</td>
                                            </tr>
                                        @endforelse

                                    </table>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $logbookpetirs->withQueryString()->links() }}
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

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <script>
        function confirmDelete(userId) {
            var result = confirm("Are you sure you want to delete this data?");
            return result;
        }

        // {{-- untuk animasi button download  --}}
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById('toggleDownloadBtn');
            const collapseTarget = document.getElementById('collapseEditForm');

            collapseTarget.addEventListener('shown.bs.collapse', () => {
                toggleBtn.innerHTML = '<i class="fa-solid fa-xmark me-1"></i> Batalkan';
            });

            collapseTarget.addEventListener('hidden.bs.collapse', () => {
                toggleBtn.innerHTML = '<i class="fa-solid fa-download me-1"></i> Unduh Data';
            });
        });
    </script>
@endpush
