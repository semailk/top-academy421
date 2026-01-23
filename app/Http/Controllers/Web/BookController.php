<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::query()->with('author')
            ->paginate(20);

        return view('books.index', [
            'books' => $books
        ]);
    }

    public function show(Book $book): View
    {
        $authors = Author::query()->where('active', 1)->get();
        $companies = Company::query()->get();

        return view('books.edit', [
            'book' => $book,
            'authors' => $authors,
            'companies' => $companies
        ]);
    }

    public function update(
        Book $book,
        Request $request
    ): RedirectResponse
    {
         $validated = $request->validate([
            'author_id' => 'required|exists:authors,id',
            'name' => 'required',
            'company_id' => 'required|exists:companies,id',
            'description' => 'nullable',
             'created_date' => 'required|date',
         ]);

         $book->update($validated);

         return redirect()
             ->route('books.edit', ['book' => $book])
             ->with(['success' => 'Book updated successfully']);
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with(['success' => 'Book delete successfully']);
    }
}
