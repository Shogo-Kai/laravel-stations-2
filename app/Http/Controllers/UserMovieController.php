<?php

namespace App\Http\Controllers;

use App\Models\Sheet;

class UserMovieController extends Controller
{
    public function sheets()
    {
        $sheets = Sheet::all()->groupBy('row');
        return view('sheets_index', ['sheets' => $sheets ]);
    }
}