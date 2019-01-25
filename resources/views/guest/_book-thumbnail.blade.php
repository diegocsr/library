<div class="thumbnail">
  <div class="">
    <a href="{{ route('guest.show', $book->id) }}">
      <img src="{{ $book->photo_path }}" class="img-jos" id="scream"> 
      <!-- {!! Html::image(asset('img/'.$book->cover),null,['class'=> 'img-jos','id' => 'scream']) !!} -->
    </a>
  </div>
  <hr>
  <div class="fug">
    <a href="{{ route('guest.show_penulis', $book->author->id) }}"><h4  class="authore-name" >{{ $book->author->name }}</h4></a>
    <a href="{{ route('guest.show', $book->id) }}"><h3 class="titos">{{ $book->title }}</h3></a>
    <div class="btm-prev">
      <hr class="hrline">
      <p class="ceo">Kategori <span class="category">{{ $book->category->name }}</span></p>
    </div>
  </div>
</div>
