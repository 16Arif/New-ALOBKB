@extends('layouts.auth')

@section('title', 'Reset Password')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Reset Password</h4>
        </div>

        <div class="card-body">
            <p class="text-muted">We will send a link to reset your password</p>
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ request()->email }}"
                        readonly>
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <div class="row">
                        <div class="col-10">
                            <input id="password" type="password"
                                class="form-control pwstrength @error('password') is-invalid @enderror"
                                data-indicator="pwindicator" name="password">
                        </div>
                        <span class="input-group-text fas fa-eye" id="togglePassword"></span>
                    </div>
                    <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-group">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                        <div class="input-group-append">
                            <span class="input-group-text fas fa-eye" id="togglePassword_confirmation"></span>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="token" value="{{ request()->route('token') }}">


                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>

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
    <script>
        const togglePasswordConfirmation = document.querySelector('#togglePassword_confirmation');
        const passwordConfirmation = document.querySelector('#password_confirmation');

        togglePasswordConfirmation.addEventListener('click', function(e) {
            // toggle tipe input antara 'password' dan 'text'
            const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmation.setAttribute('type', type);
            // ubah ikon mata untuk menunjukkan apakah sedang menampilkan atau menyembunyikan password
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endpush
