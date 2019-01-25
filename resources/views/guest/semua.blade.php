@extends('layouts.app')
	@section('content')
		<div class="container-fluid hone">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="head-book">
						<h1 class="head-stock">Katalog buku perpustakaan</h1>
						<p class="tito">Berikut adalah koleksi semua buku perpustakaan</p>
					</div>
				</div>
			</div>
		</div>

		
		<div class="container-fluid bg-book">
		{!! Form::open(['url' => '/filter', 'method'=>'get', 'class'=>'']) !!}
			<div class="row selectione">
				<div class="col-md-3 {!! $errors->has('a') ? 'has-error' : '' !!}">
					   {!! Form::select('a', [''=>'Pilih kategori buku']+App\Category::pluck('name','id')->all(), isset($a) ? $a : null, [
					  'class'=>'js-selectize']) !!}
				{!! $errors->first('a', '<p class="help-block">:message</p>') !!}
				</div>
				<div class="col-md-3 {!! $errors->has('p') ? 'has-error' : '' !!}">
					   {!! Form::select('p', [''=>'Pilih rak buku']+App\Place::pluck('name','id')->all(), isset($p) ? $p : null, [
					  'class'=>'js-selectize']) !!}
				{!! $errors->first('p', '<p class="help-block">:message</p>') !!}
				</div>
				<div class="col-md-3 {!! $errors->has('e') ? 'has-error' : '' !!}">
					   {!! Form::select('e', [''=>'Pilih tahun terbit']+App\Book::pluck('editions','editions')->all(), isset($e) ? $e : null, [
					  'class'=>'js-selectize']) !!}
				{!! $errors->first('e', '<p class="help-block">:message</p>') !!}
				</div>
				<div class="col-md-3">
				{!! Form::submit('Submit', ['class'=>'btn-submit']) !!}
				{!! Form::close() !!}
				</div>
				
			</div>

				<div class="row">
						@foreach ($books as $book)
							<div class="col-md-3">
						@include('guest._book-thumbnail', ['book' => $book])
							</div>
						@endforeach
				</div>
				
		 <div class="col-md-12 text-center">
          @if (isset($q))
          <h1>:(</h1>
          <p>Buku yang kamu cari tidak ditemukan.</p>
           @endif

 		@if (isset($books))
<!--           <h1>:(</h1>
          <p>Buku yang kamu cari tidak ditemukan.</p> -->
           @endif
				<div class="row">
					<div class="col-md-12 text-center">
							{!! $books->links() !!}
					</div>
				</div>
				</div>
		</div>
@endsection
@section('scripts')
@endsection