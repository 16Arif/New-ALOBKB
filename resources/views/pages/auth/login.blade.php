@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                        name="username" tabindex="1" required autofocus>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                        <div class="float-right">
                            <a href="{{ route('password.request') }}" class="text-small">
                                Forgot Password?
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror " name="password" required>
                        </div>
                        <span class="input-group-text fas fa-eye" id="togglePassword"></span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Login
                    </button>
                </div>
            </form>

        </div>
    </div>
    <div class="text-muted mt-5 text-center">
        Don't have an account? <a href="{{ route('register') }}">Create One</a>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle tipe input antara 'password' dan 'text'
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // ubah ikon mata untuk menunjukkan apakah sedang menampilkan atau menyembunyikan password
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    <!-- Page Specific JS File -->
@endpush
