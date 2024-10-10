<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from demo.dashboardpack.com/sales-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 May 2024 07:23:13 GMT -->

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sales</title>


    @include('admin.layouts.partials.css')
</head>

<body class="crm_body_bg">


    <nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
        @include('admin.layouts.partials.nav')
    </nav>

    <section class="main_content dashboard_part large_header_bg">

        @include('admin.layouts.partials.topbar')

        <div class="main_content_iner overly_inner ">

            @yield('content')

        </div>

        <div class="footer_part">
            @include('admin.layouts.partials.footer')
        </div>
    </section>




    <div id="back-top" style="display: none;">
        <a title="Go to Top" href="#">
            <i class="ti-angle-up"></i>
        </a>
    </div>

    @include('admin.layouts.partials.js')
</body>

<!-- Mirrored from demo.dashboardpack.com/sales-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 May 2024 07:24:00 GMT -->

</html>
