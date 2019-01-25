@extends('layouts.app')
    @section('content')

        <div class="container-fluid hone">
          <div class="row head-books">
            <div class="col-md-6">
              <h4 class="hellow">
                <span class="del">Perbarui profil</span>
                <br>
                Pengaturan profil member perpustakaan
              </h4>
            </div>
          </div>
        </div>

        <div class="container-fluid bg-books">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breafcrumb">
                      <li><a href="{{ url('/home') }}">Dashboard</a></li>
                      <li class="active">Ubah Profil</li>
                    </ul>
                          
                <div class="members-okse">
                        <h4 class="intro" style="margin: 10px 0;">Update profil</h4><hr>
                          {!! Form::model(auth()->user(), ['url'=>url('/settings/profile'), 'method'=>'put', 'files'=>'true', 'class'=>'form-horizontal']) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Nama', ['class'=>'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('email', 'Email', ['class'=>'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                        {!! Form::email('email', null, ['class'=>'form-control']) !!}
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('clase_id') ? ' has-error' : '' }}">
                        {!! Form::label('clase_id', 'Kelas', ['class'=>'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                        {!! Form::select('clase_id', [''=>'']+App\Clase::pluck('name','id')->all(), null, ['class'=>'js-selectize','placeholder' => 'Pilih Kelas']) !!}
                        {!! $errors->first('clase_id', '<p class="help-block">:message</p>') !!}
                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                          {!! Form::label('avatar', 'Foto profil', ['class'=>'col-md-2 control-label']) !!}
                          <div class="col-md-4">
                                {!! Form::File('avatar') !!}
                            
                                <p>
                                    {!! Html::image(asset('img/'.Auth::user()->avatar), null, ['class'=> 'img-rounded img-responsive']) !!}
                                </p>
                             
                                {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        

                        <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                        {!! Form::submit('Simpan', ['class'=>'btn-submit']) !!}
                        </div>
                        </div>
                        {!! Form::close() !!}
                </div>
        </div>
    </div>
</div>
@endsection


