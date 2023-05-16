<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\DB;


class DemoController extends Controller
{
    public function index() {

        $users=User::all()->toArray();
        $books=Book::all()->toArray();
        $userBooks=DB::table('user_books')->select()->get();

        $result=DB::select('SELECT user_id AS ID, CONCAT(first_name, " ", last_name) AS Name,
            author AS Author,
            Books FROM 
            (SELECT tb5.user_id AS user_id, tb5.author AS author,
            GROUP_CONCAT(name) AS Books FROM 
            (SELECT tb4.user_id, tb4.author, books.name 
            FROM 
            (SELECT tb3.user_id, author, COUNT(*) AS count 
            FROM(
                SELECT id AS tb2_user_id,tb2.user_id, book_id, get_date, return_date, 
                DATEDIFF(return_date, get_date) AS term  
                FROM            
                (SELECT * FROM             
                (SELECT user_id AS uid, COUNT(*) FROM user_books GROUP BY user_id HAVING COUNT(*)=2) AS tb1             
                JOIN user_books ON user_books.user_id=tb1.uid) AS tb2) AS tb3 
                JOIN books ON books.id=tb3.book_id 
                WHERE term<15 
                GROUP BY tb3.user_id, author) AS tb4 
                JOIN user_books ON tb4.user_id=user_books.user_id 
                JOIN books ON books.id=user_books.book_id 
                WHERE count = 2) AS tb5 GROUP BY user_id, author) AS tb6 
                JOIN (
                    SELECT id, first_name, last_name, birthday, DATE_SUB(CURDATE(),INTERVAL 17 YEAR) AS max_birthday,  
                    DATE_SUB(CURDATE(),INTERVAL 7 YEAR) AS min_birthday 
                    FROM `users`) AS users1 
                ON users1.id=tb6.user_id 
                WHERE users1.birthday>max_birthday AND users1.birthday<min_birthday');

        return view('demo', [
            'data' => [
                'result' => $result,
                'users' => $users,
                'books' => $books,
                'userBooks' => $userBooks
            ]
        ]);
    }
}
