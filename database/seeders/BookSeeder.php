<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'name'=> 'Romeo and Juliet',
                'author'=> 'William Shakespeare'
            ],
            [
                'name'=> 'The Tragedy of Hamlet',
                'author'=> 'William Shakespeare'
            ],
            [
                'name'=> 'The Tragedy of Othello',
                'author'=> 'William Shakespeare'
            ],
            [
                'name'=> 'Macbeth',
                'author'=> 'William Shakespeare'
            ],
            [
                'name'=> 'War and Peace',
                'author'=> 'Leo Tolstoy'
            ],
            [
                'name'=> 'Father Sergius',
                'author'=> 'Leo Tolstoy'
            ],
            [
                'name'=> 'The Cossacks',
                'author'=> 'Leo Tolstoy'
            ],
            [
                'name'=> 'The Idiot',
                'author'=> 'Fyodor Dostoevsky'
            ],
            [
                'name'=> 'The Brothers Karamazov',
                'author'=> 'Fyodor Dostoevsky'
            ],
            [
                'name'=> 'Humiliated and Insulted',
                'author'=> 'Fyodor Dostoevsky'
            ],
            [
                'name'=> 'The Happy Prince',
                'author'=> 'Oscar Wilde'
            ],
            [
                'name'=> 'The Picture of Dorian Gray',
                'author'=> 'Oscar Wilde'
            ]
        ]);
    }
}
