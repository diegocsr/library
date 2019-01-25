<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
  {!! Form::label('title', 'Judul', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('author_id') ? 'has-error' : '' !!}">
  {!! Form::label('author_id', 'Penulis', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
   {!! Form::select('author_id', [''=>'']+App\Author::pluck('name','id')->all(), null, [
  'class'=>'js-selectize','placeholder' => 'Pilih Penulis']) !!}
    {!! $errors->first('author_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group {!! $errors->has('category_id') ? 'has-error' : '' !!}">
  {!! Form::label('category_id', 'Kategori', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
   {!! Form::select('category_id', [''=>'']+App\Category::pluck('name','id')->all(), null, [
   'class'=>'js-selectize',
   'placeholder' => 'Pilih Kategori']) !!}
    {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('editions') ? ' has-error' : '' }}">
  {!! Form::label('editions', 'Terbitan', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
        {!! Form::selectRange('editions', 1800,3000 , null,['class'=>'js-selectize','placeholder' => 'Pilih Tahun Terbit']) !!}
        {!! $errors->first('editions', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('place_id') ? 'has-error' : '' !!}">
  {!! Form::label('place_id', 'Tempat', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
   {!! Form::select('place_id', [''=>'']+App\Place::pluck('name','id')->all(), null, [
  'class'=>'js-selectize',
  'placeholder' => 'Pilih Tempat']) !!}
    {!! $errors->first('place_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('synopsis') ? ' has-error' : '' }}">
  {!! Form::label('synopsis', 'Synopsis', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
        {!! Form::textarea('synopsis', null, ['class'=>'form-control']) !!}
        {!! $errors->first('synopsis', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
  {!! Form::label('cover', 'Cover', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
        {!! Form::File('cover') !!}
        @if (isset($book)&& $book->cover)
        <p>
            {!! Html::image(asset('img/'.$book->cover), null, ['class'=> 'img-rounded img-responsive']) !!}
        </p>
        @endif
        {!! $errors->first('cover', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4 col-md-offset-2">
        {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
    </div>
</div>