<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    public function test_authors_list(): void
    {
        $author = Author::query()->first();
        if ($author){
            $response = $this->get(route('ajax.get.all.authors'));
//            $response = $this->get(route('ajax.get.all.authors', ['search' => $author->first_name]));

            $responseData = $response->json();
            $authorsCount = Author::query()->count();

            $response->assertStatus(200);
            $this->assertEquals(10, $responseData['per_page']);
            $this->assertEquals($authorsCount, $responseData['total']);
            $this->assertEquals(route('ajax.get.all.authors'), $responseData['path']);

//            foreach ($responseData['data'] as $authorArray){
//                $this->assertEquals($author->first_name, $authorArray['first_name']);
//            }
        }
    }

        public function test_author_store(): void
        {
            $birthDate = Carbon::now()->addYears(-30)->toDateString();
            $randomText = Str::random(100);

            $data = [
                'first_name' => 'First Name Test',
                'last_name'  => 'Last Name Test',
                'father_name'=> 'Father Name Test',
                'birth_date' => $birthDate,
                'biography'  => $randomText,
                'gender'     => 'Male',
                'active'     => 1,
            ];

            $response = $this->post('/authors', $data);
            $response->assertStatus(302);
            $author = Author::query()->where(
                [
                ['first_name' , 'First Name Test'],
                ['last_name' , 'Last Name Test'],
                ['father_name' , 'Father Name Test'],
                ['biography' , $randomText],
            ])->first();


            $this->assertEquals($data['first_name'], $author->first_name);
            $this->assertEquals($data['last_name'], $author->last_name);
            $this->assertEquals($data['father_name'], $author->father_name);
            $this->assertEquals($data['biography'], $author->biography);
            $this->assertEquals($data['birth_date'], $author->birth_date->toDateString());
            $this->assertEquals($data['gender'], $author->gender);
            $this->assertEquals($data['active'], $author->active);
        }

    public function test_author_update(): void
    {
        $birthDate = Carbon::now()->addYears(-rand(10, 50))->toDateString();
        $randomText = Str::random(100);
        $firstName = Str::random(10);
        $lastName = Str::random(10);
        $fatherName = Str::random(10);
        $gender = rand(1, 2) ? 'Male' : 'Female';
        $active = rand(0, 1);

        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'father_name' => $fatherName,
            'birth_date' => $birthDate,
            'biography' => $randomText,
            'gender' => $gender,
            'active' => $active,
        ];
        $author = Author::query()->latest()->first();
        $response = $this->patch(route('authors.update', $author->id), $data);

        $author->refresh();
        $response->assertStatus(302);
        $this->assertEquals($data['first_name'], $author->first_name);
        $this->assertNull($data['last_name'], $author->last_name);
        $this->assertEquals($data['father_name'], $author->father_name);
        $this->assertEquals($data['biography'], $author->biography);
        $this->assertEquals($data['birth_date'], $author->birth_date->toDateString());
        $this->assertEquals($data['gender'], $author->gender);
        $this->assertEquals($data['active'], $author->active);
    }
}
