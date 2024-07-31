<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{ route('dashboard.'. Auth::user()->role) }}" class="app-brand-link">
        <img src="{{ asset('assets/img/logo-kfi.png') }}" width="150" alt="">
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item @yield('dashboard')">
        <a href="{{ route('dashboard.' . Auth::user()->role) }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>
      @if (Auth::user()->role == 'admin')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Admin</span>
      </li>
      <li class="menu-item @yield('planing')">
        <a href="{{ route('planing.admin') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-task"></i>
          <div data-i18n="Account Settings">Planing</div>
        </a>
      </li>
      <li class="menu-item @yield('loading')">
        <a href="{{ route('loading.admin') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-chalkboard"></i>
          <div data-i18n="Account Settings">Loading</div>
        </a>
      </li>
      <li class="menu-item @yield('packing')">
        <a href="{{ route('packing.admin') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-box"></i>
          <div data-i18n="Account Settings">Packing</div>
        </a>
      </li>
        <li class="menu-item @yield('report')">
            <a href="{{ route('report.admin') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bxs-report"></i>
            <div data-i18n="Account Settings">Daily Report</div>
            </a>
        </li>
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">management</span>
      </li>
      <li class="menu-item @yield('user')">
        <a href="{{ route('user.admin') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div data-i18n="Account Settings">User</div>
        </a>
      </li>
      @endif
      @if (Auth::user()->role == 'loading')
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Planing</span>
        </li>
        <li class="menu-item @yield('planing')">
            <a href="{{ route('planing.loading') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-task"></i>
              <div data-i18n="Account Settings">Planing</div>
            </a>
          </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Loading</span>
        </li>
        <li class="menu-item @yield('loading')">
            <a href="{{ route('operator.loading') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-chalkboard"></i>
            <div data-i18n="Account Settings">Data</div>
            </a>
        </li>
        <li class="menu-item @yield('hanger')">
            <a href="{{ route('operator.loading.hanger') }}" class="menu-link">
            <i class="menu-icon bx bx-shape-triangle"></i>
            <div data-i18n="Account Settings">Hanger</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Report</span>
        </li>
        <li class="menu-item @yield('printag')">
            <a href="{{ route('printag.loading') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bar-chart"></i>
                <div data-i18n="Account Settings">Print Tag</div>
            </a>
        </li>
        <li class="menu-item @yield('report')">
            <a href="{{ route('report.loading') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-report"></i>
              <div data-i18n="Account Settings">Daily Report</div>
            </a>
        </li>
      @endif
      @if (Auth::user()->role == 'packing')
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Planing</span>
        </li>
        <li class="menu-item @yield('planing')">
            <a href="{{ route('planing.packing') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-task"></i>
              <div data-i18n="Account Settings">Planing</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Loading</span>
        </li>
        <li class="menu-item @yield('loading')">
            <a href="{{ route('loading.packing') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-chalkboard"></i>
            <div data-i18n="Account Settings">Data</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Packing</span>
        </li>
        <li class="menu-item @yield('packing')">
            <a href="{{ route('operator.packing') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
            <div data-i18n="Account Settings">Data</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Report</span>
        </li>
        <li class="menu-item @yield('printag')">
            <a href="{{ route('printag.packing') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bar-chart"></i>
                <div data-i18n="Account Settings">Print Tag</div>
            </a>
        </li>
        <li class="menu-item @yield('report')">
            <a href="{{ route('report.packing') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-report"></i>
              <div data-i18n="Account Settings">Daily Report</div>
            </a>
        </li>
      @endif
    </ul>
  </aside>
