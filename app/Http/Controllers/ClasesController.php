<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clase;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;
use App\User;

class ClasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
        {
            if ($request->ajax()) {
        $clases = Clase::select(['id', 'name']);
            return Datatables::of($clases)
            ->addColumn('action', function($clase){
                return view('datatable._action', [
                    'model'     => $clase,
                    'form_url'  => route('clases.destroy', $clase->id),
                    'edit_url'  => route('clases.edit', $clase->id),
                    'show_url'  => route('clases.show', $clase->id),
                    'confirm_message' => 'Yakin mau menghapus '. $clase->name. '?'
                    ]);
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);   
            return view('clases.index')->with(compact('html'));
        }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:clases']);
        $clase = Clase::create($request->only('name'));
        
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $clase->name"
        ]);
        return redirect()->route('clases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clase = Clase::find($id);
        return view('clases.show', compact('clase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clase = Clase::find($id);
        return view('clases.edit')->with(compact('clase'));
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
        $this->validate($request, ['name'=>'required|unique:clases,name,'.$id]);
        $clase = Clase::find($id);
        $clase->update($request->only('name'));

        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Berhasil menyimpan $clase->name"
            ]);
        return redirect()->route('clases.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Clase::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Kategori berhasil dihapus"
            ]);
        return redirect()->route('clases.index');
    }
    
}
