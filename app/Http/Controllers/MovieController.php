<?php


namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MovieController extends Controller
{
    function index(): AnonymousResourceCollection
    {
        $movies = Movie::with('user')->get();
        return MovieResource::collection($movies);
    }

    function show($id)
    {
        return Movie::find($id);
    }

    function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        $movie->update($request->all());
        return $movie;
    }

    function store(Request $request)
    {
        return Movie::create($request->all());
    }

    function destroy($id)
    {
        return Movie::destroy($id);
    }
}
