<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
        {
            if ($request->ajax()) {
        $places = Place::select(['id', 'name']);
            return Datatables::of($places)
            ->addColumn('action', function($place){
                return view('datatable._action', [
                    'model'     => $place,
                    'form_url'  => route('places.destroy', $place->id),
                    'edit_url'  => route('places.edit', $place->id),
                    'show_url'  => route('places.show', $place->id),
                    'confirm_message' => 'Yakin mau menghapus '. $place->name. '?'
                    ]);
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);   
            return view('places.index')->with(compact('html'));
        }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:places']);
        $place = place::create($request->only('name'));
        
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $place->name"
        ]);
        return redirect()->route('places.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = place::find($id);
        return view('Places.show', compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = place::find($id);
        return view('places.edit')->with(compact('place'));
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
        $this->validate($request, ['name'=>'required|unique:places,name,'.$id]);
        $place = place::find($id);
        $place->update($request->only('name'));

        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Berhasil menyimpan $place->name"
            ]);
        return redirect()->route('places.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!place::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Kategori berhasil dihapus"
            ]);
        return redirect()->route('places.index');
    }
    
}
