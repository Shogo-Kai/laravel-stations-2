<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>createMovies</title>
</head>
<body>
    <h2>映画登録画面</h2>

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ url('/admin/movies/store') }}" method="post">
        @csrf
        <label>映画タイトル</label><br />
        <input type="text" name="title" value="{{ old('title') }}"/><br />
        <label>映画のジャンル</label><br />
        <input type="text" name="genre" value="{{ old('genre') }}"/><br />
        <label>画像URL</label><br />
        <input type="url" name="image_url" value="{{ old('image_url') }}"/><br />
        <label>公開年</label><br />
        <input type="text" name="published_year" value="{{ old('published_year') }}"/><br />
        <label>上映中か否か</label><br />
        <input type="hidden" name="is_showing" value="0">
        <input type="checkbox" name="is_showing" value="1" {{ old('is_showing') ? 'checked' : '' }}/><br />
        <label>概要</label><br />
        <textarea name="description">{{ old('description') }}</textarea><br />
        <button type="submit">登録</button>
    </form>
</body>
</html>