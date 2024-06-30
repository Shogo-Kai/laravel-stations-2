<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',         // 映画のタイトル
        'image_url',     // 映画の画像URL
        'published_year',// 映画の公開年
        'is_showing',    // 映画が上映中かどうか
        'description',   // 映画の説明
        'genre_id',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
