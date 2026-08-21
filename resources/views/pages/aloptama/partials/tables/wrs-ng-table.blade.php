<div class="row">
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
                                    href="{{ request()->fullUrlWithQuery(['sort_wrs' => 'id_desc']) }}#tab-wrs">
                                    Data Terbaru
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_wrs' => 'nama_site_asc']) }}#tab-wrs">
                                    Nama Site (A - Z)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_wrs' => 'nama_site_desc']) }}#tab-wrs">
                                    Nama Site (Z - A)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_wrs' => 'lokasi_asc']) }}#tab-wrs">
                                    Lokasi (A - Z)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_wrs' => 'lokasi_desc']) }}#tab-wrs">
                                    Lokasi (Z - A)
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Pencarian WRS NG -->
                    <div class="my-2">
                        <form method="GET" action="{{ route('aloptama.index') }}#tab-wrs">
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
                    {{ $wrsNgs->fragment('tab-wrs')->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
