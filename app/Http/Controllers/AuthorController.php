<?php

namespace App\Http\Controllers;


use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
{
    public function index(AuthorRequest $authorRequest)
    {
        dd($authorRequest->validated(), $authorRequest->all());
    }
}
