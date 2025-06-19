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
                    <div class="breadcrumb-item"><a href="{{ route('gempabumi.index') }}">Kelola Logbook Gempa</a></div>
                    <div class="breadcrumb-item">Edit Data Logbook Gempa</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Logbook Gempabumi</h2>
                <div class="card bg-secondary">
                    <form id="editGempaForm" action="{{ route('gempabumi.update', $datagempa) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-row d-flex justify-content-between">
                                <div class="form-group col-md-5 me-4">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control"
                                        value="{{ old('tanggal', $datagempa->tanggal->format('Y-m-d')) }}">
                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Waktu</label>
                                    <input type="text" name="waktu" class="form-control" placeholder="Contoh: 06:21:17"
                                        value="{{ old('waktu', \Carbon\Carbon::parse($datagempa->waktu)->format('H:i:s')) }} ">
                                    @error('waktu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Magnitudo</label>
                                <input id="magnitudo" type="text"
                                    class="form-control @error('magnitudo') is-invalid @enderror" name="magnitudo"
                                    value="{{ old('magnitudo', $datagempa->magnitudo) }}">
                                @error('magnitudo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Bujur</label>
                                <input id="bujur" type="text"
                                    class="form-control @error('bujur') is-invalid @enderror" name="bujur"
                                    value="{{ old('bujur', $datagempa->bujur) }}">
                                @error('bujur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Lintang</label>
                                <input id="lintang" type="text"
                                    class="form-control @error('lintang') is-invalid @enderror" name="lintang"
                                    value="{{ old('lintang', $datagempa->lintang) }}">
                                @error('lintang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jarak</label>
                                <input id="jarak" type="text"
                                    class="form-control @error('jarak') is-invalid @enderror" name="jarak"
                                    value="{{ old('jarak', $datagempa->jarak) }}">
                                @error('jarak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kedalaman</label>
                                <input id="kedalaman" type="text"
                                    class="form-control @error('kedalaman') is-invalid @enderror" name="kedalaman"
                                    value="{{ old('kedalaman', $datagempa->kedalaman) }}">
                                @error('kedalaman')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class=" text-right mr-4">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <div class="card-footer text-right">
                        <a href="{{ route('gempabumi.index') }}">
                            <button class="btn btn-danger">Cancel</button>
                        </a>
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
        // {{-- untuk edit waktu --}}
        document.addEventListener("DOMContentLoaded", function() {
            const waktuInput = document.querySelector("input[name='waktu']");
            waktuInput.addEventListener("input", function(e) {
                this.value = this.value.replace(/[^\d:]/g, '').slice(0, 8); // hanya angka dan :
            });
        });
    </script>
@endpush
