<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $books = Book::where('title', 'LIKE', '%'.$q.'%');
        $books = $books->paginate(12);
      
        return view('guest.semua', compact('books','q'));
    }

    public function filter(Request $request)
    {
        $a = $request->get('a');
        $e = $request->get('e');
        $p = $request->get('p');

        $books= Book::all();
       if($request->has('p','e','a')){
            $books = Book::whereCategory_id($a)->where('books.editions', $e)->where('books.place_id',$p)->paginate(12);
       } elseif($request->has('p','a')){
            $books = Book::whereCategory_id($a)->where('books.place_id',$p)->paginate(12);
       } elseif($request->has('e','a')){
            $books = Book::whereCategory_id($a)->where('books.editions', $e)->paginate(12);
       } elseif($request->has('e','p')){
            $books = Book::where('books.editions', $e)->where('books.place_id',$p)->paginate(12);
       } elseif($request->has('a')){
            $books = Book::whereCategory_id($a)->paginate(12);
       } elseif($request->has('p')){
            $books = Book::where('books.place_id',$p)->paginate(12);
       } elseif($request->has('e')){
            $books = Book::where('books.editions', $e)->paginate(12);
       }
       
      
        return view('guest.semua', compact('books','a','p','e'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
