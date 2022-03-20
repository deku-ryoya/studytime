@extends('layouts.app')

@section('content')

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
        <div class="main">
            <div class='container'>
                <h2>{{ $todo->body }}</h2>
                    <div id="timer">00:00:00</div>
                     <form action="/times/{{ $todo->id }}" method="POST" name="time[todo_id]">
                        @csrf
                        <div class="btn_form">
                            <button id="stop" class="btn" type="submit" name="time[stop_at]">stop</button>
                        </div>
                    </form>
                <div class='tasks'>
                    <a href='/tasks'>本日のタスクを確認する</a>
                </div>
            </div>
        </div>
        <script>
            var restartTime = '{{ $todo->tasks_time }}';
        </script>
        <script type="text/javascript" src="../../assets/js/dynamic.js"></script>
    </body>
</html>
@endsection