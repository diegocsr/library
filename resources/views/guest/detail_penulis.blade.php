@extends('layouts.app')
  @section('content')

  <style type="text/css">
    .form-option{
      position: relative;
    }
    .nene{
      position: absolute;
      top: 0px;
    }
    .dipinjam{
      padding: 12px 20px;
      border-radius: 5px;
      color: white;
      font-weight: 600;
      text-align: center;
      position: absolute;
      right: 0;
      width: 220px;
      background-color: #5d4199;
    }
  </style>

    <div class="container-fluid bg-books">
      <div class="detail-box">
        <div class="row">
          <div class="col-md-3">
                  <img src="{{ $book->photo_path }}" class="imgef" id="scream"> 
            <!-- {!! Html::image(asset('img/'.$book->cover),null,['class'=> 'imgef','id' => 'scream']) !!} -->
          </div>  
          
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-6">
                <p class="grey">Judul buku</p>
                <h1 class="dt-title">{{ $book->title }}</h1>
                <p class="grey">Nama penulis</p>
                <h1 class="dt-title">{{ $book->author->name }}</h1>
              </div>
              <div class="col-md-6">
                @if ($book->stock > 0 )
                  {!! Form::open(['url' => route('guest.books.borrow'), 'method' => 'put','class'=>'form-horizontal']) !!}
                  <div class="col-md-6">
                    {!! Form::select('code_id',$b->pluck('code_book','code_book'), null, [
                      'class'=>'js-selectize',
                      'placeholder' => 'Pilih kode buku']) !!}
                  </div>
                  <div class="col-md-6">
                    {!! Form::submit('Pinjam Buku', ['class'=>'bon-bon nene']) !!}
                  </div>
                  {!! Form::close() !!}
                @else  
                <p class="dipinjam">Semua Buku Sedang Dipinjam</p>
                @endif
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <p class="grey">Sinopsis buku</p>
              <p>{{$book->synopsis}}.</p>
              <hr>
              <p class="kater">Kategori <span class="gori">{{ $book->category->name }}</span> Letak rak buku <span class="gori">{{ $book->place->name }}</span></p>
              <span class="strok">{{$book->stock}}</span><span class="boke-stock">Sisa stok buku</span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
          </div>
        </div>

        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row rules">
        <h2 class="text-thin title-rule text-center">Peraturan <span class="text-bold">peminjaman</span>
          <span class="text-bold">buku</span> perpustakaan
        </h2>
        <div class="col-md-6">
          <ul class="detail-rule">
            <li>Pada waktu meminjam  buku, kartu  anggota perpustakaan SD Negeri 1 Karangkobar harus dibawa.</li>
            <li>Setiap anggota berhak meminjam maksimal 3 buku.</li>
            <li>1 (satu) kali peminjaman selama {{$denda->jth_tempo}} hari.</li>
            <li>1 (satu) hari sebelum jatuh tempo peminjam, bisa diperpanjang 1 kali masa pinjam.</li>
          </ul>
        </div>
        <div class="col-md-6">
          <ul class="detail-rule">
          <li>Melebihi batas waktu peminjaman dikenakan sanksi / denda per hari per buku Rp {{$denda->denda}}.</li>
          <li>Kerusakan / kehilangan buku menjadi resiko peminjam.</li>
          <li>Kartu  hanya berlaku untuk pemegang hak selama 1 tahun</li>
          <li>Bagi guru / karyawan lama pinjam buku maksimal 1 bulan.</li>
          </ul>
        </div>
      </div>

      <div class="row">
        <h3 class="text-center title-lain">Buku lain dari {{ $book->author->name }}</h3>
        <div class="bg-kontan">
          @foreach ($book->author->books as $book)
            <div class="col-md-3">
          @include('guest._book-thumbnail', ['book' => $book])
            </div>
          @endforeach
      </div>
      </div>

    </div>


@endsection
