@extends('admin.layouts.master')

@section('head-tag')
    <title>گالری</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کالاها</a></li>
            <li class="breadcrumb-item font-size-12 active"> رنگ کالا</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>گالری</h5>
                </section>

                @include('admin.alerts.alert-section.success')

                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <div>
                        <a href="{{ route('admin.market.gallery.create', $product->id) }}" class="btn btn-info btn-sm">ایجاد
                            عکس جدید</a>
                        <a href="{{ route('admin.market.product.index') }}" class="btn btn-danger btn-sm">بازگشت</a>
                    </div>
                    <div class="max-width-16-rem fle">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کالا</th>
                            <th>تصویر کالا</th>
                            <th class="width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->images as $image)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <img src="{{ asset($image->image['indexArray'][$image->image['currentImage']]) }}" alt="" width="100" height="50">
                                </td>
                                <td class="max-width-16-rem text-center">
                                    <form class="d-inline"
                                          action="{{ route('admin.market.gallery.destroy', ['product' => $product->id, 'gallery' => $image->id]) }}"
                                          method="post">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-danger btn-sm delete">
                                            <i class="fa fa-window-close"></i> حذف
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

    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
