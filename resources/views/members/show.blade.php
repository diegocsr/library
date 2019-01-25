@extends('layouts.app')
  @section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li><a href="{{ url('/home') }}">Dashboard</a></li>
            <li><a href="{{ url('/admin/members') }}">Member</a></li>
            <li class="active">Detail {{ $member->name }}</li>
            </ul>
              <div class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title"> Detail {{ $member->name }}</h2>
              </div>
              <div class="panel-body">
              <table class="table table-condensed table-striped">
                <tr>
                  <th rowspan="8" class="table-img">{!! Html::image(asset('img/'.$member->avatar),null,['class'=> 'img-rounded img-responsive img-pas']) !!}</th>
                  <th colspan="3">Keterangan</th>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td>{{ $member->name }}</td>
                </tr>
                <tr>
                  <td>Alamat Email</td>
                  <td>:</td>
                  <td>{{ $member->email }}</td>
                </tr>
                <tr>
                  <td>Kelas</td>
                  <td>:</td>
                  <td> {{ $member->clase->name }}</td>
                </tr>
                <table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection