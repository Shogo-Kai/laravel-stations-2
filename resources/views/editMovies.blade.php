<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編集画面</title>
</head>
<body>
    <h2>映画一覧編集画面</h2>

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ url('/admin/movies/{id}/update') }}" method="post">
        @method('PATCH')
        @csrf
        <label>映画タイトル</label><br />
        <input type="text" name="title" value="{{ $movie->title }}"/><br />
        <label>画像URL</label><br />
        <input type="url" name="image_url" value="{{ $movie->image_url }}"/><br />
        <label>公開年</label><br />
        <input type="text" name="published_year" value="{{ $movie->published_year }}"/><br />
        <label>公開中か否か</label><br />
        <input type="checkbox" name="is_showing" {{ $movie->is_showing ? 'checked' : '' }}/><br />
        <label>概要</label><br />
        <textarea name="description">{{ $movie->description }}</textarea><br />
        <button type="submit">更新</button>
    </form>
</body>
</html>