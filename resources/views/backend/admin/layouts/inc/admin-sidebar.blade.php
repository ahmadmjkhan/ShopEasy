<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('admin.dashboard')}}" class="brand-link">
    <img src="{{asset('backend/admin/assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin Panel</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('backend/admin/assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">

      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-close">
          <a href="{{route('admin.dashboard')}}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard

            </p>
          </a>

        </li>

        <li class="nav-item menu-close">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              {{Auth::guard('admin')->user()->name}}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.logout') }}" class="nav-link active" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="far fa-circle nav-icon"></i>
                <p>Logout</p>
              </a>
              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
              </form>







            </li>

          </ul>
        </li>



        <li class="nav-header">EXAMPLES</li>

        <li class="nav-item">
          <a href="{{route('admin.all-sellers')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Sellers
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('admin.all-users')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Users
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>



        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Catalogue Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{route('admin.section_index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sections</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('admin.category_index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Categories</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('admin.brand_index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Brands</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('admin.banner_index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Banners</p>
              </a>
            </li>



            <li class="nav-item">
              <a href="{{route('admin.product_index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Products</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('admin.filter_index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Filters</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('admin.coupon_index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Coupons</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Shipping Charges Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{route('admin.shipping-charges')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Shipping Charges</p>
              </a>
            </li>


          </ul>
        </li>


        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Orders Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{route('admin.orders')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Orders</p>
              </a>
            </li>


          </ul>
        </li>

        @if(Auth::guard('admin')->user()->type=='Admin')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Admins
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>


          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{url('backend/admin')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Admin</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{url('admin/subadmin')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>SubAdmins</p>
              </a>
            </li>


          </ul>
        </li>
        @endif





        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Extras
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Login & Register v1
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/examples/login.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Login v1</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item">
              <a href="pages/examples/lockscreen.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lockscreen</p>
              </a>
            </li>

          </ul>
        </li>


      </ul>








    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>