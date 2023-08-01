@extends('layouts.auth')


@section('title')
    {{ localize('Login') }}
@endsection


@section('contents')
    <section class="login-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-12 tt-login-img"
                    data-background="{{ staticAsset('frontend/default/assets/img/banner/login-banner.jpg') }}"></div>
                <div class="col-lg-5 col-12 bg-white d-flex p-0 tt-login-col shadow">
                    <form class="tt-login-form-wrap p-3 p-md-6 p-lg-6 py-7 w-100" action="{{ route('login') }}" method="POST"
                        id="login-form">
                        @csrf
                        <div class="mb-7">
                            <a href="{{ route('home') }}">
                                <img src="{{ uploadedAsset(getSetting('navbar_logo')) }}" alt="logo">
                            </a>
                        </div>
                        <h2 class="mb-4 h3">{{ localize('Hey there!') }}
                            <br>{{ localize('Welcome back to herbal.') }}
                        </h2>

                        <div class="row g-3">
                            <div class="col-sm-12">
                                <div class="input-field">
                                    <input type="hidden" name="login_with" class="login_with" value="phone">

                                    <span class="login-email">
                                        <label class="fw-bold text-dark fs-sm mb-1">{{ localize('Email') }}</label>
                                        <input type="email" id="email" name="email"
                                            placeholder="{{ localize('Enter your email') }}" class="theme-input mb-1"
                                            value="{{ old('email') }}" >
                                    </span>


                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-field check-password">
                                    <label class="fw-bold text-dark fs-sm mb-1">{{ localize('Password') }}</label>
                                    <div class="check-password">
                                        <input type="password" name="password" id="password"
                                            placeholder="{{ localize('Password') }}" class="theme-input" required>
                                        <span class="eye eye-icon"><i class="fa-solid fa-eye"></i></span>
                                        <span class="eye eye-slash"><i class="fa-solid fa-eye-slash"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-4">
                            <div class="checkbox d-inline-flex align-items-center gap-2">
                                <div class="theme-checkbox flex-shrink-0">
                                    <input type="checkbox" id="save-password">
                                    <span class="checkbox-field"><i class="fa-solid fa-check"></i></span>
                                </div>
                                <label for="save-password" class="fs-sm"> {{ localize('Remember me') }}</label>
                            </div>
                        </div>


                        <div class="row g-4 mt-3">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary w-100 sign-in-btn"
                                    onclick="handleSubmit()">{{ localize('Sign In') }}</button>
                            </div>

                        </div>

                        <div class="row g-4 mt-3">
                        </div>
                        <p class="mb-0 fs-xs mt-3">{{ localize("Don't have an Account?") }} <a
                                href="{{ route('register') }}">{{ localize('Sign Up') }}</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        "use strict";

        // copyAdmin
        function copyAdmin() {
            $('#email').val('admin@themetags.com');
            $('#password').val('123456');
        }

        // copyCustomer
        function copyCustomer() {
            $('#email').val('customer@themetags.com');
            $('#password').val('123456');
        }

        // change input to phone
        function handleLoginWithPhone() {
            $('.login_with').val('phone');

            $('.login-email').addClass('d-none');
            $('.login-email input').prop('required', false);

            $('.login-phone').removeClass('d-none');
            $('.login-phone input').prop('required', true);
        }

        // change input to email
        function handleLoginWithEmail() {
            $('.login_with').val('email');
            $('.login-email').removeClass('d-none');
            $('.login-email input').prop('required', true);

            $('.login-phone').addClass('d-none');
            $('.login-phone input').prop('required', false);
        }


        // disable login button
        function handleSubmit() {
            $('#login-form').on('submit', function(e) {
                $('.sign-in-btn').prop('disabled', true);
            });
        }

        function SendOtp(){
            var phone = $('#phone').val();

            $.ajax({
                url: "{{ route('sendotp.phone') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: 'GET',
                data: { phone: phone },
                dataType: 'JSON',
                success: function (res) {
                }
            });
        }
        
        function VerifyOtpConfirmation(){
            var phone = $('#phone').val();
            var verification_code = $('#verification_code').val();

            $.ajax({
                url: "{{ route('phone.verification.confirmation') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: 'post',
                data: { phone: phone, verification_code: verification_code},
                dataType: 'JSON',
                success: function (res) {
                    location.reload();
                }
            });
        }
    </script>
@endsection
