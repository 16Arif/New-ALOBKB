<!-- Modal Tambah Data Magnet Prekursor -->
<div class="modal fade" id="modalCreateMagnetPrekursor" tabindex="-1" role="dialog" aria-labelledby="modalCreateMagnetLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateMagnetLabel">
                    <i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Data Magnet Prekursor
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('magnet-prekursor.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create_mp_nama_site">Nama Site / Stasiun <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="create_mp_nama_site" name="nama_site"
                            placeholder="Contoh: MP-BKB01 - Stageof Balikpapan" required>
                    </div>
                    <div class="form-group">
                        <label for="create_mp_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="create_mp_lokasi" name="lokasi" rows="2"
                            placeholder="Contoh: Taman Alat Geomagnetik Stasiun Geofisika Balikpapan" required style="height: auto;"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="create_mp_latitude">Latitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_mp_latitude" name="latitude"
                                placeholder="Contoh: -1.265380" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="create_mp_longitude">Longitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_mp_longitude" name="longitude"
                                placeholder="Contoh: 116.831200" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="create_mp_tahun">Tahun Instalasi (Opsional)</label>
                            <input type="text" class="form-control" id="create_mp_tahun" name="tahun_instalasi"
                                placeholder="Contoh: 2021">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="create_mp_sensor">Sensor (Opsional)</label>
                            <input type="text" class="form-control" id="create_mp_sensor" name="sensor"
                                placeholder="Contoh: Fluxgate Magnetometer 3-Axis">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="create_mp_digitizer">Digitizer (Opsional)</label>
                            <input type="text" class="form-control" id="create_mp_digitizer" name="digitizer"
                                placeholder="Contoh: LEMI-417 High Resolution Logger">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="create_mp_regulator">Regulator / Solar Controller (Opsional)</label>
                            <input type="text" class="form-control" id="create_mp_regulator" name="regulator"
                                placeholder="Contoh: Morningstar SunSaver 10A / Victron">
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

<!-- Modal Detail & Edit Magnet Prekursor -->
<div class="modal fade" id="modalEditMagnetPrekursor" tabindex="-1" role="dialog" aria-labelledby="modalEditMagnetLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditMagnetLabel">
                    <i class="fas fa-edit mr-2 text-primary"></i>Detail & Edit Data Magnet Prekursor
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditMagnetPrekursor" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_mp_nama_site">Nama Site / Stasiun <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_mp_nama_site" name="nama_site" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_mp_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="edit_mp_lokasi" name="lokasi" rows="2" required style="height: auto;"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="edit_mp_latitude">Latitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_mp_latitude" name="latitude" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="edit_mp_longitude">Longitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_mp_longitude" name="longitude" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="edit_mp_tahun">Tahun Instalasi</label>
                            <input type="text" class="form-control" id="edit_mp_tahun" name="tahun_instalasi">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="edit_mp_sensor">Sensor</label>
                            <input type="text" class="form-control" id="edit_mp_sensor" name="sensor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="edit_mp_digitizer">Digitizer</label>
                            <input type="text" class="form-control" id="edit_mp_digitizer" name="digitizer">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="edit_mp_regulator">Regulator / Solar Controller</label>
                            <input type="text" class="form-control" id="edit_mp_regulator" name="regulator">
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
