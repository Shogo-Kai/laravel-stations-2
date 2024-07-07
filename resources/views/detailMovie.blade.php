<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画の詳細</title>
</head>
<body>
    <h1>{{ $movie->title }} (Movie_ID; {{ $movie->id }})</h1>
    <p>{{ $movie->published_year }}</p>
    <p>{{ $movie->description }}</p>
    <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}のポスター">
    
    <h2>上映スケジュール</h2>

    <ul>
            @foreach ($schedules as $schedule)
                <li>
                    <span>上映時間: {{ $schedule->start_time->format('H:i')}}</span>
                    <span>- {{ $schedule->end_time->format('H:i')}}</span>
                </li>
            @endforeach
    </ul>
</body>
</html>