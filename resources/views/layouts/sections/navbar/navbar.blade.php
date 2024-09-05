@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
$containerNav = ($configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
        <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-6">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            {{-- <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
            <span class="app-brand-text demo menu-text fw-semibold">{{config('variables.templateName')}}</span> --}}
            <img src="{{Storage::url(App\Services\SettingService::getSetting('site_logo'))}}">
          </a>
          @if(isset($menuHorizontal))
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
              <i class="ri-close-fill align-middle"></i>
            </a>
          @endif
        </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
          <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="ri-menu-fill ri-22px"></i>
          </a>
        </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        {{-- @if(!isset($menuHorizontal))
        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item navbar-search-wrapper mb-0">
            <a class="nav-item nav-link search-toggler fw-normal px-0" href="javascript:void(0);">
              <i class="ri-search-line ri-22px scaleX-n1-rtl me-3"></i>
              <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
            </a>
          </div>
        </div>
        <!-- /Search -->
        @endif --}}

       <ul class="navbar-nav flex-row align-items-center ms-auto">
          {{-- @if(isset($menuHorizontal))
            <!-- Search -->
            <li class="nav-item navbar-search-wrapper me-1 me-xl-0">
              <a class="nav-link btn btn-text-secondary rounded-pill search-toggler fw-normal" href="javascript:void(0);">
                <i class="ri-search-line ri-22px scaleX-n1-rtl"></i>
              </a>
            </li>
            <!-- /Search -->
          @endif --}}

         

        

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : url('pages/profile-user') }}">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-2">
                      <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-medium d-block small">
                        @if (Auth::check())
                          {{ auth()->user()->name }}
                        @else
                          John Doe
                        @endif
                      </span>
                      <small class="text-muted">Admin</small>
                    </div>
                  </div>
                </a>
              </li>
              {{-- <li>
                <div class="dropdown-divider"></div>
              </li> --}}
              {{-- <li>
                <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : url('pages/profile-user') }}">
                  <i class="ri-user-3-line ri-22px me-3"></i><span class="align-middle">My Profile</span>
                </a>
              </li> --}}

              {{-- @if (Auth::check())
                <li>
                  <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                    <i class="ri-key-2-line ri-22px me-3"></i><span class="align-middle">API Tokens</span>
                  </a>
                </li>
              @endif --}}
              {{-- <li>
                <a class="dropdown-item" href="{{url('pages/account-settings-billing')}}">
                  <span class="d-flex align-items-center align-middle">
                    <i class="flex-shrink-0 ri-file-text-line ri-22px me-3"></i>
                    <span class="flex-grow-1 align-middle">Billing</span>
                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger">4</span>
                  </span>
                </a>
              </li> --}}

             
              <li>
                <div class="dropdown-divider"></div>
              </li>
              @if (Auth::check())
                <li>
                  <div class="d-grid px-4 pt-2 pb-1">
                    <a class="btn btn-sm btn-danger d-flex" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <small class="align-middle">Logout</small>
                      <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                    </a>
                  </div>
                </li>
                <form method="POST" id="logout-form" action="{{ route('logout') }}">
                  @csrf
                </form>
              @else
                <li>
                  <div class="d-grid px-4 pt-2 pb-1">
                    <a class="btn btn-sm btn-danger d-flex" href="{{ Route::has('login') ? route('login') : url('auth/login-basic') }}">
                      <small class="align-middle">Logout</small>
                      <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                    </a>
                  </div>
                </li>
              @endif
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      <!-- Search Small Screens -->
      <div class="navbar-search-wrapper search-input-wrapper {{ isset($menuHorizontal) ? $containerNav : '' }} d-none">
        <input type="text" class="form-control search-input {{ isset($menuHorizontal) ? '' : $containerNav }} border-0" placeholder="Search..." aria-label="Search...">
        <i class="ri-close-fill search-toggler cursor-pointer"></i>
      </div>
      <!--/ Search Small Screens -->
      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <!-- / Navbar -->
