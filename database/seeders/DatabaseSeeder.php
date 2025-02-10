<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Role;
use App\Models\RoleUser;
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
        $this->call([
            TagSeeder::class,
            RoleSeeder::class,
        ]);

        $this->createAdmin();

        User::factory(5)
            ->has(Article::factory(10))
            ->create();

        ArticleTag::factory(50)->create();
        RoleUser::factory(20)->create();
    }

    /**
     * @return void
     */
    private function createAdmin(): void
    {
        $adminRole = Role::query()
            ->create([
                'name' => 'Admin',
            ]);

        $adminUser = User::query()
            ->create([
                'name' => 'Admin',
                'email' => 'admin@admin.rt',
                'password' => bcrypt('123'),
                'email_verified_at' => now(),
            ]);

        $adminUser->roles()->attach($adminRole);
    }
}
