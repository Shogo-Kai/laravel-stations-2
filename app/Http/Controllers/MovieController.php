<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Controllers\Controller;


class MovieController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('keyword');
        $is_showing = $request->query('is_showing');
        $query = Movie::query();

        if(!empty($keyword)) {
            $query->where('title', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%");
        }

        if(!is_null($is_showing) && $is_showing !== '') {
            $query->where('is_showing', $is_showing);
        }

        $movies = $query->paginate(20);
        return view('getMovies', ['movies' => $movies]);
    }
    public function adminMovies()
    {
        $movies = Movie::paginate(20);
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
      
          return redirect('/admin/movies/');
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

        return redirect('/admin/movies/');
    }
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect('/admin/movies/')->with('success', '削除が完了しました');
    }
}