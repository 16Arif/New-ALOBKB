@extends('layouts.app')

@section('title', 'Edit Data Logbook Gempabumi')

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
                    <div class="breadcrumb-item"><a href="{{ route('logbookgempa.index') }}">Logbook Gempa</a></div>
                    <div class="breadcrumb-item">Edit Data Logbook Gempa</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Logbook Gempabumi</h2>
                <div class="card">
                    <form action="{{ route('logbookgempa.update', $logbookgempa) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" id="tanggal" value="{{ old('tanggal', $logbookgempa->tanggal) }}">
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
                                            @if (old('jam') == '07.00' || $logbookgempa->jam == '07.00') checked @endif>
                                        <span class="selectgroup-button">07.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jam" value="13.00" class="selectgroup-input"
                                            @if (old('jam') == '13.00' || $logbookgempa->jam == '13.00') checked @endif>
                                        <span class="selectgroup-button">13.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jam" value="19.00" class="selectgroup-input"
                                            @if (old('jam') == '19.00' || $logbookgempa->jam == '19.00') checked @endif>
                                        <span class="selectgroup-button">19.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jam" value="01.00" class="selectgroup-input"
                                            @if (old('jam') == '01.00' || $logbookgempa->jam == '01.00') checked @endif>
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
                                        <select class="form-control @error('onduty1') is-invalid @enderror" name="onduty1">
                                            <option value="">{{ old('onduty1', $logbookgempa->onduty1) }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    {{ old('onduty1', $logbookgempa->onduty1) == $user->name ? 'selected' : '' }}>
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
                                        <select class="form-control" name="onduty2">
                                            <option value="">{{ old('onduty2', $logbookgempa->onduty2) }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    {{ old('onduty2', $logbookgempa->onduty2) == $user->name ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>On Duty 3</label>
                                        <select class="form-control" name="onduty3">
                                            <option value="">{{ old('onduty3', $logbookgempa->onduty3) }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    {{ old('onduty3', $logbookgempa->onduty3) == $user->name ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Catatan</label>
                                <input id="note" type="hidden" name="note"
                                    value="{{ old('note', $logbookgempa->note) }}">
                                <trix-editor input="note"></trix-editor>
                            </div>
                        </div>
                        <div class=" text-right mr-4">
                            <button class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                    <div class="card-footer text-right">
                        <a href="{{ route('logbookgempa.index') }}">
                            <button class="btn btn-danger">Batalkan</button>
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
        flatpickr("#tanggal", {
            dateFormat: "Y-m-d", // atau sesuai format yang kamu mau
            allowInput: true
        });
    </script>
@endpush
