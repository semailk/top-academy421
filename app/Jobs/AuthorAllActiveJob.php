<?php

namespace App\Jobs;

use App\Models\Author;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AuthorAllActiveJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Author::query()->get()->map(function (Author $author) {
            $author->active = rand(0, 1);
            $author->save();
        });
    }
}
