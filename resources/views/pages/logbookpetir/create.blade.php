@extends('layouts.app')

@section('title', 'Add Data Logbook Petir')

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
                    <div class="breadcrumb-item"><a href="#">Manage Logbook Petir</a></div>
                    <div class="breadcrumb-item">Add New Data Logbook Petir</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Logbook Petir</h2>
                <div class="card">
                    <form action="{{ route('logbookpetir.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Tambah Data</h4>
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
                                <label class="form-label">Pengamatan 1</label>
                                <div class="selectgroup w-100 @error('pengamatan1') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan1" value="Pengamatan LD jam 02.00"
                                            class="selectgroup-input" @if (old('pengamatan1') == 'Pengamatan LD jam 02.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 02.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan1" value="Pengamatan LD jam 08.00"
                                            class="selectgroup-input" @if (old('pengamatan1') == 'Pengamatan LD jam 08.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 08.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan1" value="Pengamatan LD jam 14.00"
                                            class="selectgroup-input" @if (old('pengamatan1') == 'Pengamatan LD jam 14.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 14.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan1" value="Pengamatan LD jam 20.00"
                                            class="selectgroup-input" @if (old('pengamatan1') == 'Pengamatan LD jam 20.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 20.00</span>
                                    </label>
                                </div>
                                @error('pengamatan1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pengamatan 2</label>
                                <div class="selectgroup w-100  @error('pengamatan2') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan2" value="Pengamatan LD jam 03.00"
                                            class="selectgroup-input" @if (old('pengamatan2') == 'Pengamatan LD jam 03.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 03.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan2" value="Pengamatan LD jam 09.00"
                                            class="selectgroup-input" @if (old('pengamatan2') == 'Pengamatan LD jam 09.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 09.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan2" value="Pengamatan LD jam 15.00"
                                            class="selectgroup-input" @if (old('pengamatan2') == 'Pengamatan LD jam 15.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 15.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan2" value="Pengamatan LD jam 21.00"
                                            class="selectgroup-input" @if (old('pengamatan2') == 'Pengamatan LD jam 21.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 21.00</span>
                                    </label>
                                </div>
                                @error('pengamatan2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pengamatan 3</label>
                                <div class="selectgroup w-100 @error('pengamatan3') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan3" value="Pengamatan LD jam 04.00"
                                            class="selectgroup-input" @if (old('pengamatan3') == 'Pengamatan LD jam 04.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 04.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan3" value="Pengamatan LD jam 10.00"
                                            class="selectgroup-input" @if (old('pengamatan3') == 'Pengamatan LD jam 10.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 10.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan3" value="Pengamatan LD jam 16.00"
                                            class="selectgroup-input" @if (old('pengamatan3') == 'Pengamatan LD jam 16.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 16.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan3" value="Pengamatan LD jam 22.00"
                                            class="selectgroup-input" @if (old('pengamatan3') == 'Pengamatan LD jam 22.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 22.00</span>
                                    </label>
                                </div>
                                @error('pengamatan3')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pengamatan 4</label>
                                <div class="selectgroup w-100 @error('pengamatan4') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan4" value="Pengamatan LD jam 05.00"
                                            class="selectgroup-input" @if (old('pengamatan4') == 'Pengamatan LD jam 05.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 05.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan4" value="Pengamatan LD jam 11.00"
                                            class="selectgroup-input" @if (old('pengamatan4') == 'Pengamatan LD jam 11.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 11.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan4" value="Pengamatan LD jam 17.00"
                                            class="selectgroup-input" @if (old('pengamatan4') == 'Pengamatan LD jam 17.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 17.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan4" value="Pengamatan LD jam 23.00"
                                            class="selectgroup-input" @if (old('pengamatan4') == 'Pengamatan LD jam 23.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 23.00</span>
                                    </label>
                                </div>
                                @error('pengamatan4')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pengamatan 5</label>
                                <div class="selectgroup w-100 @error('pengamatan5') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan5" value="Pengamatan LD jam 06.00"
                                            class="selectgroup-input" @if (old('pengamatan5') == 'Pengamatan LD jam 06.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 06.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan5" value="Pengamatan LD jam 12.00"
                                            class="selectgroup-input" @if (old('pengamatan5') == 'Pengamatan LD jam 12.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 12.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan5" value="Pengamatan LD jam 18.00"
                                            class="selectgroup-input" @if (old('pengamatan5') == 'Pengamatan LD jam 18.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 18.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan5" value="Pengamatan LD jam 00.00"
                                            class="selectgroup-input" @if (old('pengamatan5') == 'Pengamatan LD jam 00.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 00.00</span>
                                    </label>
                                </div>
                                @error('pengamatan5')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pengamatan 6</label>
                                <div class="selectgroup w-100 @error('pengamatan6') is-invalid @enderror">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan6" value="Pengamatan LD jam 07.00"
                                            class="selectgroup-input" @if (old('pengamatan6') == 'Pengamatan LD jam 07.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 07.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan6" value="Pengamatan LD jam 13.00"
                                            class="selectgroup-input" @if (old('pengamatan6') == 'Pengamatan LD jam 13.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 13.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan6" value="Pengamatan LD jam 19.00"
                                            class="selectgroup-input" @if (old('pengamatan6') == 'Pengamatan LD jam 19.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 19.00</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pengamatan6" value="Pengamatan LD jam 01.00"
                                            class="selectgroup-input" @if (old('pengamatan6') == 'Pengamatan LD jam 01.00') checked @endif>
                                        <span class="selectgroup-button">Pengamatan LD jam 01.00</span>
                                    </label>
                                </div>
                                @error('pengamatan5')
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
