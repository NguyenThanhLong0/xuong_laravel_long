<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>DinoBlog - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('client.layouts.partials.css')


</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('client.layouts.partials.header')
    </header>
    <!-- End Header -->

    <main id="main">

        <!-- ======= Banner ======= -->
        <section id="hero-slider" class="hero-slider">
            @include('client.layouts.partials.slider')
        </section>
        <!-- End Banner -->


        @yield('content')




    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        @include('client.layouts.partials.footer')
    </footer>

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('client.layouts.partials.js')

</body>

</html>
