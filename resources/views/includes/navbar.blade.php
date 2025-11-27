<!-- ========== NAVBAR AESTHETIC LIGHT BLUE (MATCH SIDEBAR) ========== -->

<style>
    .navbar-lightblue {
        background: #ffffff !important;
        border-bottom: 1px solid #dce6f5 !important;
        box-shadow: 0 2px 8px rgba(30, 90, 200, 0.10);
    }

    /* Search input */
    .navbar-lightblue input {
        background: #f3f7ff !important;
        border: 1px solid #d7e6ff !important;
        border-radius: 10px;
        color: #2b4160;
    }

    .navbar-lightblue input:focus {
        box-shadow: 0 0 0 0.20rem rgba(30, 90, 200, 0.15);
    }

    /* Icon */
    .navbar-lightblue .bx {
        color: #1b4f9c !important;
    }

    .dropdown-menu {
        border-radius: 12px;
        border: 1px solid #e1e9f8;
    }

    .dropdown-item:hover {
        background: #e9f1ff !important;
        color: #1b4f9c !important;
    }
</style>

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center navbar-lightblue"
    id="layout-navbar">

    <!-- Toggle -->
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                    aria-label="Search..." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="../assets/img/avatars/1.png" alt="User" class="w-px-40 h-auto rounded-circle">
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="../assets/img/avatars/1.png" alt
                                            class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </div>

                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">Lintang Ganteng</span>
                                    <small class="text-muted">Administrator</small>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>
            </li>
            <!-- /User -->

        </ul>
    </div>
</nav>