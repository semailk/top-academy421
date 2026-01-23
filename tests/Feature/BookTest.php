<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Author;
use App\Models\Book;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;

class BookTest extends TestCase
{
    public function test_book_update(): void
    {
        $user = User::query()->firstOrFail();

        $data = [
            'name' => Str::random(10),
            'author_id' => Author::query()->firstOrFail()->id,
            'description' => Str::random(10),
            'created_date' => Carbon::now()->toDateString(),
            'company_id' => Company::query()->firstOrFail()->id,
        ];

        $book = Book::query()->firstOrFail();

        $response = $this->actingAs($user)->patch(route('books.update', [
            'book' => $book,
        ]), $data);
        $response->assertStatus(302);
        $book = $book->refresh();
        $this->assertEquals($data['name'], $book->name);
        $this->assertEquals($data['author_id'], $book->author_id);
        $this->assertEquals($data['company_id'], $book->company_id);
        $this->assertEquals($data['description'], $book->description);
        $this->assertEquals($data['created_date'], $book->created_date);
    }

    public function test_book_destroy(): void
    {
        $user = User::query()->firstOrFail();
        $book = Book::query()->firstOrFail();
        $response = $this->actingAs($user)
            ->delete(route('books.destroy', $book->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('books', [
            'id' => $book->id
        ]);
    }
}
