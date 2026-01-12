<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Models\Author;
use App\Repository\AuthorRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class AuthorController extends Controller
{
    private AuthorRepository $authorRepository;

    public function __construct(
        AuthorRepository $authorRepository
    )
    {
        $this->authorRepository = $authorRepository;
    }


    public function index(Request $request): View
    {
        $authors = $this->authorRepository->getAuthorsToPaginate();

        return view('authors.index', [
            'authors' => $authors,
        ]);
    }

    public function update(Author $author, AuthorUpdateRequest $authorUpdateRequest): RedirectResponse
    {
        $user = Auth::user();

        if ($user->role->name == 'admin'){
            $this->authorRepository->update($author, $authorUpdateRequest);
        }elseif ($user->role->name == 'user'){
            if ($author->user_id != $user->id ){
                throw new AccessDeniedException();
            }

            $this->authorRepository->update($author, $authorUpdateRequest);
        }

        return redirect()->back()->with(['success' => 'Author updated successfully']);
    }

    public function edit(int $id): View
    {
        $author = Author::findOrFail($id);

        return view('authors.edit', [
            'author' => $author,
        ]);
    }

    public function store(AuthorStoreRequest $authorRequest): RedirectResponse
    {
        $this->authorRepository->store($authorRequest);
        return redirect()->back()->with(['success' => 'Author created successfully']);
    }

    public function destroy(int $id): RedirectResponse
    {
        $result = $this->authorRepository->softDelete($id);

        if ($result) {
            return redirect()->route('authors.index')->with(['success' => 'Author deleted successfully']);
        }

        return redirect()->route('authors.index')->with(['error' => 'Failed to delete author']);
    }

    public function trashed(): View
    {
        $trashedAuthors = $this->authorRepository->getTrashedAuthors();

        return view('authors.trashed', [
            'trashedAuthors' => $trashedAuthors,
        ]);
    }

    public function restore(int $id): RedirectResponse
    {
        $result = $this->authorRepository->restore($id);

        if ($result) {
            return redirect()->route('authors.trashed')->with(['success' => 'Author restored successfully']);
        }

        return redirect()->route('authors.trashed')->with(['error' => 'Failed to restore author']);
    }

    public function create(): View
    {
        return view('authors.create');
    }
}
