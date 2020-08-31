@php
$configData = Helper::applClasses();
@endphp
<div
  class="main-menu menu-fixed {{($configData['theme'] === 'light') ? "menu-light" : "menu-dark"}} menu-accordion menu-shadow"
  data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto"><a class="navbar-brand" href="#">
          <div><img src="{{asset('images/logo/favicon.png')}}"></div>
          <h1 class="font-medium-2 text-primary mb-0"><br>Agent Funnel System</h1>
        </a></li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      {{-- Foreach menu item starts --}}
      @if(isset($menuData[0]))
      @foreach($menuData[0]->menu as $menu)
      @if(isset($menu->navheader))
      @if($menu->role == 'all' || $menu->role == 'staff' && Auth::user()->partner_id == '')      
      <li class="navigation-header">
        <span>{{ $menu->navheader }}</span>
      </li>
      @endif
      @else
      {{-- Add Custom Class with nav-item --}}
      @php
      $custom_classes = "";
      if(isset($menu->classlist)) {
      $custom_classes = $menu->classlist;
      }
      $translation = "";
      if(isset($menu->i18n)){
      $translation = $menu->i18n;
      }
      @endphp
      @if($menu->role == 'all' || $menu->role == 'staff' && Auth::user()->partner_id == '')   
      <li class="nav-item {{ (request()->is($menu->url)) ? 'active' : '' }} {{ $custom_classes }}">
        <a href="{{ $menu->url }}">
          <i class="{{ $menu->icon }}"></i>
          <span class="menu-title" data-i18n="{{ $translation }}">{{ $menu->name }}</span>
          @if (isset($menu->badge))
          <?php $badgeClasses = "badge badge-pill badge-primary float-right" ?>
          <span
            class="{{ isset($menu->badgeClass) ? $menu->badgeClass.' test' : $badgeClasses.' notTest' }} ">{{$menu->badge}}</span>
          @endif
        </a>
        @if(isset($menu->submenu))
        @include('panels/submenu', ['menu' => $menu->submenu])
        @endif
      </li>
      @endif
      @endif
      @endforeach
      @endif
      {{-- Foreach menu item ends --}}
    </ul>
  </div>
</div>
<!-- END: Main Menu-->