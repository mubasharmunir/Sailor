<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
    {{-- <title>@yield('title')</title> --}}
      <h1 class="logo me-auto"></h1>
      <main id="main">
        <!-- ======= Breadcrumbs ======= -->

      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{route('dashboard')}}" class="active">Home</a></li>
          <li><a href="{{route('form')}}">From</a></li>
          <li><a href="{{route('jquery')}}">JQuery List</a></li>
          <li><a href="{{route('country')}}">Country List</a></li>
          <li><a href="{{route('city')}}">City List</a></li>
          <li><a href="{{route('blog')}}">Blog</a></li>
          <li><a href="{{route('contact')}}">Contact</a></li>
          <li><a href="{{route('list')}}">List</a></li>
          <li>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->
    </div>

</header>
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
       <div class="d-flex justify-content-between align-items-center"></div>
     </div>
  </section>

