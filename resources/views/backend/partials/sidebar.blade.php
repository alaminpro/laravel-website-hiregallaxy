<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
    <div class="sidebar-brand-icon">
      {{--  <i class="fas fa-laugh-wink"></i>  --}}
      <img src="{{ asset('public/images/'.App\Models\Setting::first()->site_logo) }}" style="width: 50px" />
    </div>
    <div class="sidebar-brand-text mx-3">{{ App\Models\Setting::first()->site_title }}</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('admin.index') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  {{--  <hr class="sidebar-divider">  --}}

  <!-- Heading -->
  {{--  <div class="sidebar-heading">
    Interface
  </div>  --}}

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item {{ (Route::is('admin.job.index')) ? 'active' : '' }}">
    <a class="nav-link {{ (Route::is('admin.job.index')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse"
      data-target="#jobs" aria-expanded="true" aria-controls="jobs">
      <i class="fas fa-fw fa-th"></i>
      <span>Manage Jobs</span>
    </a>
    <div id="jobs" class="collapse {{ (Route::is('admin.job.index') ) ? 'show' : '' }}" aria-labelledby="headingTwo"
      data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Manage Jobs</h6>
        <a class="collapse-item" href="{{ route('admin.job.index') }}">All Jobs</a>
      </div>
    </div>
  </li>

  <li
    class="nav-item {{ (Route::is('admin.category.index') || Route::is('admin.skill.index') || Route::is('admin.cities.index')) ? 'active' : '' }}">
    <a class="nav-link collapsed  {{ (Route::is('admin.category.index') || Route::is('admin.skill.index') || Route::is('admin.cities.index')) ? '' : 'collapsed' }}"
      href="#" data-toggle="collapse" data-target="#jobs_settings" aria-expanded="true" aria-controls="jobs_settings">
      <i class="fas fa-fw fa-cog"></i>
      <span>Job Settings</span>
    </a>
    <div id="jobs_settings"
      class="collapse  {{ (Route::is('admin.category.index') || Route::is('admin.skill.index') || Route::is('admin.cities.index')) ? 'show' : '' }}"
      aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Manage Job Settings</h6>
        <a class="collapse-item" href="{{ route('admin.category.index') }}">Categories</a>
        <a class="collapse-item" href="{{ route('admin.cities.index') }}">Cities</a>
        {{--  <a class="collapse-item" href="{{ route('admin.skill.index') }}">Skills</a>
        <a class="collapse-item" href="{{ route('admin.experience.index') }}">Experience</a> --}}
      </div>
    </div>
  </li>

  <li
    class="nav-item {{ (Route::is('admin.users.candidates') || Route::is('admin.users.employers')) ? 'active' : '' }}">
    <a class="nav-link  {{ (Route::is('admin.users.candidates') || Route::is('admin.users.employers')) ? '' : 'collapsed' }}"
      href="#" data-toggle="collapse" data-target="#users" aria-expanded="true" aria-controls="users">
      <i class="fas fa-fw fa-users"></i>
      <span>Manage Users</span>
    </a>
    <div id="users"
      class="collapse {{ (Route::is('admin.users.candidates') || Route::is('admin.users.employers')) ? 'show' : '' }}"
      aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Manage Users</h6>
        <a class="collapse-item" href="{{ route('admin.users.candidates') }}">All Candidates</a>
        <a class="collapse-item" href="{{ route('admin.users.employers') }}">All Employers</a>
      </div>
    </div>
  </li>

  <li
    class="nav-item {{ (Route::is('admin.templates.index') || Route::is('admin.templates.edit') || Route::is('admin.templates.show') || Route::is('admin.templates.create')) ? 'active' : '' }}">
    <a class="nav-link  {{ (Route::is('admin.templates.index') || Route::is('admin.templates.edit') || Route::is('admin.templates.show') || Route::is('admin.templates.create')) ? '' : 'collapsed' }}"
      href="#" data-toggle="collapse" data-target="#templates" aria-expanded="true" aria-controls="templates">
      <i class="fas fa-fw fa-th"></i>
      <span>Job Templates</span>
    </a>
    <div id="templates"
      class="collapse {{ (Route::is('admin.templates.index') || Route::is('admin.templates.edit') || Route::is('admin.templates.show') || Route::is('admin.templates.create')) ? 'show' : '' }}"
      aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Manage templates</h6>
        <a class="collapse-item   {{ (Route::is('admin.templates.index') || Route::is('admin.templates.edit') || Route::is('admin.templates.show')) ? 'active' : '' }}"
          href="{{ route('admin.templates.index') }}">All Templates</a>
        <a class="collapse-item {{ ( Route::is('admin.templates.create')) ? 'active' : '' }}"
          href="{{ route('admin.templates.create') }}">Add New Template</a>
      </div>
    </div>
  </li>


  <li
    class="nav-item {{ (Route::is('admin.crawlers.index') || Route::is('admin.crawler_sites.index')) ? 'active' : '' }}">
    <a class="nav-link  {{ (Route::is('admin.crawlers.index') || Route::is('admin.crawler_sites.index')) ? '' : 'collapsed' }}"
      href="#" data-toggle="collapse" data-target="#crawlers" aria-expanded="true" aria-controls="crawlers">
      <i class="fas fa-fw fa-tasks"></i>
      <span>Job Crawler</span>
    </a>

    <div id="crawlers"
      class="collapse {{ (Route::is('admin.crawlers.index') || Route::is('admin.crawler_sites.index') || Route::is('admin.sites.assign') || Route::is('admin.sites.asignSiteList') || Route::is('admin.crawl.extractLinks') || Route::is('admin.crawl.extractLinks.store')) ? 'show' : '' }}"
      aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Manage Crawler</h6>

        <a class="collapse-item" href="{{ route('admin.crawlers.index') }}">Add URL</a>
        <a class="collapse-item" href="{{ route('admin.crawler_sites.index') }}">Add Site</a>
        <a class="collapse-item" href="{{ route('admin.sites.assign') }}">Assign Site</a>
        <a class="collapse-item" href="{{ route('admin.crawl.extractLinks') }}">Extract Links</a>

      </div>
    </div>

  </li>


  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.settings.index') }}">
      <i class="fas fa-fw fa-cog"></i>
      <span>Settings</span></a>
  </li>


  <!-- Divider -->
  {{--  <hr class="sidebar-divider d-none d-md-block">  --}}

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->