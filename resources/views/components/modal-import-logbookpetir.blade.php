<div class="modal fade" id="importModalPetir" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="POST" action="{{ route('import.spatie_petir') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Logbook Petir (Excel)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="file">Upload File Excel</label>
                        <input type="file" name="file" accept=".xlsx,.xls" class="form-control" required>
                    </div>
                    <span class="text-warning">Pastikan kolom Excel sesuai dengan format unduhan dari aplikasi
                        ini.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>
