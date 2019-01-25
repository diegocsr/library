<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Code;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;
use App\Book;
use App\BorrowLog;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\BookException;
use Excel;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade as PDF;
use Validator;
use App\Author;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
        {
            if ($request->ajax()) {
        $codes = Code::with('book');
            return Datatables::of($codes)
            ->addColumn('action', function($code){
                return view('datatable._action', [
                    'model'     => $code,
                    'form_url'  => route('codes.destroy', $code->id),
                    'edit_url'  => route('codes.edit', $code->id),
                    'show_url'  => route('codes.show', $code->id),
                    'confirm_message' => 'Yakin mau menghapus '. $code->code_book. '?'
                    ]);
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'code_book', 'name'=>'code_book', 'title'=>'Kode Buku'])
            ->addColumn(['data' => 'book.title', 'name'=>'book.title', 'title'=>'Nama Buku'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);   
            return view('codes.index')->with(compact('html'));
        }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['code_book' => 'required|unique:codes','book_id' => 'required|exists:books,id']);
        $code = Code::create($request->all());
        
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $code->code_book"
        ]);
        return redirect()->route('codes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $code = Code::find($id);
        return view('codes.show', compact('code'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $code = Code::find($id);
        return view('codes.edit')->with(compact('code'));
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
        $this->validate($request, ['code_book' => 'required|unique:codes','book_id' => 'required|exists:books,id'.$id]);
        $code = Code::find($id);
        $code->update($request->all());

        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Berhasil menyimpan $code->code_book"
            ]);
        return redirect()->route('codes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Code::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Kode Buku berhasil dihapus"
            ]);
        return redirect()->route('codes.index');
    }
    
        public function returnBack($code_id)
    {
        $borrowLog = BorrowLog::where('user_id', Auth::user()->id)
        ->where('code_id', $code_id)
        ->where('is_returned', 0)
        ->first();

        if ($borrowLog){
            $borrowLog->is_returned = true;
            $borrowLog->save();

        Session::flash("flash_notification", [
        "level"     => "success",
        "message"   => "Berhasil mengembalikan " . $borrowLog->code->book->title
        ]);
        }

        return redirect('/home');
    }
    public function borrow(Request $request) 
    { 
        $this->validate($request, [
                    'code_id'  => 'required'
                ]);
        $a = $request->code_id;

                $jos = Code::where('code_book',$a)->first();
                    $code = BorrowLog::create([
                        'code_id'=>$jos->id,
                        'user_id'=>Auth::user()->id]);

                    Session::flash("flash_notification", [ "level"=>"success", "message"=>"Berhasil meminjam $code->book->title" ]); 
                return redirect('/home');
    }


    public function generateExcelTemplate()
    {
        Excel::create('Template import Kode Buku', function($excel){
            // set the properties
            $excel->setTitle('Template import Kode Buku')
            ->setCreator('SIP')
            ->setCompany('SIP')
            ->setDescription('Template import kode buku untuk SIP');

            $excel->sheet('Data Kode Buku', function($sheet){
                $row = 1;
                $sheet->row($row, [
                    'buku',
                    'kode_buku'
                    ]);
                });
            })->export('xlsx');
    }

    public function importExcel(Request $request)
    {
        // validasi untuk memastikan file yang diupload adalah excel
        $this->validate($request, [ 'excel' => 'required|mimes:xlsx' ]);
        // ambil file yang baru diupload
        $excel = $request->file('excel');
        // baca sheet pertama
        $excels = Excel::selectSheetsByIndex(0)->load($excel, function($reader) {
            // options, jika ada
        })->get();

        // rule untuk validasi setiap row pada file excel
        $rowRules = [
            'buku'     => 'required',
            'kode_buku'   => 'required'
        ];

        // Catat semua id buku baru
        // ID ini kita butuhkan untuk menghitung total buku yang berhasil di import
        $codes_id = [];

        // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang di proses menjadi array
            $validator = Validator::make($row->toArray(), $rowRules);

            // Skip baris ini jika tidak valid, langsung ke baris selanjutnya
            if ($validator->fails()) continue;

            // Syntax dibawah dieksekusi jika baris excel ini valid

            // Cek apakah Penulis sudah terdaftar di database
            $books = Book::where('title', $row['buku'])->first();
            $code = Code::where('code_book', $row['kode_buku'])->first();
            // buat penulis jika belum ada
            if (!$code) {
                $code = Code::create([  
                'code_book'      => $row['kode_buku'],              
                'book_id'        => $books->id
                ]);
            }
            

            // buat buku baru


            // catat id dari buku yang baru dibuat
            array_push($codes_id, $code->id);
        }
    

        // Ambil semua buku yang baru dibuat
        $codes = Code::whereIn('id', $codes_id)->get();

        // redirect ke form jika tidak ada buku yang berhasil diimport
        if ($codes->count() == 0) {
            Session::flash("flash_notification", [
                "level"   => "danger",
                "message" => "Tidak ada buku yang berhasil diimport."
            ]);
            return redirect()->back();
        }

        // set feedback
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Berhasil mengimport " . $codes->count() . " kode buku."
        ]);

        // Tampilkan index buku
        // return redirect()->route('admin.books.index');
        //return redirect()->route('books.index');

        // Tampilkan halaman review buku
        return view('codes.import-review')->with(compact('codes'));
   }
}
