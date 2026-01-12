<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorCollectionResource;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $user = User::query()->first();

       $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'father_name' => 'required|string',
            'birth_date' => 'required|string',
            'biography' => 'required|string',
            'gender' => 'required|integer|between:1,2',
            'active' => 'nullable|boolean|in:0,1',
        ], ['first_name.required' => 'Имя обезательно к заполнению!']);

        $data = array_merge($request->all(), ['user_id' => $user->id]);
        $author = Author::query()->create($data);

        return response()->json(
            ['data' => $author , 'message' => 'Successfully created author!'],
            Response::HTTP_CREATED
        );
    }

    public function show(Author $author): AuthorResource
    {
        return AuthorResource::make($author);
    }

    public function index()
    {
        $authors = Author::query()->paginate(10);

        return AuthorCollectionResource::collection($authors);
    }
}
