@extends('admin.layouts.master')

@section('head-tag')
    <title>پیج ساز</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active"> پیج ساز</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>پیج ساز</h5>
                </section>
                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.page.create') }}" class="btn btn-info btn-sm">ایجاد پیج جدید</a>
                    <div class="max-width-16-rem fle">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>اسلاگ</th>
                            <th>تگ ها</th>
                            <th>وضعیت</th>
                            <th class="width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $key => $page)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>{{ $page->tags }}</td>
                                <td>
                                    <input type="checkbox" id="{{ $page->id }}"
                                           onchange="changeStatus({{ $page->id }})"
                                           @if ($page->status === 1) checked
                                           @endif data-url="{{ route('admin.content.page.status', $page->id) }}">
                                </td>

                                <td class="max-width-16-rem text-left">
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline"
                                          action="{{ route('admin.content.page.destroy', $page->id) }}"
                                          method="post">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i>
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
                            successToast('صفحه با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked', false)
                            successToast('صفحه با موفقیت غیرفعال شد')
                        }
                    }
                    else {
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
                    '<strong class="ml-auto">'+ message +'</strong>\n' +
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
                    '<strong class="ml-auto">'+ message +'</strong>\n' +
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
