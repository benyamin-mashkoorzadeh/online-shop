@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش کوپن تخفیف</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کوپن تخفیف</a></li>
            <li class="breadcrumb-item font-size-12 active"> ویرایش کوپن تخفیف</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش کوپن تخفیف</h5>
                </section>
                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.copan') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.copan.update', $copan->id) }}" method="post">
                        @csrf
                        @method('put')

                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="code">کد کوپن
                                        @error('code')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror</label>
                                    <input type="text" name="code" id="code" value="{{ old('code', $copan->code) }}"
                                           class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="type">نوع کوپن</label>
                                    <select name="type" id="type"
                                            data-url="{{ route('admin.market.discount.copan.private') }}"
                                            class="form-control form-control-sm">
                                        <option @if(old('type', $copan->type) == 0) selected @endif value="0">عمومی</option>
                                        <option @if(old('type', $copan->type) == 1) selected @endif value="1">خصوصی</option>
                                    </select>
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="amount_type">نوع تخفیف</label>
                                    <select name="amount_type" id="amount_type" class="form-control form-control-sm">
                                        <option @if(old('amount_type', $copan->amount_type) == 0) selected @endif value="0">درصدی</option>
                                        <option @if(old('amount_type', $copan->amount_type) == 1) selected @endif value="1">عددی</option>
                                    </select>
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="amount">میزان تخفیف</label>
                                    <input type="text" id="amount" name="amount" value="{{ old('amount', $copan->amount) }}"
                                           class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="discount_ceiling">حداکثر تخفیف</label>
                                    <input type="text" name="discount_ceiling" id="discount_ceiling"
                                           value="{{ old('discount_ceiling', $copan->discount_ceiling) }}" class="form-control form-control-sm">
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
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="0" @if(old('status', $copan->status) == 0) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('status', $copan->status) == 1) selected @endif>فعال</option>
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

    <script>

        let url = $('#type').attr('data-url')


        $('#type').change(function () {
            if ($('#type').find(':selected').val() == '1') {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        if (response.status) {
                            let data = ''
                            let section = $('#type').parent().parent()[0]
                            data = '<section class="col-12 col-md-6">' +
                                '<div class="form-group">' +
                                '<label for="user_id">کاربران</label>' +
                                '<select name="user_id" id="user_id" class="form-control form-control-sm">'


                            response.users.map((user) => {
                                data += `<option value="${user.id}">${user.first_name + ' ' + user.last_name}</option>`
                            })


                            data += '</select>' +
                            '</div>' +
                            '</section>'

                            $(data).insertAfter(section)
                        }
                    }
                })
            }
            else {
                let section = $('#user_id').parent().parent()[0]
                section.remove()
            }
        })

        function users(user) {
            let data = '<section class="col-12 col-md-6">' +
                '<div class="form-group">' +
                '<label for="user_id">کاربران</label>' +
                '<select name="user_id" id="user_id" class="form-control form-control-sm">' +
                '<option></option>' +
                '</select>' +
                '</div>' +
                '</section>'
        }

    </script>
@endsection
