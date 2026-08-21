<!-- Modal Tambah Data Accelerograph -->
<div class="modal fade" id="modalCreateAccelerograph" tabindex="-1" role="dialog" aria-labelledby="modalCreateAccLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateAccLabel">
                    <i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Data Accelerograph Non Colocated
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('accelerograph.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create_acc_nama">Nama Site / Stasiun <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="create_acc_nama" name="nama"
                            placeholder="Contoh: AC-BKB01 - Balikpapan Kota" required>
                    </div>
                    <div class="form-group">
                        <label for="create_acc_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="create_acc_lokasi" name="lokasi" rows="2"
                            placeholder="Contoh: Kantor Walikota Balikpapan, Jl. Jend. Sudirman No. 1" required style="height: auto;"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="create_acc_latitude">Latitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_acc_latitude" name="latitude"
                                placeholder="Contoh: -1.270420" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="create_acc_longitude">Longitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_acc_longitude" name="longitude"
                                placeholder="Contoh: 116.828850" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="create_acc_merk">Merk Peralatan</label>
                        <input type="text" class="form-control" id="create_acc_merk" name="merk"
                            placeholder="Contoh: Nanometrics / Kinemetrics / Guralp / GeoSIG">
                    </div>
                    <div class="form-group">
                        <label for="create_acc_tipe">Tipe Accelerometer</label>
                        <input type="text" class="form-control" id="create_acc_tipe" name="tipe_accelerometer"
                            placeholder="Contoh: Titan Strong Motion / Episensor / CMG-5T">
                    </div>
                    <div class="form-group">
                        <label for="create_acc_digitizer">Digitizer</label>
                        <input type="text" class="form-control" id="create_acc_digitizer" name="digitizer"
                            placeholder="Contoh: Nanometrics Centaur / Basalt / Rock / DM24">
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

<!-- Modal Detail & Edit Accelerograph -->
<div class="modal fade" id="modalEditAccelerograph" tabindex="-1" role="dialog" aria-labelledby="modalEditAccLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditAccLabel">
                    <i class="fas fa-edit mr-2 text-primary"></i>Detail & Edit Data Accelerograph Non Colocated
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditAccelerograph" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_acc_nama">Nama Site / Stasiun <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_acc_nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_acc_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="edit_acc_lokasi" name="lokasi" rows="2" required style="height: auto;"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="edit_acc_latitude">Latitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_acc_latitude" name="latitude" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="edit_acc_longitude">Longitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_acc_longitude" name="longitude" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_acc_merk">Merk Peralatan</label>
                        <input type="text" class="form-control" id="edit_acc_merk" name="merk">
                    </div>
                    <div class="form-group">
                        <label for="edit_acc_tipe">Tipe Accelerometer</label>
                        <input type="text" class="form-control" id="edit_acc_tipe" name="tipe_accelerometer">
                    </div>
                    <div class="form-group">
                        <label for="edit_acc_digitizer">Digitizer</label>
                        <input type="text" class="form-control" id="edit_acc_digitizer" name="digitizer">
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
