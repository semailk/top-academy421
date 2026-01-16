<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Jobs\AuthorAllActiveJob;
use App\Models\Author;
use App\Repository\AuthorRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
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

        if ($user->role->name == 'admin') {
            $this->authorRepository->update($author, $authorUpdateRequest);
        } elseif ($user->role->name == 'user') {
            if ($author->user_id != $user->id) {
                throw new AccessDeniedException();
            }

            $this->authorRepository->update($author, $authorUpdateRequest);
        }

        return redirect()->back()->with(['success' => 'Author updated successfully']);
    }

    public function edit(int $id): View
    {
        $author = Author::findOrFail($id);
        if (Cache::has('author_' . $author->id)) {
            return view('authors.edit', [
                'author' => Cache::get('author_' . $author->id),
            ]);
        }

        Cache::put('author_' . $author->id, $author, 3600);

        return view('authors.edit', [
            'author' => Cache::get('author_' . $author->id),
        ]);
    }

    public function store(AuthorStoreRequest $authorRequest): RedirectResponse
    {
        $author = $this->authorRepository->store($authorRequest);

        return redirect()->route('authors.edit', $author->id)->with(['success' => 'Author created successfully']);
    }

    public function destroy(int $id): RedirectResponse
    {
        $result = $this->authorRepository->softDelete($id);

        if ($result) {
            return redirect()->route('authors.index')->with('success', 'Author deleted successfully');
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

    public function getRestoreView(): View
    {
        return view('authors.restore', [
            'authors' => Author::onlyTrashed()->get(),
        ]);
    }

    public function restore(int $id): RedirectResponse
    {
        $result = $this->authorRepository->restore($id);

        if ($result) {
            return redirect()->route('authors.edit', $id)->with(['success' => 'Author restored successfully']);
        }

        return redirect()->route('authors.restore')->with(['error' => 'Failed to restore author']);
    }

    public function create(): View
    {
        return view('authors.create');
    }
}
