<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画の詳細</title>
</head>
<body>
<div class="container">
    <h1>映画の詳細</h1>

    <table>
        <thead>
            <tr>
                <th>映画タイトル</th>
                <th>映画のジャンル</th>
                <th>概要</th>
                <th>上映中か否か</th>
                <th>公開年</th>
                <th>画像</th>
                <th>開始時刻</th>
                <th>終了時刻</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->genre ? $movie->genre->name : '' }}</td>
                    <td>{{ $movie->description }}</td>
                    <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
                    <td>{{ $movie->published_year }}</td>
                    <td><img src="{{ $movie->image_url }}" alt="{{ $movie->title }}のポスター"></td>
            @foreach ($schedules as $schedule)
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>