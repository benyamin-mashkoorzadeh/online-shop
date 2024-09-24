@extends('admin.layouts.master')

@section('head-tag')
    <title>کاربران ادمین</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active"> کاربران ادمین</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>کاربران ادمین</h5>
                </section>
                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.admin-user.create') }}" class="btn btn-info btn-sm">ایجاد ادمین
                        جدید</a>
                    <div class="max-width-16-rem fle">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ایمیل</th>
                            <th>شماره موبایل</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>فعال سازی</th>
                            <th>وضعیت</th>
                            <th>نقش</th>
                            <th>سطوح دسترسی</th>
                            <th class="width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($admins as $key => $admin)
                            <tr>
                                <th>{{ $key }}</th>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->mobile }}</td>
                                <td>{{ $admin->first_name }}</td>
                                <td>{{ $admin->last_name }}</td>
                                <td>
                                    <input type="checkbox" id="{{ $admin->id }}-active"
                                           onchange="changeActive({{ $admin->id }})"
                                           @if ($admin->activation === 1) checked
                                           @endif data-url="{{ route('admin.user.admin-user.activation', $admin->id) }}">
                                </td>
                                <td>
                                    <input type="checkbox" id="{{ $admin->id }}"
                                           onchange="changeStatus({{ $admin->id }})"
                                           @if ($admin->status === 1) checked
                                           @endif data-url="{{ route('admin.user.admin-user.status', $admin->id) }}">
                                </td>
                                <td>
                                    @forelse($admin->roles as $role)
                                        <div>
                                            {{ $role->name }}
                                        </div>
                                    @empty
                                        <div class="text-danger">
                                            نقشی یافت نشد
                                        </div>
                                    @endforelse


                                </td>
                                <td>
                                    @forelse($admin->permissions as $permission)
                                        <div>
                                            {{ $permission->name }}
                                        </div>
                                    @empty
                                        <div class="text-danger">
                                            نقشی یافت نشد
                                        </div>
                                    @endforelse


                                </td>
                                <td class="width-22-rem text-left">
                                    <a href="{{ route('admin.user.admin-user.roles', $admin->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-user-shield"></i></a>
                                    <a href="{{ route('admin.user.admin-user.permissions', $admin->id) }}" class="btn btn-info btn-sm"><i class="fa fa-user-check"></i></a>
                                    <a href="{{ route('admin.user.admin-user.edit', $admin->id) }}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <form class="d-inline"
                                          action="{{ route('admin.user.customer.destroy', $admin->id) }}"
                                          method="post">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fa fa-trash-alt"></i></button>
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
                            successToast('ادمین با موفقیت فعال شد')
                        } else {
                            element.prop('checked', false)
                            successToast('ادمین با موفقیت غیرفعال شد')
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
        function changeActive(id) {
            let element = $('#' + id + '-active')
            let url = element.attr('data-url')
            let elementValue = !element.prop('checked')

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true)
                            successToast('فعال سازی ادمین با موفقیت فعال شد')
                        } else {
                            element.prop('checked', false)
                            successToast('فعال سازی ادمین با موفقیت غیرفعال شد')
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