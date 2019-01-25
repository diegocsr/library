@extends('layouts.app')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				
							<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"> Detail {{ $author->name}}</h2>
							</div>
							<div class="panel-body">
							<table class="table table-condensed table-striped">
								{{-- <tr>
										<th rowspan="8" class="table-img">{!! Html::image(asset('img/'.$author->cover),null,['class'=> 'img-rounded img-responsive img-pas']) !!}</th>
									<th colspan="3">Keterangan</th>
								 --}}</tr>
								<tr>
									<td>Penulis</td>
									<td>:</td>
									<td>{{ $author->name }}</td>
								</tr>
								<th colspan="3"><a href="{{route('authors.edit', $author->id)}}"><span class="btn btn-primary">Edit</span></a></th>
							</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection