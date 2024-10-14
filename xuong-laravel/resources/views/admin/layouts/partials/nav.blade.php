<div class="logo d-flex justify-content-between">
    <a href="index-2.html"><img src="/adminn/img/logo.png" alt></a>
    <div class="sidebar_close_icon d-lg-none">
        <i class="ti-close"></i>
    </div>
</div>
<ul id="sidebar_menu">
    <li class>
        <a href="{{ route('admin.dashboard') }}" aria-expanded="false">
            <div class="icon_menu">
                <img src="/adminn/img/menu-icon/dashboard.svg" alt>
            </div>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="mm-active">
        <a class="has-arrow" href="#" aria-expanded="false">
            <div class="icon_menu">
                <img src="/adminn/img/menu-icon/3.svg" alt>
            </div>
            <span>Quản lý User</span>
        </a>
        <ul>
            <li><a href="{{ route('admin.users.index') }}">Danh sách </a></li>
            <li><a href="{{ route('admin.users.create') }}">Thêm mới</a></li>
        </ul>
    </li>

    <li class="mm-active">
        <a class="has-arrow" href="#" aria-expanded="false">
            <div class="icon_menu">
                <img src="/adminn/img/menu-icon/4.svg" alt>
            </div>
            <span>Quản lý post</span>
        </a>
        <ul>
            <li><a href="{{ route('admin.posts.index') }}">Danh sách </a></li>
            <li><a href="{{ route('admin.posts.create') }}">Thêm mới</a></li>
        </ul>
    </li>

    <li class="mm-active">
        <a class="has-arrow" href="#" aria-expanded="false">
            <div class="icon_menu">
                <img src="/adminn/img/menu-icon/5.svg" alt>
            </div>
            <span>Quản lý tag</span>
        </a>
        <ul>
            <li><a href="{{ route('admin.tags.index') }}">Danh sách </a></li>
            <li><a href="{{ route('admin.tags.create') }}">Thêm mới</a></li>
        </ul>
    </li>

    <li class="mm-active">
        <a class="has-arrow" href="#" aria-expanded="false">
            <div class="icon_menu">
                <img src="/adminn/img/menu-icon/2.svg" alt>
            </div>
            <span>Quản lý category</span>
        </a>
        <ul>
            <li><a href="{{ route('admin.categories.index') }}">Danh sách </a></li>
            <li><a href="{{ route('admin.categories.create') }}">Thêm mới</a></li>
        </ul>
    </li>

    <li class="mm-active">
        <a class="has-arrow" href="#" aria-expanded="false">
            <div class="icon_menu">
                <img src="/adminn/img/menu-icon/3.svg" alt>
            </div>
            <span>Quản lý author</span>
        </a>
        <ul>
            <li><a href="{{ route('admin.authors.index') }}">Danh sách </a></li>
            <li><a href="{{ route('admin.authors.create') }}">Thêm mới</a></li>
        </ul>
    </li>

    <li class="mm-active">
        <a class="has-arrow" href="#" aria-expanded="false">
            <div class="icon_menu">
                <img src="/adminn/img/menu-icon/3.svg" alt>
            </div>
            <span>QL Comments</span>
        </a>
        <ul>
            <li><a href="{{ route('admin.comments.index') }}">Danh sách </a></li>
        </ul>
    </li>
</ul>
