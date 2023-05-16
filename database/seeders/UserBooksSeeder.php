<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Arr;

class UserBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->all();
        $bookIds = Book::pluck('id')->all();

        $userBooks = [];
        foreach ($userIds as $userId) {
            // $randomBookIds = Arr::random($bookIds, mt_rand(1, count($bookIds)));
            $randomBookIds = Arr::random($bookIds, mt_rand(1, 3));

            foreach ($randomBookIds as $bookId) {
                $getDate = fake()->dateTimeBetween('-3 years');
                $userBooks[] = [
                    'user_id' => $userId,
                    'book_id' => $bookId,
                    'get_date' => $getDate,
                    'return_date' => fake()->dateTimeInInterval((clone $getDate)->modify("+1 day"), '+30 days'),
                ];
            }
        }

        DB::table('user_books')->insert($userBooks);
        // DB::table('user_books')->insert(
        //     [
        //         [    
        //             'user_id' => 2,
        //             'book_id' => 2,
        //             'get_date' => '2020-01-01',
        //             'return_date' => '2020-01-05'
        //         ],
        //         [    
        //             'user_id' => 2,
        //             'book_id' => 3,
        //             'get_date' => '2020-01-01',
        //             'return_date' => '2020-01-05'
        //         ],
        //         [    
        //             'user_id' => 4,
        //             'book_id' => 5,
        //             'get_date' => '2020-01-01',
        //             'return_date' => '2020-01-05'
        //         ],
        //         [    
        //             'user_id' => 4,
        //             'book_id' => 6,
        //             'get_date' => '2020-01-01',
        //             'return_date' => '2020-01-05'
        //         ],
        //         [    
        //             'user_id' => 4,
        //             'book_id' => 7,
        //             'get_date' => '2020-01-01',
        //             'return_date' => '2020-01-05'
        //         ],
        //         [    
        //             'user_id' => 1,
        //             'book_id' => 2,
        //             'get_date' => '2020-01-01',
        //             'return_date' => '2020-01-05'
        //         ],
        //         [    
        //             'user_id' => 8,
        //             'book_id' => 2,
        //             'get_date' => '2020-01-01',
        //             'return_date' => '2021-01-05'
        //         ],
        //         [    
        //             'user_id' => 8,
        //             'book_id' => 3,
        //             'get_date' => '2020-01-01',
        //             'return_date' => '2021-01-05'
        //         ],
        //         [    
        //             'user_id' => 10,
        //             'book_id' => 7,
        //             'get_date' => '2021-01-01',
        //             'return_date' => '2021-01-05'
        //         ],
        //         [    
        //             'user_id' => 10,
        //             'book_id' => 8,
        //             'get_date' => '2021-01-01',
        //             'return_date' => '2021-01-05'
        //         ]
        //     ]
        // );
    }
}
