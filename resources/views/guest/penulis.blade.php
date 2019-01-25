@extends('layouts.app')

  @section('content')

    <div class="container-fluid hone">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="head-book">
            <h1 class="head-stock">Penulis Buku</h1>
            <p class="tito">Berikut daftar penulis buku</p>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid bg-books">
      <div class="penulis-box">
        @foreach (App\Author::all() as $author)
        <div class="row">
          <div class="col-md-10 bolgh">
            <h2 class="penulis-name">{{ $author->name }}</h2>
            <h4 class="jumlah-buku grey">Jumlah buku : {{$author->books->count()}}</h4>
            <hr class="hair">
          </div>
          <div class="col-md-2">
            <a class="lihat-bukus" href="{{route('guest.show_penulis', $author->id)}}">Lihat Buku Penulis</a>
          </div>
        </div>
        @endforeach
      </div>

        <div class="row">
					<div class="col-md-12 text-center">
							{{-- {!! $author->links() !!} --}}
					</div>
				</div>

    </div>
  @endsection
