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
