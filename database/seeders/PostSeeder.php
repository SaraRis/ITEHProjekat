<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Post 3',
            'slug' => 'post-3',
            'category_id' => '1',
            'excerpt' => 'pocetak treceg posta',
            'body' => 'ceo tekst treceg posta',
            'user_id' => '1'
        ]);
    }
}
