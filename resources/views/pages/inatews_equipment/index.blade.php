@extends('layouts.app')

@section('title', 'Data Peralatan Site InaTEWS')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Site Ina-TEWS</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Kelola Data Site Ina-TEWS</a></div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">

                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Peralatan</h4>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="d-flex justify-content-center">
                                        <h6>Data Code Site InaTEWS</h6>
                                    </div>
                                    <div class="section-header-button mb-2 mx-2 text-center">
                                        <a href="{{ route('inatewscode.create') }}" class="btn btn-sm btn-primary">Tambah
                                            Data</a>
                                    </div>
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Kode Site</th>
                                                    <th scope="col">Nama Site</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($dataCode as $index => $data)
                                                    <tr>
                                                        <td>{{ $dataCode->firstItem() + $index }}.</td>
                                                        <td>{{ $data->kode_site }}
                                                        </td>
                                                        <td>{{ $data->nama_site }}
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <a href="{{ route('inatewscode.edit', $data->id) }}">
                                                                    <div class="btn btn-sm btn-info btn-icon">
                                                                        <i class="fas fa-edit"></i>
                                                                    </div>
                                                                </a>
                                                                <form action="{{ route('inatewscode.destroy', $data->id) }}"
                                                                    method="POST" class="ml-2">
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <input type="hidden" name="_token"
                                                                        value="{{ csrf_token() }}">
                                                                    <button class="btn btn-sm btn-danger btn-icon"
                                                                        onclick="return confirmDelete({{ $data->id }})">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">Belum ada data tersedia.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $dataCode->links() }}
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-center mt-3">
                                        <h6>Data Informasi Site Ina-TEWS</h6>
                                    </div>
                                    <div class="section-header-button mb-2 mx-2 text-center">
                                        <a href="{{ route('inatewsinformation.create') }}"
                                            class="btn btn-sm btn-primary">Tambah
                                            Data</a>
                                    </div>
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Latitude</th>
                                                    <th scope="col">Longitude</th>
                                                    <th scope="col">Elevasi</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($dataInformation as $index => $datainfo)
                                                    <tr>
                                                        <td>{{ $dataInformation->firstItem() + $index }}.</td>
                                                        <td>{{ $datainfo->lat }}
                                                        </td>
                                                        <td>{{ $datainfo->long }}
                                                        </td>
                                                        <td>{{ $datainfo->elevasi }}
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <a href="">
                                                                    <div class="btn btn-sm btn-success btn-icon mx-2">
                                                                        <i class="fas fa-eye"></i>
                                                                    </div>
                                                                </a>
                                                                <a
                                                                    href="{{ route('inatewsinformation.edit', $datainfo->id) }}">
                                                                    <div class="btn btn-sm btn-info btn-icon">
                                                                        <i class="fas fa-edit"></i>
                                                                    </div>
                                                                </a>
                                                                <form
                                                                    action="{{ route('inatewsinformation.destroy', $datainfo->id) }}"
                                                                    method="POST" class="ml-2">
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <input type="hidden" name="_token"
                                                                        value="{{ csrf_token() }}">
                                                                    <button class="btn btn-sm btn-danger btn-icon"
                                                                        onclick="return confirmDelete({{ $datainfo->id }})">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">Belum ada data tersedia.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $dataInformation->links() }}
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-center mt-3">
                                        <h6>Data Peralatan Site Ina-TEWS</h6>
                                    </div>
                                    <div class="section-header-button mb-2 mx-2 text-center">
                                        <a href="{{ route('inatewsequipment.create') }}"
                                            class="btn btn-sm btn-primary">Tambah
                                            Data</a>
                                    </div>
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Manufaktur Seismograph</th>
                                                    <th scope="col">Tipe Seismograph</th>
                                                    <th scope="col">S/N Seismograph</th>
                                                    <th scope="col">Tanggal Installasi Seismograph</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($dataEquipment as $index => $dataE)
                                                    <tr>
                                                        <td>{{ $dataEquipment->firstItem() + $index }}.</td>
                                                        <td>{{ $dataE->manufaktur_seismo }}
                                                        </td>
                                                        <td>{{ $dataE->tipe_seismo }}
                                                        </td>
                                                        <td>{{ $dataE->sn_seismo }}
                                                        </td>
                                                        <td>{{ $dataE->tglinstall_seismo }}
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-1 justify-content-center">
                                                                <a href="">
                                                                    <div class="btn btn-sm btn-success btn-icon mx-2">
                                                                        <i class="fas fa-eye"></i>
                                                                    </div>
                                                                </a>
                                                                <a href="{{ route('inatewsequipment.edit', $dataE->id) }}">
                                                                    <div class="btn btn-sm btn-info btn-icon">
                                                                        <i class="fas fa-edit"></i>
                                                                    </div>
                                                                </a>
                                                                <form
                                                                    action="{{ route('inatewsequipment.destroy', $dataE->id) }}"
                                                                    method="POST" class="mx-2">
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <input type="hidden" name="_token"
                                                                        value="{{ csrf_token() }}">
                                                                    <button class="btn btn-sm btn-danger btn-icon"
                                                                        onclick="return confirmDelete({{ $data->id }})">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">Belum ada data tersedia.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $dataEquipment->links() }}
                                    </div>
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
