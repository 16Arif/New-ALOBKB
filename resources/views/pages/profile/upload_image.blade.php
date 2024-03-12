@extends('layouts.app')

@section('title', 'Profile Image')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/dropzone/dist/dropzone.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Stasiun Geofisika Balikpapan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Profile</a></div>
                    <div class="breadcrumb-item">Profile Image</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Profile Image</h2>
                <div class="row">
                    <div class="col-8 ">
                        <div class="card">
                            <div class="card-header">
                                <h4>Photo Profile</h4>
                            </div>
                            <div class="card-body ">
                                <div class="row mb-5 ml-3">
                                    @if ($user->image)
                                        <div style="width: 140px; height: 140px;">
                                            <img src="{{ asset('storage/' . $user->image) }}"
                                                class="img-fluid img-thumbnail rounded" alt="bg-card"
                                                title="{{ $user->name }}">
                                        </div>
                                    @else
                                        <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}"
                                            class="img-fluid profile-widget-picture" style="width: 400px">
                                    @endif
                                </div>
                                <br>
                                <hr>
                                <div class="row text-start d-flex justify-content-start align-items-start  ml-2">
                                    <form action="{{ route('imageprofile.update', auth()->user()) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3 col-lg-12 ">
                                            <p>Update Profile</p>
                                            <input type="hidden" name="oldImage" value="{{ $user->image }}">
                                            <img class="img-preview img-fluid col-sm-3 mb-2" alt="img-preview">
                                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                                id="image" name="image" onchange="previewImage()">
                                            @error('image')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="card-footer text-start">
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/dropzone/dist/min/dropzone.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-multiple-upload.js') }}"></script>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block'

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(OFREvent) {
                imgPreview.src = OFREvent.target.result;
            }
        }
    </script>
@endpush
