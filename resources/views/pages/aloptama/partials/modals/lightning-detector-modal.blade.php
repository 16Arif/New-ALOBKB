<!-- Modal Tambah Data Lightning Detector -->
<div class="modal fade" id="modalCreateLightningDetector" tabindex="-1" role="dialog" aria-labelledby="modalCreateLdLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateLdLabel">
                    <i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Data Lightning Detector (LD)
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('lightning-detector.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create_ld_nama_site">Nama Site <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="create_ld_nama_site" name="nama_site"
                            placeholder="Contoh: LD-BKB01 - Stageof Balikpapan" required>
                    </div>
                    <div class="form-group">
                        <label for="create_ld_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="create_ld_lokasi" name="lokasi" rows="2"
                            placeholder="Contoh: Stasiun Geofisika Balikpapan, Jl. Mulawarman No. 2" required style="height: auto;"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="create_ld_latitude">Latitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_ld_latitude" name="latitude"
                                placeholder="Contoh: -1.265380" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="create_ld_longitude">Longitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create_ld_longitude" name="longitude"
                                placeholder="Contoh: 116.831200" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="create_ld_sensor">Sensor (Opsional)</label>
                        <input type="text" class="form-control" id="create_ld_sensor" name="sensor"
                            placeholder="Contoh: Vaisala TLS200 / Boltek EFM-100 / LS7002">
                    </div>
                    <div class="form-group">
                        <label for="create_ld_receiver">Receiver (Opsional)</label>
                        <input type="text" class="form-control" id="create_ld_receiver" name="receiver"
                            placeholder="Contoh: Vaisala CP2000 / Boltek StormTracker / LS7000">
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

<!-- Modal Detail & Edit Lightning Detector -->
<div class="modal fade" id="modalEditLightningDetector" tabindex="-1" role="dialog" aria-labelledby="modalEditLdLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLdLabel">
                    <i class="fas fa-edit mr-2 text-primary"></i>Detail & Edit Data Lightning Detector (LD)
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditLightningDetector" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_ld_nama_site">Nama Site <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_ld_nama_site" name="nama_site" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_ld_lokasi">Lokasi / Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="edit_ld_lokasi" name="lokasi" rows="2" required style="height: auto;"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="edit_ld_latitude">Latitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_ld_latitude" name="latitude" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="edit_ld_longitude">Longitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_ld_longitude" name="longitude" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_ld_sensor">Sensor</label>
                        <input type="text" class="form-control" id="edit_ld_sensor" name="sensor">
                    </div>
                    <div class="form-group">
                        <label for="edit_ld_receiver">Receiver</label>
                        <input type="text" class="form-control" id="edit_ld_receiver" name="receiver">
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
