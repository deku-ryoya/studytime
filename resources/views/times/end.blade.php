<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/assets/css/end.css">

        <title>StudyTime</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="main">
            <h1>userさん<br>おつかれさまでした!</h1>
            <p>総勉強時間</p>
            @if (($total) >= 3600)
                <p>{{ floor($total / 3600) }}時間</p>
            @elseif (($total) >= 60)
                <p>{{ floor($total / 60) }}分</p>
            @elseif (($total) >= 0)
                <p>{{ $total }}秒</p>
            @endif
            
            
            <a href="/tasks">もう少し勉強を行う！</a>
        </div>
    </body>
</html>
