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
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <h2 class="section-title">Parameter Gempabumi Kalimantan dan Sekitarnya</h2>
                    <!-- Tombol Collapse -->
                    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEditForm" aria-expanded="false" aria-controls="collapseEditForm">
                        <i class="fa-solid fa-download me-1"></i> Download Data
                    </button>
                </div>
                <div class="row ml-1">
                    <div class=" float-right">
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
                                <form method="GET" action="{{ route('gempabumi.index') }}" class="mb-3">
                                    <label for="per_page">Tampilkan:</label>
                                    <select name="per_page" id="per_page" onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua
                                        </option>
                                    </select>
                                </form>
                                <div class="table-responsive mt-3">
                                    <table class="table-striped table">
                                        <tr>
                                            <th class="checkbox-column d-none">#</th>
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
                                            <th>Aksi</th>
                                        </tr>

                                        @forelse ($datagempa as $index => $gempa)
                                            <tr>
                                                <td class="checkbox-column d-none">
                                                    <input type="checkbox" class="select-row" value="{{ $gempa->id }}">
                                                </td>
                                                <td>{{ isset($gempa->firstItem) ? $datagempa->firstItem() + $index : $index + 1 }}
                                                </td>
                                                <td>{{ $gempa->tanggal }}</td>
                                                <td>{{ $gempa->waktu }}</td>
                                                <td>{{ $gempa->waktu_utc }}</td>
                                                <td>{{ $gempa->waktu_wita }}</td>
                                                <td>{{ $gempa->lintang }}</td>
                                                <td>{{ $gempa->bujur }}</td>
                                                <td>{{ $gempa->magnitudo }}</td>
                                                <td>{{ $gempa->kedalaman }}</td>
                                                <td>{{ $gempa->jarak }}</td>
                                                <td>{{ $gempa->dirasakan }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">

                                                        <a href="{{ route('gempabumi.edit', $gempa->id) }}">
                                                            <div class="btn btn-sm btn-info btn-icon">
                                                                <i class="fas fa-edit"></i>
                                                            </div>
                                                        </a>
                                                        <form action="{{ route('gempabumi.destroy', $gempa->id) }}"
                                                            method="POST" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon"
                                                                onclick="return confirmDelete({{ $gempa->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data.</td>
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
                const anyChecked = document.querySelectorAll(".select-row:checked").length > 0;
                generateBtn.classList.toggle("d-none", !anyChecked);
                deleteBtn.classList.toggle("d-none", !anyChecked);
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
    </script>
@endpush
