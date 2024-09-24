@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد کاربر مشتری</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">کاربران مشتری</a></li>
            <li class="breadcrumb-item font-size-12 active"> ایجاد کاربر مشتری</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد کاربر مشتری</h5>
                </section>
                <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.customer.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.customer.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="first_name">نام
                                        @error('first_name')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" value="{{ old('first_name') }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="last_name">نام خانوادگی
                                        @error('last_name')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" name="last_name" id="last_name" class="form-control form-control-sm" value="{{ old('last_name') }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="email">ایمیل
                                        @error('email')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" name="email" id="email" class="form-control form-control-sm" value="{{ old('email') }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="mobile">شماره موبایل
                                        @error('mobile')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" name="mobile" id="mobile" class="form-control form-control-sm" value="{{ old('mobile') }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="password">کلمه عبور
                                        @error('password')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="password" name="password" id="password" class="form-control form-control-sm" value="{{ old('password') }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">تکرار کلمه عبور
                                        @error('password_confirmation')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm" value="{{ old('password_confirmation') }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="profile_photo_path ">تصویر
                                        @error('profile_photo_path ')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="file" name="profile_photo_path " id="profile_photo_path " class="form-control form-control-sm">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="activation">وضعیت فعال سازی</label>
                                    <select name="activation" id="activation" class="form-control form-control-sm">
                                        <option value="0" @if(old('activation') == 0) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('activation') == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                            </section>

                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>

                    </form>
                </section>
            </section>
        </section>
    </section>

@endsection
