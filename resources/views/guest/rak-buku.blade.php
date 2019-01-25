@extends('layouts.app')

  @section('content')
  <div class="container-fluid hone">
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="head-book">
          <h1 class="head-stock">Rak Koleksi Buku</h1>
        </div>
      </div>
    </div>
  </div>
    <div class="container-fluid bg-book">

      <div class="row text-center" style="margin-bottom:40px;">
        <h2>Daftar rak buku perpustakaan</h2>
        <hr style="border: 1px solid #ddd; ">
      </div>
      <div class="row text-center roe">
        @foreach ($place as $place)
          @include('guest._rak-thumbnail', ['place' => $place])
        @endforeach
      </div>

    </div>
  @endsection
