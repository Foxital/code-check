 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="{{ env('APP_URL') }}" class="nav-link">Home</a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">

         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-bell"></i>
                 <span class="badge badge-warning navbar-badge">15</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-item dropdown-header">15 Notifications</span>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-envelope mr-2"></i> 4 new messages
                     <span class="float-right text-muted text-sm">3 mins</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-users mr-2"></i> 8 friend requests
                     <span class="float-right text-muted text-sm">12 hours</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-file mr-2"></i> 3 new reports
                     <span class="float-right text-muted text-sm">2 days</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
             </div>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                 <i class="fas fa-expand-arrows-alt"></i>
             </a>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->

 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="{{ url('/admin/home') }}" class="brand-link bg-white p-0 text-center">
        <img src="{{ asset('admin-assets/logo/hlogo-min.png') }}" alt="Logo" style="opacity: 1;width: 140px;padding: 2px;">
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('admin-assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info px-2 py-0">
                 <a href="#" style="line-height: 17px;" class="d-block"><small>Welcome</small><br>{{ Auth::user()->name }}</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item">
                     <a href="{{ url('/admin/home') }}" class="nav-link {{ Request::segment(2)=='home'?'active':'' }}">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 @if (Auth::user()->role_type == 1)
                     <li class="nav-header">Main Access</li>
                     <li class="nav-item">
                         <a href="{{ url('/admin/users') }}" class="nav-link {{ Request::segment(2)=='users'?'active':'' }}">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Admin Users
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ url('/admin/candidates') }}" class="nav-link {{ Request::segment(2)=='candidates'?'active':'' }}">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Candidate
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ url('/admin/orders') }}" class="nav-link {{ Request::segment(2)=='orders'?'active':'' }}">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Orders
                             </p>
                         </a>
                     </li>
                     <li class="nav-item {{ Request::segment(2)=='settings'||Request::segment(2)=='couriers'?'menu-open':'' }}">
                         <a href="#" class="nav-link {{ Request::segment(2)=='settings'||Request::segment(2)=='newsletters'||Request::segment(2)=='contact-users'||Request::segment(2)=='couriers'?'active':'' }}">
                             <i class="nav-icon fas fa-copy"></i>
                             <p>
                                 Configuration
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{ url('/admin/settings') }}" class="nav-link {{ Request::segment(2)=='settings'?'active':'' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Settings</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('/admin/newsletters') }}" class="nav-link {{ Request::segment(2)=='newsletters'?'active':'' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Newsletters</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('/admin/contact-users') }}" class="nav-link {{ Request::segment(2)=='contact-users'?'active':'' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Contact Users</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('/admin/couriers') }}" class="nav-link {{ Request::segment(2)=='couriers'?'active':'' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Couries</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                 @endif


                 <li class="nav-header">Staff Access</li>

                 <li class="nav-item {{ Request::segment(2)=='products'||Request::segment(2)=='low-stock'||Request::segment(2)=='categorys'||Request::segment(2)=='sub-categorys'?'menu-open':'' }}">
                     <a href="#" class="nav-link {{ Request::segment(2)=='products'||Request::segment(2)=='low-stock'||Request::segment(2)=='categorys'||Request::segment(2)=='sub-categorys'?'active':'' }}">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Product Management
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ url('/admin/categorys') }}" class="nav-link {{ Request::segment(2)=='categorys'?'active':'' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Category</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('/admin/sub-categorys') }}" class="nav-link {{ Request::segment(2)=='sub-categorys'?'active':'' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Sub Category</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('/admin/products') }}" class="nav-link {{ Request::segment(2)=='products'?'active':'' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Products</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('/admin/low-stock') }}" class="nav-link {{ Request::segment(2)=='low-stock'?'active':'' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Low Stock</p>
                             </a>
                         </li>
                    </ul>
                 </li>
                 <li class="nav-item">
                     <a href="{{ url('/admin/banners') }}" class="nav-link {{ Request::segment(2)=='banners'?'active':'' }}">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Banner
                         </p>
                     </a>
                 </li>
<!--
                 <li class="nav-item">
                     <a href="{{ url('/admin/offers') }}" class="nav-link {{ Request::segment(2)=='offers'?'active':'' }}">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Offers
                         </p>
                     </a>
                 </li>
-->
                 <li class="nav-item">
                    <a href="{{ url('/admin/coupons') }}" class="nav-link {{ Request::segment(2)=='coupons'?'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Coupon
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/reviews') }}" class="nav-link {{ Request::segment(2)=='reviews'?'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Reviews
                        </p>
                    </a>
                </li>
                 <li class="nav-item">
                     <a href="{{ url('/admin/testimonials') }}" class="nav-link {{ Request::segment(2)=='testimonials'?'active':'' }}">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Testimonial
                         </p>
                     </a>
                 </li>

                 <li class="nav-item {{ Request::segment(2)=='blogs'||Request::segment(2)=='blog-categorys'?'menu-open':'' }}">
                     <a href="#" class="nav-link {{ Request::segment(2)=='blogs'||Request::segment(2)=='blog-categorys'?'active':'' }}">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Blog Management
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ url('/admin/blog-categorys') }}" class="nav-link {{ Request::segment(2)=='blog-categorys'?'active':'' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Blog Category</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('/admin/blogs') }}" class="nav-link {{ Request::segment(2)=='blogs'?'active':'' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Blog Post</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="{{ url('/admin/pages') }}" class="nav-link {{ Request::segment(2)=='pages'?'active':'' }}">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Pages
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ url('/admin/faqs') }}" class="nav-link {{ Request::segment(2)=='faqs'?'active':'' }}">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             FAQ's
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('admin.logout') }}"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                         class="nav-link">
                         <i class="nav-icon far fa-circle text-danger"></i>
                         <p>{{ __('Logout') }}</p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
 <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
     @csrf
 </form>
