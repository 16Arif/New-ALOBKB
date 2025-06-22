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
                                        <a href="{{ route('export.spatie_parametergempa') }}">
                                            <div class="btn btn-sm btn-outline-success btn-icon mx-2">
                                                <i class="fa-solid fa-file-excel"> </i><span> Download Semua Data</span>
                                            </div>
                                        </a>
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
                                            <th>Magnitudo</th>
                                            <th>Bujur</th>
                                            <th>Lintang</th>
                                            <th>Jarak</th>
                                            <th>Kedalaman (Km)</th>
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
                                                <td>{{ $data->waktuUtc }}</td>
                                                <td>{{ $data->magnitudo }}</td>
                                                <td>{{ $data->bujur }}</td>
                                                <td>{{ $data->lintang }}</td>
                                                <td>{{ $data->jarak }}</td>
                                                <td>{{ $data->kedalaman }}</td>
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
