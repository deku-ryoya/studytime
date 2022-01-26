<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/assets/css/times.css">

        <title>StudyTime</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class='container'>
            <div id="timer">00:00</div>
            <div class="btn">
                <a id="start" class='btn'>start</a>
                <a id="stop" class='btn'>stop</a>
                <a href="/end" id="end" class='btn disable' onclick="return confirm('本当に終了しますか？')">終了</a>
            </div>
            <div class='tasks'>
                <a href='/tasks'>本日のタスクを確認する</a>
            </div>
        </div>
        <script type="text/javascript" src="assets/js/time.js"></script>
    </body>
</html>
