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

    <style>
        /* Custom premium style for edit gempa form */
        .custom-form-card {
            border-radius: 12px !important;
            border: none !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04) !important;
            background: #ffffff !important;
            overflow: hidden;
        }

        .custom-card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #f2f2f2 !important;
            border-left: 4px solid #6777ef; /* Stisla primary color */
            padding: 1rem 1.75rem !important;
            display: flex;
            align-items: center;
        }

        .custom-card-header h4 {
            font-size: 1.25rem !important;
            font-weight: 700 !important;
            color: #191d21 !important;
            margin: 0 !important;
        }

        .custom-card-body {
            padding: 1.25rem 1.75rem !important;
        }

        .custom-form-label {
            font-weight: 600 !important;
            font-size: 0.95rem !important;
            letter-spacing: 0.3px;
            color: #34395e !important;
            margin-bottom: 0.4rem !important;
        }

        .custom-input {
            border-radius: 6px !important;
            border: 1px solid #e4e6fc !important;
            padding: 0.6rem 0.8rem !important;
            height: auto !important;
            font-size: 1rem !important;
            background-color: #fcfcfd !important;
            transition: all 0.2s ease-in-out !important;
        }

        .custom-input:focus {
            background-color: #fff !important;
            border-color: #6777ef !important;
            box-shadow: 0 0 0 3px rgba(103, 119, 239, 0.15) !important;
            outline: none;
        }

        .custom-input:disabled, .custom-input[readonly] {
            background-color: #f4f6f9 !important;
            border-color: #e4e6fc !important;
            color: #868e96 !important;
            opacity: 0.8;
        }

        .status-badge-container {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .status-pill-button {
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.95rem;
            border: 2px solid #e4e6fc;
            background: #fff;
            color: #495057;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            user-select: none;
        }

        .status-pill-button:hover {
            border-color: #fc544b;
            color: #fc544b;
            background: rgba(252, 84, 75, 0.02);
        }

        .status-pill-input:checked + .status-pill-button {
            background: #fc544b;
            border-color: #fc544b;
            color: #fff;
            box-shadow: 0 4px 12px rgba(252, 84, 75, 0.25);
        }

        .btn-reset-status {
            padding: 0.4rem 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 30px;
            transition: all 0.2s;
        }

        /* Helper text premium */
        .helper-text-premium {
            font-size: 0.825rem !important;
            color: #868e96 !important;
            margin-top: 0.3rem !important;
            display: block;
        }

        .helper-text-premium i {
            margin-right: 3px;
        }

        /* Trix editor customization */
        trix-editor.trix-content {
            border: 1px solid #e4e6fc !important;
            border-radius: 6px !important;
            background-color: #fff !important;
            min-height: 120px !important;
            padding: 0.8rem !important;
            font-size: 1rem !important;
        }

        trix-editor.trix-content:focus {
            border-color: #6777ef !important;
            box-shadow: 0 0 0 3px rgba(103, 119, 239, 0.15) !important;
        }

        .custom-card-footer {
            background: #fcfcfd !important;
            border-top: 1px solid #f2f2f2 !important;
            padding: 1rem 1.75rem !important;
        }
    </style>

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
                <div class="row">
                    <div class="col-12 col-lg-8 col-xl-7 mx-auto">
                        <div class="card custom-form-card">
                            <form id="editGempaForm" action="{{ route('gempabumi.update', $datagempa) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-header custom-card-header">
                                    <i class="fas fa-edit text-primary mr-2" style="font-size: 1.2rem;"></i>
                                    <h4>Edit Parameter Gempabumi</h4>
                                </div>

                                <div class="card-body custom-card-body">
                            <div class="row">
                                <!-- Section 1: Tanggal & Waktu -->
                                <div class="col-12 mb-4">
                                    <div class="p-3 rounded" style="background-color: #f8f9fa; border: 1px solid #e4e6fc;">
                                        <h6 class="text-uppercase text-primary font-weight-bold mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="far fa-clock mr-1"></i> Informasi Waktu & Tanggal
                                        </h6>
                                        <div class="row">
                                            {{-- Tanggal --}}
                                            <div class="col-md-4 mb-3 mb-md-0">
                                                <label for="tanggal" class="custom-form-label">Tanggal Kejadian</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-white text-muted" style="border: 1px solid #e4e6fc; border-right: none; border-radius: 6px 0 0 6px;"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="date" name="tanggal" id="tanggal" class="form-control custom-input @error('tanggal') is-invalid @enderror" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;"
                                                        value="{{ old('tanggal', $datagempa->tanggal->format('Y-m-d')) }}">
                                                </div>
                                                @error('tanggal')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Waktu (WIB, UTC, WITA) --}}
                                            <div class="col-md-8">
                                                <label class="custom-form-label">Konfigurasi Waktu</label>
                                                <div class="row">
                                                    <div class="col-md-4 mb-2 mb-md-0">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-primary text-white font-weight-bold" style="border: none; border-radius: 6px 0 0 6px; font-size: 0.75rem;">WIB</span>
                                                            </div>
                                                            <input type="text" name="waktu" id="waktu" class="form-control custom-input @error('waktu') is-invalid @enderror"
                                                                placeholder="06:21:17" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;"
                                                                value="{{ old('waktu', \Carbon\Carbon::parse($datagempa->waktu)->format('H:i:s')) }}">
                                                        </div>
                                                        <small class="helper-text-premium"><i class="fas fa-keyboard"></i> Format HH:MM:SS</small>
                                                    </div>
                                                    <div class="col-md-4 mb-2 mb-md-0">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-secondary text-white font-weight-bold" style="border: none; border-radius: 6px 0 0 6px; font-size: 0.75rem;">UTC</span>
                                                            </div>
                                                            <input type="text" name="waktu_utc" id="waktu_utc"
                                                                class="form-control custom-input" disabled placeholder="UTC" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;"
                                                                value="{{ old('waktu_utc', \Carbon\Carbon::parse($datagempa->waktu_utc)->format('H:i:s')) }}">
                                                        </div>
                                                        <small class="helper-text-premium"><i class="fas fa-magic"></i> Terisi otomatis (WIB -7)</small>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-secondary text-white font-weight-bold" style="border: none; border-radius: 6px 0 0 6px; font-size: 0.75rem;">WITA</span>
                                                            </div>
                                                            <input type="text" name="waktu_wita" id="waktu_wita"
                                                                class="form-control custom-input" disabled placeholder="WITA" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;"
                                                                value="{{ old('waktu_wita', \Carbon\Carbon::parse($datagempa->waktu_wita)->format('H:i:s')) }}">
                                                        </div>
                                                        <small class="helper-text-premium"><i class="fas fa-magic"></i> Terisi otomatis (WIB +1)</small>
                                                    </div>
                                                </div>
                                                @error('waktu')
                                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                                @enderror
                                                @error('waktuUtc')
                                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 2: Parameter Episenter & Magnitudo -->
                                <div class="col-12 mb-4">
                                    <h6 class="text-uppercase text-primary font-weight-bold mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                        <i class="fas fa-globe mr-1"></i> Parameter Episenter & Magnitudo
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="bujur" class="custom-form-label">Bujur (Longitude)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-white text-muted" style="border: 1px solid #e4e6fc; border-right: none; border-radius: 6px 0 0 6px;"><i class="fas fa-compass"></i></span>
                                                </div>
                                                <input id="bujur" type="text"
                                                    class="form-control custom-input @error('bujur') is-invalid @enderror" name="bujur"
                                                    value="{{ old('bujur', $datagempa->bujur) }}" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;">
                                            </div>
                                            <small class="helper-text-premium"><i class="fas fa-info-circle"></i> Contoh: 116.12 (BT) atau -0.12 (BB)</small>
                                            @error('bujur')
                                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="lintang" class="custom-form-label">Lintang (Latitude)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-white text-muted" style="border: 1px solid #e4e6fc; border-right: none; border-radius: 6px 0 0 6px;"><i class="fas fa-compass"></i></span>
                                                </div>
                                                <input id="lintang" type="text"
                                                    class="form-control custom-input @error('lintang') is-invalid @enderror" name="lintang"
                                                    value="{{ old('lintang', $datagempa->lintang) }}" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;">
                                            </div>
                                            <small class="helper-text-premium"><i class="fas fa-info-circle"></i> Contoh: 0.12 (LU) atau -0.12 (LS)</small>
                                            @error('lintang')
                                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="magnitudo" class="custom-form-label">Magnitudo (M)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-white text-muted" style="border: 1px solid #e4e6fc; border-right: none; border-radius: 6px 0 0 6px;"><i class="fas fa-wave-square"></i></span>
                                                </div>
                                                <input id="magnitudo" type="text"
                                                    class="form-control custom-input @error('magnitudo') is-invalid @enderror" name="magnitudo"
                                                    value="{{ old('magnitudo', $datagempa->magnitudo) }}" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;">
                                            </div>
                                            @error('magnitudo')
                                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="kedalaman" class="custom-form-label">Kedalaman (Km)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-white text-muted" style="border: 1px solid #e4e6fc; border-right: none; border-radius: 6px 0 0 6px;"><i class="fas fa-arrows-alt-v"></i></span>
                                                </div>
                                                <input id="kedalaman" type="text"
                                                    class="form-control custom-input @error('kedalaman') is-invalid @enderror" name="kedalaman"
                                                    value="{{ old('kedalaman', $datagempa->kedalaman) }}" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;">
                                            </div>
                                            <small class="helper-text-premium"><i class="fas fa-info-circle"></i> Angka saja, contoh: 10</small>
                                            @error('kedalaman')
                                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="jarak" class="custom-form-label">Jarak Episenter & Lokasi</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-white text-muted" style="border: 1px solid #e4e6fc; border-right: none; border-radius: 6px 0 0 6px;"><i class="fas fa-map-marker-alt"></i></span>
                                                </div>
                                                <input id="jarak" type="text"
                                                    class="form-control custom-input @error('jarak') is-invalid @enderror" name="jarak"
                                                    value="{{ old('jarak', $datagempa->jarak) }}" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;">
                                            </div>
                                            <small class="helper-text-premium"><i class="fas fa-info-circle"></i> Contoh: 10 Km Timur Laut Sangata</small>
                                            @error('jarak')
                                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 3: Status & Keterangan -->
                                <div class="col-12">
                                    <h6 class="text-uppercase text-primary font-weight-bold mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                        <i class="fas fa-bullhorn mr-1"></i> Dampak & Keterangan
                                    </h6>
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <label class="custom-form-label d-block">Status Gempa</label>
                                            <input type="hidden" name="dirasakan" value="">
                                            <div class="status-badge-container">
                                                <label class="mb-0">
                                                    <input type="radio" name="dirasakan" value="DIRASAKAN" id="radio-dirasakan" class="status-pill-input d-none"
                                                        {{ (old('dirasakan') ?? $datagempa->dirasakan) == 'DIRASAKAN' ? 'checked' : '' }}>
                                                    <span class="status-pill-button">
                                                        <i class="fas fa-bullhorn text-xs"></i> DIRASAKAN
                                                    </span>
                                                </label>
                                                <button type="button" class="btn btn-outline-danger btn-reset-status btn-sm" id="btn-batal-dirasakan"
                                                    style="display: {{ (old('dirasakan') ?? $datagempa->dirasakan) == 'DIRASAKAN' ? 'inline-block' : 'none' }}; border-radius: 30px;">
                                                    <i class="fas fa-times mr-1"></i> Batal / Reset Status
                                                </button>
                                            </div>
                                            <small class="helper-text-premium mt-2"><i class="fas fa-info-circle"></i> Pilih "DIRASAKAN" jika gempa dirasakan oleh masyarakat setempat.</small>
                                        </div>

                                        <div class="col-12">
                                            <label for="keterangan" class="custom-form-label">Keterangan / Narasi Gempa</label>
                                            <input id="keterangan" type="hidden" name="keterangan"
                                                value="{{ old('keterangan', $datagempa->keterangan) }}">
                                            <trix-editor input="keterangan" class="trix-content"></trix-editor>
                                            @error('keterangan')
                                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer custom-card-footer d-flex justify-content-between">
                            <a href="{{ route('gempabumi.index') }}" class="btn btn-light px-4 py-2" style="border-radius: 30px; font-weight: 600; color: #495057; border: 1px solid #dcdfe3;">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 30px; font-weight: 600; background-color: #6777ef; border: none; box-shadow: 0 4px 12px rgba(103, 119, 239, 0.25) !important;">
                                <i class="fas fa-save mr-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
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
        // {{-- untuk edit waktu & live timezone calculations --}}
        document.addEventListener("DOMContentLoaded", function() {
            const waktuInput = document.getElementById("waktu");
            const utcInput = document.getElementById("waktu_utc");
            const witaInput = document.getElementById("waktu_wita");

            function updateTimeZones() {
                const value = waktuInput.value.trim();
                const timePattern = /^([0-1]\d|2[0-3]):([0-5]\d):([0-5]\d)$/;
                
                if (timePattern.test(value)) {
                    const parts = value.split(':');
                    const hrs = parseInt(parts[0], 10);
                    const mins = parts[1];
                    const secs = parts[2];

                    // UTC: WIB - 7 jam
                    let utcHrs = hrs - 7;
                    if (utcHrs < 0) {
                        utcHrs += 24;
                    }
                    const utcTime = String(utcHrs).padStart(2, '0') + ':' + mins + ':' + secs;
                    utcInput.value = utcTime;

                    // WITA: WIB + 1 jam
                    let witaHrs = hrs + 1;
                    if (witaHrs >= 24) {
                        witaHrs -= 24;
                    }
                    const witaTime = String(witaHrs).padStart(2, '0') + ':' + mins + ':' + secs;
                    witaInput.value = witaTime;
                }
            }

            waktuInput.addEventListener("input", function(e) {
                this.value = this.value.replace(/[^\d:]/g, '').slice(0, 8); // hanya angka dan :
                updateTimeZones();
            });

            // Jalankan sinkronisasi awal saat halaman dimuat
            updateTimeZones();
        });
    </script>

    <script>
        $(document).ready(function() {
            const radio = $('#radio-dirasakan');
            const btnBatal = $('#btn-batal-dirasakan');

            // Munculkan tombol batal kalau radio dipilih
            radio.on('change', function() {
                if ($(this).is(':checked')) {
                    btnBatal.fadeIn();
                }
            });

            // Logika Batal (Kembali ke NULL)
            btnBatal.on('click', function() {
                radio.prop('checked', false); // Uncheck radio
                $(this).fadeOut(); // Sembunyikan tombol batal
            });
        });
    </script>
@endpush
