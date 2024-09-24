@extends('admin.layouts.master')

@section('head-tag')
    <title>اطلاعیه پیامکی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 active"> اطلاعیه پیامکی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>اطلاعیه پیامکی</h5>
                </section>
                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.notify.sms.create') }}" class="btn btn-info btn-sm">ایجاد اطلاعیه
                        پیامکی</a>
                    <div class="max-width-16-rem fle">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان اطلاعیه</th>
                            <th>متن پیامک</th>
                            <th>تاریخ ارسال</th>
                            <th>وضعیت</th>
                            <th class="width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sms as $key => $single_sms)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $single_sms->title }}</td>
                                <td>{{ $single_sms->body }}</td>
                                <td>{{ jalaliDate($single_sms->published_at, 'H:i:s Y-M-d') }}</td>
                                <td><input type="checkbox" id="{{ $single_sms->id }}"
                                           onchange="changeStatus({{ $single_sms->id }})"
                                           @if ($single_sms->status === 1) checked
                                           @endif data-url="{{ route('admin.notify.email.status', $single_sms->id) }}">
                                </td>
                                <td class="max-width-16-rem text-left">
                                    <a href="{{ route('admin.notify.sms.edit') }}" class="btn btn-info btn-sm"><i
                                            class="fa fa-eye"></i> ویرایش</a>
                                    <form class="d-inline"
                                          action="{{ route('admin.notify.sms.destroy', $sms->id) }}"
                                          method="post">
                                        @csrf
                                        {{ method_field('delete') }}

                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fa fa-trash-alt"></i>
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>

@endsection
@section('script')

    <script>
        function changeStatus(id) {
            let element = $('#' + id)
            let url = element.attr('data-url')
            let elementValue = !element.prop('checked')

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true)
                            successToast('پیامک با موفقیت فعال شد')
                        } else {
                            element.prop('checked', false)
                            successToast('پیامک با موفقیت غیرفعال شد')
                        }
                    } else {
                        element.prop('checked', elementValue)
                        errorToast('هنگام ویرایش مشکلی به وجود آمده است')
                    }
                },
                error: function () {
                    element.prop('checked', elementValue)
                    errorToast('ارتباط برقرار نشد')
                }
            })

            function successToast(message) {
                let successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>'

                $('.toast-wrapper').append(successToastTag)
                $('.toast').toast('show').delay('5500').queue(function () {
                    $(this).remove()
                });
            }

            function errorToast(message) {
                let errorToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>'

                $('.toast-wrapper').append(errorToastTag)
                $('.toast').toast('show').delay('5500').queue(function () {
                    $(this).remove()
                });
            }
        }
    </script>

    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection