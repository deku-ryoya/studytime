<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css">

        <title>StudyTime</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <div>
            <h1>Study Time</h1>
        </div>
        <div class="profile">
            <a href="">ユーザー名</a>
            <h3>Lv.4</h3>
        </div>
        <div class="content">
            <a href="/times">勉強を始める</a>
            <a href="/tasks">今日のタスクを決める</a>
            <a href="">ランキングを確認する</a>
        </div>
    </body>
</html>
