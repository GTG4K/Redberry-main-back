<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    function index(): AnonymousResourceCollection
    {

        $quotes = Quote::with('user', 'movie', 'comments', 'likes')->orderBy('created_at', 'desc')->get();
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

    public function show($id)
    {
        $quote = Quote::with('user', 'movie', 'comments', 'likes')->find($id);
        return new QuoteResource($quote);
    }

    public function delete($id){
        Quote::where('id', $id)->delete();
        return response()->json(['message' => 'quote Deleted'], 202);
    }

    public function update($id, UpdateQuoteRequest $request){
        $request->validated();

        $quote = Quote::find($id);
        if ($quote->user->id != auth()->user()->id){
            return response()->json(['message'=>'not allowed, quote belongs to another user'],405);
        }

        if($request['quote_ka']){
            $quote->setTranslation('quote', 'ka', $request['quote_ka']);
        }

        if($request['quote_en']){
            $quote->setTranslation('quote', 'en', $request['quote_en']);
        }

        if($request['image']){
            $path = $request['image']->store('img/quote');
            $quote->image = $path;
        }

        $quote->save();
        return response()->json(['message'=>'quote changes successfully'], 202);
    }

}
