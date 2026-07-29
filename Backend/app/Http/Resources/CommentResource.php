<?php

namespace App\Http\Resources;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'        => $this->id,
            'user'      => $this->user,
            'body'      => $this->body,
            'story_id'  => $this->story_id,
            'created_at'=> $this->created_at,
        ];
    }
}
