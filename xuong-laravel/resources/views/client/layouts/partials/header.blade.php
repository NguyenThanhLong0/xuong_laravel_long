<div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <a href="{{ route('home') }}" class="logo d-flex align-items-center">
        <h1>DinoBlog</h1>
    </a>

    <nav id="navbar" class="navbar">
        <ul>
            <li><a href="{{ route('home') }}">Blog</a></li>
            <li><a href="single-post.html">Single Post</a></li>

            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ($categories as $category)
                        <li><a class="dropdown-item"
                                href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </li> --}}

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ($categories as $category)
                        <li><a class="dropdown-item"
                                href="{{ route('categories.filter', $category->id) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </li>




            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>

    <div class="position-relative d-flex align-items-center">
        <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
        <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- Search Form -->
        <div class="search-form-wrap js-search-form-wrap">
            <form action="search-result.html" class="search-form">
                <span class="icon bi-search"></span>
                <input type="text" placeholder="Search" class="form-control">
                <button class="btn js-search-close"><span class="bi-x"></span></button>
            </form>
        </div>

        <!-- Check if user is authenticated -->
        @auth
            <div class="dropdown ms-3">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu">
                    @if (Auth::user()->type == 1)
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Trang quản trị</a></li>
                    @endif
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Đăng xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <!-- If guest, show user icon and menu for login/register -->
            <div class="dropdown ms-3">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('login') }}" class="dropdown-item">Đăng nhập</a></li>
                    <li><a href="{{ route('register') }}" class="dropdown-item">Đăng ký</a></li>
                </ul>
            </div>
        @endauth
    </div>

</div>
