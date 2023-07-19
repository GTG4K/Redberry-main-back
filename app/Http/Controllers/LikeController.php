<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Notification;
use App\Models\Quote;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Quote $quote)
    {
        $liked = $quote->likedByAuthUser();
        $checkIfYOurOwnPost = $quote->user->id == auth()->user()->id;

        if ($liked) {
            Like::where('quote_id', $quote->id)->where('user_id', auth()->user()->id)->delete();
            Notification::where('quote_id', $quote->id)->where('sender_id', auth()->user()->id)->delete();

            return response()->json(['message' => 'like Removed'], 202);
        } else {
            Like::create(['quote_id' => $quote->id, 'user_id' => auth()->user()->id]);
            if (!$checkIfYOurOwnPost) {
                Notification::create([
                    'notification_type' => 'like',
                    'message' => 'Reacted to your quote',
                    'quote_id' => $quote->id,
                    'sender_id' => auth()->user()->id,
                    'user_id' => $quote->user->id,
                ]);
            }
            return response()->json(['message' => 'like Created'], 200);
        }
    }
}
