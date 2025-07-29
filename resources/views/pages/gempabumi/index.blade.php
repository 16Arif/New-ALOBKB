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
                    <!-- Tombol Collapse -->
                    <button id="toggleDownloadBtn" class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEditForm" aria-expanded="false" aria-controls="collapseEditForm">
                        <i class="fa-solid fa-download me-1"></i> Unduh Data
                    </button>
                </div>
                <div class="row ml-1">
                    <div class=" float-right">
                        <!-- Konten Collapse -->
                        <div class="collapse row" id="collapseEditForm">
                            <div class="card bg-light shadow rounded p-3 mr-3">
                                <p class="text-center">Unduh Data Excel</p>
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
                            <div class="card bg-light shadow rounded p-3">
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

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-header">
                                <h4>Semua Data</h4>
                                <a href="{{ route('gempabumi.custom.create') }}" class="btn btn-primary mr-2">Tambah
                                    Data</a>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                                    <i class="fa-solid fa-upload me-1"></i> Import CSV
                                </button>
                            </div>
                            <div class="card-body">
                                {{-- pilih data  --}}
                                <div class="row justify-content-between">
                                    <div class="float-left ml-3">
                                        <div class="mb-3">
                                            <button id="toggleSelection" class="btn btn-primary">Pilih</button>

                                            <button id="cancelSelection" class="btn btn-secondary d-none">Batal</button>
                                            <button id="generateInfografis" class="btn btn-success d-none mb-2">Buat
                                                Infografis</button>
                                            <form id="infografisForm" action="{{ route('gempabumi.infografiss') }}"
                                                method="POST" target="_blank">
                                                @csrf
                                                <input type="hidden" name="ids" id="selectedIdsInput">
                                            </form>

                                            <button id="hapusData" class="btn btn-danger d-none">Hapus Data</button>
                                        </div>
                                    </div>

                                    <!-- Form Filter Rentang Tanggal -->
                                    <div class="collapse mt-3 col-md-6" id="collapseFilterForm">
                                        <div class="card bg-light shadow rounded p-3">
                                            <form method="GET" action="{{ route('gempabumi.index') }}"
                                                class="row g-2 align-items-end mb-3" id="filterForm">
                                                <div class="col-md-3">
                                                    <label for="filter_start">Dari Tanggal</label>
                                                    <input type="date" id="filter_start" name="filter_start"
                                                        class="form-control" value="{{ request('filter_start') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="filter_end">Sampai Tanggal</label>
                                                    <input type="date" id="filter_end" name="filter_end"
                                                        class="form-control" value="{{ request('filter_end') }}">
                                                </div>

                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="submit" class="btn btn-warning w-100">
                                                        <i class="fa-solid fa-filter me-1"></i> Filter
                                                    </button>
                                                </div>

                                                @if (request('filter_start') && request('filter_end'))
                                                    <div class="col-md-2 d-flex align-items-end">
                                                        <a href="{{ route('gempabumi.index') }}"
                                                            class="btn btn-sm btn-secondary w-100">
                                                            <i class="fa-solid fa-xmark me-1"></i> Hapus Filter
                                                        </a>
                                                    </div>
                                                @endif
                                            </form>

                                        </div>
                                    </div>


                                    <div class="float-right mr-4">
                                        <div class="row">
                                            <button id="toggleFilterBtn" class="btn btn-warning mr-3" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFilterForm"
                                                aria-expanded="false" aria-controls="collapseFilterForm">
                                                <i class="fa-solid fa-filter me-1"></i> Filter
                                            </button>
                                            <form method="GET" action="{{ route('gempabumi.index') }}">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Search"
                                                        name="search" value="{{ request('search') }}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary"><i
                                                                class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                {{-- pilihan jumlah tampilan data  --}}
                                <div class="text-muted float-right">
                                    Menampilkan {{ is_countable($datagempa) ? count($datagempa) : $datagempa->total() }}
                                    data
                                </div>
                                <form method="GET" action="{{ route('gempabumi.index') }}"
                                    class="mb-3 float-right mr-1">
                                    <label for="per_page">Tampilkan:</label>

                                    {{-- Tambahkan hidden input agar filter tetap terbawa --}}
                                    @if (request('filter_start'))
                                        <input type="hidden" name="filter_start" value="{{ request('filter_start') }}">
                                    @endif
                                    @if (request('filter_end'))
                                        <input type="hidden" name="filter_end" value="{{ request('filter_end') }}">
                                    @endif
                                    @if (request('search'))
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif

                                    <select name="per_page" id="per_page" onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10
                                        </option>
                                        <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30
                                        </option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50
                                        </option>
                                        <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua
                                        </option>
                                    </select>
                                </form>

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
                                                <td>{{ $gempa->tanggal }}</td>
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
                                    <div class="mt-3">
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
        });

        cancelBtn.addEventListener("click", () => {
            checkboxCols.forEach(el => el.classList.add("d-none"));
            cancelBtn.classList.add("d-none");
            toggleBtn.classList.remove("d-none");
            generateBtn.classList.add("d-none");
            deleteBtn.classList.add("d-none");
            checkboxes.forEach(cb => cb.checked = false);
        });

        checkboxes.forEach(cb => {
            cb.addEventListener("change", () => {
                const allChecked = document.querySelectorAll(".select-row").length === document
                    .querySelectorAll(".select-row:checked").length;
                document.getElementById("selectAll").checked = allChecked;

                const anyChecked = document.querySelectorAll(".select-row:checked").length > 0;
                generateBtn.classList.toggle("d-none", !anyChecked);
                deleteBtn.classList.toggle("d-none", !anyChecked);
            });
        });

        //  ceklist semua data 
        document.getElementById("selectAll").addEventListener("change", function() {
            const checked = this.checked;
            document.querySelectorAll(".select-row").forEach(cb => {
                cb.checked = checked;
            });

            // Tampilkan tombol jika ada checkbox yang dicentang
            const anyChecked = document.querySelectorAll(".select-row:checked").length > 0;
            generateBtn.classList.toggle("d-none", !anyChecked);
            deleteBtn.classList.toggle("d-none", !anyChecked);
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
