<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"
                            srcset="" /></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                {{-- <li class="sidebar-title">Menu</li> --}}

                <li class="sidebar-item {{ Route::is("dashboard.index") ? "active" : "" }}">
                    <a href="{{ route('dashboard.index') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is("slider.index") ? "active" : "" }}">
                    <a href="{{ route('slider.index') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Slider</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is("page.index") ? "active" : "" }}">
                    <a href="{{ route('page.index') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Pages</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub {{ Route::is("blog.index") ? "active" : "" }}">
                    <a href="#" class="sidebar-link">
                      <i class="bi bi-stack"></i>
                      <span>Blog</span>
                    </a>
                    <ul class="submenu {{ Route::is("blog.index") ? "active" : "" }}">
                      <li class="submenu-item {{ Route::is("blog.index") ? "active" : "" }}"">
                        <a href="{{ route('blog.index') }}">Articles</a>
                      </li>
                    </ul>
                  </li>


                <li class="sidebar-item ">
                    <a href="index.html" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Mail</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Route::is("settings.index") ? "active" : "" }}">
                    <a href="{{ route("settings.index") }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Settings</span>
                    </a>
                </li>



            </ul>
        </div>
        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>
