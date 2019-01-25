<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font -->

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/jquery.dataTables.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/selectize.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/selectize.bootstrap3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
<!--     <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
 -->
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<style type="text/css">
  .titleo{
    position: relative;
    top: -9px;
    width: 350px;
  }
</style>
<div id="app">

  <nav class="navigation2">
      <div class="container">
          <div class="nav-left">
              <!-- Branding Image -->
              <a class="navbar-brand" href="{{ url('/homepage') }}">
                 <!-- <div class="titleo"><i class="fa fa-home"></i>SIP</div> -->
                 <img class="titleo" src="/image/goo.png" alt="">
              </a>
          </div>

          <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <!-- Left Side Of Navbar -->
              <ul class="nav navbar-nav">


              </ul>
              <!-- Right Side Of Navbar -->
              <div class="nav-right2">
                  <!-- Authentication Links -->
                  @if (Auth::guest())
                      <li><a href="{{ url('semua_buku') }}">Katalog</a></li>
                      <li><a href="{{ url('/panduan') }}">Panduan</a></li>
                      <li><a href="{{ url('/login') }}" class="login">Masuk</a></li>
                  @else

                  @role('member')
                  <li><a href="{{ url('semua_buku') }}">Katalog</a></li>
                  @endrole

                  @if (Auth::check())
                  <li><a href="{{ url('/home') }}">Dashboard</a></li>
                  @endif
                  @role('admin')
                  <li><a href="{{ route('authors.index') }}">Penulis</a></li>
                  <li><a href="{{ route('categories.index')}}">Kategori</a></li>
                  <li><a href="{{ route('places.index')}}">Rak</a></li>
                  <li><a href="{{ route('books.index') }}">Buku</a></li>
                  <li><a href="{{ route('codes.index') }}">Kode Buku</a></li>
                  <li><a href="{{ route('dendas.index') }}">Denda</a></li>
                  <li><a href="{{ route('statistics.index') }}">Peminjam</a></li>
                  <li><a href="{{ route('clases.index') }}">Kelas</a></li>
                  <li><a href="{{ route('members.index') }}">Member</a></li>
                  @endrole
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>
                          
                          <!-- Dropdown menu -->
                          <ul class="dropdown-menu">
                          <li>
                          <a style="color:#999999;" href="{{ url('/home') }}">
                          Lihat Profil
                          </a>
                          </li>
                          <li>
                            <a style="color:#999999;" href="{{ url('/settings/profile/edit') }}">
                            Update Profil
                            </a>
                          </li>
                          <li>
                            <a style="color:#999999;" href="{{ url('/settings/password') }}">
                            Ubah Password
                            </a>
                          </li>
                          <li>
                            <hr>
                          </li>
                              <li>
                                  <a href="{{ url('/logout') }}"
                                      onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                      Logout
                                  </a>

                                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                  </form>
                              </li>
                          </ul>
                          <!-- Dropdown menu -->

                      </li>
                  @endif
              </div>
          </div>
      </div>
  </nav>

        @include('layouts._flash')
        @yield('content')

        <footer>
          <div class="container-fluid">
            <div class="row foobar">
              <div class="col-md-9">
                <span class="copr">Sistem Informasi Perpustakaan | SD Negeri 1 Karangkobar | All Right Reserved</span>
              </div>
              <div class="col-md-3 text-right">
                <a href="{{ url ('panduan') }}"><span class="btn-panduan">Panduan pengguna</span></a>
              </div>
            </div>
          </div>
        </footer>


        <!-- Scripts -->
        <script src="/js/jquery-3.1.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery.dataTables.min.js"></script>
        <script src="/js/dataTables.bootstrap.min.js"></script>
        <script src="/js/selectize.min.js"></script>
        <script src="/js/custom.js"></script>
        @yield('scripts')

        </body>
        </html>
