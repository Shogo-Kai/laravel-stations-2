<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
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

        DB::beginTransaction();

        try {
            Log::info('Request is_showing: ' . $request->input('is_showing'));

            $genreName = $request->input('genre');
            $genre = Genre::firstOrCreate(['name' => $genreName]);

            Movie::create([  
                'title' => $request->input('title'),  
                'image_url' => $request->input('image_url'),
                'published_year' => $request->input('published_year'),
                'is_showing' => $request->input('is_showing'),
                'description' => $request->input('description'),
                'genre_id' => $genre->id,
              ]);

              DB::commit();

              return redirect('/admin/movies/')->with('success', '登録が完了しました');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create movie: ' . $e->getMessage());
            // 修正: 例外が発生した場合に500エラーを返す
            return response()->view('errors.500', [], 500);
        }

    }
    public function edit($id)
    {
        // ジャンル情報を含めて映画を取得
        $movie = Movie::with('genre')->findOrFail($id);

        return view('editMovies', ['movie' => $movie]);
    }
    public function update(UpdateMovieRequest $request, $id)
    {
        // ジャンル情報を含めて映画を取得
        $movie = Movie::with('genre')->findOrFail($id);

        DB::beginTransaction();

        try {
            $genreName = $request->input('genre');
            $genre = Genre::firstOrCreate(['name' => $genreName]);
            
            $movie->update([
            'title' => $request->input('title'),  
            'image_url' => $request->input('image_url'),
            'published_year' => $request->input('published_year'),
            'is_showing' => $request->input('is_showing'),
            'description' => $request->input('description'),
            'genre_id' => $genre->id,
            ]);

            DB::commit();

            return redirect('/admin/movies/')->with('success', '更新が完了しました');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create movie: ' . $e->getMessage());
            // 修正: 例外が発生した場合に500エラーを返す
            return response()->view('errors.500', [], 500);
        }
    
    }
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect('/admin/movies/')->with('success', '削除が完了しました');
    }

    public function schedules($id)
    {
        $movie = Movie::findOrFail($id);
        $schedules = Schedule::where('movie_id', $id)->orderBy('start_time', 'asc')->get();

        return view('detailMovie', compact('movie', 'schedules'));
    }
}