<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Practice;
use App\Models\Movie;
use App\Models\Genre;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ジャンルをいくつか作成
        $genres = Genre::factory(2)->create();

        // 各ジャンルに対して映画を生成
        $genres->each(function($genre) {
            Movie::factory(2)->create([
                'genre_id' => $genre->id
            ]);
        });

        $this->call([
            SheetTableSeeder::class,
        ]);
    }
}