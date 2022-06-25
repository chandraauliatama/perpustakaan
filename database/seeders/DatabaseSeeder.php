<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\LibraryRules;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([RoleSeeder::class, UserSeeder::class]);
        LibraryRules::create([
            'day_limit' => '3',
            'fine' => '500'
        ]);

        Book::factory(40)->create();
    }
}
