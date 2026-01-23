<?php

namespace App\Http\Controllers;

abstract class Controller
{
    private $book = 'test';

    public function book()
    {
        return $this->book;
    }

    public function setBook(string $book)
    {
        $this->book = $book;
    }
}
