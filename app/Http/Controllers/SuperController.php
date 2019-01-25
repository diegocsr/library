<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Book;
use App\Place;
use App\Author;
use Laratrust\LaratrustFacade as Laratrust;
use Carbon\Carbon;
use App\Code;
use App\BorrowLog;
use App\Denda;

class SuperController extends Controller
{
  public function penulis()
  {
    return view('guest.penulis');
  }

  public function rak_buku()
  {
          $place = Place::paginate(8);
    return view('guest.rak-buku')->with(compact('place'));
  }

  public function show($id)
  {
    $book = Book::find($id);
    $jos = $book->borrowlogs()->returned()->get();
    $a = $book->code()->get();
    $c = $book->code();
    $b = $book->code()->leftJoin('borrow_logs','borrow_logs.code_id', '=', 'codes.id')->where('is_returned', '=', 1)->orwhere('is_returned', '=', null)->where('book_id',$id)->get();
    $denda = Denda::find(1);
    return view('guest.detail_penulis')->with(compact('book','jos','a','b','denda'));
  }

  public function show_place($id)
  {
    $place = Place::find($id);
    return view('guest.show_place')->with(compact('place'));
  }

  public function show_penulis($id)
  {
    $author = Author::find($id);
    return view('guest.show_penulis')->with(compact('author'));
  }

  public function semua_buku()
  {
    return view('guest.semua');
  }

    public function buku()
    {
      $books = Book::paginate(12);
      return view('guest.semua', compact('books'));
    }
}
