@extends('admin.layouts.master')

@section('head-tag')
    <title>تنظیمات</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">تنظیمات</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">ویرایش تنظیمات</a></li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش تنظیمات</h5>
                </section>
                <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.setting.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.setting.update', $setting->id) }}" method="post" enctype="multipart/form-data">

                        @csrf
                        {{ method_field('put') }}

                        <section class="row">
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="title">عنوان سایت
                                        @error('title')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" id="title" name="title" class="form-control form-control-sm" value="{{ old('title', $setting->title) }}">
                                </div>
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="description">توضیحات سایت
                                        @error('description')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" id="description" name="description" class="form-control form-control-sm" value="{{ old('description', $setting->description) }}">
                                </div>
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="keywords">کلمات کلیدی سایت
                                        @error('description')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" id="keywords" name="keywords" class="form-control form-control-sm" value="{{ old('keywords', $setting->keywords) }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="logo">لوگو سایت
                                        @error('logo')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="file" class="form-control form-control-sm" id="logo" name="logo">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="icon">آیکون سایت
                                        @error('icon')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="file" class="form-control form-control-sm" id="icon" name="icon">
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
