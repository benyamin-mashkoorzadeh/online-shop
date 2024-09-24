@extends('admin.layouts.master')

@section('head-tag')
    <title>فایلل های اطلاعیه ایمیلی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 active"> اطلاعیه ایمیلی</li>
            <li class="breadcrumb-item font-size-12 active"> فایل های اطلاعیه ایمیلی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>فایل های اطلاعیه ایمیلی</h5>
                </section>
                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.notify.email-file.create', $email->id) }}" class="btn btn-info btn-sm">ایجاد
                        فایل اطلاعیه ایمیلی</a>
                    <div class="max-width-16-rem fle">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان ایمیل</th>
                            <th>سایز فایل</th>
                            <th>نوع فایل</th>
                            <th>وضعیت</th>
                            <th class="width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($email->files as $key => $file)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $email->subject }}</td>
                                <td>{{ $file->$file_size }}</td>
                                <td>{{ $file->$file_type }}</td>
                                <td>
                                    <input type="checkbox" id="{{ $file->id }}"
                                           onchange="changeStatus({{ $file->id }})"
                                           @if ($file->status === 1) checked
                                           @endif data-url="{{ route('admin.notify.email-file.status', $file->id) }}">
                                </td>
                                <td class="max-width-16-rem text-left">
                                    <a href="{{ route('admin.notify.email-file.edit', $file->id) }}"
                                       class="btn btn-warning btn-sm text-white"><i
                                            class="fa fa-file"></i> فایل های ضمیمه شده</a>
                                    <a href="{{ route('admin.notify.email-file.edit', $email->id) }}"
                                       class="btn btn-info btn-sm"><i
                                            class="fa fa-eye"></i> ویرایش</a>
                                    <form class="d-inline"
                                          action="{{ route('admin.notify.email-file.destroy', $email->id) }}"
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
                            successToast('فایل ایمیل با موفقیت فعال شد')
                        } else {
                            element.prop('checked', false)
                            successToast('فایل ایمیل با موفقیت غیرفعال شد')
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

@endsection
