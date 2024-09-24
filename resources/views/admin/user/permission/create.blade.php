@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد دسترسی جدید</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">نقش ها</a></li>
            <li class="breadcrumb-item font-size-12 active"> ایجاد دسترسی جدید</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد دسترسی جدید</h5>
                </section>
                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.permission.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.permission.store') }}" method="post">
                        @csrf

                        <section class="row">
                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="name">عنوان دسترسی
                                        @error('name')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" name="name" class="form-control form-control-sm"
                                           value="{{ old('name') }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="description">توضیح دسترسی
                                        @error('description')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" id="description" name="description"
                                           class="form-control form-control-sm" value="{{ old('description') }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-2 mt-4">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>

@endsection
