<!doctype html>
<html lang="en">
<head>
    @include('customer.layouts.head-tag')
    @yield('head-tag')

</head>
<body>
@include('customer.layouts.header')

<section class="container-xxl body-container">
    @include('customer.layouts.sidebar')
</section>

<!-- start main one col -->
@include('admin.alerts.alert-section.success')
<main id="main-body-one-col" class="main-body">
    @yield('content')
</main>

@include('customer.layouts.footer')


@include('customer.layouts.script')
@yield('script')
</body>
</html>
