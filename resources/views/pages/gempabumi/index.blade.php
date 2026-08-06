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
                        <button id="toggleDownloadBtn" class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseEditForm" aria-expanded="false" aria-controls="collapseEditForm">
                            <i class="fa-solid fa-download me-1"></i> Unduh Data
                        </button>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <!-- Konten Collapse -->
                        <div class="collapse" id="collapseEditForm">
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
                                    <button id="hapusData" class="btn btn-danger d-none ml-sm-4 ml-0 mb-1" disabled><i class="fa-solid fa-trash mr-1"></i> Hapus Data</button>
                                </div>

                                <!-- Tengah: Filter & Pencarian -->
                                <div class="d-flex align-items-center flex-wrap my-1 mx-md-auto">
                                    <button id="toggleFilterBtn" class="btn btn-outline-warning mr-2 mb-1" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFilterForm"
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
                                
                                <!-- Kanan: Import & Tambah Data -->
                                <div class="d-flex align-items-center flex-wrap my-1">
                                    <button class="btn btn-outline-success mr-2 mb-1" data-bs-toggle="modal" data-bs-target="#importModal">
                                        <i class="fa-solid fa-upload me-1"></i> Import Data
                                    </button>
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

                                                    <div class="col-md-3 text-left">
                                                        <label for="filter_start" class="form-label" style="font-size: 12px; font-weight: 600;">Dari Tanggal</label>
                                                        <input type="date" id="filter_start" name="filter_start"
                                                            class="form-control form-control-sm" value="{{ request('filter_start') }}">
                                                    </div>
                                                    <div class="col-md-3 text-left">
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

                                                    <div class="col-md-3 d-flex align-items-end justify-content-between mt-2 mt-md-0">
                                                        <button type="submit" class="btn btn-sm btn-warning w-100 mr-1">
                                                            <i class="fa-solid fa-filter me-1"></i> Filter
                                                        </button>
                                                        @if (request('filter_start') || request('filter_end') || request('filter_provinsi'))
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
                                                id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
                                                            data-bs-toggle="dropdown" aria-expanded="false">
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
        document.addEventListener("DOMContentLoaded", function() {
            const filterToggleBtn = document.getElementById('toggleFilterBtn');
            const collapseFilter = document.getElementById('collapseFilterForm');

            collapseFilter.addEventListener('shown.bs.collapse', () => {
                filterToggleBtn.innerHTML = '<i class="fa-solid fa-xmark me-1"></i> Batalkan';
                filterToggleBtn.classList.remove('btn-warning');
                filterToggleBtn.classList.add('btn-secondary');
            });

            collapseFilter.addEventListener('hidden.bs.collapse', () => {
                filterToggleBtn.innerHTML = '<i class="fa-solid fa-filter me-1"></i> Filter';
                filterToggleBtn.classList.remove('btn-secondary');
                filterToggleBtn.classList.add('btn-warning');
            });
        });


        // untuk hapus data

        document.getElementById("hapusData").addEventListener("click", function() {
            const selectedIds = Array.from(document.querySelectorAll(".select-row:checked"))
                .map(cb => cb.value);

            if (selectedIds.length === 0) {
                alert("Pilih setidaknya satu data untuk dihapus!");
                return;
            }

            if (!confirm("Yakin ingin menghapus data terpilih?")) return;

            fetch("{{ route('gempabumi.destroyBatch') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id: selectedIds,
                        _method: "DELETE"
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload(); // atau hapus baris secara dinamis dari DOM
                    } else {
                        alert("Gagal menghapus data.");
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert("Terjadi kesalahan saat menghapus data.");
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

        //modal import data 
        document.getElementById('importModal').addEventListener('hidden.bs.modal', function() {
            this.querySelector('form').reset();
        });
    </script>
@endpush
