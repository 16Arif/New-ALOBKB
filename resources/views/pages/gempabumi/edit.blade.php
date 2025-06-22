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
                <h2 class="section-title">Parameter Gempabumi Kalimantan dan Sekitarnya</h2>
                <div class="card bg-light shadow-sm border-0">
                    <form id="editGempaForm" action="{{ route('gempabumi.update', $datagempa) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-header bg-info text-white">
                            <h4 class="mb-0">Edit Data</h4>
                        </div>

                        <div class="card-body">
                            <div class="row g-3">
                                {{-- Tanggal --}}
                                <div class="col-md-6">
                                    <label for="tanggal" class="form-label mb-4">Tanggal</label>
                                    <div class="input-group">
                                        <input type="date" name="tanggal" class="form-control rounded-0 py-2"
                                            {{-- Persegi, padding agar tombol lebih tinggi --}}
                                            value="{{ old('tanggal', $datagempa->tanggal->format('Y-m-d')) }}">
                                    </div>
                                    @error('tanggal')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Waktu & Waktu UTC --}}
                                <div class="col-md-6 mb-3">
                                    <label for="waktu" class="form-label">Waktu</label>
                                    <div class="d-flex flex-column flex-md-row gap-2 mb-3">
                                        <div class="flex-fill">
                                            <label for="waktu" class="form-label">Waktu (WIB)</label>
                                            <input type="text" name="waktu" id="waktu" class="form-control"
                                                placeholder="06:21:17"
                                                value="{{ old('waktu', \Carbon\Carbon::parse($datagempa->waktu)->format('H:i:s')) }}">
                                            <small class="form-text text-muted">Mohon edit waktu secara manual</small>
                                        </div>
                                        <div class="flex-fill">
                                            <label for="waktuUtc" class="form-label">Waktu UTC</label>
                                            <input type="text" name="waktuUtc" id="waktuUtc"
                                                class="form-control bg-light" disabled placeholder="UTC"
                                                value="{{ old('waktuUtc', \Carbon\Carbon::parse($datagempa->waktuUtc)->format('H:i:s')) }}">
                                        </div>
                                    </div>

                                    @error('waktu')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @error('waktuUtc')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="magnitudo">Magnitudo</label>
                                    <input id="magnitudo" type="text"
                                        class="form-control @error('magnitudo') is-invalid @enderror" name="magnitudo"
                                        value="{{ old('magnitudo', $datagempa->magnitudo) }}">
                                    @error('magnitudo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="bujur" class="form-label">Bujur</label>
                                    <input id="bujur" type="text"
                                        class="form-control @error('bujur') is-invalid @enderror" name="bujur"
                                        value="{{ old('bujur', $datagempa->bujur) }}">
                                    @error('bujur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="lintang" class="form-label">Lintang</label>
                                    <input id="lintang" type="text"
                                        class="form-control @error('lintang') is-invalid @enderror" name="lintang"
                                        value="{{ old('lintang', $datagempa->lintang) }}">
                                    @error('lintang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="jarak" class="form-label">Jarak</label>
                                    <input id="jarak" type="text"
                                        class="form-control @error('jarak') is-invalid @enderror" name="jarak"
                                        value="{{ old('jarak', $datagempa->jarak) }}">
                                    @error('jarak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="kedalaman" class="form-label">Kedalaman</label>
                                    <input id="kedalaman" type="text"
                                        class="form-control @error('kedalaman') is-invalid @enderror" name="kedalaman"
                                        value="{{ old('kedalaman', $datagempa->kedalaman) }}">
                                    @error('kedalaman')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="dirasakan" class="form-label d-block">Dirasakan</label>
                                    <div class="selectgroup selectgroup-pills">
                                        <label class="selectgroup-item me-3">
                                            <input type="radio" name="dirasakan" value="DIRASAKAN"
                                                class="selectgroup-input" @if (old('dirasakan') == 'DIRASAKAN' || $datagempa->dirasakan == 'DIRASAKAN') checked @endif>
                                            <span class="selectgroup-button">DIRASAKAN</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="dirasakan" value="TIDAK DIRASAKAN"
                                                class="selectgroup-input" @if (old('dirasakan') == 'TIDAK DIRASAKAN' || $datagempa->dirasakan == 'TIDAK DIRASAKAN') checked @endif>
                                            <span class="selectgroup-button">TIDAK DIRASAKAN</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input id="keterangan" type="hidden" name="keterangan"
                                        value="{{ old('keterangan', $datagempa->keterangan) }}">
                                    <trix-editor input="keterangan"
                                        class="trix-content bg-white border rounded"></trix-editor>
                                    @error('keterangan')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-between px-4 py-3">
                            <a href="{{ route('gempabumi.index') }}" class="btn btn-outline-danger">Cancel</a>
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
