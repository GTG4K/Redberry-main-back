<?php


namespace App\Http\Controllers;

use App\Http\Requests\CreateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    function index(): AnonymousResourceCollection
    {
        $movies = Movie::with('user','quotes')->get();
        return MovieResource::collection($movies);
    }

    function store(CreateMovieRequest $request)
    {
        $validated = $request->validated();
        $path = $validated['image']->store('img/movie');
        $title = [
            'ka' => $validated['title_ka'],
            'en' => $validated['title_en'],
        ];
        $description = [
            'en' => $validated['description_en'],
            'ka' => $validated['description_ka'],
        ];
        $director = [
            'en' => $validated['director_en'],
            'ka' => $validated['director_ka'],
        ];
        Movie::create([
            'title' => $title,
            'director' => $director,
            'description' => $description,
            'poster' => $path,
            'release_date'=> $validated['release_date'],
            'genre' => $validated['genre'],
            'user_id' => $validated['user_id'],
        ]);
    }
}
