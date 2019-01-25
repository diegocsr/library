<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
use Illuminate\Support\Facades\Auth;
use App\Author;
use App\User;
use App\Clase;
use App\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function home()
    {
      return view('index');
    }

    public function index()
    {
        if (Laratrust::hasRole('admin')) return $this->adminDashboard();
        if (Laratrust::hasRole('member')) return $this->memberDashboard();
        return view('home');
    }

    protected function adminDashboard()
    {
        $authors = [];
        $books   = [];
        foreach (Author::all() as $author){
            array_push($authors, $author->name);
            array_push($books, $author->books->count());
        }

        $class = [];
        $users = [];
        foreach (Clase::all() as $clas){
            array_push($class, $clas->name);
            array_push($users, $clas->user->count());
        }

        $kelas = [];
        $borrow = [];
        $retur = [];
        foreach (Clase::all() as $clas){
            array_push($kelas, $clas->name);
            array_push($borrow, $clas->borrow->count());
            array_push($retur, $clas->retur->count());
        }

        $jumlah = [];
        foreach (Book::all() as $al){
            array_push($jumlah, $al->amount);
        }
        return view('dashboard.admin', compact('authors','books','class','users','borrow','kelas','retur','jumlah'));
    }

    protected function memberDashboard()
    {
        $borrowLogs = Auth::user()->borrowLogs()->borrowed()->get();
        return view('dashboard.membero', compact('borrowLogs'));
    }
}
