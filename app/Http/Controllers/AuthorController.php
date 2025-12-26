<?php

namespace App\Http\Controllers;


use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Models\Author;
use App\Repository\AuthorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    private AuthorRepository $authorRepository;
    private const PER_PAGE = 10;

    public function __construct(
        AuthorRepository $authorRepository
    )
    {
        $this->authorRepository = $authorRepository;
    }

    public function index(Request $request): View
    {
        $search = $request->input('search');
        $query = Author::query()->select([
            'authors.id',
            'authors.first_name',
            'authors.last_name',
            'authors.father_name',
            'authors.birth_date',
            'authors.active',
        ])->with(['book' => function ($query) {
            $query->select([
                'books.id',
                'books.name',
                'books.author_id',
                'books.company_id',
            ]);
        } , 'book.company' => function ($query) {
            $query->select([
                'companies.id',
                'companies.name',
                'companies.city_id',
            ]);
        },'book.company.city' => function ($query) {
            $query->select([
                'cities.id',
                'cities.name',
            ]);
        }]);

        if (!empty($search)) {
            $query
                ->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('father_name', 'like', '%' . $search . '%');
        }

        return view('authors.index', [
            'authors' => $query
                ->where('active', true)
                ->paginate(self::PER_PAGE),
        ]);
    }

    public function edit(Author $author): View
    {
        return view('authors.edit', [
            'author' => $author,
        ]);
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

    public function update(Author $author, AuthorUpdateRequest $authorUpdateRequest): RedirectResponse
    {
        $this->authorRepository->update($author, $authorUpdateRequest);

        return redirect()->back()->with(['success' => 'Author updated successfully']);
    }

    public function getAllAuthors(): JsonResponse
    {
        $search = \request()->input('search');

        $query = Author::query();
        if (!empty($search)) {
            $query
                ->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('father_name', 'like', '%' . $search . '%');
        }

        return response()->json($query->paginate(self::PER_PAGE));
    }
}
