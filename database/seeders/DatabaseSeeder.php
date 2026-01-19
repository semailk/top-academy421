<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\City;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $roles = [
            'admin',
            'user'
        ];

        foreach ($roles as $role) {
            Role::query()->firstOrCreate(['name' => $role]);
        }

        User::query()->firstOrCreate([
            'email_verified_at' => now(),
            'password' => Hash::make('adminadmin'),
            'remember_token' => Str::random(10),
            'name' => 'Admin',
            'email' => 'test@example.com',
            'role_id' => Role::query()->where('name', 'admin')->first()->id
        ]);

        User::factory([
            'role_id' => Role::query()->where('name', 'user')->first()?->id
        ])
            ->count(20)
            ->has(Author::factory()
                ->count(500)
                ->has(Book::factory()
                    ->for(Company::factory()
                        ->for(City::factory(), 'city'), 'company'), 'book'), 'authors')->create();
    }
}
