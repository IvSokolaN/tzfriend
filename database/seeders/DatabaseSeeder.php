<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)
            ->has(Article::factory(10))
            ->create();

        $this->call([
            TagSeeder::class,
        ]);

        ArticleTag::factory(50)->create();
    }
}
