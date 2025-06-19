{{-- @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert"><span>x</span></button>
            <p>{{ $message }}</p>
        </div>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert"><span>x</span></button>
            <p>{{ $message }}</p>
        </div>
    </div>
@endif
@if ($message = Session::get('info'))
    <div class="alert alert-info alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert"><span>x</span></button>
            <p>{{ $message }}</p>
        </div>
    </div>
@endif --}}


@if ($message = Session::get('success') ?? (Session::get('error') ?? Session::get('info')))
    @php
        $alertType = Session::has('success') ? 'success' : (Session::has('error') ? 'danger' : 'info');
        $alertTitle = ucfirst($alertType);
    @endphp

    <!-- resources/views/components/modal-alert.blade.php -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true"
        style="z-index: 1055;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-{{ $alertType ?? 'primary' }}">
                <div class="modal-header bg-{{ $alertType ?? 'primary' }} text-white">
                    <h5 class="modal-title">{{ $alertTitle ?? 'Informasi' }}</h5>

                </div>
                <div class="modal-body">
                    {{ $message ?? 'Tidak ada pesan' }}
                </div>
                <div class="modal-footer">
                    <p>Klik Layar Untuk Menutup !</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modalEl = document.getElementById('alertModal');
            if (modalEl) {
                const alertModal = new bootstrap.Modal(modalEl);
                alertModal.show();

                // Tutup otomatis setelah 3 detik (3000 ms)
                setTimeout(() => {
                    alertModal.hide();
                }, 3000);
            }
        });
    </script>
@endif
