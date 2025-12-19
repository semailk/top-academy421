<?php

namespace App\Http\Controllers;


use App\Http\Requests\AuthorStoreRequest;
use App\Models\Author;
use App\Repository\AuthorRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
    }

    public function edit(int $id): View
    {
    }

    public function store(AuthorStoreRequest $authorRequest): RedirectResponse
    {
        $this->authorRepository->store($authorRequest);
        return redirect()->back()->with(['success' => 'Author created successfully']);
    }

    public function create(): View
    {
        $authors = Author::query()->get();
        return view('authors.create', [
            'authors' => $authors,
        ]);
    }
}
