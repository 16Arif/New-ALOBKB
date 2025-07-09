@extends('layouts.app')

@section('title', 'Tambah Data Informasi Site InaTEWS')

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
                    <div class="breadcrumb-item"><a href="#">Kelola Data Site InaTEWS</a></div>
                    <div class="breadcrumb-item">Edit Data Informasi Site InaTEWS</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Informasi Site InaTEWS</h2>
                <div class="text-right mb-2">
                    {{-- <a href="{{ route('equipment_inatews.index') }}" style="color: white; text-decoration: none;">
                        <button class="btn btn-danger">Kembali</button>
                    </a> --}}
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row">
                                <h5>Edit Data</h5>
                            </div>
                        </div>
                        <form action="{{ route('inatewsinformation.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="lat" class="form-label">Latitude</label>
                                <input id="lat" type="text" name="lat"
                                    value="{{ old('lat', $inatewsinformation->lat) }}"
                                    class="form-control @error('lat') is-invalid @enderror">
                                @error('lat')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="long" class="form-label">Longitude</label>
                                <input id="long" type="text" name="long"
                                    value="{{ old('long', $inatewsinformation->long) }}"
                                    class="form-control @error('long') is-invalid @enderror">
                                @error('long')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="elevasi" class="form-label">Elevasi</label>
                                <input id="elevasi" type="text" name="elevasi"
                                    value="{{ old('elevasi', $inatewsinformation->elevasi) }}"
                                    class="form-control @error('elevasi') is-invalid @enderror">
                                @error('elevasi')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="th_install" class="form-label">Tahun Installasi</label>
                                <input id="th_install" type="date" name="th_install"
                                    value="{{ old('th_install', $inatewsinformation->th_install) }}"
                                    class="form-control @error('th_install') is-invalid @enderror">
                                @error('th_install')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat_site" class="form-label">Alamat Site</label>
                                <input id="alamat_site" type="text" name="alamat_site"
                                    value="{{ old('alamat_site', $inatewsinformation->alamat_site) }}"
                                    class="form-control @error('alamat_site') is-invalid @enderror">
                                @error('alamat_site')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kel_site" class="form-label">Keluharan Siite</label>
                                <input id="kel_site" type="text" name="kel_site"
                                    value="{{ old('kel_site', $inatewsinformation->kel_site) }}"
                                    class="form-control @error('kel_site') is-invalid @enderror">
                                @error('kel_site')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kec_site" class="form-label">Kecamatan Site</label>
                                <input id="kec_site" type="text" name="kec_site"
                                    value="{{ old('kec_site', $inatewsinformation->kec_site) }}"
                                    class="form-control @error('kec_site') is-invalid @enderror">
                                @error('kec_site')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kota" class="form-label">Kota Site</label>
                                <input id="kota" type="text" name="kota"
                                    value="{{ old('kota', $inatewsinformation->kota) }}"
                                    class="form-control @error('kota') is-invalid @enderror">
                                @error('kota')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="prov" class="form-label">Provinsi Site</label>
                                <input id="prov" type="text" name="prov"
                                    value="{{ old('prov', $inatewsinformation->prov) }}"
                                    class="form-control @error('prov') is-invalid @enderror">
                                @error('prov')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pic_site" class="form-label">Pic di Site</label>
                                <input id="pic_site" type="text" name="pic_site"
                                    value="{{ old('pic_site', $inatewsinformation->pic_site) }}"
                                    class="form-control @error('pic_site') is-invalid @enderror">
                                @error('pic_site')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kontak_pic" class="form-label">Kontak Pic</label>
                                <input id="kontak_pic" type="text" name="kontak_pic"
                                    value="{{ old('kontak_pic', $inatewsinformation->kontak_pic) }}"
                                    class="form-control @error('kontak_pic') is-invalid @enderror">
                                @error('kontak_pic')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="upt" class="form-label">UPT</label>
                                <input id="upt" type="text" name="upt"
                                    value="{{ old('upt', $inatewsinformation->upt) }}"
                                    class="form-control @error('upt') is-invalid @enderror">
                                @error('upt')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat_upt" class="form-label">Alamat UPT</label>
                                <input id="alamat_upt" type="text" name="alamat_upt"
                                    value="{{ old('alamat_upt', $inatewsinformation->alamat_upt) }}"
                                    class="form-control @error('alamat_upt') is-invalid @enderror">
                                @error('alamat_upt')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kel_upt" class="form-label">Kelurahan UPT</label>
                                <input id="kel_upt" type="text" name="kel_upt"
                                    value="{{ old('kel_upt', $inatewsinformation->kel_upt) }}"
                                    class="form-control @error('kel_upt') is-invalid @enderror">
                                @error('kel_upt')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kec_upt" class="form-label">Kecamatan UPT</label>
                                <input id="kec_upt" type="text" name="kec_upt"
                                    value="{{ old('kec_upt', $inatewsinformation->kec_upt) }}"
                                    class="form-control @error('kec_upt') is-invalid @enderror">
                                @error('kec_upt')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kota_upt" class="form-label">Kota UPT</label>
                                <input id="kota_upt" type="text" name="kota_upt"
                                    value="{{ old('kota_upt', $inatewsinformation->kota_upt) }}"
                                    class="form-control @error('kota_upt') is-invalid @enderror">
                                @error('kota_upt')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jab_pic_upt" class="form-label">Jabatan PIC UPT</label>
                                <input id="jab_pic_upt" type="text" name="jab_pic_upt"
                                    value="{{ old('jab_pic_upt', $inatewsinformation->jab_pic_upt) }}"
                                    class="form-control @error('jab_pic_upt') is-invalid @enderror">
                                @error('jab_pic_upt')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pic_upt" class="form-label">PIC UPT</label>
                                <input id="pic_upt" type="text" name="pic_upt"
                                    value="{{ old('pic_upt', $inatewsinformation->pic_upt) }}"
                                    class="form-control @error('pic_upt') is-invalid @enderror">
                                @error('pic_upt')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kontak_pic_upt" class="form-label">Kontak PIC UPT</label>
                                <input id="kontak_pic_upt" type="text" name="kontak_pic_upt"
                                    value="{{ old('kontak_pic_upt', $inatewsinformation->kontak_pic_upt) }}"
                                    class="form-control @error('kontak_pic_upt') is-invalid @enderror">
                                @error('kontak_pic_upt')
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
