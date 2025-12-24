<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\City;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        Author::factory()
            ->count(1000)
            ->has(Book::factory()
                ->for(Company::factory()
                    ->for(City::factory(), 'city'), 'company'), 'book')
            ->create();
    }
}
