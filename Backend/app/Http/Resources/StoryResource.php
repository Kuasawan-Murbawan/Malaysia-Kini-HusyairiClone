<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'image'             => $this->image,
            'category'          => new CategoryResource($this->whenLoaded('category')),
            'author'            => $this->author?->name,
            'date_published'    => $this->date_published,
            'summary'           => $this->summary,
            // Load tags that is associated with the story, and only take the name
            'tags'              => $this->whenLoaded('tags', fn()=> $this->tags->pluck('name')),
            'comment_count'     => $this->comments_count ?? $this->comments()->count(),
            'full_story'        => $this->full_story,
        ];










    }
}
