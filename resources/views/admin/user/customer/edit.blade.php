@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش کاربر مشتری</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">کاربران ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active"> ویرایش کاربر مشتری</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش کاربر مشتری</h5>
                </section>
                <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.customer.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.customer.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

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
                                    <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" value="{{ old('first_name', $user->first_name) }}">
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
                                    <input type="text" name="last_name" id="last_name" class="form-control form-control-sm" value="{{ old('last_name', $user->last_name) }}">
                                </div>
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="profile_photo_path ">تصویر
                                        @error('profile_photo_path')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="file" name="profile_photo_path " id="profile_photo_path " class="form-control form-control-sm">
                                    <img class="mt-3" src="{{ asset($user->profile_photo_path) }}" alt="avatar" width="100" height="50">
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
