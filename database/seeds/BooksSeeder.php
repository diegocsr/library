<?php

use Illuminate\Database\Seeder;
use App\Author;
use App\Book;
use App\BorrowLog;
use App\User;
use App\Denda;
use App\Code;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Sample penulis 
        $author1 = Author::create(['name'=>'Muhammad Fauzil Adhim']);
        $author2 = Author::create(['name'=>'Salim A. Fillah']);
        $author3 = Author::create(['name'=>'Aam Amiruddin']);

        //Sample buku
        $book1 = Book::create(['title'=>'Kupinang Engkau dengan Hamdalah', 'author_id'=>$author1->id,'editions'=>1990, 'category_id'=>1, 'place_id'=>2]);
        $book2 = Book::create(['title'=>'Jalan Cinta Para Pejuang', 'author_id'=>$author2->id, 'editions'=>2090, 'category_id'=>2, 'place_id'=>1]);
        $book3 = Book::create(['title'=>'Membingkai Surga dalam Rumah Tangga', 'author_id'=>$author3->id, 'editions'=>2000, 'category_id'=>1, 'place_id'=>5]);
        $book4 = Book::create(['title'=>'Cinta Rumah Tangga Muslim', 'author_id'=>$author3->id, 'editions'=>2010, 'category_id'=>2, 'place_id'=>4]);
    
        $code1 = Code::create(['code_book'=>5003,'book_id'=>$book3->id]);
        $code2 = Code::create(['code_book'=>5032,'book_id'=>$book3->id]);
        $code3 = Code::create(['code_book'=>5232,'book_id'=>$book2->id]);
        $code4 = Code::create(['code_book'=>2432,'book_id'=>$book2->id]);
        $code5 = Code::create(['code_book'=>5674,'book_id'=>$book1->id]);
        $code6 = Code::create(['code_book'=>'q243','book_id'=>$book1->id]);
        $code7 = Code::create(['code_book'=>'fs23','book_id'=>$book4->id]);
        $code8 = Code::create(['code_book'=>'vbd2','book_id'=>$book4->id]);
        $code9 = Code::create(['code_book'=>'fds3','book_id'=>$book4->id]);

        // Sample peminjaman buku
        $member = User::where('email', 'jonimarko@gmail.com')->first();
        BorrowLog::create(['user_id' => $member->id, 'code_id'=>$code1->id, 'is_returned' => 0,'denda_id'=>1]);
        BorrowLog::create(['user_id' => $member->id, 'code_id'=>$code2->id, 'is_returned' => 0,'denda_id'=>1]);
        BorrowLog::create(['user_id' => $member->id, 'code_id'=>$code3->id, 'is_returned' => 1,'denda_id'=>1]);

        $member = User::where('email', 'kuatsekali@gmail.com')->first();
        BorrowLog::create(['user_id' => $member->id, 'code_id'=>$code4->id, 'is_returned' => 0,'denda_id'=>1]);
        BorrowLog::create(['user_id' => $member->id, 'code_id'=>$code5->id, 'is_returned' => 0,'denda_id'=>1]);
        BorrowLog::create(['user_id' => $member->id, 'code_id'=>$code6->id, 'is_returned' => 1,'denda_id'=>1]);

    }
}
