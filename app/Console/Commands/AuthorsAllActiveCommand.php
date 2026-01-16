<?php

namespace App\Console\Commands;

use App\Models\Author;
use Illuminate\Console\Command;

class AuthorsAllActiveCommand extends Command
{
    protected $signature = 'app:authors-all-active-command';

    protected $description = 'Command description';

    public function handle(): int
    {
        try {
            Author::query()->get()->map(function (Author $author) {
                $author->active = false;
                $author->save();

                $this->info('Автор ' . $author->fio() . '. Присвоен статус "Не активен!"');
            });
            return 1;
        } catch (\Exception $exception) {
            return 0;
        }
    }
}
