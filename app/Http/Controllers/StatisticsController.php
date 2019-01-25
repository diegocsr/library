<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Facades\Datatables;
use App\BorrowLog;
use Session;
class StatisticsController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
    	if($request->ajax()){
    		$stats = BorrowLog::with('code','user','book');
    		if ($request->get('status') == 'returned') $stats->returned();
			if ($request->get('status') == 'not-returned') $stats->borrowed();
    		return Datatables::of($stats)
    		->addColumn('returned_at', function($stat){
    			if($stat->is_returned){
    				return $stat->updated_at->format('Y-M-D');
    			}
    			return '<a class="btn btn-xs btn-danger" href="'.route('statistics.return', $stat->id).'">Kembalikan</a>';
    			})->make(true);
        }
    	$html = $htmlBuilder
    	->addColumn(['data' => 'code.code_book', 'name'=>'code.code_book', 'title'=>'Kode Buku'])
    	->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Peminjam'])
    	->addColumn(['data' => 'created_at', 'name'=>'created_at', 'title'=>'Tanggal Pinjam'])
    	->addColumn(['data' => 'returned_at', 'name'=>'returned_at', 'title'=>'Tanggal Kembali']);

    	return view('statistics.index')->with(compact('html'));
    	
    }


    public function returnBack($id)
    {
        $borrowLog = BorrowLog::find($id);
        if ($borrowLog){
            $borrowLog->is_returned = true;
            $borrowLog->save();

        Session::flash("flash_notification", [
        "level"     => "success",
        "message"   => "Berhasil mengembalikan " . $borrowLog->code->book->title . " pada member " .$borrowLog->user->name
        ]);
        }
        return redirect()->route('statistics.index');
    }

        private function exportPdf()
    {
        $peminjam = BorrowLog::all();
        $pdf = PDF::loadview('pdf.peminjam', compact('peminjam'));
        return $pdf->stream('riwayat.pdf');
    }

}
