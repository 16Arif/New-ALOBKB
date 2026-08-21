<div class="row">
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
                                    href="{{ request()->fullUrlWithQuery(['sort_ld' => 'id_desc']) }}#tab-ld">
                                    Data Terbaru
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_ld' => 'nama_site_asc']) }}#tab-ld">
                                    Nama Site (A - Z)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_ld' => 'nama_site_desc']) }}#tab-ld">
                                    Nama Site (Z - A)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_ld' => 'lokasi_asc']) }}#tab-ld">
                                    Lokasi (A - Z)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_ld' => 'lokasi_desc']) }}#tab-ld">
                                    Lokasi (Z - A)
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Pencarian Lightning Detector -->
                    <div class="my-2">
                        <form method="GET" action="{{ route('aloptama.index') }}#tab-ld">
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
                    {{ $lightningDetectors->fragment('tab-ld')->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
