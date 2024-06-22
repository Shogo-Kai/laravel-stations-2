<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Controllers\Controller;


class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('getMovies', ['movies' => $movies]);
    }
    public function adminMovies()
    {
        $movies = Movie::all();
        return view('adminMovies', ['movies' => $movies]);
    }
    public function create()
    {
        return view('createMovies');
    }
    public function store(CreateMovieRequest $request)
    {

        Movie::create([  
            'title' => $request->input('title'),  
            'image_url' => $request->input('image_url'),
            'published_year' => $request->input('published_year'),
            'is_showing' => $request->input('is_showing'),
            'description' => $request->input('description'),
          ]);  
      
          return redirect('/admin/movies');
    }
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('editMovies', ['movie' => $movie]);
    }
    public function update(UpdateMovieRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update([
            'title' => $request->input('title'),  
            'image_url' => $request->input('image_url'),
            'published_year' => $request->input('published_year'),
            'is_showing' => $request->input('is_showing'),
            'description' => $request->input('description'),
        ]);

        return redirect('/admin/movies');
    }
}