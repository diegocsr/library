<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Denda;
use Session;

class DendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
        {
            if ($request->ajax()) {
        $dendas = Denda::select(['id', 'denda','jth_tempo']);
            return Datatables::of($dendas)
            ->addColumn('action', function($denda){
                return view('datatable._action', [
                    'model'     => $denda,
                    'form_url'  => route('dendas.destroy', $denda->id),
                    'edit_url'  => route('dendas.edit', $denda->id),
                    'show_url'  => route('dendas.show', $denda->id),
                    'confirm_message' => 'Yakin mau menghapus '. $denda->name. '?'
                    ]);
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'denda', 'name'=>'denda', 'title'=>'Denda(Rp)'])
            ->addColumn(['data' => 'jth_tempo', 'name'=>'jth_tempo', 'title'=>'Waktu Peminjaman(Hari)'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);   
            return view('dendas.index')->with(compact('html'));
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
        $this->validate($request, ['denda' => 'numeric']);
        $this->validate($request, ['jth_tempo' => 'numeric']);
        $denda = Denda::create($request->only('denda','jth_tempo'));
        
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan denda"
        ]);
        return redirect()->route('dendas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $denda = Denda::find($id);
        return view('dendas.show', compact('denda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $denda = Denda::find($id);
        return view('dendas.edit')->with(compact('denda'));
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
        $this->validate($request, ['denda' => 'numeric']);
        $this->validate($request, ['jth_tempo' => 'numeric']);
        $denda = Denda::find($id);
        $denda->update($request->only('denda','jth_tempo'));

        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Berhasil menyimpan denda"
            ]);
        return redirect()->route('dendas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Denda::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Denda berhasil dihapus"
            ]);
        return redirect()->route('dendas.index');
    }
}
