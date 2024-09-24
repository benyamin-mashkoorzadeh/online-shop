@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش نقش</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">نقش ها</a></li>
            <li class="breadcrumb-item font-size-12 active"> ویرایش نقش</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش نقش</h5>
                </section>
                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.role.update', $role->id) }}" method="post">
                        @method('put')
                        @csrf

                        <section class="row">
                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="name">عنوان نقش
                                        @error('name')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" id="description" name="name" class="form-control form-control-sm"
                                           value="{{ old('name', $role->name) }}">
                                </div>
                            </section>
                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="description">توضیح نقش
                                        @error('description')
                                        <span class="alert_required text-danger p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <input type="text" id="description" name="description" class="form-control form-control-sm"
                                           value="{{ old('description', $role->description) }}">
                                </div>
                            </section>
                            <section class="col-12 col-md-2 mt-4">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>

                            <section class="col-12">
                                <section class="row border-top mt-3 py-3">
                                    @php
                                        $rolePermissionArray = $role->permissions->pluck('id')->toArray();
                                    @endphp
                                    @foreach($permissions as $key => $permission)
                                        <section class="col-md-3">
                                            <div class="form-check">
                                                    <input type="checkbox" name="permissions[]"
                                                           id="{{ $permission->id }}"
                                                           class="form-check-input" value="{{ $permission->id }}"
                                                           @if (in_array($permission->id, $rolePermissionArray)) checked @endif>

                                                    <label class="form-check-label mr-3 mt-1"
                                                           for="{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>

                                            <div class="mt-2">
                                                @error('$permissions.' . $key)
                                                <span class="alert_required bg-danger text-white p-1 rounded"
                                                      role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                                @enderror
                                            </div>

                                        </section>
                                    @endforeach
                                </section>
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>

@endsection
