<!-- Modal Tambah Data Seismograph -->
<div class="modal fade" id="modalCreateSeismograph" tabindex="-1" role="dialog" aria-labelledby="modalCreateSeismoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateSeismoLabel">
                    <i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Data Seismograph
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('seismograph.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create_nama_site">Nama Site <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="create_nama_site" name="nama_site"
                            placeholder="Contoh: BBKI - Balikpapan" required>
                    </div>
                    <div class="form-group">
                        <label for="create_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="create_lokasi" name="lokasi" rows="2"
                            placeholder="Contoh: Stasiun Geofisika Balikpapan, Jl. Mulawarman" required style="height: auto;"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="create_latitude">Latitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_latitude" name="latitude"
                                placeholder="Contoh: -1.265380" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="create_longitude">Longitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_longitude" name="longitude"
                                placeholder="Contoh: 116.831200" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="create_seismometer">Seismometer</label>
                        <input type="text" class="form-control" id="create_seismometer" name="seismometer"
                            placeholder="Contoh: Nanometrics Trillium Compact 120s">
                    </div>
                    <div class="form-group">
                        <label for="create_accelerometer">Accelerometer</label>
                        <input type="text" class="form-control" id="create_accelerometer" name="accelerometer"
                            placeholder="Contoh: Nanometrics Titan Accelerometer">
                    </div>
                    <div class="form-group">
                        <label for="create_digitizer">Digitizer</label>
                        <input type="text" class="form-control" id="create_digitizer" name="digitizer"
                            placeholder="Contoh: Nanometrics Centaur 24-bit">
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

<!-- Modal Detail & Edit Seismograph -->
<div class="modal fade" id="modalEditSeismograph" tabindex="-1" role="dialog" aria-labelledby="modalEditSeismoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSeismoLabel">
                    <i class="fas fa-edit mr-2 text-primary"></i>Detail & Edit Data Seismograph
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditSeismograph" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nama_site">Nama Site <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_nama_site" name="nama_site" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="edit_lokasi" name="lokasi" rows="2" required style="height: auto;"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="edit_latitude">Latitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_latitude" name="latitude" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="edit_longitude">Longitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_longitude" name="longitude" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_seismometer">Seismometer</label>
                        <input type="text" class="form-control" id="edit_seismometer" name="seismometer">
                    </div>
                    <div class="form-group">
                        <label for="edit_accelerometer">Accelerometer</label>
                        <input type="text" class="form-control" id="edit_accelerometer" name="accelerometer">
                    </div>
                    <div class="form-group">
                        <label for="edit_digitizer">Digitizer</label>
                        <input type="text" class="form-control" id="edit_digitizer" name="digitizer">
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
