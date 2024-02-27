@extends('layouts.app')

@section('title', 'Logbook Peralatan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Logbook Peralatan</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Logbook</a></div>
                    <div class="breadcrumb-item">Logbook Peralatan</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Data</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <div class="section-header-button">
                                        <a href="{{ route('logbookperalatan.create') }}" class="btn btn-sm btn-primary">Add
                                            New</a>
                                    </div>
                                </div>
                                {{-- <a href="{{ route('download.index') }}"  target="_blank">
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
                                    <form method="GET" action="{{ route('logbookperalatan.index') }}">
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
                                            <th>Finger Print</th>
                                            <th>TDS</th>
                                            <th>NextStorm</th>
                                            <th>Obs NexStorm 4</th>
                                            <th>CMSS</th>
                                            <th>Monitoring Sensor</th>
                                            <th>Accelerograph</th>
                                            <th>WRS NG</th>
                                            <th>Integrasi Data</th>
                                            <th>Seiscomp4</th>
                                            <th>PC Magnet</th>
                                            </th>
                                            <th>Penakar Hujan</th>
                                            </th>
                                            <th>Radio SSB</th>
                                            </th>
                                            <th>Kondisi</th>
                                            <th>created_at</th>
                                        </tr>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($logbookperalatans as $lbp)
                                            <tr>
                                                <td>{{ $no++ }}.</td>
                                                <td>{{ $lbp->tanggal }}
                                                </td>
                                                <td>{{ $lbp->jam }} WITA
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>{{ $lbp->onduty1 }}</li>
                                                        <li>{{ $lbp->onduty2 }}</li>
                                                        <li>{{ $lbp->onduty3 }}</li>
                                                    </ul>
                                                </td>
                                                </td>
                                                <td>{{ $lbp->kehadiran }}
                                                </td>
                                                <td>
                                                    {{ $lbp->fingerprint }}
                                                </td>
                                                <td>
                                                    {{ $lbp->tds }}
                                                </td>
                                                <td>
                                                    {{ $lbp->nexstorm }}
                                                </td>
                                                <td>
                                                    {{ $lbp->obs_nexstorm }}
                                                </td>
                                                <td>
                                                    {{ $lbp->cmss }}
                                                </td>
                                                <td>
                                                    {{ $lbp->monitoring }}
                                                </td>
                                                <td>
                                                    {{ $lbp->acc }}
                                                </td>
                                                <td>
                                                    {{ $lbp->wrsng }}
                                                </td>
                                                <td>
                                                    {{ $lbp->integrasi_data }}
                                                </td>
                                                <td>
                                                    {{ $lbp->seiscomp4 }}
                                                </td>
                                                <td>
                                                    {{ $lbp->pc_magnet }}
                                                </td>
                                                <td>
                                                    {{ $lbp->penakar_hujan }}
                                                </td>
                                                <td>
                                                    {{ $lbp->radio_ssb }}
                                                </td>
                                                <td>
                                                    {{ $lbp->kondisi }}
                                                </td>
                                                <td>{{ $lbp->created_at }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('logbookperalatan.show', $lbp->id) }}"
                                                            target="_blank">
                                                            <div class="btn btn-sm btn-info btn-icon mx-2">
                                                                <i class="fa-solid fa-file-pdf"></i>
                                                            </div>
                                                        </a>
                                                        <a href="{{ route('logbookperalatan.edit', $lbp->id) }}">
                                                            <div class="btn btn-sm btn-info btn-icon">
                                                                <i class="fas fa-edit"></i>
                                                            </div>
                                                        </a>
                                                        <form action="{{ route('logbookperalatan.destroy', $lbp->id) }}"
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
                                        @endforeach

                                    </table>
                                </div>
                                <div class="float-right mt-3">
                                    {{ $logbookperalatans->withQueryString()->links() }}
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
