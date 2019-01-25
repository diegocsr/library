<div class="form-group{{ $errors->has('denda') ? ' has-error' : '' }}">
  {!! Form::label('denda', 'Jumlah Denda', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
        {!! Form::number('denda', null, ['class'=>'form-control']) !!}
        {!! $errors->first('denda', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('jth_tempo') ? ' has-error' : '' }}">
  {!! Form::label('jth_tempo', 'Lama Peminjaman', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
        {!! Form::number('jth_tempo', null, ['class'=>'form-control']) !!}
        {!! $errors->first('jth_tempo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4 col-md-offset-2">
        {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
    </div>
</div>