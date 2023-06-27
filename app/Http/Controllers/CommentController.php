<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request){
        $attributes = $request->validated();
        Comment::create($attributes);

        return response()->json(['message'=>'Comment created successfully'], 201);
    }
}
