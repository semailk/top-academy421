<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private const PER_PAGE = 10;

    public function index(Request $request)
    {
        $query = Book::query();
        $createdDateStart = $request->get('created_date_start'); // 2024
        $createdDateEnd = $request->get('created_date_end'); // 2025
        $name = $request->get('name');
        $authorName = $request->get('author_name'); // Thomas
        $companyName = $request->get('company_name'); // Swift-Nader
        $ids = $request->get('ids');

        if ($createdDateStart) {
            $query
                ->whereDate('created_date', '>=', Carbon::create($createdDateStart)
                    ->startOfYear()
                );
        }
        if ($createdDateEnd) {
            $query
                ->whereDate('created_date', '<=', Carbon::create($createdDateEnd)
                    ->endOfYear()
                );
        }

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($authorName) {
            $query->whereHas('author', function ( $authorQuery) use ($authorName) {
                $authorQuery->where('first_name', 'like', '%' . $authorName . '%');
            });
        }

        if ($companyName) {
            $query->whereHas('company', function ( $companyQuery) use ($companyName) {
                $companyQuery->where('name', 'like', '%' . $companyName . '%');
            });
        }

        if ($ids && !empty($ids)) {
            $query->whereIn('id', $ids);
        }

        return BookResource::collection($query->orderByDesc('created_date')->paginate(self::PER_PAGE));
    }

    public function show(Book $book)
    {
        return BookResource::make($book);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'created_date' => 'required|date',
            'company_id' => 'required|exists:companies,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book = new Book();
        $book->name = $validate['name'];
        $book->description = $validate['description'];
        $book->created_date = $validate['created_date'];
        $book->company_id = $validate['company_id'];
        $book->author_id = $validate['author_id'];
        $book->save();


        return BookResource::make($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([], 200);
    }

    public function update(Request $request, Book $book)
    {
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'created_date' => 'required|date',
            'company_id' => 'required|exists:companies,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book->name = $validate['name'];
        $book->description = $validate['description'];
        $book->created_date = $validate['created_date'];
        $book->company_id = $validate['company_id'];
        $book->author_id = $validate['author_id'];
        $book->save();

        return BookResource::make($book);
    }
}
