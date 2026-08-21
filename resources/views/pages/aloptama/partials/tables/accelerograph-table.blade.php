<div class="row">
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
                                    href="{{ request()->fullUrlWithQuery(['sort_acc' => 'id_desc']) }}#tab-acc">
                                    Data Terbaru
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_acc' => 'nama_asc']) }}#tab-acc">
                                    Nama (A - Z)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_acc' => 'nama_desc']) }}#tab-acc">
                                    Nama (Z - A)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_acc' => 'lokasi_asc']) }}#tab-acc">
                                    Lokasi (A - Z)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_acc' => 'lokasi_desc']) }}#tab-acc">
                                    Lokasi (Z - A)
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Pencarian Accelerograph -->
                    <div class="my-2">
                        <form method="GET" action="{{ route('aloptama.index') }}#tab-acc">
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
                    {{ $accelerographs->fragment('tab-acc')->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
