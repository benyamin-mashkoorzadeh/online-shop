@extends('customer.layouts.master-two-col')


@section('head-tag')
    <title>صفحه ی پرداخت</title>
@endsection

@section('content')
    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>انتخاب نوع پرداخت </span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        @if(session('copan'))
                            <div class="alert alert-success">
                                {{ session('copan') }}
                            </div>
                        @endif
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <section class="col-md-9">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            کد تخفیف
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>

                                <section class="payment-alert alert alert-primary d-flex align-items-center p-2"
                                         role="alert">
                                    <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                    <secrion>
                                        کد تخفیف خود را در این بخش وارد کنید.
                                    </secrion>
                                </section>

                                <section class="row">
                                    <section class="col-md-5">
                                        <form action="{{ route('customer.sales-process.copan-discount') }}"
                                              method="post">
                                            @csrf
                                            <section class="input-group input-group-sm">

                                                <input type="text" name="copan" id="copan" class="form-control"
                                                       placeholder="کد تخفیف را وارد کنید"/>
                                                <button class="btn btn-primary" type="submit">اعمال کد</button>
                                            </section>
                                        </form>
                                    </section>

                                </section>
                            </section>


                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            انتخاب نوع پرداخت
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="payment-select">

                                    <section class="payment-alert alert alert-primary d-flex align-items-center p-2"
                                             role="alert">
                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                        <secrion>
                                            برای پیشگیری از انتقال ویروس کرونا پیشنهاد می کنیم روش پرداخت اینترنتی رو
                                            پرداخت کنید.
                                        </secrion>
                                    </section>

                                    <form action="{{ route('customer.sales-process.payment-submit') }}" method="post"
                                          id="payment_submit">
                                        @csrf

                                        <input type="radio" name="payment_type" value="1" id="d1"/>
                                        <label for="d1" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-credit-card mx-1"></i>
                                                پرداخت آنلاین
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                درگاه پرداخت زرین پال
                                            </section>
                                        </label>

                                        <section class="mb-2"></section>

                                        <input type="radio" name="payment_type" value="2" id="d2"/>
                                        <label for="d2" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-id-card-alt mx-1"></i>
                                                پرداخت آفلاین
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                حداکثر در 2 روز کاری بررسی می شود
                                            </section>
                                        </label>

                                        <section class="mb-2"></section>

                                        <input type="radio" name="payment_type" value="3" id="cash_payment"/>
                                        <label for="cash_payment" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-money-check mx-1"></i>
                                                پرداخت در محل
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                پرداخت به پیک هنگام دریافت کالا
                                            </section>
                                        </label>

                                    </form>

                                </section>
                            </section>


                        </section>
                        <section class="col-md-3">
                            @php
                                $totalProductPrice = 0;
                                $totalDiscount = 0;
                            @endphp

                            @foreach($cartItems as $cartItem)
                                @php
                                    $totalProductPrice += $cartItem->cartItemProductPrice() * $cartItem->number;
                                    $totalDiscount += $cartItem->cartItemProductDiscount() * $cartItem->number;
                                @endphp
                            @endforeach
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالاها
                                        ({{ convertEnglishToPersian($cartItems->count()) }})</p>
                                    <p class="text-muted">{{ priceFormat($totalProductPrice) }} تومان</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">تخفیف کالاها</p>
                                    <p class="text-danger fw-bolder">{{ priceFormat($totalDiscount) }} تومان</p>
                                </section>

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder">{{ priceFormat($totalProductPrice - $totalDiscount) }}
                                        تومان</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">هزینه ارسال</p>
                                    <p class="text-warning">{{ priceFormat($order->delivery->amount) }} تومان</p>
                                </section>

                                @if($order->commonDiscount != null)
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف اعمال شده</p>
                                        <p class="text-danger">{{ convertEnglishToPersian($order->commonDiscount->percentage) }}
                                            درصد (حداکثر {{ priceFormat($order->commonDiscount->discount_ceiling) }}
                                            تومان)</p>
                                    </section>
                                @endif

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که
                                    انتخاب می کنید در مدت زمان ذکر شده ارسال می شود.
                                </p>

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    @php
                                        $final_amount = $order->order_final_amount + $order->delivery->amount;
                                    @endphp
                                    <p class="text-muted">مبلغ قابل پرداخت</p>
                                    <p class="fw-bold">{{ priceFormat($final_amount) }} تومان</p>
                                </section>

                                <section class="">
                                    <section id="payment-button"
                                             class="text-warning border border-warning text-center py-2 pointer rounded-2 d-block">
                                        نوع پرداخت را انتخاب کن
                                    </section>
                                    <button id="final-level" type="button" onclick="document.getElementById('payment_submit').submit()" class="btn btn-danger d-none w-100">ثبت سفارش و
                                        گرفتن کد رهگیری</button>
                                </section>

                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#cash_payment').click(function () {
                let newDiv = document.createElement('div');
                newDiv.innerHTML = `
                    <section class="input-group input-group-sm">
                        <input type="text" name="cash_receiver" class="form-control" form="payment_submit" placeholder="نام و نام خانوادگی دریافت کننده">
                    </section>`

                document.getElementsByClassName('content-wrapper')[1].appendChild(newDiv)
            })
        })
    </script>
@endsection
