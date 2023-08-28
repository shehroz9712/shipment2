<!DOCTYPE html>
<html lang="en">

@include('admin.layouts.partials.head')

<body>

    <div class="container-scroller">
        <div class="bg-transparent container-fluid page-body-wrapper">
            <div class="justify-content-center main-panel w-100">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ frontVendors('js/vendor.bundle.base.js') }}"></script>
    <script src="{{ frontVendors('chart.js/Chart.min.js') }}"></script>
    <script src="{{ frontJs('off-canvas.js') }}"></script>
    <script src="{{ frontJs('hoverable-collapse.js') }}"></script>
    <script src="{{ frontJs('template.js') }}"></script>
    <script src="{{ frontJs('settings.js') }}"></script>
    <script src="{{ frontJs('todolist.js') }}"></script>
    <script src="{{ frontJs('dashboard.js') }}"></script>

    @yield('js')

</body>

</html>
