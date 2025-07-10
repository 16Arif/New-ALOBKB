@extends('layouts.app')

@section('title', 'Tamabh Data Parameter Gempa')

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
                    <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('gempabumi.index')}}">Kelola Data Gempabumi</a></div>
                    <div class="breadcrumb-item">Tambah Data Gempabumi</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Parameter Gempabumi</h2>
                <div class="text-right mb-2">
                    <a href="{{ route('gempabumi.index') }}" style="color: white; text-decoration: none;">
                        <button class="btn btn-danger">Kembali</button>
                    </a>
                </div>

                <div class="card container">
                    <form action="{{ route('gempabumi.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <div class="row">
                                <h4>Tambah Data Baru</h4>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') ? \Carbon\Carbon::parse(old('tanggal'))->format('d-M-y') : '' }}" name="tanggal" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <label>Waktu (WIB)<span class="text-danger">*</span></label>
                                <input type="time" step="1"  class="form-control @error('waktu') is-invalid @enderror"
                                    name="waktu" value="{{ old('waktu') }}" required>
                                @error('waktu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Lintang<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lintang') is-invalid @enderror"
                                    name="lintang" value="{{ old('lintang') }}" required>
                                    <p class="text-muted">Contoh : 0.12 untuk LU dan -0.12 untuk LS</p>
                                @error('lintang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Bujur<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('bujur') is-invalid @enderror"
                                    name="bujur" value="{{ old('bujur') }}" required>
                                    <p class="text-muted">Contoh : 116.12 untuk BT dan -0.12 untuk BB</p>
                                @error('bujur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Magnitudo<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('magnitudo') is-invalid @enderror"
                                    name="magnitudo" value="{{ old('magnitudo') }}" required>
                                    
                                @error('magnitudo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kedalaman<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kedalaman') is-invalid @enderror"
                                    name="kedalaman" value="{{ old('kedalaman') }}" required>
                                    <p class="text-muted">Cukup nilai 10 tanpa satuan, untuk kedalaman 10Km</p>
                                @error('kedalaman')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jarak Lokasi<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('jarak') is-invalid @enderror"
                                    name="jarak" value="{{ old('jarak') }}" required>
                                    <p class="text-muted">Contoh : 10 Km Timur Laut Sangata</p>
                                @error('jarak')
                                    <div class="invalid-feedback" >
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                    <label class="form-label">Dirasakan</label>
                                    <div class="selectgroup w-100 @error('dirasakan') is-invalid @enderror">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="dirasakan" value="DIRASAKAN"
                                                class="selectgroup-input"
                                                @if (old('dirasakan') == 'DIRASAKAN') checked @endif>
                                            <span class="selectgroup-button">DIRASAKAN</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="dirasakan" value="TIDAK DIRASAKAN"
                                                class="selectgroup-input"
                                                @if (old('dirasakan') == 'TIDAK DIRASAKAN') checked @endif>
                                            <span class="selectgroup-button">TIDAK DIRASAKAN</span>
                                        </label>
                                    </div>
                                    @error('dirasakan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                    <label>Keterangan</label>
                                    <input id="keterangan" type="hidden" name="keterangan" value="{{ old('keterangan') }}">
                                    <trix-editor input="keterangan"></trix-editor>
                                </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
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
        document.addEventListener('trix-file-accept', function(e)) {
            e.preventDefault();
        }
    </script>

    // untuk form tanggal 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
    flatpickr("#tanggal", {
        dateFormat: "d-M-y", // atau sesuai format yang kamu mau
        allowInput: true
    });
    </script>


@endpush
