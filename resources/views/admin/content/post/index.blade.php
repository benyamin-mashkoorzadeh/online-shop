@extends('admin.layouts.master')

@section('head-tag')
    <title>پست ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active"> پست ها</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>پست ها</h5>
                </section>
                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.post.create') }}" class="btn btn-info btn-sm">ایجاد پست جدید</a>
                    <div class="max-width-16-rem fle">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان پست</th>
                            <th>دسته</th>
                            <th>تصویر</th>
                            <th>وضعیت</th>
                            <th class="width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $key => $post)
                            <tr>
                                <th>{{ $key += 1 }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->name }}</td>
                                <td><img src="{{ asset($post->image['indexArray'][$post->image['currentImage']])  }}"
                                         alt="avatar" width="50" height="50"></td>
                                <td>
                                    <input type="checkbox" id="{{ $post->id }}" onchange="changeStatus({{ $post->id }})"
                                           @if ($post->status === 1) checked
                                           @endif data-url="{{ route('admin.content.post.status', $post->id) }}">
                                </td>
                                <td>
                                    <input type="checkbox" id="{{ $post->id }}-commentable"
                                           onchange="changeStatus({{ $post->id }})"
                                           @if ($post->commentable === 1) checked
                                           @endif data-url="{{ route('admin.content.post.commentable', $post->id) }}">
                                </td>
                                <td class="max-width-16-rem text-left">
                                    <a href="{{ route('admin.content.post.edit') }}" class="btn btn-primary btn-sm"><i
                                            class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline"
                                          action="{{ route('admin.content.category.destroy', $postCategory->id) }}"
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
                            successToast('پست با موفقیت فعال شد')
                        } else {
                            element.prop('checked', false)
                            successToast('پست با موفقیت غیرفعال شد')
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

    <script>
        function changeStatus(id) {
            let element = $('#' + id + '-commentable')
            let url = element.attr('data-url')
            let elementValue = !element.prop('checked')

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    if (response.commentable) {
                        if (response.commentable) {
                            element.prop('checked', true)
                            successToast('امکان درج کامنت با موفقیت فعال شد')
                        } else {
                            element.prop('checked', false)
                            successToast('امکان درج کامنت با موفقیت غیرفعال شد')
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
