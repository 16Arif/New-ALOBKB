@extends('layouts.app')

@section('title', 'Tambah Data Logbook Peralatan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Stasiun Geofisika Balikpapan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('logbookperalatan.index') }}">Logbook
                            Peralatan</a>
                    </div>
                    <div class="breadcrumb-item">Tambah Data Logbook Peralatan</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Logbook Peralatan</h2>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Tambah Data </h4>
                        <a href="{{ route('logbookperalatan.index') }}" style="color: white; text-decoration: none;">
                            <button class="btn btn-danger">Kembali</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('logbookperalatan.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Tanggal<span class="text-danger">*</span></label>
                                <input type="date" id="tanggal"
                                    class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                                    value="{{ old('tanggal', now()->toDateString()) }}" autocomplete="off" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Jam Dinas<span class="text-danger">*</span></label>
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
                                        <label>On Duty 1<span class="text-danger">*</span></label>
                                        <select class="form-control @error('onduty1') is-invalid @enderror" name="onduty1">
                                            <option value="">-- Select User --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    {{ old('onduty1') == $user->name ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('onduty1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>On Duty 2</label>
                                        <select class="form-control " name="onduty2">
                                            <option value="">-- Select User --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    {{ old('onduty2') == $user->name ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>On Duty 3</label>
                                        <select class="form-control " name="onduty3">
                                            <option value="">-- Select User --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    {{ old('onduty3') == $user->name ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Finger Print<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('fingerprint') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="fingerprint" value="BAIK" class="selectgroup-input"
                                            @if (old('fingerprint') == 'BAIK') checked @endif checked>
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
                                <label class="form-label">TDS<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('tds') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="tds" value="BAIK" class="selectgroup-input"
                                            @if (old('tds') == 'BAIK') checked @endif checked>
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
                                <label class="form-label">NexStorm<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('nexstorm') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="nexstorm" value="BAIK" class="selectgroup-input"
                                            @if (old('nexstorm') == 'BAIK') checked @endif checked>
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
                                <label class="form-label">OBS NexStorm<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('obs_nexstorm') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="obs_nexstorm" value="BAIK"
                                            class="selectgroup-input" @if (old('obs_nexstorm') == 'BAIK') checked @endif
                                            checked>
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
                                <label class="form-label">CMSS<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('cmss') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="cmss" value="BAIK" class="selectgroup-input"
                                            @if (old('cmss') == 'BAIK') checked @endif checked>
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
                                <label class="form-label">Monitoring Sensor<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('monitoring') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="monitoring" value="BAIK" class="selectgroup-input"
                                            @if (old('monitoring') == 'BAIK') checked @endif checked>
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
                                <label class="form-label">Accelerograph<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('acc') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="acc" value="BAIK" class="selectgroup-input"
                                            @if (old('acc') == 'BAIK') checked @endif checked>
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
                                <label class="form-label">WRS NG<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('wrsng') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="wrsng" value="BAIK" class="selectgroup-input"
                                            @if (old('wrsng') == 'BAIK') checked @endif checked>
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
                                <label class="form-label">Integrasi Data<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('integrasi_data') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="integrasi_data" value="BAIK"
                                            class="selectgroup-input" @if (old('integrasi_data') == 'BAIK') checked @endif
                                            checked>
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
                                <label class="form-label">Seiscomp<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('seiscomp4') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="seiscomp4" value="BAIK" class="selectgroup-input"
                                            @if (old('seiscomp4') == 'BAIK') checked @endif checked>
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
                                <label class="form-label">PC Magnet<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('pc_magnet') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pc_magnet" value="BAIK" class="selectgroup-input"
                                            @if (old('pc_magnet') == 'BAIK') checked @endif checked>
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
                                <label class="form-label">Monitor ZOOM<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('monitor_zoom') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="monitor_zoom" value="BAIK"
                                            class="selectgroup-input" @if (old('monitor_zoom') == 'BAIK') checked @endif
                                            checked>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="monitor_zoom" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('monitor_zoom') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="monitor_zoom" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('monitor_zoom') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('monitor_zoom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Internet Operasional Seiscomp<span
                                        class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('internet_ops') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="internet_ops" value="BAIK"
                                            class="selectgroup-input" @if (old('internet_ops') == 'BAIK') checked @endif
                                            checked>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="internet_ops" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('internet_ops') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="internet_ops" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('internet_ops') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('internet_ops')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Internet Lokal SG4-Balikpapan<span
                                        class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('internet_lokal') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="internet_lokal" value="BAIK"
                                            class="selectgroup-input" @if (old('internet_lokal') == 'BAIK') checked @endif
                                            checked>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="internet_lokal" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('internet_lokal') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="internet_lokal" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('internet_lokal') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('internet_lokal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Shakemap<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('shakemap') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="shakemap" value="BAIK" class="selectgroup-input"
                                            @if (old('shakemap') == 'BAIK') checked @endif checked>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="shakemap" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('shakemap') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="shakemap" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('shakemap') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('shakemap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Seiscomp Regional<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('seiscomp_reg') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="seiscomp_reg" value="BAIK"
                                            class="selectgroup-input" @if (old('seiscomp_reg') == 'BAIK') checked @endif
                                            checked>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="seiscomp_reg" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('seiscomp_reg') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="seiscomp_reg" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('seiscomp_reg') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('seiscomp_reg')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">PC QC Seiscomp<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('qc_seiscomp') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="qc_seiscomp" value="BAIK"
                                            class="selectgroup-input" @if (old('qc_seiscomp') == 'BAIK') checked @endif
                                            checked>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="qc_seiscomp" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('qc_seiscomp') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="qc_seiscomp" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('qc_seiscomp') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('qc_seiscomp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Monitor SIMAP<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('monitor_simap') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="monitor_simap" value="BAIK"
                                            class="selectgroup-input" @if (old('monitor_simap') == 'BAIK') checked @endif
                                            checked>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="monitor_simap" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('monitor_simap') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="monitor_simap" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('monitor_simap') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('monitor_simap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">PC WorkStation SIMAP<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('ws_simap') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="ws_simap" value="BAIK" class="selectgroup-input"
                                            @if (old('ws_simap') == 'BAIK') checked @endif checked>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="ws_simap" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('ws_simap') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="ws_simap" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('ws_simap') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('ws_simap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">BKB Server<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('bkb_server') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="bkb_server" value="BAIK" class="selectgroup-input"
                                            @if (old('bkb_server') == 'BAIK') checked @endif checked>
                                        <span class="selectgroup-button">BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="bkb_server" value="TIDAK BAIK"
                                            class="selectgroup-input" @if (old('bkb_server') == 'TIDAK BAIK') checked @endif>
                                        <span class="selectgroup-button">TIDAK BAIK</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="bkb_server" value="TIDAK AKTIF"
                                            class="selectgroup-input" @if (old('bkb_server') == 'TIDAK AKTIF') checked @endif>
                                        <span class="selectgroup-button">TIDAK AKTIF</span>
                                    </label>
                                </div>
                                @error('bkb_server')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Penakar Hujan<span class="text-danger">*</span></label>
                                <div class="selectgroup w-100 @error('penakar_hujan') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="penakar_hujan" value="BAIK"
                                            class="selectgroup-input" @if (old('penakar_hujan') == 'BAIK') checked @endif
                                            checked>
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
                                <label class="form-label">Radio SSB<span class="text-danger">*</span></label>
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
                                            class="selectgroup-input" @if (old('radio_ssb') == 'TIDAK AKTIF') checked @endif
                                            checked>
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
                                <label>Catatan</label>
                                <input id="note" type="hidden" name="note" value="{{ old('note') }}">
                                <trix-editor input="note"></trix-editor>
                            </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Simpan</button>
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
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>

    <script>
        flatpickr("#tanggal", {
            dateFormat: "Y-m-d", // atau sesuai format yang kamu mau
            allowInput: true
        });
    </script>
@endpush
