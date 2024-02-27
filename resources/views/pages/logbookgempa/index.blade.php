@extends('layouts.app')

@section('title', 'Logbook Gempa')

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
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Logbook</a></div>
                    <div class="breadcrumb-item">Logbook Gempa</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Logbook Gempa</h2>
                <p class="section-lead">
                    Lakukan Pengelolaan Data Logbook Gempa.
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Data</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <div class="section-header-button">
                                        <a href="{{ route('logbookgempa.create') }}" class="btn btn-primary">Add New</a>
                                    </div>
                                </div>
                                {{-- <a href="{{ route('download.index') }}" target="_blank">
                                    <div class="btn btn-sm btn-info btn-icon mx-2">
                                        <i class="fa-solid fa-file-pdf"> </i><span> Download Semua Data</span>
                                    </div>
                                
                                </a> --}}
                                {{-- <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div> --}}
                                <div class="float-right">
                                    <form method="GET" action="{{ route('logbookgempa.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="search"
                                                value="{{ request('search') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jam Dinas</th>
                                            <th>On Duty</th>
                                            <th>Kehadiran</th>
                                            <th>Kegiatan 1</th>
                                            <th>Kegiatan 2</th>
                                            <th>Monitoring 1</th>
                                            <th>Berita 1</th>
                                            <th>Monitoring 2</th>
                                            <th>Berita 2</th>
                                            <th>Kondisi</th>
                                        </tr>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($logbookgempas as $lpg)
                                            <tr>
                                                <td>{{ $no++ }}.</td>
                                                <td>{{ $lpg->tanggal }}
                                                </td>
                                                <td>{{ $lpg->jam }} WITA
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>{{ $lpg->onduty1 }}</li>
                                                        <li>{{ $lpg->onduty2 }}</li>
                                                        <li>{{ $lpg->onduty3 }}</li>
                                                    </ul>
                                                </td>

                                                <td>{{ $lpg->kehadiran }}
                                                </td>
                                                <td>
                                                    {{ $lpg->kegiatan1 }}
                                                </td>
                                                <td>
                                                    {{ $lpg->kegiatan2 }}
                                                </td>
                                                <td>
                                                    {{ $lpg->monitoring1 }}
                                                </td>
                                                <td>
                                                    {{ $lpg->berita1 }}
                                                </td>
                                                <td>
                                                    {{ $lpg->monitoring2 }}
                                                </td>
                                                <td>
                                                    {{ $lpg->berita2 }}
                                                </td>
                                                <td>
                                                    {{ $lpg->kondisi }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('logbookgempa.show', $lpg->id) }}"
                                                            target="_blank">
                                                            <div class="btn btn-sm btn-info btn-icon mx-2">
                                                                <i class="fa-solid fa-file-pdf"></i>
                                                            </div>
                                                        </a>
                                                        <a href="{{ route('logbookgempa.edit', $lpg->id) }}">
                                                            <div class="btn btn-sm btn-info btn-icon">
                                                                <i class="fas fa-edit"></i>
                                                            </div>
                                                        </a>
                                                        <form action="{{ route('logbookgempa.destroy', $lpg->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button class="btn btn-sm btn-danger btn-icon"
                                                                onclick="return confirmDelete({{ $lpg->id }})">
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
                                    {{ $logbookgempas->withQueryString()->links() }}
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
    </script>
@endpush
