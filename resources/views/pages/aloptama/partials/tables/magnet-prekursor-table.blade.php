<div class="row">
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
                                    href="{{ request()->fullUrlWithQuery(['sort_magnet' => 'id_desc']) }}#tab-magnet">
                                    Data Terbaru
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_magnet' => 'nama_site_asc']) }}#tab-magnet">
                                    Nama Site (A - Z)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_magnet' => 'nama_site_desc']) }}#tab-magnet">
                                    Nama Site (Z - A)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_magnet' => 'lokasi_asc']) }}#tab-magnet">
                                    Lokasi (A - Z)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_magnet' => 'lokasi_desc']) }}#tab-magnet">
                                    Lokasi (Z - A)
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Pencarian Magnet Prekursor -->
                    <div class="my-2">
                        <form method="GET" action="{{ route('aloptama.index') }}#tab-magnet">
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
                    {{ $magnetPrekursors->fragment('tab-magnet')->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
