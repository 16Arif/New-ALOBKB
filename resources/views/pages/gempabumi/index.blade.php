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
                    <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Kelola Data Gempabumi</a></div>
                </div>
            </div>
            <div class="section-body">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <h2 class="section-title">Parameter Gempabumi Kalimantan dan Sekitarnya</h2>
                    <div>
                        <!-- Tombol Collapse -->
                        <button id="toggleDownloadBtn" class="btn btn-primary mb-3" type="button" data-toggle="collapse"
                            data-target="#collapseEditForm" aria-expanded="false" aria-controls="collapseEditForm">
                            <i class="fa-solid fa-download me-1"></i> Unduh Data
                        </button>
                        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#importModal">
                            <i class="fa-solid fa-upload me-1"></i> Import Data
                        </button>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <!-- Konten Collapse -->
                        <div class="collapse" id="collapseEditForm">
                            {{-- Download Sesuai Filter Aktif --}}
                            <div class="card bg-light shadow rounded p-3 mb-2">
                                <p class="text-center font-weight-bold mb-2"><i class="fa-solid fa-filter me-1"></i> Unduh Sesuai Filter Aktif</p>
                                @php
                                    $filterParams = [];
                                    if (request('filter_start')) $filterParams['filter_start'] = request('filter_start');
                                    if (request('filter_end')) $filterParams['filter_end'] = request('filter_end');
                                    if (request('filter_provinsi')) $filterParams['filter_provinsi'] = request('filter_provinsi');
                                    if (request('filter_kab_kota')) $filterParams['filter_kab_kota'] = request('filter_kab_kota');
                                    if (request('search')) $filterParams['search'] = request('search');
                                    if (request('sort')) $filterParams['sort'] = request('sort');

                                    $hasFilter = !empty($filterParams);

                                    $provLabels = [
                                        'KALBAR' => 'Kalimantan Barat',
                                        'KALTENG' => 'Kalimantan Tengah',
                                        'KALSEL' => 'Kalimantan Selatan',
                                        'KALTIM' => 'Kalimantan Timur',
                                        'KALTARA' => 'Kalimantan Utara',
                                        'LAINNYA' => 'Luar Kalimantan',
                                    ];
                                @endphp

                                @if ($hasFilter)
                                    <div class="alert alert-info py-2 px-3 mb-2" style="font-size: 12px;">
                                        <strong>Filter aktif:</strong>
                                        <ul class="mb-0 pl-3">
                                            @if (request('filter_start') && request('filter_end'))
                                                <li>Tanggal: {{ request('filter_start') }} s/d {{ request('filter_end') }}</li>
                                            @endif
                                            @if (request('filter_provinsi'))
                                                <li>Provinsi: {{ $provLabels[request('filter_provinsi')] ?? request('filter_provinsi') }}</li>
                                            @endif
                                            @if (request('filter_kab_kota'))
                                                <li>Kab/Kota: Kode {{ request('filter_kab_kota') }}</li>
                                            @endif
                                            @if (request('search'))
                                                <li>Pencarian: "{{ request('search') }}"</li>
                                            @endif
                                        </ul>
                                    </div>
                                    <a href="{{ route('export.spatie_parametergempa_filtered', $filterParams) }}"
                                        class="btn btn-success w-100">
                                        <i class="fa-solid fa-download me-1"></i> Unduh Data Sesuai Filter
                                    </a>
                                @else
                                    <div class="alert alert-secondary py-2 px-3 mb-2" style="font-size: 12px;">
                                        <i class="fa-solid fa-circle-info me-1"></i> Tidak ada filter aktif. Aktifkan filter terlebih dahulu, atau gunakan opsi unduh di bawah.
                                    </div>
                                    <a href="{{ route('export.spatie_parametergempa_filtered') }}"
                                        class="btn btn-outline-success w-100">
                                        <i class="fa-solid fa-download me-1"></i> Unduh Semua Data
                                    </a>
                                @endif
                            </div>

                            {{-- Download Semua Data & Per Periode (Opsi Lama) --}}
                            <div class="card bg-light shadow rounded p-3">
                                <p class="text-center">Simpan Data (Excel)</p>
                                <!-- Download Semua Data -->
                                <div class="mb-3">
                                    <a href="{{ route('export.spatie_parametergempa', ['start' => '1900-01-01', 'end' => now()->format('Y-m-d')]) }}"
                                        class="btn btn-outline-success w-100">
                                        <i class="fa-solid fa-file-excel"></i> Simpan Semua Data
                                    </a>
                                </div>
                                <hr>
                                <span class="mb-2">Atau simpan data periode tertentu:</span>
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
                            {{-- <div class="card bg-light shadow rounded p-3">
                                <p class="text-center">Unduh Data CSV</p>
                                <!-- Download Semua Data -->
                                <div class="mb-3">
                                    <a href="{{ route('export.spatie_parametergempa_csv', ['start' => '1900-01-01', 'end' => now()->format('Y-m-d')]) }}"
                                        class="btn btn-outline-info w-100" target="_blank">
                                        <i class="fa-solid fa-file-csv"></i> Export Semua Data (CSV)
                                    </a>

                                </div>
                                <hr>

                                <!-- Form Export Berdasarkan Tanggal -->
                                <form action="{{ route('export.spatie_parametergempa_csv') }}" method="GET"
                                    class="row g-2 align-items-end mt-2">
                                    <div class="col-md-5">
                                        <label class="form-label">Dari Tanggal</label>
                                        <input type="date" name="start" class="form-control" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label">Sampai Tanggal</label>
                                        <input type="date" name="end" class="form-control" required>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="submit" class="btn btn-info ">
                                            <i class="fa-solid fa-download me-1"></i>
                                        </button>
                                    </div>
                                </form>

                            </div> --}}
                        </div>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-header d-flex justify-content-between align-items-center flex-wrap py-3" style="height: auto; min-height: 60px;">
                                <!-- Kiri: Tombol-tombol Pilihan / Aksi Massal -->
                                <div class="d-flex align-items-center flex-wrap my-1">
                                    <button id="toggleSelection" class="btn btn-outline-primary mr-2 mb-1">Pilih</button>
                                    <button id="cancelSelection" class="btn btn-outline-secondary d-none mr-2 mb-1">Batal</button>
                                    
                                    <button id="generateInfografis" class="btn btn-success d-none mr-2 mb-1" disabled>Buat Infografis</button>
                                    <form id="infografisForm" action="{{ route('gempabumi.infografiss') }}"
                                        method="POST" target="_blank">
                                        @csrf
                                        <input type="hidden" name="ids" id="selectedIdsInput">
                                    </form>

                                    <!-- Jarak pemisah (ml-sm-4) untuk menghindari salah klik tombol Hapus Data -->
                                    <button id="hapusData" class="btn btn-danger d-none ml-sm-4 ml-0 mb-1" disabled data-toggle="modal" data-target="#confirmDeleteBatchModal"><i class="fa-solid fa-trash mr-1"></i> Hapus Data</button>
                                </div>

                                <!-- Tengah: Filter & Pencarian -->
                                <div class="d-flex align-items-center flex-wrap my-1 mx-md-auto">
                                    <button id="toggleFilterBtn" class="btn btn-outline-warning mr-2 mb-1" type="button"
                                        data-toggle="collapse" data-target="#collapseFilterForm"
                                        aria-expanded="false" aria-controls="collapseFilterForm">
                                        <i class="fa-solid fa-filter me-1"></i> Filter
                                    </button>
                                    <form method="GET" action="{{ route('gempabumi.index') }}" class="mb-1">
                                        {{-- Hidden inputs to preserve active filter parameters --}}
                                        @if (request('filter_start'))
                                            <input type="hidden" name="filter_start" value="{{ request('filter_start') }}">
                                        @endif
                                        @if (request('filter_end'))
                                            <input type="hidden" name="filter_end" value="{{ request('filter_end') }}">
                                        @endif
                                        @if (request('filter_provinsi'))
                                            <input type="hidden" name="filter_provinsi" value="{{ request('filter_provinsi') }}">
                                        @endif
                                        @if (request('filter_kab_kota'))
                                            <input type="hidden" name="filter_kab_kota" value="{{ request('filter_kab_kota') }}">
                                        @endif
                                        @if (request('per_page'))
                                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                                        @endif
                                        @if (request('sort'))
                                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                                        @endif

                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari"
                                                name="search" value="{{ request('search') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- Kanan: Tambah Data -->
                                <div class="d-flex align-items-center flex-wrap my-1">
                                    <a href="{{ route('gempabumi.custom.create') }}" class="btn btn-primary mb-1">Tambah Data</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Form Filter Rentang Tanggal (Rata Tengah tepat di bawah Header) -->
                                <div class="collapse mt-3" id="collapseFilterForm">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 col-lg-10">
                                            <div class="card bg-light shadow-sm rounded p-3">
                                                <form method="GET" action="{{ route('gempabumi.index') }}"
                                                    class="row g-2 align-items-end mb-0" id="filterForm">
                                                    {{-- Hidden inputs to preserve active search parameters --}}
                                                    @if (request('search'))
                                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                                    @endif
                                                    @if (request('per_page'))
                                                        <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                                                    @endif
                                                    @if (request('sort'))
                                                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                                                    @endif

                                                    <div class="col-md-2 text-left">
                                                        <label for="filter_start" class="form-label" style="font-size: 12px; font-weight: 600;">Dari Tanggal</label>
                                                        <input type="date" id="filter_start" name="filter_start"
                                                            class="form-control form-control-sm" value="{{ request('filter_start') }}">
                                                    </div>
                                                    <div class="col-md-2 text-left">
                                                        <label for="filter_end" class="form-label" style="font-size: 12px; font-weight: 600;">Sampai Tanggal</label>
                                                        <input type="date" id="filter_end" name="filter_end"
                                                            class="form-control form-control-sm" value="{{ request('filter_end') }}">
                                                    </div>
                                                    <div class="col-md-3 text-left">
                                                        <label for="filter_provinsi" class="form-label" style="font-size: 12px; font-weight: 600;">Provinsi</label>
                                                        <select name="filter_provinsi" id="filter_provinsi" class="form-control form-control-sm">
                                                            <option value="">Semua Provinsi</option>
                                                            <option value="KALBAR" {{ request('filter_provinsi') == 'KALBAR' ? 'selected' : '' }}>Kalimantan Barat</option>
                                                            <option value="KALTENG" {{ request('filter_provinsi') == 'KALTENG' ? 'selected' : '' }}>Kalimantan Tengah</option>
                                                            <option value="KALSEL" {{ request('filter_provinsi') == 'KALSEL' ? 'selected' : '' }}>Kalimantan Selatan</option>
                                                            <option value="KALTIM" {{ request('filter_provinsi') == 'KALTIM' ? 'selected' : '' }}>Kalimantan Timur</option>
                                                            <option value="KALTARA" {{ request('filter_provinsi') == 'KALTARA' ? 'selected' : '' }}>Kalimantan Utara</option>
                                                            <option value="LAINNYA" {{ request('filter_provinsi') == 'LAINNYA' ? 'selected' : '' }}>Lainnya (Luar Kalimantan)</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 text-left">
                                                        <label for="filter_kab_kota" class="form-label" style="font-size: 12px; font-weight: 600;">Kabupaten/Kota</label>
                                                        <select name="filter_kab_kota" id="filter_kab_kota" class="form-control form-control-sm">
                                                            <option value="">Semua Kab/Kota</option>
                                                            @php
                                                                $provNames = [
                                                                    '61' => 'Kalimantan Barat',
                                                                    '62' => 'Kalimantan Tengah',
                                                                    '63' => 'Kalimantan Selatan',
                                                                    '64' => 'Kalimantan Timur',
                                                                    '65' => 'Kalimantan Utara'
                                                                ];
                                                            @endphp
                                                            @foreach ($listKabKota as $kodeProv => $kabKotas)
                                                                <optgroup label="{{ $provNames[$kodeProv] ?? 'Lainnya' }}">
                                                                    @foreach ($kabKotas as $item)
                                                                        <option value="{{ $item->kode_kk }}" 
                                                                            data-province="{{ $item->kode_prov }}" 
                                                                            data-province-name="{{ $provNames[$kodeProv] ?? 'Lainnya' }}"
                                                                            {{ request('filter_kab_kota') == $item->kode_kk ? 'selected' : '' }}>
                                                                            {{ $item->nama_kab_kota }}
                                                                        </option>
                                                                    @endforeach
                                                                </optgroup>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-2 d-flex align-items-end justify-content-between mt-2 mt-md-0">
                                                        <button type="submit" class="btn btn-sm btn-warning w-100 mr-1">
                                                            <i class="fa-solid fa-filter me-1"></i> Filter
                                                        </button>
                                                        @if (request('filter_start') || request('filter_end') || request('filter_provinsi') || request('filter_kab_kota'))
                                                            <a href="{{ route('gempabumi.index', ['search' => request('search'), 'per_page' => request('per_page'), 'sort' => request('sort')]) }}"
                                                                class="btn btn-sm btn-secondary w-100 ml-1">
                                                                <i class="fa-solid fa-xmark me-1"></i> Reset
                                                            </a>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Urutkan data & per_page (Sejajar & Rapi) --}}
                                <div class="row justify-content-between align-items-center mb-4 mt-3">
                                    <!-- Kiri: Dropdown Urutkan & Status Aktif -->
                                    <div class="col-md-6 d-flex align-items-center flex-wrap">
                                        <!-- Dropdown Urutkan -->
                                        <div class="dropdown mr-3">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                id="sortDropdown" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-sort"></i> Urutkan
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('gempabumi.index', array_merge(request()->query(), ['sort' => 'id_desc'])) }}">
                                                        Data Terbaru
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('gempabumi.index', array_merge(request()->query(), ['sort' => 'tanggal_asc'])) }}">
                                                        Tanggal (Terlama)
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('gempabumi.index', array_merge(request()->query(), ['sort' => 'tanggal_desc'])) }}">
                                                        Tanggal (Terbaru)
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Keterangan Sorting Aktif -->
                                        <div class="text-muted mb-0" style="font-size: 13px;">
                                            <i class="fa-solid fa-circle-info mr-1 text-primary"></i>
                                            Urutan aktif: <strong>
                                                @switch(request('sort'))
                                                    @case('tanggal_asc')
                                                        Tanggal (Terlama)
                                                        @break
                                                    @case('tanggal_desc')
                                                        Tanggal (Terbaru)
                                                        @break
                                                    @default
                                                        Data Terbaru
                                                @endswitch
                                            </strong>
                                        </div>
                                    </div>

                                    <!-- Kanan: Tampilkan per_page & Info Data -->
                                    <div class="col-md-6 d-flex justify-content-md-end justify-content-start align-items-center flex-wrap mt-2 mt-md-0">
                                        <div class="text-muted mr-3 mb-0">
                                            Menampilkan {{ is_countable($datagempa) ? count($datagempa) : $datagempa->total() }} data
                                        </div>
                                        <form method="GET" action="{{ route('gempabumi.index') }}" class="mb-0 d-flex align-items-center">
                                            <label for="per_page" class="mb-0 mr-2">Tampilkan:</label>

                                            {{-- Hidden inputs to preserve filters --}}
                                            @if (request('filter_start'))
                                                <input type="hidden" name="filter_start" value="{{ request('filter_start') }}">
                                            @endif
                                            @if (request('filter_end'))
                                                <input type="hidden" name="filter_end" value="{{ request('filter_end') }}">
                                            @endif
                                            @if (request('filter_provinsi'))
                                                <input type="hidden" name="filter_provinsi" value="{{ request('filter_provinsi') }}">
                                            @endif
                                            @if (request('filter_kab_kota'))
                                                <input type="hidden" name="filter_kab_kota" value="{{ request('filter_kab_kota') }}">
                                            @endif
                                            @if (request('search'))
                                                <input type="hidden" name="search" value="{{ request('search') }}">
                                            @endif
                                            @if (request('sort'))
                                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                            @endif

                                            <select name="per_page" id="per_page" class="form-control form-control-sm d-inline-block" style="width: auto;" onchange="this.form.submit()">
                                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive mt-3">
                                    <table class="table-striped table">
                                        <tr>
                                            <th class="checkbox-column d-none">
                                                <input type="checkbox" id="selectAll">
                                            </th>
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
                                            <th></th>
                                        </tr>

                                        @forelse ($datagempa as $index => $gempa)
                                            <tr>
                                                <td class="checkbox-column d-none">
                                                    <input type="checkbox" class="select-row"
                                                        value="{{ $gempa->id }}">
                                                </td>
                                                <td>{{ method_exists($datagempa, 'firstItem') ? $datagempa->firstItem() + $index : $index + 1 }}
                                                </td>
                                                <td>{{ $gempa->tanggal->format('Y-m-d') }}</td>
                                                <td>{{ $gempa->waktu }}</td>
                                                <td>{{ $gempa->waktu_utc }}</td>
                                                <td>{{ $gempa->waktu_wita }}</td>
                                                <td>{{ $gempa->formatted_lintang }}</td>
                                                <td>{{ $gempa->formatted_bujur }}</td>
                                                <td>{{ $gempa->magnitudo }}</td>
                                                <td>{{ $gempa->kedalaman }}</td>
                                                <td>{{ $gempa->jarak }}</td>
                                                <td>{{ $gempa->dirasakan }}</td>
                                                <td>
                                                    <div class="dropdown text-end">
                                                        <button class="btn btn-light border shadow-sm" type="button"
                                                            id="dropdownMenu{{ $gempa->id }}"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm animate__animated animate__fadeIn"
                                                            aria-labelledby="dropdownMenu{{ $gempa->id }}">
                                                            @if ($gempa->dirasakan == 'DIRASAKAN')
                                                                <li>
                                                                    <a class="dropdown-item text-success "
                                                                        href="{{ route('narasigempa.createWithId', $gempa->id) }}">
                                                                        <i
                                                                            class="fa-solid fa-file-lines me-2 text-success ml-1"></i>
                                                                        Buat Narasi
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            <li>
                                                                <a class="dropdown-item text-info "
                                                                    href="{{ route('gempabumi.custom.createOneInfographic', ['ids' => $gempa->id]) }}">
                                                                    <i class="fa-solid fa-pen me-2 text-info ml-1"></i>
                                                                    Buat Infografis
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item text-info "
                                                                    href="{{ route('gempabumi.edit', $gempa->id) }}">
                                                                    <i
                                                                        class="fa-solid fa-pen-to-square me-2 text-info ml-1"></i>
                                                                    Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('gempabumi.destroy', $gempa->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item btn-sm text-danger">
                                                                        <i class="fa-solid fa-trash me-2"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
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
                                @if (!request()->has('per_page') || request('per_page') !== 'all')
                                    <div class="mt-3 d-flex justify-content-center">
                                        {{ $datagempa->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('components.gempa.modal-import')

    <!-- Modal Konfirmasi Hapus Batch -->
    <div class="modal fade" id="confirmDeleteBatchModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteBatchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="confirmDeleteBatchModalLabel">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>Konfirmasi Hapus Data
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data gempa yang dipilih? Tindakan ini akan menghapus data secara permanen.</p>
                    <div class="form-group mb-0">
                        <label for="deleteConfirmationInput" class="form-label" style="font-weight: 600;">
                            Ketik kalimat di bawah untuk melanjutkan:
                        </label>
                        <div class="alert alert-warning py-2 px-3 mb-2" style="font-size: 13px; font-weight: 600; border-left: 4px solid #ffa426;">
                            Saya yakin menghapus data gempa yang dipilih
                        </div>
                        <input type="text" id="deleteConfirmationInput" class="form-control" placeholder="Ketik kalimat konfirmasi di sini" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" id="submitDeleteBatch" class="btn btn-danger" disabled>
                        <i class="fa-solid fa-trash me-1"></i>Hapus Data
                    </button>
                </div>
            </div>
        </div>
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

    <script>
        const toggleBtn = document.getElementById("toggleSelection");
        const cancelBtn = document.getElementById("cancelSelection");
        const generateBtn = document.getElementById("generateInfografis");
        const deleteBtn = document.getElementById("hapusData");

        const checkboxCols = document.querySelectorAll(".checkbox-column");
        const checkboxes = document.querySelectorAll(".select-row");

        toggleBtn.addEventListener("click", () => {
            checkboxCols.forEach(el => el.classList.remove("d-none"));
            cancelBtn.classList.remove("d-none");
            toggleBtn.classList.add("d-none");
            
            // Tampilkan tombol Buat Infografis dan Hapus Data dalam keadaan disabled
            generateBtn.classList.remove("d-none");
            generateBtn.disabled = true;
            deleteBtn.classList.remove("d-none");
            deleteBtn.disabled = true;
        });

        cancelBtn.addEventListener("click", () => {
            checkboxCols.forEach(el => el.classList.add("d-none"));
            cancelBtn.classList.add("d-none");
            toggleBtn.classList.remove("d-none");
            
            // Sembunyikan dan disable kembali tombol aksi
            generateBtn.classList.add("d-none");
            generateBtn.disabled = true;
            deleteBtn.classList.add("d-none");
            deleteBtn.disabled = true;
            
            checkboxes.forEach(cb => cb.checked = false);
            document.getElementById("selectAll").checked = false;
        });

        checkboxes.forEach(cb => {
            cb.addEventListener("change", () => {
                const allChecked = document.querySelectorAll(".select-row").length === document
                    .querySelectorAll(".select-row:checked").length;
                document.getElementById("selectAll").checked = allChecked;

                // Aktifkan tombol jika ada checkbox yang dicentang
                const anyChecked = document.querySelectorAll(".select-row:checked").length > 0;
                generateBtn.disabled = !anyChecked;
                deleteBtn.disabled = !anyChecked;
            });
        });

        //  ceklist semua data 
        document.getElementById("selectAll").addEventListener("change", function() {
            const checked = this.checked;
            document.querySelectorAll(".select-row").forEach(cb => {
                cb.checked = checked;
            });

            // Aktifkan tombol jika ada checkbox yang dicentang
            const anyChecked = document.querySelectorAll(".select-row:checked").length > 0;
            generateBtn.disabled = !anyChecked;
            deleteBtn.disabled = !anyChecked;
        });

        // Tombol Filter Collapse
        $(document).ready(function() {
            const filterToggleBtn = $('#toggleFilterBtn');
            const collapseFilter = $('#collapseFilterForm');

            collapseFilter.on('shown.bs.collapse', function() {
                filterToggleBtn.html('<i class="fa-solid fa-xmark me-1"></i> Batalkan');
                filterToggleBtn.removeClass('btn-warning').addClass('btn-secondary');
            });

            collapseFilter.on('hidden.bs.collapse', function() {
                filterToggleBtn.html('<i class="fa-solid fa-filter me-1"></i> Filter');
                filterToggleBtn.removeClass('btn-secondary').addClass('btn-warning');
            });
        });


        // untuk hapus data

        // Menampilkan modal konfirmasi hapus batch
        document.getElementById("hapusData").addEventListener("click", function(e) {
            const selectedIds = Array.from(document.querySelectorAll(".select-row:checked"))
                .map(cb => cb.value);

            if (selectedIds.length === 0) {
                e.preventDefault();
                alert("Pilih setidaknya satu data untuk dihapus!");
                return;
            }

            // Reset input konfirmasi dan disable tombol submit
            const confirmationInput = document.getElementById("deleteConfirmationInput");
            confirmationInput.value = "";
            document.getElementById("submitDeleteBatch").disabled = true;
        });

        // Validasi input kalimat konfirmasi hapus batch
        document.getElementById("deleteConfirmationInput").addEventListener("input", function() {
            const text = this.value;
            const expectedText = "Saya yakin menghapus data gempa yang dipilih";
            const submitBtn = document.getElementById("submitDeleteBatch");
            if (text === expectedText) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        });

        // Submit proses hapus batch
        document.getElementById("submitDeleteBatch").addEventListener("click", function() {
            const selectedIds = Array.from(document.querySelectorAll(".select-row:checked"))
                .map(cb => cb.value);
            
            const confirmationInput = document.getElementById("deleteConfirmationInput").value;
            const expectedText = "Saya yakin menghapus data gempa yang dipilih";
            if (confirmationInput !== expectedText) {
                alert("Kalimat konfirmasi tidak sesuai!");
                return;
            }

            this.disabled = true;

            fetch("{{ route('gempabumi.destroyBatch') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id: selectedIds,
                        confirmation: confirmationInput,
                        _method: "DELETE"
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Tutup modal secara aman (menggunakan jQuery Bootstrap 4)
                    $('#confirmDeleteBatchModal').modal('hide');

                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message || "Gagal menghapus data.");
                        this.disabled = false;
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert("Terjadi kesalahan saat menghapus data.");
                    this.disabled = false;
                });
        });




        // untuk generate infografis dengan banyak data 

        document.getElementById("generateInfografis").addEventListener("click", function() {
            const selectedIds = Array.from(document.querySelectorAll(".select-row:checked"))
                .map(cb => cb.value);

            if (selectedIds.length === 0) {
                alert("Pilih setidaknya satu data!");
                return;
            }

            document.getElementById("selectedIdsInput").value = selectedIds.join(",");
            document.getElementById("infografisForm").submit();
        });

        // {{-- untuk animasi button download & modal import --}}
        $(document).ready(function() {
            const toggleBtn = $('#toggleDownloadBtn');
            const collapseTarget = $('#collapseEditForm');

            collapseTarget.on('shown.bs.collapse', function() {
                toggleBtn.html('<i class="fa-solid fa-xmark me-1"></i> Batalkan');
            });

            collapseTarget.on('hidden.bs.collapse', function() {
                toggleBtn.html('<i class="fa-solid fa-download me-1"></i> Unduh Data');
            });

            $('#importModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
        });

        // Filter Berjenjang (Cascading Dropdown) Provinsi -> Kabupaten/Kota
        (function() {
            const provSelect = document.getElementById('filter_provinsi');
            const citySelect = document.getElementById('filter_kab_kota');
            if (!provSelect || !citySelect) return;

            // Simpan daftar opsi asli
            const originalOptions = Array.from(citySelect.options);

            const provMap = {
                'KALBAR': '61',
                'KALTENG': '62',
                'KALSEL': '63',
                'KALTIM': '64',
                'KALTARA': '65'
            };

            function updateCities() {
                const selectedProv = provSelect.value;
                const targetCode = provMap[selectedProv] || '';
                const currentSelectedVal = citySelect.value;

                // Kosongkan dropdown kota, sisakan opsi pertama ("Semua Kab/Kota")
                citySelect.innerHTML = '';
                citySelect.appendChild(originalOptions[0]);

                if (selectedProv === 'LAINNYA') {
                    // Wilayah luar Kalimantan tidak memiliki opsi kota/kabupaten
                    citySelect.value = '';
                    return;
                }

                if (!targetCode) {
                    // Jika pilih "Semua Provinsi", tampilkan seluruh kota dikelompokkan dengan optgroup
                    const optgroups = {};
                    originalOptions.forEach(opt => {
                        if (!opt.value) return; // lewati opsi kosong
                        const provCode = opt.getAttribute('data-province');
                        const provName = opt.getAttribute('data-province-name') || 'Lainnya';
                        if (!optgroups[provCode]) {
                            optgroups[provCode] = document.createElement('optgroup');
                            optgroups[provCode].label = provName;
                        }
                        optgroups[provCode].appendChild(opt.cloneNode(true));
                    });
                    Object.values(optgroups).forEach(group => citySelect.appendChild(group));
                } else {
                    // Tampilkan hanya kota yang sesuai dengan provinsi terpilih
                    originalOptions.forEach(opt => {
                        if (opt.getAttribute('data-province') === targetCode) {
                            citySelect.appendChild(opt.cloneNode(true));
                        }
                    });
                }

                // Pertahankan pilihan kota sebelumnya jika masih valid di daftar baru
                if (Array.from(citySelect.options).some(opt => opt.value === currentSelectedVal)) {
                    citySelect.value = currentSelectedVal;
                } else {
                    citySelect.value = '';
                }
            }

            provSelect.addEventListener('change', updateCities);
            // Jalankan sekali saat load halaman untuk inisialisasi state awal (old input)
            updateCities();
        })();
    </script>
@endpush
