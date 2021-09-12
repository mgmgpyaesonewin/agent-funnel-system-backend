<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/vendors.min.css')) }}">

{{-- Vendor Styles --}}
  @yield('vendor-style')
{{-- Theme Styles --}}

<link rel="stylesheet" href="{{ asset(mix('css/bootstrap.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/bootstrap-extended.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/colors.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/components.css')) }}">

@php
  $configData = Helper::applClasses();
@endphp

@if($configData['mainLayoutType'] === 'horizontal')
  <link rel="stylesheet" href="{{ asset(mix('css/core/menu/menu-types/horizontal-menu.css')) }}">
@endif

<link rel="stylesheet" href="{{ asset(mix('css/core/menu/menu-types/vertical-menu.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/core/colors/palette-gradient.css')) }}">

{{-- Page Styles --}}
  @yield('page-style')
{{-- Laravel Style --}}

<link rel="stylesheet" href="{{ asset(mix('css/custom-laravel.css')) }}">
