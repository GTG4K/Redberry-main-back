<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Quote;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $attributes = $request->validated();

        $quote = Quote::with('user')->find($attributes['quote_id']);
        $checkIfYOurOwnPost = $quote->user->id == auth()->user()->id;

        Comment::create($attributes);
        if (!$checkIfYOurOwnPost) {
            Notification::create([
                'notification_type' => 'comment',
                'message' => 'Commented to your movie quote',
                'quote_id' => $quote->id,
                'sender_id' => auth()->user()->id,
                'user_id' => $quote->user->id,
            ]);
        }

        return response()->json(['message' => 'Comment created successfully'], 201);
    }
}
