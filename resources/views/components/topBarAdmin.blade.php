<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow d-flex justify-content-between px-5">
    {{-- Title Page --}}
    <h2 class="m-0 text-dark font-weight-bold">{{ $title }}</h2>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav">
        
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="text-center">
                    <img src="{{ asset('assets/images/avatar.jpg') }}" class="rounded-circle" alt="Logo" width="48"
                        height="48" />
                </div>
                <div class="mx-3">
                    <p class="fs-6 font-weight-bold text-dark p-0 m-0">
                        {{ Auth::user()->nama }}
                    </p>
                    <p class="fw-light text-gray-500 p-0 m-0" style="font-size: 12px">
                        {{ Auth::user()->role->role }}
                    </p>
                </div>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->