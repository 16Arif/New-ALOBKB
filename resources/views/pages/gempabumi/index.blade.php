@extends('layouts.app')

@section('title', 'Data Gempabumi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Stageof Balikpapan</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Gempabumi</a></div>
                    <div class="breadcrumb-item">Parameter Gempa</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Parameter Gempabumi Kalimantan dan Sekitarnya</h2>
                <div class="row">
                    <div class="col-12">

                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-header">
                                <h4>Semua Data</h4>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="float-left ml-3">

                                        <!-- Tombol Collapse -->
                                        <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseEditForm" aria-expanded="false"
                                            aria-controls="collapseEditForm">
                                            <i class="fa-solid fa-download me-1"></i> Download Data
                                        </button>

                                        <!-- Konten Collapse -->
                                        <div class="collapse" id="collapseEditForm">
                                            <div class="card bg-light shadow rounded p-3">
                                                <!-- Download Semua Data -->
                                                <div class="mb-3">
                                                    <a href="{{ route('export.spatie_parametergempa', ['start' => '1900-01-01', 'end' => now()->format('Y-m-d')]) }}"
                                                        class="btn btn-outline-success w-100">
                                                        <i class="fa-solid fa-file-excel"></i> Export Semua Data
                                                    </a>

                                                </div>

                                                <hr>

                                                <!-- Form Export Berdasarkan Tanggal -->
                                                <form action="{{ route('export.spatie_parametergempa') }}" method="GET"
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


                                    <div class="float-right mr-3">
                                        <form method="GET" action="{{ route('gempabumi.index') }}">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search"
                                                    name="search" value="{{ request('search') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive mt-3">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Waktu (WIB)</th>
                                            <th>Waktu (UTC)</th>
                                            <th>Waktu (WITA)</th>
                                            <th>Lintang</th>
                                            <th>Bujur</th>
                                            <th>Magnitudo</th>
                                            <th>Kedalaman (Km)</th>
                                            <th>Jarak</th>
                                            <th>Dirasakan</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datagempa as $data)
                                            <tr>
                                                <td>{{ $no++ }}.</td>
                                                <td>{{ $data->tanggal }}</td>
                                                <td>{{ $data->waktu }}</td>
                                                <td>{{ $data->waktu_utc }}</td>
                                                <td>{{ $data->waktu_wita }}</td>
                                                <td>{{ $data->lintang }}</td>
                                                <td>{{ $data->bujur }}</td>
                                                <td>{{ $data->magnitudo }}</td>
                                                <td>{{ $data->kedalaman }}</td>
                                                <td>{{ $data->jarak }}</td>
                                                <td>{{ $data->dirasakan }}</td>
                                                <td>{!! $data->keterangan !!}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">

                                                        <a href="{{ route('gempabumi.edit', $data->id) }}">
                                                            <div class="btn btn-sm btn-info btn-icon">
                                                                <i class="fas fa-edit"></i>
                                                            </div>
                                                        </a>
                                                        <form action="{{ route('gempabumi.destroy', $data->id) }}"
                                                            method="POST" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon"
                                                                onclick="return confirmDelete({{ $data->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </div>
                                <div class="float-right mt-3">
                                    {{ $datagempa->withQueryString()->links() }}
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
        function confirmDelete(userId) {
            var result = confirm("Are you sure you want to delete this data?");
            return result;
        }
    </script>
@endpush
