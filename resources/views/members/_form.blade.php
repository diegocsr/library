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
        {!! Form::text('email', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('clase_id') ? ' has-error' : '' }}">
  {!! Form::label('clase_id', 'Kelas', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
        {!! Form::select('clase_id', [''=>'']+App\Clase::pluck('name','id')->all(), null, ['class'=>'js-selectize','placeholder' => 'Pilih Kelas']) !!}
        {!! $errors->first('clase_id', '<p class="help-block">:message</p>') !!}
     </div>
</div>

<div class="form-group">
    <div class="col-md-4 col-md-offset-2">
        {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
    </div>
</div>