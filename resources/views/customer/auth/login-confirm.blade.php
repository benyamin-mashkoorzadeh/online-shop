@extends('customer.layouts.master-simple');

@section('head-tag')
    <style>
        #resend_otp {
            font-size: 1rem;
        }
    </style>
@endsection


@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <form action="{{ route('auth.customer.login-confirm', $token) }}" method="post">
            @csrf

            <section class="login-wrapper mb-5">
                <section class="login-logo">
                    <img src="{{ asset('customer-assets/images/logo/4.png') }}" alt="logo">
                </section>
                <section class="login-title mb-2">
                    <a href="{{ route('auth.customer.login-register-form') }}">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </section>
                <section class="login-title">
                    کد تأیید را وارد نمایید
                </section>
                @if($otp->type == 0)
                    <section class="login-info">
                        کد تأیید برای شماره موبایل {{ $otp->login_id }} ارسال شد
                    </section>
                @else
                    <section class="login-info">
                        کد تأیید برای ایمیل {{ $otp->login_id }} ارسال شد
                    </section>
                @endif
                <section class="login-input-text">
                    <input type="text" name="otp" id="otp" value="{{ old('otp') }}">
                    @error('otp')
                    <span class="alert_required text-danger p-1" role="alert">
                        <strong>
                            {{ $message }}
                        </strong>
                    </span>
                    @enderror
                </section>
                <section class="login-btn d-grid g-2">
                    <button class="btn btn-danger">تأیید</button>
                </section>

                <section id="resend_otp" class="d-none">
                    <a href="{{ route('auth.customer.login-resend-otp', $token) }}" class="text-decoration-none text-primary">دریافت
                        مجدد کد تأیید</a>
                </section>

                <section id="timer"></section>

            </section>
        </form>
    </section>
@endsection

@section('script')
    @php
        $timer = ((new \Carbon\Carbon($otp->created_at))->addMinute(5)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000;
    @endphp

    <script>
        let countDownDate = new Date().getTime() + {{ $timer }};
        let timer = $('#timer');
        let resend_otp = $('#resend_otp');

        let x = setInterval(function () {
            let now = new Date().getTime()
            let distance = countDownDate - now

            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
            let seconds = Math.floor((distance % (1000 * 60)) / (1000))

            if(minutes == 0) {
                timer.html('ارسال مجدد کد تأیید تا ' + seconds + 'ثانیه دیگر ')
            }
            else {
                timer.html('ارسال مجدد کد تأیید تا ' + minutes + ' دقیقه و ' + seconds + ' دیگر')
            }

            if(distance < 0) {
                clearInterval(x);
                timer.addClass('d-none')
                resend_otp.removeClass('d-none')
            }
        }, 1000)

    </script>
@endsection
