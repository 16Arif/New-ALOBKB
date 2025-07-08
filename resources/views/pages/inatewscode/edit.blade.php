@extends('layouts.app')

@section('title', 'Edit Data Parameter Gempabumi')

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
                            InaTEWS</a></div>
                    <div class="breadcrumb-item">Edit Data Kode Site InaTEWS</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Kode Site InaTEWS</h2>
                <div class="card bg-light shadow-sm border-0">
                    <form action="{{ route('inatewscode.update', $inatewscode) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Kode Site</label>
                                <input id="kode_site" type="text" name="kode_site"
                                    value="{{ old('kode_site', $inatewscode->kode_site) }}"
                                    class="form-control @error('kode_site') is-invalid @enderror">
                                @error('kode_site')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Site</label>
                                <input id="nama_site" type="text" name="nama_site"
                                    value="{{ old('nama_site', $inatewscode->nama_site) }}"
                                    class="form-control @error('nama_site') is-invalid @enderror">
                                @error('nama_site')
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
