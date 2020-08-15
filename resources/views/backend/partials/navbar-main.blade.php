<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow admin-navbar">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar Search -->
  {{--   <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-primary" type="button">
          <i class="fas fa-search fa-sm"></i>
        </button>
      </div>
    </div>
  </form> --}}

  <!-- Topbar Navbar -->
  <ul class="navbar-nav">
    <a class="nav-link" href="{{ route('admin.index') }}" id="alertsDropdown" role="button" aria-expanded="false">
      <img src="{{ asset('public/images/'.App\Models\Setting::first()->site_logo) }}"
        style="width: 50px;margin-top: 12px;" class="float-left" />

      <div class="sidebar-brand-text mx-3 mt-3 float-left">{{ App\Models\Setting::first()->site_title }}</div>
      <div class="clearfix"></div>
    </a>



    <li
      class="nav-item dropdown no-arrow {{ (Route::is('admin.category.index') || Route::is('admin.skill.index') || Route::is('admin.cities.index')) ? 'show' : '' }}">
      <a class="nav-link dropdown-toggle" href="#" id="jobs_settings" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-cog"></i> &nbsp;Job Settings
      </a>
      <div class="dropdown-menu shadow animated--grow-in" aria-labelledby="jobs_settings">
        <a class="dropdown-item" href="{{ route('admin.category.index') }}">Positions</a>
        <a class="dropdown-item" href="{{ route('admin.cities.index') }}">Cities</a>
        <a class="dropdown-item" href="{{ route('admin.skill.index') }}">Skills</a>
        <a class="dropdown-item" href="{{ route('admin.experience.index') }}">Experience</a>
      </div>
    </li>

    <li
      class="nav-item dropdown no-arrow {{ (Route::is('admin.users.candidates') || Route::is('admin.users.employers')) ? 'show' : '' }}">
      <a class="nav-link dropdown-toggle" href="#" id="candidates" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-users"></i> &nbsp;Users
      </a>
      <div class="dropdown-menu shadow animated--grow-in" aria-labelledby="candidates">
        <a class="dropdown-item" href="{{ route('admin.users.candidates') }}">Candidates</a>
        <a class="dropdown-item" href="{{ route('admin.users.employers') }}">Employers</a>
      </div>
    </li>

    <li
      class="nav-item dropdown no-arrow {{ (Route::is('admin.templates.index') || Route::is('admin.templates.edit') || Route::is('admin.templates.show') || Route::is('admin.templates.create')) ? 'show' : '' }}">
      <a class="nav-link dropdown-toggle" href="#" id="templates" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-th"></i> &nbsp;Job Templates
      </a>
      <div class="dropdown-menu shadow animated--grow-in" aria-labelledby="templates">
        <a class="dropdown-item" href="{{ route('admin.templates.index') }}">All Templates</a>
        <a class="dropdown-item" href="{{ route('admin.templates.create') }}">Add New Template</a>
      </div>
    </li>

    <li
      class="nav-item dropdown no-arrow {{ (Route::is('admin.crawlers.index') || Route::is('admin.crawler_sites.index') || Route::is('admin.sites.assign') || Route::is('admin.sites.asignSiteList') || Route::is('admin.crawl.extractLinks') || Route::is('admin.crawl.extractLinks.store')) ? 'show' : '' }}">
      <a class="nav-link dropdown-toggle" href="#" id="crawlers" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-tasks"></i> &nbsp;Job Crawler
      </a>
      <div class="dropdown-menu shadow animated--grow-in" aria-labelledby="crawlers">
        <a class="dropdown-item" href="{{ route('admin.crawlers.index') }}">Add URL</a>
        <a class="dropdown-item" href="{{ route('admin.crawler_sites.index') }}">Add Site</a>
        <a class="dropdown-item" href="{{ route('admin.sites.assign') }}">Assign Site</a>
        <a class="dropdown-item" href="{{ route('admin.crawl.extractLinks') }}">Extract Links</a>
      </div>
    </li>

    <li class="nav-item  {{ (Route::is('admin.settings.index')) ? 'show' : '' }}">
      <a class="nav-link" href="{{ route('admin.settings.index') }}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Settings</span></a>
    </li>

  </ul>
  <ul class="navbar-nav ml-auto">

    <li class="nav-item">
      <a class="nav-link" href="{{ route('index') }}" id="alertsDropdown" role="button" aria-expanded="false"
        target="_blank">
        <i class="fas fa-eye fa-fw"></i> View Site
      </a>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('admin')->user()->first_name }}</span>
        <img class="img-profile rounded-circle"
          src="{{ App\Helpers\ReturnPathHelper::getAdminImage(Auth::guard('admin')->user()->id) }}">
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#changePasswordModal" data-toggle="modal">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Change Email/Password
        </a>
        <div class="dropdown-divider"></div>

        <a href="{{ route('admin.logout') }}" class="dropdown-item notify-item"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
          @csrf
        </form>

      </div>
    </li>

  </ul>

</nav>
<!-- End of Topbar -->



<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Admin Email/Password</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="" action="{{ route('admin.password.change') }}" method="post">
              @csrf
              <label>New Email:</label> <br>
              <input type="email" name="email" id="email" placeholder="New Email" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" required/>
              <br>
              
              <label>New Password:</label> <br>
              <div class="row">
                 <div class="col-md-6">
                     <input type="password" name="password" id="password" placeholder="New Password" class="form-control" required/>
                 </div>
                 <div class="col-md-6">
                     <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm New Password" class="form-control" required/>
                 </div>
              </div>
              
              <button type="submit" class="btn btn-success btn-block btn-sm mt-3">
                <i class="fa fa-check"></i> Change Email/Password</button>
            </form>
        </div>
      </div>
    </div>
  </div>
<!-- Change Password Modal -->