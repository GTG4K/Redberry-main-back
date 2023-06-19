<?php


namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    function index(): string
    {
        return Movie::all();
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
