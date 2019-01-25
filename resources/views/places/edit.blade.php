@extends('layouts.app')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="{{ url('/home') }}">Dashboard</a></li>
						<li><a href="{{ url('/admin/places') }}">Rak</a></li>
						<li class="active">Ubah Rak</li>
					</ul>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title">Ubah Rak</h2>
							</div>
								<div class="panel-body">
									{!! Form::model($place, ['url' => route('places.update', $place->id),'method'=>'put', 'class'=>'form-horizontal']) !!}
									@include('places._form')
									{!! Form::close() !!}
								</div>
						</div>
				</div>
			</div>
		</div>
@endsection