@extends('layouts.app')

@section('title', 'Tambah Data Informasi Site InaTEWS')

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
                    <div class="breadcrumb-item"><a href="#">Kelola Data Site InaTEWS</a></div>
                    <div class="breadcrumb-item">Edit Data Informasi Site InaTEWS</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Informasi Site InaTEWS</h2>
                <div class="text-right mb-2">
                    {{-- <a href="{{ route('equipment_inatews.index') }}" style="color: white; text-decoration: none;">
                        <button class="btn btn-danger">Kembali</button>
                    </a> --}}
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row">
                                <h5>Edit Data</h5>
                            </div>
                        </div>
                        <form action="{{ route('inatewsinformation.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="lat" class="form-label">Latitude</label>
                                <input id="lat" type="text" name="lat"
                                    value="{{ old('lat', $inatewsinformation->lat) }}"
                                    class="form-control @error('lat') is-invalid @enderror">
                                @error('lat')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="long" class="form-label">Longitude</label>
                                <input id="long" type="text" name="long"
                                    value="{{ old('long', $inatewsinformation->long) }}"
                                    class="form-control @error('long') is-invalid @enderror">
                                @error('long')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="elevasi" class="form-label">Elevasi</label>
                                <input id="elevasi" type="text" name="elevasi"
                                    value="{{ old('elevasi', $inatewsinformation->elevasi) }}"
                                    class="form-control @error('elevasi') is-invalid @enderror">
                                @error('elevasi')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('inatewsequipment.index') }}" class="btn btn-outline-danger">Cancel</a>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
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
        document.addEventListener('trix-file-accept', function(e)) {
            e.preventDefault();
        }
    </script>
@endpush
