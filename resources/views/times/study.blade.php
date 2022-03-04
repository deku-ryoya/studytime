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
                <!--<div id="timer">0時間00分</div>-->
                <h2>{{ $todo->body }}</h2>
                    <div id="timer">00:00:00</div>
                    <form action="/times/{{ $todo->id }}/study" method="POST" name="time[todo_id]">
                        @csrf
                        <div class="btn_form">
                            <button id="start" class='btn' name="time[start_at]" type="submit">start</button>
                            <!--<input type="hidden" name="time[start_at]" id="input_time" type="submit">-->
                            <!--<button id="stop" class="btn" name="time[stop_at]">stop</button>-->
                        <!--<a id="stop" class='btn' onclick="document.time_form.submit();">stop</a>-->
                            <a href="/end" id="end" class='btn' onclick="return confirm('本当に終了しますか？')">終了</a>
                        </div>
                    </form>
                <div class='tasks'>
                    <a href='/tasks'>本日のタスクを確認する</a>
                </div>
            </div>
        </div>
        <script>
            var defaultValue = '{{ $todo->tasks_time }}';
        </script>
        <script type="text/javascript" src="../assets/js/time.js"></script>
    </body>
</html>
@endsection