<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuoteRequest;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class QuoteController extends Controller
{
    function index(): AnonymousResourceCollection
    {

        $quotes = Quote::with('user','movie','comments','likes')->orderBy('created_at', 'desc')->get();
        return QuoteResource::collection($quotes);
    }

    function store(CreateQuoteRequest $request)
    {
        $validated = $request->validated();
        $path = $validated['image']->store('img/quote');

        $quote = [
            'en' => $validated['quote_en'],
            'ka' => $validated['quote_ka'],
        ];

        Quote::create([
            'quote' => $quote,
            'image' => $path,
            'user_id' => $validated['user_id'],
            'movie_id' => $validated['movie_id'],
        ]);
    }
}
