<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoryResource;
use App\Http\Resources\StoryListResource;

use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    // 1. Get full story
    public function show(Story $story){
        $story->load(['category', 'author', 'comments', 'tags']);
        return new StoryResource($story);
    }


    // 2. Homepage headlines
    public function index(Request $request)
    {
        $stories = Story::with(['category', 'author', 'tags'])
            ->withCount('comments')
            ->when($request->category, function ($q, $slug) {
                $q->whereHas('category', fn ($cq) => $cq->where('slug', $slug));
            })
            ->latest('date_published')
            ->paginate(25);

        return StoryListResource::collection($stories);
    }
}
