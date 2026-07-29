<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Story;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show(Comment $comment){
        return new CommentResource($comment);
    }

    public function storyComments(Story $story){
        $comments = $story->comments()->latest()->get();

        return CommentResource::collection($comments);
    }
}
