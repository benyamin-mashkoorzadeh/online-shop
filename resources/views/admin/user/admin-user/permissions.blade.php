@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد سطح دسترسی ادمین</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کاربران ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active"> ایجاد سطح دسترسی ادمین</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد سطح دسترسی ادمین</h5>
                </section>
                <section
                        class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.admin-user.permissions.store', $admin) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf

                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="permissions">سطح دسترسی ها
                                        @error('first_name')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <select class="select2 form-control form-control-sm" name="permissions[]"
                                            id="select_permissions" multiple>
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->id }}" @foreach($admin->permissions as $user_permission)
                                                @if($user_permission->id === $permission->id) selected @endif
                                                    @endforeach>{{ $permission->name }}</option>
                                        @endforeach
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
    <script>
        let select_roles = $('#select_permissions')
        select_roles.select2({
            placeholder: 'لطفأ دسترسی ها را وارد نمایید',
            multiple: true,
            tags: true
        })
    </script>
@endsection
