<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>OCF LIIBERIA | {{ $title }}</title>

<!-- Custom fonts for this template-->
<link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link rel="icon" type="X-icon" href="{{ asset('assets/img/logo.png') }}" />
<link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
@livewireStyles

</head>
<style>
    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        10%,
        30%,
        50%,
        70%,
        90% {
            transform: translateX(-10px);
        }

        20%,
        40%,
        60%,
        80% {
            transform: translateX(10px);
        }
    }

    .shake {
        animation: shake 7s;
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}"
                wire:navigate>
                <div class="sidebar-brand-icon">
                    <i class="">OCF</i>
                </div>
                <div class="sidebar-brand-text mx-3">LIBERIA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            @haspermission('view-dashboard')
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home.dashboard') }}" wire:navigate>
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
            @endhaspermission
            <!-- Divider -->
            <hr class="sidebar-divider">
            @haspermission('manage-sponsors')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sponsors.index') }}" wire:navigate>
                        <i class="fas fa-fw fa-users"></i>
                        <span>Sponsors</span>
                    </a>
                </li>
            @endhaspermission
            @haspermission('manage-schools')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('schools.index') }}" wire:navigate>
                        <i class="fas fa-fw fa-school"></i>
                        <span>Institutions</span>
                    </a>
                </li>
            @endhaspermission
            @haspermission('manage-students')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('beneficiaries.index') }}" wire:navigate>
                        <i class="fas fa-fw fa-user"></i>
                        <span>Students</span>
                    </a>
                </li>
            @endhaspermission
            @haspermission('manage-beneficiaries')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('distribution.beneficiaries') }}" wire:navigate>
                        <i class="fas fa-fw fa-user"></i>
                        <span>Beneficiaries</span>
                    </a>
                </li>
            @endhaspermission
            @haspermission('manage-visits')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('visits.index') }}" wire:navigate>
                        <i class="fas fa-fw fa-road"></i>
                        <span>Visits</span>
                    </a>
                </li>
            @endhaspermission
            @haspermission('manage-distributions')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('distributions.index') }}" wire:navigate>
                        <i class="fas fa-fw fa-share"></i>
                        <span>Distributions</span>
                    </a>
                </li>
            @endhaspermission
            {{-- @haspermission('manage-reports')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-book"></i>
                        <span>Reports</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('reports.students') }}" wire:navigate>Students</a>
                            <a class="collapse-item" href="{{ route('reports.distributions') }}"
                                wire:navigate>Distributions</a>
                            <a class="collapse-item" href="{{ route('reports.visits') }}" wire:navigate>Visits</a>
                            <a class="collapse-item" href="{{ route('reports.sponsors') }}" wire:navigate>Sponsors</a>
                        </div>
                    </div>
                </li>
            @endhaspermission --}}
            @haspermission('manage-settings')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Settings</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">ACCOUNT</h6>
                            @haspermission('manage-users')
                                <a class="collapse-item" href="{{ route('account.users') }}" wire:navigate>Users</a>
                            @endhaspermission
                            @haspermission('manage-roles')
                                <a class="collapse-item" href="{{ route('roles.index') }}" wire:navigate>Roles</a>
                            @endhaspermission
                            @haspermission('manage-permissions')
                                <a class="collapse-item" href="{{ route('permissions.index') }}" wire:navigate>Permissions</a>
                            @endhaspermission
                            <div class="collapse-divider"></div>
                            <h6 class="collapse-header">SYSTEM TYPES</h6>
                            @haspermission('manage-county-types')
                                <a class="collapse-item" href="{{ route('counties.index') }}" wire:navigate>County Types</a>
                            @endhaspermission
                            @haspermission('manage-distribution-types')
                                <a class="collapse-item" href="{{ route('distributiontypes.index') }}"
                                    wire:navigate>Distribution Types</a>
                            @endhaspermission
                        </div>
                    </div>
                </li>
            @endhaspermission
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    @include('layouts.profile')
                </nav>
                <div class="container-fluid">
                    <div class="container-fluid">
                        @if (session('msg'))
                            <div id="delete-success-alert"
                                class="alert {{ session('flag') }} alert-dismissible fade show shake" role="alert">
                                {{ session('msg') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var alertElement = document.getElementById('delete-success-alert');
                                    setTimeout(function() {
                                        alertElement.classList.add('fade');
                                        alertElement.classList.remove('show', 'shake');
                                        alertElement.addEventListener('transitionend', function() {
                                            alertElement.remove();
                                        });
                                    }, 5000);
                                });
                            </script>
                        @endif
                    </div>
                    @yield('content')
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; OCFLIBERIA {{ date('Y') }} | Developed By <a
                                href="mailto:pantoejr@gmail.com">Joel Pantoe Jr.</a></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    @livewireScripts
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>


</body>

</html>
