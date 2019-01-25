@extends('layouts.app')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="{{ url('/home') }}">Dashboard</a></li>
						<li><a href="{{ url('/admin/books') }}">Buku</a></li>
						<li class="active">Detail {{ $book->title }}</li>
						</ul>
							<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"> Detail {{ $book->title }}</h2>
							</div>
							<div class="panel-body">
							<table class="table table-condensed table-striped">
								<tr>
									<th rowspan="8" class="table-img">{!! Html::image(asset('img/'.$book->cover),null,['class'=> 'img-rounded img-responsive img-pas']) !!}</th>
									<th colspan="3">Keterangan</th>
								</tr>
								<tr>
									<td>Judul</td>
									<td>:</td>
									<td>{{ $book->title }}</td>
								</tr>
								<tr>
									<td>Penulis</td>
									<td>:</td>
									<td>{{ $book->author->name }}</td>
								</tr>
								<tr>
									<td>Kategori</td>
									<td>:</td>
									<td> Kategori {{ $book->category->name }}</td>
								</tr>
								<tr>
									<td>Terbitan</td>
									<td>:</td>
									<td>{{ $book->editions }}</td>
								</tr>
								<tr>
									<td>Tempat Rak</td>
									<td>:</td>
									<td>{{ $book->place->name }}</td>
								</tr>
							</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection