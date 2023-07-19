<?php


namespace App\Http\Controllers;

use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $movies = Movie::with('user', 'quotes')->get();
        return MovieResource::collection($movies);
    }

    public function store(CreateMovieRequest $request)
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
            'release_date' => $validated['release_date'],
            'genre' => $validated['genre'],
            'user_id' => $validated['user_id'],
        ]);
    }

    public function update(UpdateMovieRequest $request, $id)
    {
        $request->validated();

        $movie = Movie::find($id);
        if ($movie->user->id != auth()->user()->id) {
            return response()->json(['message' => 'not allowed, movie belongs to another user'], 405);
        }

        if ($request['title_ka']) {
            $movie->setTranslation('title', 'ka', $request['title_ka']);
        }

        if ($request['title_en']) {
            $movie->setTranslation('title', 'en', $request['title_en']);
        }

        if ($request['director_ka']) {
            $movie->setTranslation('director', 'ka', $request['director_ka']);
        }

        if ($request['director_en']) {
            $movie->setTranslation('director', 'en', $request['director_en']);
        }

        if ($request['description_ka']) {
            $movie->setTranslation('description', 'ka', $request['description_ka']);
        }

        if ($request['description_en']) {
            $movie->setTranslation('description', 'en', $request['description_en']);
        }

        if ($request['release_date']) {
            $movie->release_date = $request['release_date'];
        }

        if ($request['genre']) {
            $movie->genre = $request['genre'];
        }

        if ($request['image']) {
            $path = $request['image']->store('img/quote');
            $movie->poster = $path;
        }

        $movie->save();
        return response()->json(['message' => 'movie changes successfully'], 202);
    }

    public function delete($id)
    {
        Movie::find($id)->delete();
        return response()->json(['message' => 'Movie removed']);
    }
}
