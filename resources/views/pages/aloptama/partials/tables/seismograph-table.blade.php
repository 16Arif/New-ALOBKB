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
                                    href="{{ request()->fullUrlWithQuery(['sort_seismo' => 'id_desc']) }}#tab-seismo">
                                    Data Terbaru
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_seismo' => 'nama_site_asc']) }}#tab-seismo">
                                    Nama Site (A - Z)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_seismo' => 'nama_site_desc']) }}#tab-seismo">
                                    Nama Site (Z - A)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_seismo' => 'lokasi_asc']) }}#tab-seismo">
                                    Lokasi (A - Z)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort_seismo' => 'lokasi_desc']) }}#tab-seismo">
                                    Lokasi (Z - A)
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Pencarian Seismograph -->
                    <div class="my-2">
                        <form method="GET" action="{{ route('aloptama.index') }}#tab-seismo">
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
                    {{ $seismographs->fragment('tab-seismo')->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
