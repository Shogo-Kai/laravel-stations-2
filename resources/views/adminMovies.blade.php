<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理者画面</title>
</head>
<body>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <ul>
    @foreach ($movies as $movie)
        <li>映画タイトル: {{ $movie->title }}</li>
        <li>映画のジャンル: {{ $movie->genre ? $movie->genre->name : '未設定' }}</li>
        <li>公開年: {{ $movie->published_year }}</li>
        <li>
        @if($movie->is_showing)
            上映中
        @else
            上映予定
        @endif
        </li>
        <li>概要: {{ $movie->description }}</li>
        <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}のポスター"  width="640" height="480"><br>
        <button onclick="location.href='/admin/movies/{{ $movie->id }}/edit/'">編集</button>
        <form action="/admin/movies/{{ $movie->id }}/destroy" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" onclick='return confirm("本当に削除しますか？")'>削除</button>
        </form>
    @endforeach
    </ul>
</body>
</html>