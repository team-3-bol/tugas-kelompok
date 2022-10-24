<header class="mb-5">
    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="{{ route('home') }}"><h2>Tugas Kelompok</h2></a>
            </div>
            <div class="header-top-right">

                @auth
                    <div class="dropdown">
                        <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="avatar avatar-md2" >
                                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Avatar">
                            </div>
                            <div class="text">
                                <h6 class="user-dropdown-name">{{ auth()->user()->name }}</h6>
                                <p class="user-dropdown-status text-sm text-muted">Member</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="d-flex align-items-center dropend">
                        <div class="text">
                            <h6 class="user-dropdown-name">Login</h6>
                        </div>
                    </a>
                @endauth

                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>

    <nav class="main-navbar">
        <div class="container">
            <ul>
                <li class="menu-item">
                    <a href="{{ route('video.index') }}" class='menu-link'>
                        <i class="bi bi-film"></i>
                        <span>Videos</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('score.index') }}" class='menu-link'>
                        <i class="bi bi-alt"></i>
                        <span>Scores</span>
                    </a>
                </li>
                <li class="menu-item has-sub">
                    <a href="#" class='menu-link'>
                        <i class="bi bi-stack"></i>
                        <span>Components</span>
                    </a>
                    <div class="submenu">
                        <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                <li class="submenu-item  ">
                                    <a href="component-alert.html" class='submenu-link'>Alert</a>
                                </li>
                                <li class="submenu-item  ">
                                    <a href="component-badge.html" class='submenu-link'>Badge</a>
                                </li>
                                <li class="submenu-item  has-sub">
                                    <a href="#" class='submenu-link'>Extra Components</a>

                                    <ul class="subsubmenu">
                                        <li class="subsubmenu-item ">
                                            <a href="extra-component-avatar.html" class="subsubmenu-link">Avatar</a>
                                        </li>
                                        <li class="subsubmenu-item ">
                                            <a href="extra-component-sweetalert.html" class="subsubmenu-link">Sweet Alert</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
