@extends('layouts.app')

@section('title', 'Tambah Data Peralatan Stasiun InaTEWS')

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
                    <div class="breadcrumb-item">Tambah Data Peralatan Site InaTEWS</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Peralatan Site InaTEWS</h2>
                <div class="text-right mb-2">
                    {{-- <a href="{{ route('equipment_inatews.index') }}" style="color: white; text-decoration: none;">
                        <button class="btn btn-danger">Kembali</button>
                    </a> --}}
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row">
                                <h5>Tambah Data Baru</h5>
                            </div>
                        </div>
                        <form action="{{ route('inatewsequipment.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="manufaktur_seismo" class="form-label">Manufaktur Seismograph</label>
                                <input id="manufaktur_seismo" type="text" name="manufaktur_seismo"
                                    value="{{ old('manufaktur_seismo') }}"
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
                                <input id="tipe_seismo" type="text" name="tipe_seismo" value="{{ old('tipe_seismo') }}"
                                    class="form-control @error('tipe_seismo') is-invalid @enderror">
                                <div class="form-text">
                                    Contoh : 3T 120
                                </div>
                                @error('tipe_seismo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="sn_seismo" class="form-label">S/N </label>
                                <input id="sn_seismo" type="text" name="sn_seismo" value="{{ old('sn_seismo') }}"
                                    class="form-control @error('sn_seismo') is-invalid @enderror">
                                <div class="form-text">
                                    Contoh : T310777
                                </div>
                                @error('sn_seismo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggalinstall_seismo" class="form-label">Tanggal Installasi Seismograph</label>
                                <input id="tanggalinstall_seismo" type="text" name="tanggalinstall_seismo"
                                    value="{{ old('tanggalinstall_seismo') }}"
                                    class="form-control @error('tanggalinstall_seismo') is-invalid @enderror">
                                <div class="form-text">
                                    Contoh : 20 Oktober 2019
                                </div>
                                @error('tanggalinstall_seismo')
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
