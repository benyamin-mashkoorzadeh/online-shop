@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active"> نظرات</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نظرات</h5>
                </section>
                <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد نظر جدید</a>
                    <div class="max-width-16-rem fle">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نویسنده نظر</th>
                                <th>کد کاربر</th>
                                <th>نظر</th>
                                <th>پاسخ به</th>
                                <th>کد پست</th>
                                <th>پست</th>
                                <th>وضعیت تأیید</th>
                                <th>وضعیت کامنت</th>
                                <th class="width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $key => $comment)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $comment->author_id }}</td>
                                <td>{{ $comment->user->fullName }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($comment->body) }}</td>
                                <td>{{ $comment->parent_id ? \Illuminate\Support\Str::limit($comment->parent->body) : '' }}</td>
                                <td>{{ $comment->commentable_id }}</td>
                                <td>{{ $comment->commentable->title }}</td>
                                <td>{{ $comment->approved == 1 ? 'تأیید شده' : 'تأیید نشده'}}</td>
                                <td>
                                    <input type="checkbox" id="{{ $comment->id }}"
                                           onchange="changeStatus({{ $comment->id }})"
                                           @if ($comment->status === 1) checked
                                           @endif data-url="{{ route('admin.market.comment.status', $comment->id) }}">
                                </td>
                                <td class="max-width-16-rem text-left">
                                    <a href="{{ route('admin.market.comment.show', $comment->id) }}" class="btn btn-info btn-sm"><i
                                            class="fa fa-eye"></i> نمایش</a>

                                    @if($comment->approved == 1)
                                        <a href="{{ route('admin.market.comment.approved', $comment->id) }}" type="submit" class="btn btn-warning btn-sm text-white"><i class="fa fa-clock"></i>
                                            عدم تایید
                                        </a>
                                    @else
                                        <a href="{{ route('admin.market.comment.approved', $comment->id) }}" type="submit" class="btn btn-success btn-sm text-white"><i class="fa fa-check"></i>
                                            تایید
                                        </a>
                                    @endif
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
                            successToast('نظر با موفقیت فعال شد')
                        } else {
                            element.prop('checked', false)
                            successToast('نظر با موفقیت غیرفعال شد')
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
