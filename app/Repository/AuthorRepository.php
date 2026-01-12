<?php

namespace App\Repository;

use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Models\Author;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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

    /**
     * Мягкое удаление автора
     */
    public function softDelete($id): bool
    {
        $author = Author::find($id);
        if ($author) {
            return $author->delete();
        }
        return false;
    }

    /**
     * Восстановление автора
     */
    public function restore($id): bool
    {
        $author = Author::onlyTrashed()->find($id);
        if ($author) {
            return $author->restore();
        }
        return false;
    }

    /**
     * Получение всех удаленных авторов
     */
    public function getTrashedAuthors()
    {
        return Author::onlyTrashed()->get();
    }

    /**
     * Получение всех авторов для списка
     */
    public function getAllAuthors()
    {
        return Author::all();
    }

    public function getAuthorsToPaginate(?int $perPage = 10): LengthAwarePaginator
    {
        return Author::query()->paginate($perPage);
    }

    public function update(Author $author, AuthorUpdateRequest $authorUpdateRequest): Author
    {
        $author->update(
            $authorUpdateRequest->validated()
        );

        return $author->refresh();
    }
}
