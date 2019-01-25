@extends('layouts.app')
	@section('content')
	<div class="container-fluid hone">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="head-book">
					<h1 class="head-stock">Koleksi Buku - Buku </h1>
					<p class="tito">Pada rak {{ $place->name }} </p>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid bg-book">
			<div class="row">
					@foreach ($place->books as $book)
						<div class="col-md-3">
					@include('guest._book-thumbnail', ['book' => $book])
						</div>
					@endforeach
			</div>

			<div class="row">
				<div class="col-md-12 text-center">
						{{-- {!! $place->links() !!} --}}
				</div>
			</div>
	</div>
@endsection
