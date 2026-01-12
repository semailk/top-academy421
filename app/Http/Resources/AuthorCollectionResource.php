<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->user;

        return [
            'id' => $this->id,
            'birth_date' => $this->birth_date,
            'full_name' => $this->fio(),
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
            ]
        ];
    }
}
