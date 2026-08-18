@extends('layouts.app')

@section('title', 'Data Aloptama')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                @include('layouts.alert')
            </div>
        </div>

        <section class="section">
            <div class="section-header">
                <h1>Data Aloptama</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Aloptama</div>
                    <div class="breadcrumb-item">Data Peralatan</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Peralatan Operasional Utama (Aloptama)</h2>
                <p class="section-lead">Manajemen inventaris dan spesifikasi sensor Seismograph, Accelerograph Non Colocated, Lightning Detector, WRS New Generation, serta Magnet Prekursor.</p>

                <!-- CARD 1: DATA SEISMOGRAPH -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header justify-content-between">
                                <h4><i class="fas fa-satellite-dish mr-2 text-primary"></i> Data Seismograph</h4>
                                <div class="card-header-action">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalCreateSeismograph">
                                        <i class="fas fa-plus mr-1"></i> Tambah Data Seismograph
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                                    <!-- Dropdown Urutkan Seismograph -->
                                    <div class="dropdown my-2">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="sortDropdownSeismo" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-sort"></i> Urutkan
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="sortDropdownSeismo">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_seismo' => 'id_desc']) }}">
                                                    Data Terbaru
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_seismo' => 'nama_site_asc']) }}">
                                                    Nama Site (A - Z)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_seismo' => 'nama_site_desc']) }}">
                                                    Nama Site (Z - A)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_seismo' => 'lokasi_asc']) }}">
                                                    Lokasi (A - Z)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_seismo' => 'lokasi_desc']) }}">
                                                    Lokasi (Z - A)
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Pencarian Seismograph -->
                                    <div class="my-2">
                                        <form method="GET" action="{{ route('aloptama.index') }}">
                                            @if (request('search_acc'))
                                                <input type="hidden" name="search_acc" value="{{ request('search_acc') }}">
                                            @endif
                                            @if (request('search_ld'))
                                                <input type="hidden" name="search_ld" value="{{ request('search_ld') }}">
                                            @endif
                                            @if (request('search_wrs'))
                                                <input type="hidden" name="search_wrs" value="{{ request('search_wrs') }}">
                                            @endif
                                            @if (request('search_magnet'))
                                                <input type="hidden" name="search_magnet" value="{{ request('search_magnet') }}">
                                            @endif
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Cari seismograph..."
                                                    name="search_seismo" autocomplete="off" value="{{ request('search_seismo') ?? request('search') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <thead>
                                            <tr>
                                                <th style="width: 60px;">#</th>
                                                <th>Nama Site</th>
                                                <th>Lokasi</th>
                                                <th class="text-center" style="width: 130px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($seismographs as $index => $seismo)
                                                <tr>
                                                    <td>{{ $seismographs->firstItem() + $index }}</td>
                                                    <td>
                                                        <span class="font-weight-600 text-dark">{{ $seismo->nama_site }}</span>
                                                    </td>
                                                    <td>{{ $seismo->lokasi }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <!-- Tombol Edit/Show Pop-up -->
                                                            <button type="button"
                                                                class="btn btn-sm btn-info btn-icon btn-edit-seismograph"
                                                                title="Detail & Edit Data"
                                                                data-id="{{ $seismo->id }}"
                                                                data-nama_site="{{ $seismo->nama_site }}"
                                                                data-lokasi="{{ $seismo->lokasi }}"
                                                                data-latitude="{{ $seismo->latitude }}"
                                                                data-longitude="{{ $seismo->longitude }}"
                                                                data-seismometer="{{ $seismo->seismometer }}"
                                                                data-accelerometer="{{ $seismo->accelerometer }}"
                                                                data-digitizer="{{ $seismo->digitizer }}"
                                                                data-action="{{ route('seismograph.update', $seismo->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>

                                                            <!-- Tombol Hapus -->
                                                            <form action="{{ route('seismograph.destroy', $seismo->id) }}"
                                                                method="POST" class="ml-2"
                                                                onsubmit="return confirmDeleteSeismo('{{ addslashes($seismo->nama_site) }}')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger btn-icon"
                                                                    title="Hapus Data">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-4 text-muted">
                                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                        Tidak ada data seismograph ditemukan.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    {{ $seismographs->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: DATA ACCELEROGRAPH NON COLOCATED -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header justify-content-between">
                                <h4><i class="fas fa-wave-square mr-2 text-primary"></i> Data Accelerograph Non Colocated</h4>
                                <div class="card-header-action">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalCreateAccelerograph">
                                        <i class="fas fa-plus mr-1"></i> Tambah Data Accelerograph
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                                    <!-- Dropdown Urutkan Accelerograph -->
                                    <div class="dropdown my-2">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="sortDropdownAcc" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-sort"></i> Urutkan
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="sortDropdownAcc">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_acc' => 'id_desc']) }}">
                                                    Data Terbaru
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_acc' => 'nama_asc']) }}">
                                                    Nama (A - Z)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_acc' => 'nama_desc']) }}">
                                                    Nama (Z - A)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_acc' => 'lokasi_asc']) }}">
                                                    Lokasi (A - Z)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_acc' => 'lokasi_desc']) }}">
                                                    Lokasi (Z - A)
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Pencarian Accelerograph -->
                                    <div class="my-2">
                                        <form method="GET" action="{{ route('aloptama.index') }}">
                                            @if (request('search_seismo'))
                                                <input type="hidden" name="search_seismo" value="{{ request('search_seismo') }}">
                                            @endif
                                            @if (request('search_ld'))
                                                <input type="hidden" name="search_ld" value="{{ request('search_ld') }}">
                                            @endif
                                            @if (request('search_wrs'))
                                                <input type="hidden" name="search_wrs" value="{{ request('search_wrs') }}">
                                            @endif
                                            @if (request('search_magnet'))
                                                <input type="hidden" name="search_magnet" value="{{ request('search_magnet') }}">
                                            @endif
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Cari accelerograph..."
                                                    name="search_acc" autocomplete="off" value="{{ request('search_acc') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <thead>
                                            <tr>
                                                <th style="width: 60px;">#</th>
                                                <th>Nama</th>
                                                <th>Lokasi</th>
                                                <th class="text-center" style="width: 130px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($accelerographs as $index => $acc)
                                                <tr>
                                                    <td>{{ $accelerographs->firstItem() + $index }}</td>
                                                    <td>
                                                        <span class="font-weight-600 text-dark">{{ $acc->nama }}</span>
                                                    </td>
                                                    <td>{{ $acc->lokasi }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <!-- Tombol Edit/Show Pop-up Accelerograph -->
                                                            <button type="button"
                                                                class="btn btn-sm btn-info btn-icon btn-edit-accelerograph"
                                                                title="Detail & Edit Data"
                                                                data-id="{{ $acc->id }}"
                                                                data-nama="{{ $acc->nama }}"
                                                                data-lokasi="{{ $acc->lokasi }}"
                                                                data-latitude="{{ $acc->latitude }}"
                                                                data-longitude="{{ $acc->longitude }}"
                                                                data-merk="{{ $acc->merk }}"
                                                                data-tipe_accelerometer="{{ $acc->tipe_accelerometer }}"
                                                                data-digitizer="{{ $acc->digitizer }}"
                                                                data-action="{{ route('accelerograph.update', $acc->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>

                                                            <!-- Tombol Hapus Accelerograph -->
                                                            <form action="{{ route('accelerograph.destroy', $acc->id) }}"
                                                                method="POST" class="ml-2"
                                                                onsubmit="return confirmDeleteAcc('{{ addslashes($acc->nama) }}')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger btn-icon"
                                                                    title="Hapus Data">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-4 text-muted">
                                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                        Tidak ada data accelerograph non colocated ditemukan.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    {{ $accelerographs->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: DATA LIGHTNING DETECTOR (LD) -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header justify-content-between">
                                <h4><i class="fas fa-bolt-lightning mr-2 text-primary"></i> Data Lightning Detector (LD)</h4>
                                <div class="card-header-action">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalCreateLightningDetector">
                                        <i class="fas fa-plus mr-1"></i> Tambah Data LD
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                                    <!-- Dropdown Urutkan Lightning Detector -->
                                    <div class="dropdown my-2">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="sortDropdownLd" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-sort"></i> Urutkan
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="sortDropdownLd">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_ld' => 'id_desc']) }}">
                                                    Data Terbaru
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_ld' => 'nama_site_asc']) }}">
                                                    Nama Site (A - Z)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_ld' => 'nama_site_desc']) }}">
                                                    Nama Site (Z - A)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_ld' => 'lokasi_asc']) }}">
                                                    Lokasi (A - Z)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_ld' => 'lokasi_desc']) }}">
                                                    Lokasi (Z - A)
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Pencarian Lightning Detector -->
                                    <div class="my-2">
                                        <form method="GET" action="{{ route('aloptama.index') }}">
                                            @if (request('search_seismo'))
                                                <input type="hidden" name="search_seismo" value="{{ request('search_seismo') }}">
                                            @endif
                                            @if (request('search_acc'))
                                                <input type="hidden" name="search_acc" value="{{ request('search_acc') }}">
                                            @endif
                                            @if (request('search_wrs'))
                                                <input type="hidden" name="search_wrs" value="{{ request('search_wrs') }}">
                                            @endif
                                            @if (request('search_magnet'))
                                                <input type="hidden" name="search_magnet" value="{{ request('search_magnet') }}">
                                            @endif
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Cari lightning detector..."
                                                    name="search_ld" autocomplete="off" value="{{ request('search_ld') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <thead>
                                            <tr>
                                                <th style="width: 60px;">#</th>
                                                <th>Nama Site</th>
                                                <th>Lokasi</th>
                                                <th class="text-center" style="width: 130px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($lightningDetectors as $index => $ld)
                                                <tr>
                                                    <td>{{ $lightningDetectors->firstItem() + $index }}</td>
                                                    <td>
                                                        <span class="font-weight-600 text-dark">{{ $ld->nama_site }}</span>
                                                    </td>
                                                    <td>{{ $ld->lokasi }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <!-- Tombol Edit/Show Pop-up Lightning Detector -->
                                                            <button type="button"
                                                                class="btn btn-sm btn-info btn-icon btn-edit-ld"
                                                                title="Detail & Edit Data"
                                                                data-id="{{ $ld->id }}"
                                                                data-nama_site="{{ $ld->nama_site }}"
                                                                data-lokasi="{{ $ld->lokasi }}"
                                                                data-latitude="{{ $ld->latitude }}"
                                                                data-longitude="{{ $ld->longitude }}"
                                                                data-sensor="{{ $ld->sensor }}"
                                                                data-receiver="{{ $ld->receiver }}"
                                                                data-action="{{ route('lightning-detector.update', $ld->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>

                                                            <!-- Tombol Hapus Lightning Detector -->
                                                            <form action="{{ route('lightning-detector.destroy', $ld->id) }}"
                                                                method="POST" class="ml-2"
                                                                onsubmit="return confirmDeleteLd('{{ addslashes($ld->nama_site) }}')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger btn-icon"
                                                                    title="Hapus Data">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-4 text-muted">
                                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                        Tidak ada data lightning detector ditemukan.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    {{ $lightningDetectors->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 4: DATA WRS NG (WARNING RECEIVER SYSTEM NEW GENERATION) -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header justify-content-between">
                                <h4><i class="fas fa-tower-broadcast mr-2 text-primary"></i> Data WRS NG (Warning Receiver System New Gen)</h4>
                                <div class="card-header-action">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalCreateWrsNg">
                                        <i class="fas fa-plus mr-1"></i> Tambah Data WRS NG
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                                    <!-- Dropdown Urutkan WRS NG -->
                                    <div class="dropdown my-2">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="sortDropdownWrs" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-sort"></i> Urutkan
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="sortDropdownWrs">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_wrs' => 'id_desc']) }}">
                                                    Data Terbaru
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_wrs' => 'nama_site_asc']) }}">
                                                    Nama Site (A - Z)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_wrs' => 'nama_site_desc']) }}">
                                                    Nama Site (Z - A)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_wrs' => 'lokasi_asc']) }}">
                                                    Lokasi (A - Z)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_wrs' => 'lokasi_desc']) }}">
                                                    Lokasi (Z - A)
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Pencarian WRS NG -->
                                    <div class="my-2">
                                        <form method="GET" action="{{ route('aloptama.index') }}">
                                            @if (request('search_seismo'))
                                                <input type="hidden" name="search_seismo" value="{{ request('search_seismo') }}">
                                            @endif
                                            @if (request('search_acc'))
                                                <input type="hidden" name="search_acc" value="{{ request('search_acc') }}">
                                            @endif
                                            @if (request('search_ld'))
                                                <input type="hidden" name="search_ld" value="{{ request('search_ld') }}">
                                            @endif
                                            @if (request('search_magnet'))
                                                <input type="hidden" name="search_magnet" value="{{ request('search_magnet') }}">
                                            @endif
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Cari WRS NG..."
                                                    name="search_wrs" autocomplete="off" value="{{ request('search_wrs') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <thead>
                                            <tr>
                                                <th style="width: 60px;">#</th>
                                                <th>Nama Site</th>
                                                <th>Lokasi</th>
                                                <th class="text-center" style="width: 130px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($wrsNgs as $index => $wrs)
                                                <tr>
                                                    <td>{{ $wrsNgs->firstItem() + $index }}</td>
                                                    <td>
                                                        <span class="font-weight-600 text-dark">{{ $wrs->nama_site }}</span>
                                                    </td>
                                                    <td>{{ $wrs->lokasi }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <!-- Tombol Edit/Show Pop-up WRS NG -->
                                                            <button type="button"
                                                                class="btn btn-sm btn-info btn-icon btn-edit-wrs"
                                                                title="Detail & Edit Data"
                                                                data-id="{{ $wrs->id }}"
                                                                data-nama_site="{{ $wrs->nama_site }}"
                                                                data-lokasi="{{ $wrs->lokasi }}"
                                                                data-latitude="{{ $wrs->latitude }}"
                                                                data-longitude="{{ $wrs->longitude }}"
                                                                data-action="{{ route('wrs-ng.update', $wrs->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>

                                                            <!-- Tombol Hapus WRS NG -->
                                                            <form action="{{ route('wrs-ng.destroy', $wrs->id) }}"
                                                                method="POST" class="ml-2"
                                                                onsubmit="return confirmDeleteWrs('{{ addslashes($wrs->nama_site) }}')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger btn-icon"
                                                                    title="Hapus Data">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-4 text-muted">
                                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                        Tidak ada data WRS NG ditemukan.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    {{ $wrsNgs->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 5: DATA MAGNET PREKURSOR -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header justify-content-between">
                                <h4><i class="fas fa-compass mr-2 text-primary"></i> Data Magnet Prekursor</h4>
                                <div class="card-header-action">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalCreateMagnetPrekursor">
                                        <i class="fas fa-plus mr-1"></i> Tambah Data Magnet Prekursor
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                                    <!-- Dropdown Urutkan Magnet Prekursor -->
                                    <div class="dropdown my-2">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="sortDropdownMagnet" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-sort"></i> Urutkan
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="sortDropdownMagnet">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_magnet' => 'id_desc']) }}">
                                                    Data Terbaru
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_magnet' => 'nama_site_asc']) }}">
                                                    Nama Site (A - Z)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_magnet' => 'nama_site_desc']) }}">
                                                    Nama Site (Z - A)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_magnet' => 'lokasi_asc']) }}">
                                                    Lokasi (A - Z)
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ request()->fullUrlWithQuery(['sort_magnet' => 'lokasi_desc']) }}">
                                                    Lokasi (Z - A)
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Pencarian Magnet Prekursor -->
                                    <div class="my-2">
                                        <form method="GET" action="{{ route('aloptama.index') }}">
                                            @if (request('search_seismo'))
                                                <input type="hidden" name="search_seismo" value="{{ request('search_seismo') }}">
                                            @endif
                                            @if (request('search_acc'))
                                                <input type="hidden" name="search_acc" value="{{ request('search_acc') }}">
                                            @endif
                                            @if (request('search_ld'))
                                                <input type="hidden" name="search_ld" value="{{ request('search_ld') }}">
                                            @endif
                                            @if (request('search_wrs'))
                                                <input type="hidden" name="search_wrs" value="{{ request('search_wrs') }}">
                                            @endif
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Cari magnet prekursor..."
                                                    name="search_magnet" autocomplete="off" value="{{ request('search_magnet') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <thead>
                                            <tr>
                                                <th style="width: 60px;">#</th>
                                                <th>Nama Site</th>
                                                <th>Lokasi</th>
                                                <th class="text-center" style="width: 130px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($magnetPrekursors as $index => $mp)
                                                <tr>
                                                    <td>{{ $magnetPrekursors->firstItem() + $index }}</td>
                                                    <td>
                                                        <span class="font-weight-600 text-dark">{{ $mp->nama_site }}</span>
                                                    </td>
                                                    <td>{{ $mp->lokasi }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <!-- Tombol Edit/Show Pop-up Magnet Prekursor -->
                                                            <button type="button"
                                                                class="btn btn-sm btn-info btn-icon btn-edit-magnet"
                                                                title="Detail & Edit Data"
                                                                data-id="{{ $mp->id }}"
                                                                data-nama_site="{{ $mp->nama_site }}"
                                                                data-lokasi="{{ $mp->lokasi }}"
                                                                data-latitude="{{ $mp->latitude }}"
                                                                data-longitude="{{ $mp->longitude }}"
                                                                data-tahun_instalasi="{{ $mp->tahun_instalasi }}"
                                                                data-sensor="{{ $mp->sensor }}"
                                                                data-digitizer="{{ $mp->digitizer }}"
                                                                data-regulator="{{ $mp->regulator }}"
                                                                data-action="{{ route('magnet-prekursor.update', $mp->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>

                                                            <!-- Tombol Hapus Magnet Prekursor -->
                                                            <form action="{{ route('magnet-prekursor.destroy', $mp->id) }}"
                                                                method="POST" class="ml-2"
                                                                onsubmit="return confirmDeleteMagnet('{{ addslashes($mp->nama_site) }}')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger btn-icon"
                                                                    title="Hapus Data">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-4 text-muted">
                                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                        Tidak ada data magnet prekursor ditemukan.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    {{ $magnetPrekursors->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- ==================== MODAL SEISMOGRAPH ==================== -->
    <!-- Modal Tambah Data Seismograph -->
    <div class="modal fade" id="modalCreateSeismograph" tabindex="-1" role="dialog" aria-labelledby="modalCreateSeismoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateSeismoLabel">
                        <i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Data Seismograph
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('seismograph.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="create_nama_site">Nama Site <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_nama_site" name="nama_site"
                                placeholder="Contoh: BBKI - Balikpapan" required>
                        </div>
                        <div class="form-group">
                            <label for="create_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="create_lokasi" name="lokasi" rows="2"
                                placeholder="Contoh: Stasiun Geofisika Balikpapan, Jl. Mulawarman" required style="height: auto;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="create_latitude">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="create_latitude" name="latitude"
                                    placeholder="Contoh: -1.265380" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_longitude">Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="create_longitude" name="longitude"
                                    placeholder="Contoh: 116.831200" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="create_seismometer">Seismometer</label>
                            <input type="text" class="form-control" id="create_seismometer" name="seismometer"
                                placeholder="Contoh: Nanometrics Trillium Compact 120s">
                        </div>
                        <div class="form-group">
                            <label for="create_accelerometer">Accelerometer</label>
                            <input type="text" class="form-control" id="create_accelerometer" name="accelerometer"
                                placeholder="Contoh: Nanometrics Titan Accelerometer">
                        </div>
                        <div class="form-group">
                            <label for="create_digitizer">Digitizer</label>
                            <input type="text" class="form-control" id="create_digitizer" name="digitizer"
                                placeholder="Contoh: Nanometrics Centaur 24-bit">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail & Edit Seismograph -->
    <div class="modal fade" id="modalEditSeismograph" tabindex="-1" role="dialog" aria-labelledby="modalEditSeismoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditSeismoLabel">
                        <i class="fas fa-edit mr-2 text-primary"></i>Detail & Edit Data Seismograph
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEditSeismograph" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_nama_site">Nama Site <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_nama_site" name="nama_site" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="edit_lokasi" name="lokasi" rows="2" required style="height: auto;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="edit_latitude">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_latitude" name="latitude" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_longitude">Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_longitude" name="longitude" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_seismometer">Seismometer</label>
                            <input type="text" class="form-control" id="edit_seismometer" name="seismometer">
                        </div>
                        <div class="form-group">
                            <label for="edit_accelerometer">Accelerometer</label>
                            <input type="text" class="form-control" id="edit_accelerometer" name="accelerometer">
                        </div>
                        <div class="form-group">
                            <label for="edit_digitizer">Digitizer</label>
                            <input type="text" class="form-control" id="edit_digitizer" name="digitizer">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==================== MODAL ACCELEROGRAPH ==================== -->
    <!-- Modal Tambah Data Accelerograph -->
    <div class="modal fade" id="modalCreateAccelerograph" tabindex="-1" role="dialog" aria-labelledby="modalCreateAccLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateAccLabel">
                        <i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Data Accelerograph Non Colocated
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('accelerograph.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="create_acc_nama">Nama Site / Stasiun <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_acc_nama" name="nama"
                                placeholder="Contoh: AC-BKB01 - Balikpapan Kota" required>
                        </div>
                        <div class="form-group">
                            <label for="create_acc_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="create_acc_lokasi" name="lokasi" rows="2"
                                placeholder="Contoh: Kantor Walikota Balikpapan, Jl. Jend. Sudirman No. 1" required style="height: auto;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="create_acc_latitude">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="create_acc_latitude" name="latitude"
                                    placeholder="Contoh: -1.270420" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_acc_longitude">Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="create_acc_longitude" name="longitude"
                                    placeholder="Contoh: 116.828850" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="create_acc_merk">Merk Peralatan</label>
                            <input type="text" class="form-control" id="create_acc_merk" name="merk"
                                placeholder="Contoh: Nanometrics / Kinemetrics / Guralp / GeoSIG">
                        </div>
                        <div class="form-group">
                            <label for="create_acc_tipe">Tipe Accelerometer</label>
                            <input type="text" class="form-control" id="create_acc_tipe" name="tipe_accelerometer"
                                placeholder="Contoh: Titan Strong Motion / Episensor / CMG-5T">
                        </div>
                        <div class="form-group">
                            <label for="create_acc_digitizer">Digitizer</label>
                            <input type="text" class="form-control" id="create_acc_digitizer" name="digitizer"
                                placeholder="Contoh: Nanometrics Centaur / Basalt / Rock / DM24">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail & Edit Accelerograph -->
    <div class="modal fade" id="modalEditAccelerograph" tabindex="-1" role="dialog" aria-labelledby="modalEditAccLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditAccLabel">
                        <i class="fas fa-edit mr-2 text-primary"></i>Detail & Edit Data Accelerograph Non Colocated
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEditAccelerograph" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_acc_nama">Nama Site / Stasiun <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_acc_nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_acc_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="edit_acc_lokasi" name="lokasi" rows="2" required style="height: auto;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="edit_acc_latitude">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_acc_latitude" name="latitude" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_acc_longitude">Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_acc_longitude" name="longitude" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_acc_merk">Merk Peralatan</label>
                            <input type="text" class="form-control" id="edit_acc_merk" name="merk">
                        </div>
                        <div class="form-group">
                            <label for="edit_acc_tipe">Tipe Accelerometer</label>
                            <input type="text" class="form-control" id="edit_acc_tipe" name="tipe_accelerometer">
                        </div>
                        <div class="form-group">
                            <label for="edit_acc_digitizer">Digitizer</label>
                            <input type="text" class="form-control" id="edit_acc_digitizer" name="digitizer">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==================== MODAL LIGHTNING DETECTOR ==================== -->
    <!-- Modal Tambah Data Lightning Detector -->
    <div class="modal fade" id="modalCreateLightningDetector" tabindex="-1" role="dialog" aria-labelledby="modalCreateLdLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLdLabel">
                        <i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Data Lightning Detector (LD)
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('lightning-detector.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="create_ld_nama_site">Nama Site <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_ld_nama_site" name="nama_site"
                                placeholder="Contoh: LD-BKB01 - Stageof Balikpapan" required>
                        </div>
                        <div class="form-group">
                            <label for="create_ld_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="create_ld_lokasi" name="lokasi" rows="2"
                                placeholder="Contoh: Stasiun Geofisika Balikpapan, Jl. Mulawarman No. 2" required style="height: auto;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="create_ld_latitude">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="create_ld_latitude" name="latitude"
                                    placeholder="Contoh: -1.265380" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_ld_longitude">Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="create_ld_longitude" name="longitude"
                                    placeholder="Contoh: 116.831200" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="create_ld_sensor">Sensor (Opsional)</label>
                            <input type="text" class="form-control" id="create_ld_sensor" name="sensor"
                                placeholder="Contoh: Vaisala TLS200 / Boltek EFM-100 / LS7002">
                        </div>
                        <div class="form-group">
                            <label for="create_ld_receiver">Receiver (Opsional)</label>
                            <input type="text" class="form-control" id="create_ld_receiver" name="receiver"
                                placeholder="Contoh: Vaisala CP2000 / Boltek StormTracker / LS7000">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail & Edit Lightning Detector -->
    <div class="modal fade" id="modalEditLightningDetector" tabindex="-1" role="dialog" aria-labelledby="modalEditLdLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLdLabel">
                        <i class="fas fa-edit mr-2 text-primary"></i>Detail & Edit Data Lightning Detector (LD)
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEditLightningDetector" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_ld_nama_site">Nama Site <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_ld_nama_site" name="nama_site" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_ld_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="edit_ld_lokasi" name="lokasi" rows="2" required style="height: auto;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="edit_ld_latitude">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_ld_latitude" name="latitude" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_ld_longitude">Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_ld_longitude" name="longitude" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_ld_sensor">Sensor</label>
                            <input type="text" class="form-control" id="edit_ld_sensor" name="sensor">
                        </div>
                        <div class="form-group">
                            <label for="edit_ld_receiver">Receiver</label>
                            <input type="text" class="form-control" id="edit_ld_receiver" name="receiver">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==================== MODAL WRS NG ==================== -->
    <!-- Modal Tambah Data WRS NG -->
    <div class="modal fade" id="modalCreateWrsNg" tabindex="-1" role="dialog" aria-labelledby="modalCreateWrsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateWrsLabel">
                        <i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Data WRS NG
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('wrs-ng.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="create_wrs_nama_site">Nama Site / Instansi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_wrs_nama_site" name="nama_site"
                                placeholder="Contoh: WRS-BKB01 - BPBD Balikpapan" required>
                        </div>
                        <div class="form-group">
                            <label for="create_wrs_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="create_wrs_lokasi" name="lokasi" rows="2"
                                placeholder="Contoh: Pusdalops BPBD Kota Balikpapan, Jl. Ruhui Rahayu" required style="height: auto;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="create_wrs_latitude">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="create_wrs_latitude" name="latitude"
                                    placeholder="Contoh: -1.252400" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_wrs_longitude">Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="create_wrs_longitude" name="longitude"
                                    placeholder="Contoh: 116.861200" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail & Edit WRS NG -->
    <div class="modal fade" id="modalEditWrsNg" tabindex="-1" role="dialog" aria-labelledby="modalEditWrsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditWrsLabel">
                        <i class="fas fa-edit mr-2 text-primary"></i>Detail & Edit Data WRS NG
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEditWrsNg" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_wrs_nama_site">Nama Site / Instansi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_wrs_nama_site" name="nama_site" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_wrs_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="edit_wrs_lokasi" name="lokasi" rows="2" required style="height: auto;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="edit_wrs_latitude">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_wrs_latitude" name="latitude" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_wrs_longitude">Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_wrs_longitude" name="longitude" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==================== MODAL MAGNET PREKURSOR ==================== -->
    <!-- Modal Tambah Data Magnet Prekursor -->
    <div class="modal fade" id="modalCreateMagnetPrekursor" tabindex="-1" role="dialog" aria-labelledby="modalCreateMagnetLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateMagnetLabel">
                        <i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Data Magnet Prekursor
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('magnet-prekursor.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="create_mp_nama_site">Nama Site / Stasiun <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_mp_nama_site" name="nama_site"
                                placeholder="Contoh: MP-BKB01 - Stageof Balikpapan" required>
                        </div>
                        <div class="form-group">
                            <label for="create_mp_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="create_mp_lokasi" name="lokasi" rows="2"
                                placeholder="Contoh: Taman Alat Geomagnetik Stasiun Geofisika Balikpapan" required style="height: auto;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="create_mp_latitude">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="create_mp_latitude" name="latitude"
                                    placeholder="Contoh: -1.265380" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_mp_longitude">Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="create_mp_longitude" name="longitude"
                                    placeholder="Contoh: 116.831200" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="create_mp_tahun">Tahun Instalasi (Opsional)</label>
                                <input type="text" class="form-control" id="create_mp_tahun" name="tahun_instalasi"
                                    placeholder="Contoh: 2021">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_mp_sensor">Sensor (Opsional)</label>
                                <input type="text" class="form-control" id="create_mp_sensor" name="sensor"
                                    placeholder="Contoh: Fluxgate Magnetometer 3-Axis">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="create_mp_digitizer">Digitizer (Opsional)</label>
                                <input type="text" class="form-control" id="create_mp_digitizer" name="digitizer"
                                    placeholder="Contoh: LEMI-417 High Resolution Logger">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_mp_regulator">Regulator / Solar Controller (Opsional)</label>
                                <input type="text" class="form-control" id="create_mp_regulator" name="regulator"
                                    placeholder="Contoh: Morningstar SunSaver 10A / Victron">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail & Edit Magnet Prekursor -->
    <div class="modal fade" id="modalEditMagnetPrekursor" tabindex="-1" role="dialog" aria-labelledby="modalEditMagnetLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditMagnetLabel">
                        <i class="fas fa-edit mr-2 text-primary"></i>Detail & Edit Data Magnet Prekursor
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEditMagnetPrekursor" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_mp_nama_site">Nama Site / Stasiun <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_mp_nama_site" name="nama_site" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_mp_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="edit_mp_lokasi" name="lokasi" rows="2" required style="height: auto;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="edit_mp_latitude">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_mp_latitude" name="latitude" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_mp_longitude">Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_mp_longitude" name="longitude" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="edit_mp_tahun">Tahun Instalasi</label>
                                <input type="text" class="form-control" id="edit_mp_tahun" name="tahun_instalasi">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_mp_sensor">Sensor</label>
                                <input type="text" class="form-control" id="edit_mp_sensor" name="sensor">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="edit_mp_digitizer">Digitizer</label>
                                <input type="text" class="form-control" id="edit_mp_digitizer" name="digitizer">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_mp_regulator">Regulator / Solar Controller</label>
                                <input type="text" class="form-control" id="edit_mp_regulator" name="regulator">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // 1. Populate Modal Edit Seismograph
            $('.btn-edit-seismograph').on('click', function() {
                var actionUrl = $(this).data('action');
                var namaSite = $(this).data('nama_site');
                var lokasi = $(this).data('lokasi');
                var latitude = $(this).data('latitude');
                var longitude = $(this).data('longitude');
                var seismometer = $(this).data('seismometer');
                var accelerometer = $(this).data('accelerometer');
                var digitizer = $(this).data('digitizer');

                $('#formEditSeismograph').attr('action', actionUrl);
                $('#edit_nama_site').val(namaSite);
                $('#edit_lokasi').val(lokasi);
                $('#edit_latitude').val(latitude);
                $('#edit_longitude').val(longitude);
                $('#edit_seismometer').val(seismometer);
                $('#edit_accelerometer').val(accelerometer);
                $('#edit_digitizer').val(digitizer);

                $('#modalEditSeismograph').modal('show');
            });

            // 2. Populate Modal Edit Accelerograph
            $('.btn-edit-accelerograph').on('click', function() {
                var actionUrl = $(this).data('action');
                var nama = $(this).data('nama');
                var lokasi = $(this).data('lokasi');
                var latitude = $(this).data('latitude');
                var longitude = $(this).data('longitude');
                var merk = $(this).data('merk');
                var tipeAccelerometer = $(this).data('tipe_accelerometer');
                var digitizer = $(this).data('digitizer');

                $('#formEditAccelerograph').attr('action', actionUrl);
                $('#edit_acc_nama').val(nama);
                $('#edit_acc_lokasi').val(lokasi);
                $('#edit_acc_latitude').val(latitude);
                $('#edit_acc_longitude').val(longitude);
                $('#edit_acc_merk').val(merk);
                $('#edit_acc_tipe').val(tipeAccelerometer);
                $('#edit_acc_digitizer').val(digitizer);

                $('#modalEditAccelerograph').modal('show');
            });

            // 3. Populate Modal Edit Lightning Detector
            $('.btn-edit-ld').on('click', function() {
                var actionUrl = $(this).data('action');
                var namaSite = $(this).data('nama_site');
                var lokasi = $(this).data('lokasi');
                var latitude = $(this).data('latitude');
                var longitude = $(this).data('longitude');
                var sensor = $(this).data('sensor');
                var receiver = $(this).data('receiver');

                $('#formEditLightningDetector').attr('action', actionUrl);
                $('#edit_ld_nama_site').val(namaSite);
                $('#edit_ld_lokasi').val(lokasi);
                $('#edit_ld_latitude').val(latitude);
                $('#edit_ld_longitude').val(longitude);
                $('#edit_ld_sensor').val(sensor);
                $('#edit_ld_receiver').val(receiver);

                $('#modalEditLightningDetector').modal('show');
            });

            // 4. Populate Modal Edit WRS NG
            $('.btn-edit-wrs').on('click', function() {
                var actionUrl = $(this).data('action');
                var namaSite = $(this).data('nama_site');
                var lokasi = $(this).data('lokasi');
                var latitude = $(this).data('latitude');
                var longitude = $(this).data('longitude');

                $('#formEditWrsNg').attr('action', actionUrl);
                $('#edit_wrs_nama_site').val(namaSite);
                $('#edit_wrs_lokasi').val(lokasi);
                $('#edit_wrs_latitude').val(latitude);
                $('#edit_wrs_longitude').val(longitude);

                $('#modalEditWrsNg').modal('show');
            });

            // 5. Populate Modal Edit Magnet Prekursor
            $('.btn-edit-magnet').on('click', function() {
                var actionUrl = $(this).data('action');
                var namaSite = $(this).data('nama_site');
                var lokasi = $(this).data('lokasi');
                var latitude = $(this).data('latitude');
                var longitude = $(this).data('longitude');
                var tahunInstalasi = $(this).data('tahun_instalasi');
                var sensor = $(this).data('sensor');
                var digitizer = $(this).data('digitizer');
                var regulator = $(this).data('regulator');

                $('#formEditMagnetPrekursor').attr('action', actionUrl);
                $('#edit_mp_nama_site').val(namaSite);
                $('#edit_mp_lokasi').val(lokasi);
                $('#edit_mp_latitude').val(latitude);
                $('#edit_mp_longitude').val(longitude);
                $('#edit_mp_tahun').val(tahunInstalasi);
                $('#edit_mp_sensor').val(sensor);
                $('#edit_mp_digitizer').val(digitizer);
                $('#edit_mp_regulator').val(regulator);

                $('#modalEditMagnetPrekursor').modal('show');
            });

            // Reset create forms when closed
            $('#modalCreateSeismograph').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
            $('#modalCreateAccelerograph').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
            $('#modalCreateLightningDetector').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
            $('#modalCreateWrsNg').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
            $('#modalCreateMagnetPrekursor').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
        });

        function confirmDeleteSeismo(siteName) {
            return confirm('Apakah Anda yakin ingin menghapus data seismograph "' + siteName + '"?');
        }

        function confirmDeleteAcc(nama) {
            return confirm('Apakah Anda yakin ingin menghapus data accelerograph "' + nama + '"?');
        }

        function confirmDeleteLd(siteName) {
            return confirm('Apakah Anda yakin ingin menghapus data lightning detector "' + siteName + '"?');
        }

        function confirmDeleteWrs(siteName) {
            return confirm('Apakah Anda yakin ingin menghapus data WRS NG "' + siteName + '"?');
        }

        function confirmDeleteMagnet(siteName) {
            return confirm('Apakah Anda yakin ingin menghapus data magnet prekursor "' + siteName + '"?');
        }
    </script>
@endpush
