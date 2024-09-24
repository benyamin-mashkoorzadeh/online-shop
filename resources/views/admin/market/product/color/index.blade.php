@extends('admin.layouts.master')

@section('head-tag')
    <title>رنگ کالا</title>
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
                    <h5>رنگ کالا</h5>
                </section>

                @include('admin.alerts.alert-section.success')

                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <div>
                        <a href="{{ route('admin.market.color.create', $product->id) }}" class="btn btn-info btn-sm">ایجاد
                            رنگ جدید</a>
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
                            <th>رنگ کالا</th>
                            <th>افزایش قیمت</th>
                            <th class="width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->colors as $color)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $color->color_name }}</td>
                                <td>{{ $color->price_increase }}</td>
                                <td class="max-width-16-rem text-center">
                                    <form class="d-inline"
                                          action="{{ route('admin.market.color.destroy', ['product' => $product->id, 'color' => $color->id]) }}"
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