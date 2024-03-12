@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Hi, {{ $user->name }} </h2>
                <p class="section-lead">
                    Change information about yourself on this page.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-16 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <a href="{{ route('imageprofile.edit', ['imageprofile' => auth()->user()->id]) }}"
                                    title="Edit Foto Profile">
                                    @if ($user->image)
                                        <div style="max-width: 180px; max-height: 180px;">
                                            <img src="{{ asset('storage/' . $user->image) }}"
                                                class="img-fluid img-thumbnail rounded" alt="bg-card"
                                                title="{{ $user->name }}">
                                        </div>
                                    @else
                                        <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}"
                                            class="img-fluid profile-widget-picture" style="width: 400px">
                                    @endif
                                </a>
                            </div>

                            <div class="profile-widget-description">
                                <div class="profile-widget-name">{{ old('name') ?? $user->name }} <div
                                        class="text-muted d-inline font-weight-normal">
                                    </div>
                                </div>
                                <hr>
                                {{-- <a href=""><button class="btn btn-outline-secondary">Ubah Password</button></a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form action="{{ route('profile.update', auth()->user()) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>User Data</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ $user->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            name="username" value="{{ $user->username }}">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ $user->email }}">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" value="{{ $user->phone }}">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Submit</button>
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
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
@endpush
