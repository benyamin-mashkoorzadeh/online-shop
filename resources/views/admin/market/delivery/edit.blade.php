@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش روش ارسال</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">روش های ارسال</a></li>
            <li class="breadcrumb-item font-size-12 active"> ویرایش روش ارسال</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش روش ارسال</h5>
                </section>
                <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.delivery.update', $delivery->id) }}" method="post">
                        @csrf
                        ٬@method('put')

                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">نام روش ارسال
                                        @error('name')
                                        <span class="alert_required text-danger p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $delivery->name) }}" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="amount">هزینه روش ارسال
                                        @error('amount')
                                        <span class="alert_required text-danger p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" id="amount" name="amount" value="{{ old('amount', $delivery->amount) }}" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="delivery_time">زمان ارسال
                                        @error('delivery_time')
                                        <span class="alert_required text-danger p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" id="delivery_time" name="delivery_time" value="{{ old('delivery_time', $delivery->delivery_time) }}" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="delivery_time_unit">واحد زمان ارسال
                                        @error('delivery_time_unit')
                                        <span class="alert_required text-danger p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" id="delivery_time_unit" name="delivery_time_unit" value="{{ old('delivery_time_unit', $delivery->delivery_time_unit) }}" class="form-control form-control-sm">
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
