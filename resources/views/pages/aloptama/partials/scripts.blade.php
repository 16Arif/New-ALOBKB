<!-- JS Libraries -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // --- 1. TAB SELECTION PERSISTENCE ---
        // Activate tab based on URL hash or Query parameters
        var hash = window.location.hash;
        if (hash && $('a[data-toggle="pill"][href="' + hash + '"]').length) {
            $('a[data-toggle="pill"][href="' + hash + '"]').tab('show');
        } else {
            // Auto-detect tab from query parameters if hash not in URL
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('search_acc') || urlParams.has('sort_acc') || urlParams.has('page_acc')) {
                $('#acc-tab').tab('show');
            } else if (urlParams.has('search_ld') || urlParams.has('sort_ld') || urlParams.has('page_ld')) {
                $('#ld-tab').tab('show');
            } else if (urlParams.has('search_wrs') || urlParams.has('sort_wrs') || urlParams.has('page_wrs')) {
                $('#wrs-tab').tab('show');
            } else if (urlParams.has('search_magnet') || urlParams.has('sort_magnet') || urlParams.has('page_magnet')) {
                $('#magnet-tab').tab('show');
            } else {
                $('#seismo-tab').tab('show');
            }
        }

        // Store hash on tab change without scrolling
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            var targetHash = $(e.target).attr('href');
            if (history.replaceState) {
                history.replaceState(null, null, targetHash);
            } else {
                window.location.hash = targetHash;
            }
        });

        // --- 2. MODAL POPULATE HANDLERS ---
        // 1. Populate Modal Edit Seismograph
        $('.btn-edit-seismograph').on('click', function() {
            var actionUrl = $(this).data('action');
            var namaSite = $(this).data('nama_site');
            var lokasi = $(this).data('lokasi');
            var latitude = $(this).data('latitude');
            var longitude = $(this).data('longitude');
            var seismometer = $(this).data('seismometer');
            var accelerometer = $(this).data('accelerometer');
            var digitizer = $(this).data('digitizer');

            $('#formEditSeismograph').attr('action', actionUrl);
            $('#edit_nama_site').val(namaSite);
            $('#edit_lokasi').val(lokasi);
            $('#edit_latitude').val(latitude);
            $('#edit_longitude').val(longitude);
            $('#edit_seismometer').val(seismometer);
            $('#edit_accelerometer').val(accelerometer);
            $('#edit_digitizer').val(digitizer);

            $('#modalEditSeismograph').modal('show');
        });

        // 2. Populate Modal Edit Accelerograph
        $('.btn-edit-accelerograph').on('click', function() {
            var actionUrl = $(this).data('action');
            var nama = $(this).data('nama');
            var lokasi = $(this).data('lokasi');
            var latitude = $(this).data('latitude');
            var longitude = $(this).data('longitude');
            var merk = $(this).data('merk');
            var tipeAccelerometer = $(this).data('tipe_accelerometer');
            var digitizer = $(this).data('digitizer');

            $('#formEditAccelerograph').attr('action', actionUrl);
            $('#edit_acc_nama').val(nama);
            $('#edit_acc_lokasi').val(lokasi);
            $('#edit_acc_latitude').val(latitude);
            $('#edit_acc_longitude').val(longitude);
            $('#edit_acc_merk').val(merk);
            $('#edit_acc_tipe').val(tipeAccelerometer);
            $('#edit_acc_digitizer').val(digitizer);

            $('#modalEditAccelerograph').modal('show');
        });

        // 3. Populate Modal Edit Lightning Detector
        $('.btn-edit-ld').on('click', function() {
            var actionUrl = $(this).data('action');
            var namaSite = $(this).data('nama_site');
            var lokasi = $(this).data('lokasi');
            var latitude = $(this).data('latitude');
            var longitude = $(this).data('longitude');
            var sensor = $(this).data('sensor');
            var receiver = $(this).data('receiver');

            $('#formEditLightningDetector').attr('action', actionUrl);
            $('#edit_ld_nama_site').val(namaSite);
            $('#edit_ld_lokasi').val(lokasi);
            $('#edit_ld_latitude').val(latitude);
            $('#edit_ld_longitude').val(longitude);
            $('#edit_ld_sensor').val(sensor);
            $('#edit_ld_receiver').val(receiver);

            $('#modalEditLightningDetector').modal('show');
        });

        // 4. Populate Modal Edit WRS NG
        $('.btn-edit-wrs').on('click', function() {
            var actionUrl = $(this).data('action');
            var namaSite = $(this).data('nama_site');
            var lokasi = $(this).data('lokasi');
            var latitude = $(this).data('latitude');
            var longitude = $(this).data('longitude');

            $('#formEditWrsNg').attr('action', actionUrl);
            $('#edit_wrs_nama_site').val(namaSite);
            $('#edit_wrs_lokasi').val(lokasi);
            $('#edit_wrs_latitude').val(latitude);
            $('#edit_wrs_longitude').val(longitude);

            $('#modalEditWrsNg').modal('show');
        });

        // 5. Populate Modal Edit Magnet Prekursor
        $('.btn-edit-magnet').on('click', function() {
            var actionUrl = $(this).data('action');
            var namaSite = $(this).data('nama_site');
            var lokasi = $(this).data('lokasi');
            var latitude = $(this).data('latitude');
            var longitude = $(this).data('longitude');
            var tahunInstalasi = $(this).data('tahun_instalasi');
            var sensor = $(this).data('sensor');
            var digitizer = $(this).data('digitizer');
            var regulator = $(this).data('regulator');

            $('#formEditMagnetPrekursor').attr('action', actionUrl);
            $('#edit_mp_nama_site').val(namaSite);
            $('#edit_mp_lokasi').val(lokasi);
            $('#edit_mp_latitude').val(latitude);
            $('#edit_mp_longitude').val(longitude);
            $('#edit_mp_tahun').val(tahunInstalasi);
            $('#edit_mp_sensor').val(sensor);
            $('#edit_mp_digitizer').val(digitizer);
            $('#edit_mp_regulator').val(regulator);

            $('#modalEditMagnetPrekursor').modal('show');
        });

        // --- 3. RESET CREATE FORMS ON CLOSE ---
        $('#modalCreateSeismograph').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
        });
        $('#modalCreateAccelerograph').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
        });
        $('#modalCreateLightningDetector').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
        });
        $('#modalCreateWrsNg').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
        });
        $('#modalCreateMagnetPrekursor').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
        });
    });

    // --- 4. CONFIRM DELETE HELPERS ---
    function confirmDeleteSeismo(siteName) {
        return confirm('Apakah Anda yakin ingin menghapus data seismograph "' + siteName + '"?');
    }

    function confirmDeleteAcc(nama) {
        return confirm('Apakah Anda yakin ingin menghapus data accelerograph "' + nama + '"?');
    }

    function confirmDeleteLd(siteName) {
        return confirm('Apakah Anda yakin ingin menghapus data lightning detector "' + siteName + '"?');
    }

    function confirmDeleteWrs(siteName) {
        return confirm('Apakah Anda yakin ingin menghapus data WRS NG "' + siteName + '"?');
    }

    function confirmDeleteMagnet(siteName) {
        return confirm('Apakah Anda yakin ingin menghapus data magnet prekursor "' + siteName + '"?');
    }
</script>
