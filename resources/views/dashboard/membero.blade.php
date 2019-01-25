@extends('layouts.app')
    @section('content')

        <div class="container-fluid">
          <div class="row nones">

            <div class="col-md-3">
              <h4 class="title-alea">Identitas Pribadi</h4>
              <div class="aleas text-center">
                  <img src="{{ Auth::user()->photo_path }}" class="users-image"> 
                <h3><strong>{{ Auth::user()->name }}</strong></h3>
                <p>Kelas : {{Auth::user()->clase->name }}</p>
                <p>Alamat email : {{Auth::user()->email }}</p>
                <p>Terakhir login :{{ Auth::user()->last_login }}</p>
                <hr style="border: none; height: 2px; background-color: #ddd;">
                <a href="{{ url('/settings/profile/edit') }}"><strong>Ubah Profil Pengguna</strong></a>
              </div>
            </div>

            <div class="col-md-9">
              <h4 class="title-alea">Daftar buku yang dipinjam</h4>
              <div class="jamela">
                <table class="table">
                  <thead style="background-color: #fafafa;">
                    <tr>
                      <td style="width: 100px;"><strong>Cover Buku</strong></td>
                      <td style="width: 250px;"><strong>Judul Buku</strong></td>
                      <td style="width: 120px;"><strong>Kode Buku</strong></td>
                      <td style="width: 120px;"><strong>Pinjam</strong></td>
                      <td style="width: 120px;"><strong>Kembali</strong></td>
                      <td style="width: 150px;"><strong>Denda</strong></td>
                      <td style="width: 60px;"><strong>Status</strong></td>
                    </tr>
                  </thead>
                  <tbody class="table-striped">
                    @foreach ($borrowLogs as $borrowLog)
                    {!! Form::open(['url' => route('member.books.return', $borrowLog->code_id),
                      'method'        => 'put',
                      'class'         => 'form-inline js-confirm',
                      'data-confirm'  => "Anda yakin hendak mengambalikan " . $borrowLog->code->book->title . "?"
                    ]) !!}
                    <tr style="border-bottom: 2px solid #fafafa;">
                      <td>
                      <img src="{{ $borrowLog->code->book->photo_path }}" class="img-controller"> 
                      <!-- {!! Html::image(asset('img/'.$borrowLog->code->book->cover),null,['class'=> 'img-controller book-image']) !!} -->
                       <!-- {!! Html::image(asset('img/'.$borrowLog->code->book->cover), null, ['class'=> 'book-image']) !!} -->
                      </td>
                      <td style="vertical-align: middle;">{{ $borrowLog->code->book->title }}</td>
                      <td style="vertical-align: middle;">{{ $borrowLog->code->code_book }}</td>
                      <td style="vertical-align: middle;">{{ $borrowLog->pinjam }}</td>
                      <td style="vertical-align: middle;">{{ $borrowLog->kembali }}</td>
                      <td style="vertical-align: middle;">{{ $borrowLog->banyakdenda }}</td>
                      <td style="vertical-align: middle;">
                      {!! Form::submit('Kembalikan', ['class'=>'btn-submit']) !!}
                      {!! Form::close() !!}
                      </td>
                      {{-- <hr> --}}
                    </tr>
                    </tbody>
                    @endforeach
                </table>
                @if ($borrowLogs->count() ==0 )
                  <span class=""><i class="fa fa-info-circle alea"></i>Belum ada buku yang kamu dipinjam</span>
                @endif    

              </div>
            </div>
          
          </div>
        </div>

@endsection
