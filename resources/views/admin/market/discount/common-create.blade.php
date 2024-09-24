@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد تخفیف عمومی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">تخفیف عمومی</a></li>
            <li class="breadcrumb-item font-size-12 active"> ایجاد تخفیف عمومی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد تخفیف عمومی</h5>
                </section>
                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.commonDiscount') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.commonDiscount.store') }}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="percentage">درصد تخفیف
                                        @error('percentage')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" name="percentage" id="percentage"
                                           class="form-control form-control-sm" value="{{ old('percentage') }}">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="discount_ceiling">حداکثر تخفیف
                                        @error('discount_ceiling')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" name="discount_ceiling" id="discount_ceiling"
                                           class="form-control form-control-sm" value="{{ old('discount_ceiling') }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="minimal_order_amount">حداقل مبلغ خرید
                                        @error('minimal_order_amount')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" id="minimal_order_amount" name="minimal_order_amount"
                                           value="{{ old('minimal_order_amount') }}"
                                           class="form-control form-control-sm">
                                </div>
                            </section>


                                <section class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="title">عنوان مناسبت
                                            @error('title')
                                            <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                            @enderror
                                        </label>
                                        <input type="text" id="title" name="title"
                                               class="form-control form-control-sm"
                                               value="{{ old('title') }}">
                                    </div>
                                </section>

                                <section class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">تاریخ شروع</label>
                                        <input type="text" name="start_date" id="start_date"
                                               class="form-control form-control-sm d-none">
                                        <input type="text" id="start_date_view" class="form-control form-control-sm">
                                    </div>
                                </section>

                                <section class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">تاریخ پایان</label>
                                        <input type="text" name="end_date" id="end_date"
                                               class="form-control form-control-sm d-none">
                                        <input type="text" id="end_date_view" class="form-control form-control-sm">
                                    </div>
                                </section>

                                <section class="col-12">
                                    <div class="form-group">
                                        <label for="status">وضعیت</label>
                                        <select name="status" id="status" class="form-control form-control-sm">
                                            <option value="0" @if(old('status') == 0) selected @endif>غیر فعال</option>
                                            <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
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
@section('script')
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_date'
            })

            $('#end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_date'
            })
        })
    </script>
@endsection
