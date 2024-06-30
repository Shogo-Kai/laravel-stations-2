<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>作品リスト</title>
</head>
<body>
<div class="container">
    <h1>映画作品リスト</h1>

    <form method="GET" action="{{ url('/movies') }}">
        @csrf
        <div>
            <input type="text" name="keyword" class="form-control" placeholder="キーワードで検索" value="{{ request('keyword') }}">
        </div>
        <div>
            <div>
                <input type="radio" name="is_showing" value="" {{ request('is_showing') === null ? 'checked' : '' }}>
                <label>すべて</label>
            </div>
            <div>
                <input type="radio" name="is_showing" value="1" {{ request('is_showing') == '1' ? 'checked' : '' }}>
                <label>上映中</label>
            </div>
            <div>
                <input type="radio" name="is_showing" value="0" {{ request('is_showing') == '0' ? 'checked' : '' }}>
                <label>上映予定</label>
            </div>
        </div>
        <button type="submit">検索</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>映画タイトル</th>
                <th>映画のジャンル</th>
                <th>概要</th>
                <th>上映中か否か</th>
                <th>公開年</th>
                <th>画像</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->genre ? $movie->genre->name : '' }}</td>
                    <td>{{ $movie->description }}</td>
                    <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
                    <td>{{ $movie->published_year }}</td>
                    <td><img src="{{ $movie->image_url }}" alt="{{ $movie->title }}のポスター"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>