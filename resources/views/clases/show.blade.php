@extends('layouts.app')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				
							<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"> Detail {{ $clase->name}}</h2>
							</div>
							<div class="panel-body">
							<table class="table table-condensed table-striped">
								<tr>
									<td>Kelas</td>
									<td>:</td>
									<td>{{ $clase->name }}</td>
								</tr>
								<th colspan="3"><a href="{{route('clases.edit', $clase->id)}}"><span class="btn btn-primary">Edit</span></a></th>
							</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection