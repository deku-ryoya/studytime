@extends('layouts.app')

@section('content')

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
            <h1>{{Auth::user()->name}}さん<br>おつかれさまでした!</h1>
            
            <table class="time_table">
                <tbody>
                    <tr>
                        <td class="title">本日の勉強時間</td>
                        @if (($user->today_time) >= 3600)
                            <td class="value">{{ floor($user->today_time / 3600) }}時間</td>
                        @elseif (($user->today_time) >= 60)
                            <td class="value">{{ floor($user->today_time / 60) }}分</td>
                        @elseif (($user->today_time) >= 0)
                            <td class="value">{{ $user->today_time }}秒</td>
                        @endif
                    </tr>
                    <tr>
                        <td class="title">総勉強時間</td>
                        @if (($user->total_time) >= 3600)
                            <td class="value">{{ floor($user->total_time / 3600) }}時間</td>
                        @elseif (($user->total_time) >= 60)
                            <td class="value">{{ floor($user->total_time / 60) }}分</td>
                        @elseif (($user->total_time) >= 0)
                            <td class="value">{{ $user->total_time }}秒</td>
                        @endif
                    </tr>
                </tbody>
            </table>
            
            
            <h2 class="today_task">本日達成したタスク</h2>
            <table class="task_table">
                <thead>
                    <tr>
                        <td class="title">タスク名</td>
                        <td class="title">達成時間</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)
                        @if (($todo->achievement_task) == 1)
                            <tr>
                                <td class="value">{{ $todo->body }}</td>
                                @foreach ((array)$todo->tasks_time as $elapsedtime)
                                    @if (($elapsedtime) >= 3600)
                                        <td class="value">{{ floor($elapsedtime / 3600) }}時間</td>
                                    @elseif (($elapsedtime) >= 60)
                                        <td td class="value">{{ floor($elapsedtime / 60) }}分</td>
                                    @elseif (($elapsedtime) >= 0)
                                        <td td class="value">{{ $elapsedtime }}秒</td>
                                    @elseif (!isset($elapsedtime))
                                        <td td class="value">0分(null)</td>
                                    @else
                                        <td td class="value">0分(null)</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            
            <a href="/tasks">もう少し勉強を行う！</a>
            <div class="footer">
                <a href="/">ホームに戻る</a>
            </div>
        </div>
    </body>
</html>
@endsection