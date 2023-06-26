<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Quote;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Quote $quote)
    {
        $liked = $quote->likedByAuthUser();

        if ($liked) {
            Like::where('quote_id', $quote->id)->where('user_id', auth()->user()->id)->delete();
            return response()->json(['message' => 'like Removed'], 202);
        } else {
            Like::create(['quote_id' => $quote->id, 'user_id' => auth()->user()->id]);
            return response()->json(['message' => 'like Created'], 200);
        }
    }
}
