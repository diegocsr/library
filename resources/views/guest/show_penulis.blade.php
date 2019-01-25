@extends('layouts.app')
	@section('content')
	<div class="container-fluid hone">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="head-book">
					<h1 class="head-stock">Koleksi penulis</h1>
					<p class="tito">Berikut adalah daftar buku yang ditulis oleh {{ $author->name }} </p>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid bg-book">
			<div class="row">
					@foreach ($author->books as $book)
						<div class="col-md-3">
					@include('guest._book-thumbnail', ['book' => $book])
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
