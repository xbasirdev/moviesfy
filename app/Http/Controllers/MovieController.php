<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function index()
    {
        $movies = Movie::get();
        echo json_encode($movies);
        /*
        return response()->download(public_path('bg-1.jpg'), 'User Image'); */
    }

    public function store(Request $request)
    {
        $movie = new Movie();
        $movie->name = $request->input('name');
        $movie->description = $request->input('description');
        $movie->year = $request->input('year');
        $movie->genre = $request->input('genre');
        $movie->duration = $request->input('duration');
        $movie->save();
        echo json_encode($movie);

        /*
        $fileName = "user_image.pdf";
        $path = $request->file('photo')->move(public_path("/"), $fileName);
        $photoURL = url('/', $fileName);
        return response()->json(['url' => $photoURL], 200);*/
    }

    public function update(Request $request, $movie_id)
    {
        $movie = Movie::find($movie_id);
        $movie->name = $request->input('name');
        $movie->description = $request->input('description');
        $movie->year = $request->input('year');
        $movie->genre = $request->input('genre');
        $movie->duration = $request->input('duration');
        $movie->save();
        echo json_encode($movie);
    }

    public function destroy($movie_id)
    {   
        $movie = Movie::find($movie_id);
        $movie->delete();
    }
}
