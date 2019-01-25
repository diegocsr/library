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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
<div class="container-fluid login-bg">

  <nav class="navigation">
      <div class="container">
          <div class="nav-left">
              <!-- Branding Image -->
              <a class="navbar-brand" href="{{ url('/homepage') }}">
                 <img class="logos" src="/image/logo-sikap.png" alt="">
              </a>
          </div>

          <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <!-- Left Side Of Navbar -->
              <ul class="nav navbar-nav">

                  @role('admin')
                  <li><a href="{{ route('authors.index') }}">Penulis</a></li>
                  <li><a href="{{ route('books.index') }}">Buku</a></li>
                  <li><a href="{{ route('members.index') }}">Member</a></li>
                  <li><a href="{{ route('statistics.index') }}">Peminjam</a></li>
                  @endrole

                  @if (Auth::check())
                  <li><a href="{{ url('/settings/profile') }}">Profil</a></li>
                  @endif

              </ul>
              <!-- Right Side Of Navbar -->
              <div class="nav-right">
                  <!-- Authentication Links -->
                  @if (Auth::guest())
                      <li><a href="{{ url('semua_buku') }}">Katalog</a></li>
                      <li><a href="{{ url('/panduan') }}">Panduan</a></li>
                      <li><a href="{{ url('/login') }}" class="login">Masuk</a></li>
                  @else

                  @role('member')
                  <li><a href="{{ url('semua_buku') }}">Koleksi Semua Buku</a></li>
                  @endrole

                  @if (Auth::check())
                  <li><a href="{{ url('/home') }}">Dashboard</a></li>
                  @endif
                  @role('admin')
                  <li><a href="{{ route('authors.index') }}">Penulis</a></li>
                  <li><a href="{{ route('books.index') }}">Buku</a></li>
                  <li><a href="{{ route('members.index') }}">Member</a></li>
                  <li><a href="{{ route('statistics.index') }}">Peminjam</a></li>
                  @endrole
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu" role="menu">
                          <li><a href="{{ url('/settings/password') }}"><i class="fa fa-btn fa-lock"></i> Ubah Password</a></li>
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
                      </li>
                  @endif
              </div>
          </div>
      </div>
  </nav>

    <div class="row login-boxy">
        <div class="col-md-6 col-md-offset-1">
                <div class="panel-box">
                    {!! Form::open(['url'=>'login', 'class'=>'form-horizontal'])!!}

                    <div class="form-group{{ $errors->has('email')? 'has-error' : '' }}">
                    {!! Form::label('email', 'Alamat Email', ['class'=>'col-md-12 ctrl-label']) !!}
                    <div class="col-md-6">
                        {!! Form::email('email',null,['class'=>'search-form2'])!!}
                        {!! $errors->first('email','<p class="help-block">:message</p>')!!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password')? 'has-error' : '' }}">
                        {!! Form::label('password', 'Password', ['class'=>'col-md-12 ctrl-label']) !!}
                        <div class="col-md-6">
                            {!! Form::password('password',['class'=>'search-form2']) !!}
                            {!! $errors->first('password','<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <div class="col-md-6 ">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('remember') !!} Ingat saya
                                </label>
                            </div>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <div class="col-md-6">
                            <button type="submit" class="btn-main">
                                Masuk<i class="fa fa-chevron-right space"></i>
                            </button>
                                <a class="forgots" href="{{ url('/password/reset') }}" >Lupa password</a>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-7">
                      <hr style="margin-bottom:5px;">
                        <span class="inf">Apabila belum mempunyai akun silahkan daftar <a href="{{ url('/register') }}" style="color:#0abbed;text-decoration:underline;">disini</a></span>
                      </div>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

<footer>
  <div class="container-fluid">
    <div class="row foobar">
      <div class="col-md-10">
        <span class="copr">Sistem Informasi Katalog Perpustakaan | SD Negeri 1 Karangkobar | All Right Reserved</span>
      </div>
      <div class="col-md-2 text-right">
        <a href="#"><span class="btn-panduan">Panduan pengguna</span></a>
      </div>
    </div>
  </div>
</footer>


</div>

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
