@extends('layouts.app')

@section('title', 'Add Data Logbook Peralatan')

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
                <h1>Logbook Peralatan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Manage Logbook Peralatan</a></div>
                    <div class="breadcrumb-item">Add New Data Logbook Peralatan</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Add New Data Logbook Peralatan</h2>

                <div class="card">
                    <form action="{{ route('logbookperalatan.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Logbook Peralatan Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" autofocus value="{{ old('tanggal') }}">
                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Jam Dinas</label>
                                <div class="selectgroup w-100 @error('jam') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jam" value="07.00" class="selectgroup-input"
                                            @if (old('jam') == '07.00') checked @endif>
                                        <span class="selectgroup-button">07.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jam" value="13.00" class="selectgroup-input"
                                            @if (old('jam') == '13.00') checked @endif>
                                        <span class="selectgroup-button">13.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jam" value="19.00" class="selectgroup-input"
                                            @if (old('jam') == '19.00') checked @endif>
                                        <span class="selectgroup-button">19.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jam" value="01.00" class="selectgroup-input"
                                            @if (old('jam') == '01.00') checked @endif>
                                        <span class="selectgroup-button">01.00</span>
                                    </label>
                                </div>
                                @error('jam')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-lg-4">
                                        <label>On Duty 1</label>
                                        <input type="text" class="form-control @error('onduty1') is-invalid @enderror"
                                            name="onduty1" value="{{ old('onduty1') }}">
                                        @error('onduty1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>On Duty 2</label>
                                        <input type="text" class="form-control " name="onduty2"
                                            value="{{ old('onduty2') }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>On Duty 3</label>
                                        <input type="text" class="form-control " name="onduty3"
                                            value="{{ old('onduty3') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="form-label">Kehadiran</label>
                                <div class="selectgroup w-100 @error('kehadiran') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="kehadiran" value="HADIR" class="selectgroup-input "
                                            @if (old('kehadiran') == 'HADIR') checked @endif>
                                        <span class="selectgroup-button ">HADIR</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="kehadiran" value="TIDAK HADIR" class="selectgroup-input"
                                            @if (old('kehadiran') == 'TIDAK HADIR') checked @endif>
                                        <span class="selectgroup-button">TIDAK HADIR</span>
                                    </label>
                                </div>
                                @error('kehadiran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Finger Print</label>
                                <div class="selectgroup w-100 @error('fingerprint') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="fingerprint" value="BAIK"
                                            class="selectgroup-input" @if (old('fingerprint') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="fingerprint" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('fingerprint') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="fingerprint" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('fingerprint') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('fingerprint')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">TDS</label>
                                <div class="selectgroup w-100 @error('tds') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="tds" value="BAIK" class="selectgroup-input"
                                            @if (old('tds') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="tds" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('tds') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="tds" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('tds') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('tds')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">NexStorm</label>
                                <div class="selectgroup w-100 @error('nexstorm') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="nexstorm" value="BAIK" class="selectgroup-input"
                                            @if (old('nexstorm') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="nexstorm" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('nexstorm') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="nexstorm" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('nexstorm') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('nexstorm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">OBS NexStorm</label>
                                <div class="selectgroup w-100 @error('obs_nexstorm') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="obs_nexstorm" value="BAIK"
                                            class="selectgroup-input" @if (old('obs_nexstorm') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="obs_nexstorm" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('obs_nexstorm') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="obs_nexstorm" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('obs_nexstorm') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('obs_nexstorm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">CMSS</label>
                                <div class="selectgroup w-100 @error('cmss') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="cmss" value="BAIK" class="selectgroup-input"
                                            @if (old('cmss') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="cmss" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('cmss') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="cmss" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('cmss') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('cmss')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Monitoring Sensor</label>
                                <div class="selectgroup w-100 @error('monitoring') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="monitoring" value="BAIK" class="selectgroup-input"
                                            @if (old('monitoring') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="monitoring" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('monitoring') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="monitoring" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('monitoring') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('monitoring')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Accelerograph</label>
                                <div class="selectgroup w-100 @error('acc') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="acc" value="BAIK" class="selectgroup-input"
                                            @if (old('acc') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="acc" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('acc') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="acc" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('acc') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('acc')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">WRS NG</label>
                                <div class="selectgroup w-100 @error('wrsng') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="wrsng" value="BAIK" class="selectgroup-input"
                                            @if (old('wrsng') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="wrsng" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('wrsng') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="wrsng" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('wrsng') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('wrsng')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Integrasi Data</label>
                                <div class="selectgroup w-100 @error('integrasi_data') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="integrasi_data" value="BAIK"
                                            class="selectgroup-input" @if (old('integrasi_data') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="integrasi_data" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('integrasi_data') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="integrasi_data" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('integrasi_data') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('integrasi_data')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">seiscomp4</label>
                                <div class="selectgroup w-100 @error('seiscomp4') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="seiscomp4" value="BAIK" class="selectgroup-input"
                                            @if (old('seiscomp4') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="seiscomp4" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('seiscomp4') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="seiscomp4" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('seiscomp4') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('seiscomp4')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">PC Magnet</label>
                                <div class="selectgroup w-100 @error('pc_magnet') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pc_magnet" value="BAIK" class="selectgroup-input"
                                            @if (old('pc_magnet') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pc_magnet" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('pc_magnet') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pc_magnet" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('pc_magnet') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('pc_magnet')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Penakar Hujan</label>
                                <div class="selectgroup w-100 @error('penakar_hujan') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="penakar_hujan" value="BAIK"
                                            class="selectgroup-input" @if (old('penakar_hujan') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="penakar_hujan" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('penakar_hujan') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="penakar_hujan" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('penakar_hujan') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('penakar_hujan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Radio SSB</label>
                                <div class="selectgroup w-100 @error('radio_ssb') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="radio_ssb" value="BAIK" class="selectgroup-input"
                                            @if (old('radio_ssb') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="radio_ssb" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('radio_ssb') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="radio_ssb" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('radio_ssb') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('radio_ssb')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Kondisi</label>
                                <div class="selectgroup w-100 @error('kondisi') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="kondisi" value="BAIK" class="selectgroup-input"
                                            @if (old('kondisi') == 'BAIK') checked @endif>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="kondisi" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('kondisi') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                </div>
                                @error('kondisi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Catatan</label>
                                <input id="note" type="hidden" name="note" value="{{ old('note') }}">
                                <trix-editor input="note"></trix-editor>
                            </div>
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
@endpush
