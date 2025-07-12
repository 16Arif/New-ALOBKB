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
                            <h5>Seismograf</h5>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="manufaktur_seismo" class="form-label">Manufaktur Seismograph <span
                                            class="text-danger">*</span></label>
                                    <input id="manufaktur_seismo" type="text" name="manufaktur_seismo"
                                        value="{{ old('manufaktur_seismo', $inatewsequipment->manufaktur_seismo) }}"
                                        class="form-control @error('manufaktur_seismo') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : Guralp
                                    </div>
                                    @error('manufaktur_seismo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipe_seismo" class="form-label">Tipe Seismograph <span
                                            class="text-danger">*</span></label>
                                    <input id="tipe_seismo" type="text" name="tipe_seismo"
                                        value="{{ old('tipe_seismo', $inatewsequipment->tipe_seismo) }}"
                                        class="form-control @error('tipe_seismo') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : 3t 120
                                    </div>
                                    @error('tipe_seismo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sn_seismo" class="form-label">S/N Seismograph <span
                                            class="text-danger">*</span></label>
                                    <input id="sn_seismo" type="text" name="sn_seismo"
                                        value="{{ old('sn_seismo', $inatewsequipment->sn_seismo) }}"
                                        class="form-control @error('sn_seismo') is-invalid @enderror" autocomplete="off"
                                        required>
                                    <div class="form-text">
                                        Contoh : 12345
                                    </div>
                                    @error('sn_seismo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tglinstall_seismo" class="form-label">Tanggal Installasi Seismograph <span
                                            class="text-danger">*</span></label>
                                    <input id="tglinstall_seismo" type="text" name="tglinstall_seismo"
                                        value="{{ old('tglinstall_seismo', $inatewsequipment->tglinstall_seismo) }}"
                                        id="tglinstall_seismo"
                                        class="form-control @error('tglinstall_seismo') is-invalid @enderror"
                                        autocomplete="off" required>
                                    <div class="form-text">
                                        Contoh : 22 Oktober 2021
                                    </div>
                                    @error('tglinstall_seismo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <h5>Accelerograf</h5>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="manufaktur_acc" class="form-label">Manufaktur Accelerograf <span
                                            class="text-danger">*</span></label>
                                    <input id="manufaktur_acc" type="text" name="manufaktur_acc"
                                        value="{{ old('manufaktur_acc', $inatewsequipment->manufaktur_acc) }}"
                                        class="form-control @error('manufaktur_acc') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : Guralp
                                    </div>
                                    @error('manufaktur_acc')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipe_acc" class="form-label">Tipe Accelerograf <span
                                            class="text-danger">*</span></label>
                                    <input id="tipe_acc" type="text" name="tipe_acc"
                                        value="{{ old('tipe_acc', $inatewsequipment->tipe_acc) }}"
                                        class="form-control @error('tipe_acc') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : 3t 120
                                    </div>
                                    @error('tipe_acc')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sn_acc" class="form-label">S/N Accelerograf <span
                                            class="text-danger">*</span></label>
                                    <input id="sn_acc" type="text" name="sn_acc"
                                        value="{{ old('sn_acc', $inatewsequipment->sn_acc) }}"
                                        class="form-control @error('sn_acc') is-invalid @enderror" autocomplete="off"
                                        required>
                                    <div class="form-text">
                                        Contoh : 12345
                                    </div>
                                    @error('sn_acc')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tglinstall_acc" class="form-label">Tanggal Installasi Accelerograf
                                        <span class="text-danger">*</span></label>
                                    <input id="tglinstall_acc" type="text" name="tglinstall_acc"
                                        value="{{ old('tglinstall_acc', $inatewsequipment->tglinstall_acc) }}"
                                        id="tglinstall_acc"
                                        class="form-control @error('tglinstall_acc') is-invalid @enderror"
                                        autocomplete="off" required>
                                    <div class="form-text">
                                        Contoh : 22 Oktober 2021
                                    </div>
                                    @error('tglinstall_acc')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <h5>Digitizer</h5>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="manufaktur_digitizer" class="form-label">Manufaktur Digitizer <span
                                            class="text-danger">*</span></label>
                                    <input id="manufaktur_digitizer" type="text" name="manufaktur_digitizer"
                                        value="{{ old('manufaktur_digitizer', $inatewsequipment->manufaktur_digitizer) }}"
                                        class="form-control @error('manufaktur_digitizer') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : Guralp
                                    </div>
                                    @error('manufaktur_digitizer')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipe_digitizer" class="form-label">Tipe Digitizer <span
                                            class="text-danger">*</span></label>
                                    <input id="tipe_digitizer" type="text" name="tipe_digitizer"
                                        value="{{ old('tipe_digitizer', $inatewsequipment->tipe_digitizer) }}"
                                        class="form-control @error('tipe_digitizer') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : 3t 120
                                    </div>
                                    @error('tipe_digitizer')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sn_digitizer" class="form-label">S/N Digitizer <span
                                            class="text-danger">*</span></label>
                                    <input id="sn_digitizer" type="text" name="sn_digitizer"
                                        value="{{ old('sn_digitizer', $inatewsequipment->sn_digitizer) }}"
                                        class="form-control @error('sn_digitizer') is-invalid @enderror"
                                        autocomplete="off" required>
                                    <div class="form-text">
                                        Contoh : 12345
                                    </div>
                                    @error('sn_digitizer')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tglinstall_digitizer" class="form-label">Tanggal Installasi Digitizer
                                        <span class="text-danger">*</span></label>
                                    <input id="tglinstall_digitizer" type="text" name="tglinstall_digitizer"
                                        value="{{ old('tglinstall_digitizer', $inatewsequipment->tglinstall_digitizer) }}"
                                        id="tglinstall_digitizer"
                                        class="form-control @error('tglinstall_digitizer') is-invalid @enderror"
                                        autocomplete="off" required>
                                    <div class="form-text">
                                        Contoh : 22 Oktober 2021
                                    </div>
                                    @error('tglinstall_digitizer')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <h5>Antenna VSAT</h5>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="manufaktur_antenna" class="form-label">Manufaktur Antenna VSAT <span
                                            class="text-danger">*</span></label>
                                    <input id="manufaktur_antenna" type="text" name="manufaktur_antenna"
                                        value="{{ old('manufaktur_antenna', $inatewsequipment->manufaktur_antenna) }}"
                                        class="form-control @error('manufaktur_antenna') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : Guralp
                                    </div>
                                    @error('manufaktur_antenna')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipe_antenna" class="form-label">Tipe Antenna VSAT <span
                                            class="text-danger">*</span></label>
                                    <input id="tipe_antenna" type="text" name="tipe_antenna"
                                        value="{{ old('tipe_antenna', $inatewsequipment->tipe_antenna) }}"
                                        class="form-control @error('tipe_antenna') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : 3t 120
                                    </div>
                                    @error('tipe_antenna')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sn_antenna" class="form-label">S/N Antenna VSAT <span
                                            class="text-danger">*</span></label>
                                    <input id="sn_antenna" type="text" name="sn_antenna"
                                        value="{{ old('sn_antenna', $inatewsequipment->sn_antenna) }}"
                                        class="form-control @error('sn_antenna') is-invalid @enderror" autocomplete="off"
                                        required>
                                    <div class="form-text">
                                        Contoh : 12345
                                    </div>
                                    @error('sn_antenna')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tglinstall_antenna" class="form-label">Tanggal Installasi Antenna VSAT
                                        <span class="text-danger">*</span></label>
                                    <input id="tglinstall_antenna" type="text" name="tglinstall_antenna"
                                        value="{{ old('tglinstall_antenna', $inatewsequipment->tglinstall_antenna) }}"
                                        id="tglinstall_antenna"
                                        class="form-control @error('tglinstall_antenna') is-invalid @enderror"
                                        autocomplete="off" required>
                                    <div class="form-text">
                                        Contoh : 22 Oktober 2021
                                    </div>
                                    @error('tglinstall_antenna')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <h5>Modem VSAT</h5>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="manufaktur_modem_vsat" class="form-label">Manufaktur Modem VSAT <span
                                            class="text-danger">*</span></label>
                                    <input id="manufaktur_modem_vsat" type="text" name="manufaktur_modem_vsat"
                                        value="{{ old('manufaktur_modem_vsat', $inatewsequipment->manufaktur_modem_vsat) }}"
                                        class="form-control @error('manufaktur_modem_vsat') is-invalid @enderror"
                                        required>
                                    <div class="form-text">
                                        Contoh : Guralp
                                    </div>
                                    @error('manufaktur_modem_vsat')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipe_modem_vsat" class="form-label">Tipe Modem VSAT <span
                                            class="text-danger">*</span></label>
                                    <input id="tipe_modem_vsat" type="text" name="tipe_modem_vsat"
                                        value="{{ old('tipe_modem_vsat', $inatewsequipment->tipe_modem_vsat) }}"
                                        class="form-control @error('tipe_modem_vsat') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : 3t 120
                                    </div>
                                    @error('tipe_modem_vsat')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sn_modem_vsat" class="form-label">S/N Modem VSAT <span
                                            class="text-danger">*</span></label>
                                    <input id="sn_modem_vsat" type="text" name="sn_modem_vsat"
                                        value="{{ old('sn_modem_vsat', $inatewsequipment->sn_modem_vsat) }}"
                                        class="form-control @error('sn_modem_vsat') is-invalid @enderror"
                                        autocomplete="off" required>
                                    <div class="form-text">
                                        Contoh : 12345
                                    </div>
                                    @error('sn_modem_vsat')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tglinstall_modem_vsat" class="form-label">Tanggal Installasi Modem VSAT
                                        <span class="text-danger">*</span></label>
                                    <input id="tglinstall_modem_vsat" type="text" name="tglinstall_modem_vsat"
                                        value="{{ old('tglinstall_modem_vsat', $inatewsequipment->tglinstall_modem_vsat) }}"
                                        id="tglinstall_modem_vsat"
                                        class="form-control @error('tglinstall_modem_vsat') is-invalid @enderror"
                                        autocomplete="off" required>
                                    <div class="form-text">
                                        Contoh : 22 Oktober 2021
                                    </div>
                                    @error('tglinstall_modem_vsat')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <h5>Modem GSM</h5>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="manufaktur_modem_gsm" class="form-label">Manufaktur Modem GSM </label>
                                    <input id="manufaktur_modem_gsm" type="text" name="manufaktur_modem_gsm"
                                        value="{{ old('manufaktur_modem_gsm', $inatewsequipment->manufaktur_modem_gsm) }}"
                                        class="form-control ">
                                    <div class="form-text">
                                        Contoh : Guralp
                                    </div>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipe_modem_gsm" class="form-label">Tipe Modem GSM </label>
                                    <input id="tipe_modem_gsm" type="text" name="tipe_modem_gsm"
                                        value="{{ old('tipe_modem_gsm', $inatewsequipment->tipe_modem_gsm) }}"
                                        class="form-control ">
                                    <div class="form-text">
                                        Contoh : 3t 120
                                    </div>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sn_modem_gsm" class="form-label">S/N Modem GSM </label>
                                    <input id="sn_modem_gsm" type="text" name="sn_modem_gsm"
                                        value="{{ old('sn_modem_gsm', $inatewsequipment->sn_modem_gsm) }}"
                                        class="form-control " autocomplete="off">
                                    <div class="form-text">
                                        Contoh : 12345
                                    </div>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tglinstall_modem_gsm" class="form-label">Tanggal Installasi Modem gsm
                                    </label>
                                    <input id="tglinstall_modem_gsm" type="text" name="tglinstall_modem_gsm"
                                        value="{{ old('tglinstall_modem_gsm', $inatewsequipment->tglinstall_modem_gsm) }}"
                                        id="tglinstall_modem_gsm" class="form-control " autocomplete="off">
                                    <div class="form-text">
                                        Contoh : 22 Oktober 2021
                                    </div>

                                </div>
                            </div>
                            <h5>GPS</h5>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="manufaktur_gps" class="form-label">Manufaktur GPS <span
                                            class="text-danger">*</span></label>
                                    <input id="manufaktur_gps" type="text" name="manufaktur_gps"
                                        value="{{ old('manufaktur_gps', $inatewsequipment->manufaktur_gps) }}"
                                        class="form-control @error('manufaktur_gps') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : Guralp
                                    </div>
                                    @error('manufaktur_gps')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipe_gps" class="form-label">Tipe GPS <span
                                            class="text-danger">*</span></label>
                                    <input id="tipe_gps" type="text" name="tipe_gps"
                                        value="{{ old('tipe_gps', $inatewsequipment->tipe_gps) }}"
                                        class="form-control @error('tipe_gps') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : 3t 120
                                    </div>
                                    @error('tipe_gps')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sn_gps" class="form-label">S/N GPS <span
                                            class="text-danger">*</span></label>
                                    <input id="sn_gps" type="text" name="sn_gps"
                                        value="{{ old('sn_gps', $inatewsequipment->sn_gps) }}"
                                        class="form-control @error('sn_gps') is-invalid @enderror" autocomplete="off"
                                        required>
                                    <div class="form-text">
                                        Contoh : 12345
                                    </div>
                                    @error('sn_gps')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tglinstall_gps" class="form-label">Tanggal Installasi GPS <span
                                            class="text-danger">*</span></label>
                                    <input id="tglinstall_gps" type="text" name="tglinstall_gps"
                                        value="{{ old('tglinstall_gps', $inatewsequipment->tglinstall_gps) }}"
                                        id="tglinstall_gps"
                                        class="form-control @error('tglinstall_gps') is-invalid @enderror"
                                        autocomplete="off" required>
                                    <div class="form-text">
                                        Contoh : 22 Oktober 2021
                                    </div>
                                    @error('tglinstall_gps')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <h5>Solar Panel</h5>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="manufaktur_solar" class="form-label">Manufaktur Solar Panel <span
                                            class="text-danger">*</span></label>
                                    <input id="manufaktur_solar" type="text" name="manufaktur_solar"
                                        value="{{ old('manufaktur_solar', $inatewsequipment->manufaktur_solar) }}"
                                        class="form-control @error('manufaktur_solar') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : Guralp
                                    </div>
                                    @error('manufaktur_solar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipe_solar" class="form-label">Tipe Solar Panel <span
                                            class="text-danger">*</span></label>
                                    <input id="tipe_solar" type="text" name="tipe_solar"
                                        value="{{ old('tipe_solar', $inatewsequipment->tipe_solar) }}"
                                        class="form-control @error('tipe_solar') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : 3t 120
                                    </div>
                                    @error('tipe_solar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sn_solar" class="form-label">S/N Solar Panel <span
                                            class="text-danger">*</span></label>
                                    <input id="sn_solar" type="text" name="sn_solar"
                                        value="{{ old('sn_solar', $inatewsequipment->sn_solar) }}"
                                        class="form-control @error('sn_solar') is-invalid @enderror" autocomplete="off"
                                        required>
                                    <div class="form-text">
                                        Contoh : 12345
                                    </div>
                                    @error('sn_solar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tglinstall_solar" class="form-label">Tanggal Installasi Solar Panel <span
                                            class="text-danger">*</span></label>
                                    <input id="tglinstall_solar" type="text" name="tglinstall_solar"
                                        value="{{ old('tglinstall_solar', $inatewsequipment->tglinstall_solar) }}"
                                        id="tglinstall_solar"
                                        class="form-control @error('tglinstall_solar') is-invalid @enderror"
                                        autocomplete="off" required>
                                    <div class="form-text">
                                        Contoh : 22 Oktober 2021
                                    </div>
                                    @error('tglinstall_solar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <h5>Solar Charge</h5>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="manufaktur_charge" class="form-label">Manufaktur Solar Charge <span
                                            class="text-danger">*</span></label>
                                    <input id="manufaktur_charge" type="text" name="manufaktur_charge"
                                        value="{{ old('manufaktur_charge', $inatewsequipment->manufaktur_charge) }}"
                                        class="form-control @error('manufaktur_charge') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : Guralp
                                    </div>
                                    @error('manufaktur_charge')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipe_charge" class="form-label">Tipe Solar Charge <span
                                            class="text-danger">*</span></label>
                                    <input id="tipe_charge" type="text" name="tipe_charge"
                                        value="{{ old('tipe_charge', $inatewsequipment->tipe_charge) }}"
                                        class="form-control @error('tipe_charge') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : 3t 120
                                    </div>
                                    @error('tipe_charge')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sn_charge" class="form-label">S/N Solar Charge <span
                                            class="text-danger">*</span></label>
                                    <input id="sn_charge" type="text" name="sn_charge"
                                        value="{{ old('sn_charge', $inatewsequipment->sn_charge) }}"
                                        class="form-control @error('sn_charge') is-invalid @enderror" autocomplete="off"
                                        required>
                                    <div class="form-text">
                                        Contoh : 12345
                                    </div>
                                    @error('sn_charge')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tglinstall_charge" class="form-label">Tanggal Installasi Solar Charge
                                        <span class="text-danger">*</span></label>
                                    <input id="tglinstall_charge" type="text" name="tglinstall_charge"
                                        value="{{ old('tglinstall_charge', $inatewsequipment->tglinstall_charge) }}"
                                        id="tglinstall_charge"
                                        class="form-control @error('tglinstall_charge') is-invalid @enderror"
                                        autocomplete="off" required>
                                    <div class="form-text">
                                        Contoh : 22 Oktober 2021
                                    </div>
                                    @error('tglinstall_charge')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <h5>Baterai</h5>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="manufaktur_battery" class="form-label">Manufaktur Baterai <span
                                            class="text-danger">*</span></label>
                                    <input id="manufaktur_battery" type="text" name="manufaktur_battery"
                                        value="{{ old('manufaktur_battery', $inatewsequipment->manufaktur_battery) }}"
                                        class="form-control @error('manufaktur_battery') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : Guralp
                                    </div>
                                    @error('manufaktur_battery')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipe_battery" class="form-label">Tipe Baterai <span
                                            class="text-danger">*</span></label>
                                    <input id="tipe_battery" type="text" name="tipe_battery"
                                        value="{{ old('tipe_battery', $inatewsequipment->tipe_battery) }}"
                                        class="form-control @error('tipe_battery') is-invalid @enderror" required>
                                    <div class="form-text">
                                        Contoh : 3t 120
                                    </div>
                                    @error('tipe_battery')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sn_battery" class="form-label">S/N Baterai <span
                                            class="text-danger">*</span></label>
                                    <input id="sn_battery" type="text" name="sn_battery"
                                        value="{{ old('sn_battery', $inatewsequipment->sn_battery) }}"
                                        class="form-control @error('sn_battery') is-invalid @enderror" autocomplete="off"
                                        required>
                                    <div class="form-text">
                                        Contoh : 12345
                                    </div>
                                    @error('sn_battery')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tglinstall_battery" class="form-label">Tanggal Installasi Baterai <span
                                            class="text-danger">*</span></label>
                                    <input id="tglinstall_battery" type="text" name="tglinstall_battery"
                                        value="{{ old('tglinstall_battery', $inatewsequipment->tglinstall_battery) }}"
                                        id="tglinstall_battery"
                                        class="form-control @error('tglinstall_battery') is-invalid @enderror"
                                        autocomplete="off" required>
                                    <div class="form-text">
                                        Contoh : 22 Oktober 2021
                                    </div>
                                    @error('tglinstall_battery')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <h5>IP</h5>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="ip_digitizer" class="form-label">IP Digitizer </label>
                                    <input id="ip_digitizer" type="text" name="ip_digitizer"
                                        value="{{ old('ip_digitizer', $inatewsequipment->ip_digitizer) }}"
                                        class="form-control " autocomplete="off">
                                    <div class="form-text">
                                        Contoh : 123.456.6.6
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="ip_modem_vsat" class="form-label">IP Modem VSAT </label>
                                    <input id="ip_modem_vsat" type="text" name="ip_modem_vsat"
                                        value="{{ old('ip_modem_vsat', $inatewsequipment->ip_modem_vsat) }}"
                                        class="form-control " autocomplete="off">
                                    <div class="form-text">
                                        Contoh : 123.456.6.6
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="ip_modem_gsm" class="form-label">IP Modem GSM </label>
                                    <input id="ip_modem_gsm" type="text" name="ip_modem_gsm"
                                        value="{{ old('ip_modem_gsm', $inatewsequipment->ip_modem_gsm) }}"
                                        class="form-control " autocomplete="off">
                                    <div class="form-text">
                                        Contoh : 123.456.6.6
                                    </div>

                                </div>
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

    {{-- date picker --}}
    <script>
        flatpickr(
            "#tglinstall_seismo, #tglinstall_acc, #tglinstall_digitizer, #tglinstall_antenna, #tglinstall_modem_vsat,#tglinstall_modem_gsm, #tglinstall_gps, #tglinstall_solar, #tglinstall_charge, #tglinstall_battery", {
                dateFormat: "d-m-Y", // atau sesuai format yang kamu mau
                allowInput: true
            });
    </script>
@endpush
