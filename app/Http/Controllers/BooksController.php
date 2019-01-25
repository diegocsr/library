<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Book;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\BorrowLog;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\BookException;
use Excel;
use PDF;
use Validator;
use App\Author;
use App\Category;
use App\Place;
use App\Code;
use Carbon\Carbon;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $books = Book::with('author', 'category');//Penggunaan method with() akan meload relasi dari Book ke Author dengan teknik eager loading
          return Datatables::of($books)
                ->addColumn('action', function($book){
                    return view('datatable._action', [
                        'model'           => $book,
                        'form_url'        => route('books.destroy', $book->id),
                        'edit_url'        => route('books.edit', $book->id),
                        'show_url'        => route('books.show', $book->id),
                        'confirm_message' => 'Yakin mau menghapus ' . $book->title . '?',

                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'title', 'name'=>'title', 'title'=>'Judul'])
            ->addColumn(['data' => 'author.name', 'name'=>'author.name', 'title'=>'Penulis'])
            ->addColumn(['data' => 'category.name', 'name'=>'category.name', 'title'=>'Kategori'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);


        return view('books.index')->with(compact('html'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    public function borrow($id)
    {
    try {
            $book = Book::findOrFail($id);
            Auth::user()->borrow($book);
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil meminjam $book->title"
            ]);
        } catch (BookException $e) {
            Session::flash("flash_notification", [
                "level"   => "danger",
                "message" => $e->getMessage()
            ]);
        } catch (ModelNotFoundException $e) {
            Session::flash("flash_notification", [
                "level"   => "danger",
                "message" => "Buku tidak ditemukan."
            ]);
        }

        return redirect('/semua_buku');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
	{
        $book = Book::create($request->except('cover'));
        // isi field cover jika ada cover yang diupload
        if ($request->hasFile('cover')) {
        // Mengambil file yang diupload
        $uploaded_cover = $request->file('cover');
        // mengambil extension file
        $extension = $uploaded_cover->getClientOriginalExtension();
        // membuat nama file random berikut extension
        $filename = md5(time()) . '.' . $extension;
        // menyimpan cover ke folder public/img
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        $uploaded_cover->move($destinationPath, $filename);
        // mengisi field cover di book dengan filename yang baru dibuat
        $book->cover = $filename;
        $book->save();
        }
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $book->title"
        ]);
        return redirect()->route('books.index');
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
         * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('books.show')->with(compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('books.edit')->with(compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::find($id);
        if(!$book->update($request->all())) return redirect()->back();
        
        if ($request->hasFile('cover')) {
            $filename = null;
            $uploaded_cover = $request->file('cover');
            $extension = $uploaded_cover->getClientOriginalExtension();

            // membuat nama file random dengan extension
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';

            // memindahkan file ke folder public/img
            $uploaded_cover->move($destinationPath, $filename);

            // hapus cover lama, jika ada
            if ($book->cover) {
                $old_cover = $book->cover;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                    . DIRECTORY_SEPARATOR . $book->cover;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }

            // ganti field cover dengan cover yang baru
            $book->cover = $filename;
            $book->save();
        }
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $book->title"
        ]);
        return redirect()->route('books.index');
        }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $book = Book::find($id);
        $cover = $book->cover;
        if (!$book->delete()) return redirect()->back();

        //handle hapus buku via ajax
        if ($request->ajax()) return response()->json(['id'=>$id]);

        //hapus cover lama, jika ada
        if ($cover){
            $old_cover = $book->cover;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $book->cover;

            try {
                File::delete($filepath);
            } catch(FileNotFoundException $e){
                //File sudah dihapus/tidak ada
            }
        }



        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Buku berhasil dihapus"
            ]);

        return redirect()->route('books.index');
    }

    public function returnBack($book_id)
    {
        $borrowLog = BorrowLog::where('user_id', Auth::user()->id)
        ->where('book_id', $book_id)
        ->where('is_returned', 0)
        ->first();

        if ($borrowLog){
            $borrowLog->is_returned = true;
            $borrowLog->save();

        Session::flash("flash_notification", [
        "level"     => "success",
        "message"   => "Berhasil mengembalikan " . $borrowLog->book->title
        ]);
        }

        return redirect('/home');
    }

    public function export()
    {
        return view('books.export');
    }

    public function exportPost(Request $request)
    {

        // validasi
        $this->validate($request, [
            'author_id'=>'required',
            'type'=>'required|in:pdf,xls'
        ], [
            'author_id.required'=>'Anda belum memilih penulis. Pilih minimal 1 penulis.'
        ]);

        $books = Book::whereIn('id', $request->get('author_id'))->get();

        $handler = 'export' . ucfirst($request->get('type'));
        return $this->$handler($books);
    }

    /**
     * Download pdf data buku
     * @return Dompdf
     */
    private function exportPdf($books)
    {
        
        $pdf = PDF::loadview('pdf.books', compact('books'));
        return $pdf->stream('books.pdf');
    }

    private function exportXls($books)
    {

        Excel::create('Data Buku SIP', function($excel) use ($books){
            //set the properties
            $excel->setTitle('Data Buku SIP')
            ->setCreator('Diego Cesar Nugroho');

            $excel->sheet('Data Buku', function($sheet) use ($books){
                $row = 1;
                $sheet->row($row, [
                    'Judul',
                    'Synopsis',
                    'Jumlah',
                    'Stock',
                    'Penulis',
                    'Kategori',
                    'Terbitan'
                    ]);
                foreach ($books as $book){
                    $sheet->row(++$row, [
                        $book->title,
                        $book->synopsis,
                        $book->amount,
                        $book->stock,
                        $book->author->name,
                        $book->category->name,
                        $book->editions
                        ]);
                }
                });
            })->export('xls');
    }

    public function generateExcelTemplate()
    {
        Excel::create('Template import Buku', function($excel){
            // set the properties
            $excel->setTitle('Template import Buku')
            ->setCreator('SIP')
            ->setCompany('SIP')
            ->setDescription('Template import buku untuk SIP');

            $excel->sheet('Data Buku', function($sheet){
                $row = 1;
                $sheet->row($row, [
                    'judul',
                    'penulis',
                    'synopsis',
                    'terbitan',
                    'kategori',
                    'tempat',
                    'kode1',
                    'kode2',
                    'kode3  '
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
            'judul'     => 'required',
            'penulis'   => 'required',
            'synopsis'    => 'required',
            'terbitan'  => 'required',
            'kategori'  => 'required',
            'tempat'    => 'required',
            'kode1'    => 'required',
            'kode2'    => 'required',   
            'kode3'    => 'required'

        ];

        // Catat semua id buku baru
        // ID ini kita butuhkan untuk menghitung total buku yang berhasil di import
        $books_id = [];
        $codes_id1 = [];
        $codes_id2 = [];
        $codes_id3 = [];

        // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang di proses menjadi array
            $validator = Validator::make($row->toArray(), $rowRules);

            // Skip baris ini jika tidak valid, langsung ke baris selanjutnya
            if ($validator->fails()) continue;

            // Syntax dibawah dieksekusi jika baris excel ini valid

            // Cek apakah Penulis sudah terdaftar di database
            $author = Author::where('name', $row['penulis'])->first();

            $book = Book::where('title', $row['judul'])->first();

            $code1 = Code::where('code_book', $row['kode1'])->first();
            $code2 = Code::where('code_book', $row['kode2'])->first();
            $code3 = Code::where('code_book', $row['kode3'])->first();

            $category = Category::where('name', $row['kategori'])->first();

            $place = Place::where('name', $row['tempat'])->first();

            // buat penulis jika belum ada
            if (!$author) {
                $author = Author::create(['name'=>$row['penulis']]);
            }
            // buat kategori jika belum ada
            if (!$category) {
                $category = Category::create(['name'=>$row['kategori']]);
            }
            if (!$book) {
                $book = Book::create([                
                'title'         => $row['judul'],
                'author_id'     => $author->id,
                'synopsis'      => $row['synopsis'],
                'editions'      => $row['terbitan'],
                'category_id'   => $category->id,
                'place_id'      => $place->id]);
            }
            array_push($books_id, $book->id);

            if (!$code1) {
                $code1 = Code::create([                
                'book_id'         => $book->id,
                'code_book'      => $row['kode1']]);
            }
            if (!$code2) {
                $code2 = Code::create([                
                'book_id'         => $book->id,
                'code_book'      => $row['kode2']]);
            }
            if (!$code3) {
                $code3 = Code::create([                
                'book_id'         => $book->id,
                'code_book'      => $row['kode3']]);
            }
            // catat id dari buku yang baru dibuat
            // array_push($books_id, $book->id);
            array_push($codes_id1, $code1->id);
            array_push($codes_id2, $code2->id);
            array_push($codes_id3, $code3->id);

        }

        // Ambil semua buku yang baru dibuat
        $books = Book::whereIn('id', $books_id)->get();
        $codes1 = Code::whereIn('id', $codes_id1)->get();

        $codes2 = Code::whereIn('id', $codes_id2)->get();
        $codes3 = Code::whereIn('id', $codes_id3)->get();


        // redirect ke form jika tidak ada buku yang berhasil diimport
        if ($books->count() == 0) {
            Session::flash("flash_notification", [
                "level"   => "danger",
                "message" => "Tidak ada buku yang berhasil diimport."
            ]);
            return redirect()->back();  
        }

        // set feedback
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Berhasil mengimport " . $books->count() . " buku."
        ]);

        // Tampilkan index buku
        // return redirect()->route('admin.books.index');
        //return redirect()->route('books.index');

        // Tampilkan halaman review buku
        return view('books.import-review')->with(compact('books','codes1','codes2','codes3','jos'));
   }
}
