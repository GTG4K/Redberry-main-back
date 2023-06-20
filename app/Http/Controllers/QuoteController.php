<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class QuoteController extends Controller
{
    function index(): AnonymousResourceCollection
    {
        $quotes = Quote::with('user','movie','comments')->get();
        return QuoteResource::collection($quotes);
    }
}
