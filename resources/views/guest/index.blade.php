<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIKAP') }}</title>

    <!-- Font -->

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/jquery.dataTables.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/selectize.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/selectize.bootstrap3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style type="text/css">
      .logo-baru{
        width: 340px;
      }
    </style>

</head>
<body>
    <div id="app">

        <header class="container-fluid no-padding">
          <div class="background-header">
          <nav class="navigation">
            <div class="nav-right">
              @if (Auth::check())
              <a href="{{ url('/semua_buku') }}">KATALOG</a>
                <a href="{{ url('/home') }}">dashboard</a>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret careto"></span>
                </a>

                <ul class="dropdown-menu menu-pos" role="menu">
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
                    <a style="color:#999999;" href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                </ul>
              @else
              <a href="{{ url('/semua_buku') }}">KATALOG</a>
              <a href="{{ url('panduan') }}">PANDUAN</a>
              <a href="{{ url('/login') }}" class="login">MASUK</a>
              @endif
            </div>
          </nav>
          <div class="header-content">
            <div class="logo-atas">
              <img class="logo-sekolah" src="/image/logo-sekolah.png" alt="">
              <img class="logo-baru" src="/image/gooo.png" alt="">
            </div>
            <h2 class="quote-top">
              <span class="text-thin tite">Sistem Informasi Perpustakaan</span>
              <span class="text-bold">SD Negeri 1 Karangkobar</span>
            </h2>

            <form class="form-inline" action="/search" method="get">
              <div class="form-group">
                <label class="sr-only" for="exampleInputAmount"></label>
                <div class="fsearch">
                  <input type="search" class="search-form" id="exampleInputAmount" placeholder="Masukkan judul buku" name="q">
                  <div class="search-group"><i class="fa fa-search"></i></div>
                </div>
              </div>
            </form>
            <div class="bottom-title">
              <hr class="hero">
              <h5 class="bottom-quote">Buku adalah sumber ilmu masa depanmu</h5>
            </div>
            <div class="extra-text">
              <hr class="btm-hr">
              <p class="btm-text">Ayo Membaca</p>
              <i class="fa fa-chevron-down fao"></i>
            </div>
          </div>
          </div>
        </header>


        <!-- <a href="{{ url('semua_buku') }}"> -->

        <div class="container section-pad">
          <div class="row row-pad">
            <div class="col-md-6">
              <div class="ctrl-box">
                <span class="subtitle-top">Budayakan membaca buku</span>
                <h1 class="title-big">Pilihan menu</h1>
                <hr class="hr-boo">
                <p class="btm-content">Berikut adalah daftar menu yang dapat dipilih</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="right-gun">
                <div class="list-icon">
                  <a href="{{ url('register') }}">
                  <img class="imges" src="/image/icon-1.png" alt="">
                  <div class="ctn-list">
                    <h2>Daftar Member</h2>
                    <p>Pendaftaran member baru</p>
                  </div>
                </a>
                </div>
                <div class="list-icon">
                  <a href="{{ url('semua_buku') }}">
                  <img class="imges" src="/image/icon-2.png" alt="">
                  <div class="ctn-list">
                    <h2>Katalog Buku</h2>
                    <p>List koleksi buku di perpustakaan</p>
                  </div>
                  </a>
                </div>
                <div class="list-icon">
                  <a href="{{ url('penulis') }}">
                  <img class="imges" src="/image/icon-3.png" alt="">
                  <div class="ctn-list">
                    <h2>Penulis Buku</h2>
                    <p>Lihat daftar penulis buku</p>
                  </div>
                  </a>
                </div>
                <div class="list-icon">
                  <a href="{{ url('rak-buku') }}">
                  <img class="imges" src="/image/icon-4.png" alt="">
                  <div class="ctn-list">
                    <h2>Rak Buku</h2>
                    <p>Lihat koleksi buku menurut rak buku</p>
                  </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <footer>
          <div class="container-fluid">
            <div class="row foobar">
              <div class="col-md-10">
                <span class="copr">Sistem Informasi Perpustakaan | SD Negeri 1 Karangkobar | All Right Reserved</span>
              </div>
              <div class="col-md-2 text-right">
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
