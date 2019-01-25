@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li><a href="{{ url('/admin/dendas') }}">Denda</a></li>
					<li class="active">Ubah Denda</li>
				</ul>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2 class="panel-title">Ubah Denda</h2>
						</div>
							<div class="panel-body">
								{!! Form::model($denda, ['url' => route('dendas.update', $denda->id),
								'method'=>'put', 'class'=>'form-horizontal']) !!}
								@include('dendas._form')
								{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection