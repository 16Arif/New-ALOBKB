@extends('layouts.app')

@section('title', 'Edit Data Peralatan Site InaTEWS')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Stasiun Geofisika Balikpapan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('inatewsequipment.index') }}">Kelola Data Site
                            InaTEWS</a>
                    </div>
                    <div class="breadcrumb-item">Edit Data Peralatan Site InaTEWS</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Peralatan Site InaTEWS</h2>
                <div class="card bg-light shadow-sm border-0">
                    <form action="{{ route('inatewsequipment.update', $inatewsequipment) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="manufaktur_seismo" class="form-label">Manufaktur Seismograph</label>
                                <input id="manufaktur_seismo" type="text" name="manufaktur_seismo"
                                    value="{{ old('manufaktur_seismo', $inatewsequipment->manufaktur_seismo) }}"
                                    class="form-control @error('manufaktur_seismo') is-invalid @enderror">
                                <div class="form-text">
                                    Contoh : Guralp
                                </div>
                                @error('manufaktur_seismo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tipe_seismo" class="form-label">Tipe Seismograph</label>
                                <input id="tipe_seismo" type="text" name="tipe_seismo"
                                    value="{{ old('tipe_seismo', $inatewsequipment->tipe_seismo) }}"
                                    class="form-control @error('tipe_seismo') is-invalid @enderror">
                                <div class="form-text">
                                    Contoh : 3t 120
                                </div>
                                @error('tipe_seismo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="sn_seismo" class="form-label">S/N Seismograph</label>
                                <input id="sn_seismo" type="text" name="sn_seismo"
                                    value="{{ old('sn_seismo', $inatewsequipment->sn_seismo) }}"
                                    class="form-control @error('sn_seismo') is-invalid @enderror">
                                <div class="form-text">
                                    Contoh : 12345
                                </div>
                                @error('sn_seismo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggalinstall_seismo" class="form-label">Tanggal Installasi Seismograph</label>
                                <input id="tanggalinstall_seismo" type="text" name="tanggalinstall_seismo"
                                    value="{{ old('tanggalinstall_seismo', $inatewsequipment->tanggalinstall_seismo) }}"
                                    class="form-control @error('tanggalinstall_seismo') is-invalid @enderror">
                                <div class="form-text">
                                    Contoh : 22 Oktober 2021
                                </div>
                                @error('tanggalinstall_seismo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between px-4 py-3">
                            <a href="{{ route('inatewsequipment.index') }}" class="btn btn-outline-danger">Cancel</a>
                            <button class="btn btn-primary px-4">Simpan</button>
                        </div>
                    </form>

                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>

    <script>
        // {{-- untuk edit waktu --}}
        document.addEventListener("DOMContentLoaded", function() {
            const waktuInput = document.querySelector("input[name='waktu']");
            waktuInput.addEventListener("input", function(e) {
                this.value = this.value.replace(/[^\d:]/g, '').slice(0, 8); // hanya angka dan :
            });
        });
    </script>
@endpush
