<header class="header header-light bg-primary header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="fa fa-bars"></i>
        </button>
        <a class="header-brand d-md-none text-white" href="#">
           <img src="{{ asset('assets/img/logo.png')  }}" alt="">
       </a>
       <form class="d-none d-md-flex" role="search">
          <div class="input-group">
             <span class="input-group-text bg-light border-0 px-1" id="search-addon">
                <div style="margin-left: 10px;">
                    <i class="fa fa-search"></i>

                </div>
             </span>
             <input class="form-control bg-light border-0" type="text" placeholder="Search..." aria-label="Search" aria-describedby="search-addon">
          </div>
       </form>
       <ul class="header-nav d-none d-sm-flex ms-auto me-3"></ul>
       <ul class="header-nav ms-auto ms-sm-0 me-sm-4">
          <li class="nav-item dropdown d-flex align-items-center">
             <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img" src="{{ asset('assets/img/user-account-management-logo-user-icon-11562867145a56rus2zwu.png')  }}" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
             </a>
             <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="dropdown-header bg-light py-2 dark:bg-white dark:bg-opacity-10">
                   <div class="fw-semibold">Account</div>
                </div>


                <a class="dropdown-item"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>
                   Logout
                   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                 </form>
                </a>
             </div>
          </li>
       </ul>
       <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#aside')).show()">
          <svg class="icon icon-lg">
             <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-applications-settings"></use>
          </svg>
       </button>
    </div>
 </header>
