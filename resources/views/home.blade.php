@extends('layouts.app')

@section('login')
<div class="">

    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">IPOSA</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

       

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </a><!-- End Notification Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header" style="padding: 0px 60px 4px 60px;">
                            @if(auth()->user()->unreadNotifications->count() == 0)
                                 No new reports
                            @else
                                {{ auth()->user()->unreadNotifications->count() }} unread reports
                                <!-- <a href="{{ url('/notifications') }}"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a> -->
                                <li>
                                <hr class="dropdown-divider">
                                </li>
                                @foreach(auth()->User()->notifications as $notifications)
                                @if(!$notifications->read_at)
                                @foreach($global_variable as $variable)
                                @if($variable->id == $notifications->data['report']['user_id'])
                                    <li class="notification-item">
                                        <i class="bi bi-exclamation-circle text-warning"></i>
                                        <a href="{{ url('/reports_page') }}" style="text-decoration: none;">
                                        <div>
                                            <h4 style="color: rgb(51, 51, 51);">{{ $variable->name}}</h4>
                                            <p>{{ $notifications->data['report']['name']}}</p>
                                            <p>{{$variable->role}} at {{$variable->center_name}}</p>
                                        </div>
                                        </a>
                                        
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    @endif
                                @endforeach    
                                @endif
                                @endforeach
                    
                                <!-- <li class="dropdown-footer">
                                    <a href="#">Show all notifications</a>
                                </li> -->
                            
                            @endif
                            
                            
                        </li>
                       

                    </ul>
                  <!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

                        <img src="{{ asset(Auth::user()->profile_photo) }}" alt="Profile" class="rounded-circle"
                            style="width: 40px; height: 40px;">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>{{ Auth::user()->role->role }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ url('/user_profile') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!-- <li>
                                                <a class="dropdown-item d-flex align-items-center" href="#">
                                                    <i class="bi bi-box-arrow-right"></i>
                                                    <span>Log Out</span>
                                                </a>
                                            </li> -->
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>

                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="{{ url('/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            @can('is_dist_cordinator')
            @cannot('is_admin')
            <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/students') }}">
                    <i class="bi bi-person-lines-fill"></i>
                        <span>Students</span>
                    </a>
                </li>
           
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/courses') }}">
                    <i class="ri-pencil-fill"></i>
                        <span>Courses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/teachers') }}">
                    <i class="bi bi-file-person-fill"></i>
                        <span>Teachers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/clubs') }}">
                    <i class="bi bi-people-fill"></i>
                        <span>Clubs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/inventory') }}">
                    <i class="bi bi-file-ruled-fill"></i>
                        <span>Inventory list</span>
                    </a>
                </li>
            @endcannot
            @endcan

            @canany(['is_admin','is_user'])
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('/users') }}">
                            <i class="bi bi-circle"></i><span>users</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
            @endcanany

            @canany('is_user')

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#regions-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Regions</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="regions-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('/regions') }}">
                            <i class="bi bi-circle"></i><span>Regions</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Forms Nav -->
            @endcanany
            @canany(['is_reg_cordinator','is_user'])
            <!-- districti level -->
            <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/students') }}">
                    <i class="bi bi-person-lines-fill"></i>
                        <span>Students</span>
                    </a>
            </li>
            <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/courses') }}">
                    <i class="ri-pencil-fill"></i>
                        <span>Courses</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/teachers') }}">
                    <i class="bi bi-file-person-fill"></i>
                        <span>Teachers</span>
                    </a>
                </li>    
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/clubs') }}">
                    <i class="bi bi-people-fill"></i>
                        <span>Clubs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/inventory') }}">
                    <i class="bi bi-file-ruled-fill"></i>
                        <span>Inventory list</span>
                    </a>
                </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#districts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Districts</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="districts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('/districts') }}">
                            <i class="bi bi-circle"></i><span>Districts</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/select_region') }}">
                    <i class="bi bi-journal-text"></i>
                    <span>Centers</span>
                </a>
            </li>
            <!-- end of district level -->
            @endcanany

            @canany(['is_admin'])
            <li class="nav-item">
               
                @cannot('is_admin')
                <ul id="center-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('/reports_page') }}">
                            <i class="bi bi-circle"></i><span>Reports</span>
                        </a>
                    </li>
                </ul>
                @endcannot

            </li>
            @endcanany
        <!-- End Forms Nav -->
            @can('is_hoc')
            @cannot('is_admin')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/students') }}">
                    <i class="bi bi-person-lines-fill"></i>
                        <span>Students</span>
                    </a>
                </li>
           
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/courses') }}">
                    <i class="ri-pencil-fill"></i>
                        <span>Courses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/teachers') }}">
                    <i class="bi bi-file-person-fill"></i>
                        <span>Teachers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/clubs') }}">
                    <i class="bi bi-people-fill"></i>
                        <span>Clubs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/inventory') }}">
                    <i class="bi bi-file-ruled-fill"></i>
                        <span>Inventory list</span>
                    </a>
                </li>
                
            @endcannot
            @endcan      
           
           

            @cannot('is_hoc')
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#students-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Students</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="students-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('/students') }}">
                            <i class="bi bi-circle"></i><span>Students</span>
                        </a>
                    </li>

                </ul>
            </li> -->
            @endcannot

            @canany(['is_dist_cordinator', 'is_reg_cordinator', 'is_hoc'])
           
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/reports_page') }}">
                <!-- <i class="bi bi-layout-text-window-reverse"></i> -->
                <i class="ri-mail-open-fill"></i>
                    <span>Reports</span>
                </a>
            </li>
          
            @endcanany


            <li class="nav-heading"><hr></li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/user_profile') }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li>
            <!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-contact.html">
                    <i class="bi bi-envelope"></i>
                    <span>Contact</span>
                </a>
            </li><!-- End Contact Page Nav -->





        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main py-1 my-1">

        @yield('contente')
        <!-- @yield('content') -->





    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

</div>
@endsection