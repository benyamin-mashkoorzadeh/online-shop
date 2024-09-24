@extends('admin.layouts.master')

@section('head-tag')
    <title>اضافه کردن به انبار</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">انبار</a></li>
            <li class="breadcrumb-item font-size-12 active"> اضافه کردن به انبار</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>اضافه کردن به انبار</h5>
                </section>
                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.store.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.store.store', $product->id) }}" method="post">
                        @csrf

                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="receiver">نام تحویل گیرنده
                                        @error('receiver')
                                        <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" name="receiver" id="receiver"
                                           class="form-control form-control-sm" value="{{ old('receiver') }}">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="deliverer">نام تحویل دهنده
                                        @error('deliverer')
                                        <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" name="deliverer" id="deliverer" class="form-control form-control-sm"
                                           value="{{ old('deliverer') }}">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="marketable_number">تعداد
                                        @error('marketable_number')
                                        <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" name="marketable_number" id="marketable_number"
                                           class="form-control form-control-sm" value="{{ old('marketable_number') }}">
                                </div>
                            </section>
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="description">توضیحات
                                        @error('description')
                                        <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <textarea id="description" name="description" class="form-control form-control-sm"
                                              rows="4">
                                        {{ old('description') }}
                                    </textarea>
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
