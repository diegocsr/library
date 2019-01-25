<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Book;
use App\Code;
use App\BorrowLog;
use Laratrust\LaratrustFacade as Laratrust;

class GuestController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
          $books = Book::with('author');
          return Datatables::of($books)
          ->addColumn('stock', function($book){
          return $book->stock;
        })
          ->addColumn('act', function($book){
          return '<a class="btn btn-xs btn-primary" href="'.route('guest.show', $book->id).'">Lihat</a>';
    })
          ->addColumn('action', function($book){
          if (Laratrust::hasRole('admin')) return '';// jika admin tidak muncul tombol pinjam
          return '<a class="btn btn-xs btn-primary" href="'.route('guest.books.borrow', $book->id).'">Pinjam</a>';
          })->make(true);
      }
        $html = $htmlBuilder
          ->addColumn(['data' => 'title', 'name'=>'title', 'title'=>'Judul'])
          // ->addColumn(['data' => 'stock', 'name'=>'stock', 'title'=>'Stok', 'orderable'=>false, 'searchable'=>false])
          ->addColumn(['data' => 'author.name', 'name'=>'author.name', 'title'=>'Penulis'])
          ->addColumn(['data' => 'act', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false])
          ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
    return view('guest.list-buku')->with(compact('html'));
    }

    public function home(Request $request)
    {
      $a = Code::with('borrowLogs')->get();
      $b = Book::all();
      return view('guest.index')->with(compact('a','b'));
    }

    public function panduan()
    {
      return view('guest.panduan');
    }

    public function show($id)
    {
        $book = Book::find($id);
        return view('guest.show')->with(compact('book'));
    }
}
