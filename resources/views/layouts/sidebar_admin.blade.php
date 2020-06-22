<aside class="main-sidebar sidebar-dark-primary bg-info elevation-5">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="/../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Laravel V1</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="/" class="nav-link {{ setActive(['/', 'home']) }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right"></i>
              </p>
            </a>
          </li>
          <li class="nav-item {{ setOpen(['customer*', 'kategori*', 'lokasi*', 'item*','stok*','suplier*','user*']) }}">
            <a href="#" class="nav-link {{ setActive(['customer*', 'kategori*', 'lokasi*', 'item*','stok*','suplier*','user*']) }}">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('lokasi.index')}}" class="nav-link {{ setActive(['lokasi*']) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lokasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('kategori.index')}}" class="nav-link {{ setActive(['kategori*']) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('item.index')}}" class="nav-link {{ setActive(['item*']) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Item</p>
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