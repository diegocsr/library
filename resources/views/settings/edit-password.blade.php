@extends('layouts.app')

@section('content')

  <div class="container-fluid hone">
          <div class="row head-books">
            <div class="col-md-6">
              <h4 class="hellow">
                <span class="del">Perbarui password</span>
                <br>
                Pengaturan password member perpustakaan
              </h4>
            </div>
          </div>
        </div>

  <div class="container-fluid bg-books">
    <div class="row">
        <div class="col-md-12">
            <ul class="breafcrumb">
              <li><a href="{{ url('/home') }}">Dashboard</a></li>
              <li class="active">Ubah Password</li>
            </ul>

          <div class="members-oks">
            {!! Form::open(['url' => url('/settings/password'),  
            'method' => 'post', 'class'=>'form-horizontal']) !!}
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              {!! Form::label('password', 'Password lama', ['class'=>'col-md-4 control-label']) !!}
              <div class="col-md-6">
                {!! Form::password('password', ['class'=>'form-control']) !!}
                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
              {!! Form::label('new_password', 'Password baru', ['class'=>'col-md-4 control-label']) !!}
              <div class="col-md-6">
                {!! Form::password('new_password', ['class'=>'form-control']) !!}
                {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
              {!! Form::label('new_password_confirmation', 'Konfirmasi password baru', ['class'=>'col-md-4 control-label']) !!}
              <div class="col-md-6">
                {!! Form::password('new_password_confirmation', ['class'=>'form-control']) !!}
                {!! $errors->first('new_password_confirmation', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                {!! Form::submit('Simpan', ['class'=>'btn-submit']) !!} 
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
   </div> 
@endsection

