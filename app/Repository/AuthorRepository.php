<?php

namespace App\Repository;

use App\Http\Requests\AuthorStoreRequest;
use App\Models\Author;
class AuthorRepository
{
    public function store(AuthorStoreRequest $authorRequest): Author
    {
        $validated = $authorRequest->validated();
        $author = new Author();
        $author->first_name = $validated['first_name'];
        $author->last_name = $validated['last_name'];
        $author->father_name = $validated['father_name'];
        $author->biography = $validated['biography'];
        $author->active = $validated['active'] ?? false;
        $author->birth_date = $validated['birth_date'];
        $author->gender = $validated['gender'];
        $author->save();

        return $author;
    }
}
