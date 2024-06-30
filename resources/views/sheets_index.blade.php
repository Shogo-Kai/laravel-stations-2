<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席表</title>
</head>
<body>
<div class="container">
    <h1>座席表</h1>

    <table border="1">
        <thead>
            <tr>
                <th>.</th>
                <th>.</th>
                <th>スクリーン</th>
                <th>.</th>
                <th>.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sheets as $row => $columns)
                <tr>
                    @foreach ($columns as $sheet)
                        <td>{{ $sheet->row }}-{{ $sheet->column }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>