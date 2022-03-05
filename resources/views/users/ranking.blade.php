@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/assets/css/ranking.css">

        <title>StudyTime</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="main">
            <h1>ランキング</h1>
            <table class="ranking_table">
                <thead>
                    <tr>
                        <td>順位</td>
                        <td>ユーザー名</td>
                        <td>総勉強時間</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="value">{{ $loop->iteration }}位</td>
                            <td class="value">{{ $user->name}}</td>
                            @if (($user->total_time) >= 3600)
                                <td class="value">{{ floor($user->total_time / 3600) }}時間</td>
                            @elseif (($user->total_time) >= 60)
                                <td class="value">{{ floor($user->total_time / 60) }}分</td>
                            @elseif (($user->total_time) >= 0)
                                <td class="value">{{ $user->total_time }}秒</td>
                            @else
                                <td class="value">0秒</td>
                            @endif
                        </tr>
                    @endforeach
                    <tr>
                        <td>------</td>
                        <td>---------------</td>
                        <td>------</td>
                    </tr>
                    <tr class="myScore">
                        <td class="value myScore">{{ $result }}位</td>
                        <td class="value">{{ Auth::user()->name }}</td>
                        @if ((Auth::user()->total_time) >= 3600)
                            <td class="value">{{ floor(Auth::user()->total_time / 3600) }}時間</td>
                        @elseif ((Auth::user()->total_time) >= 60)
                            <td class="value">{{ floor(Auth::user()->total_time / 60) }}分</td>
                        @elseif ((Auth::user()->total_time) >= 1)
                            <td class="value">{{ Auth::user()->total_time }}秒</td>
                        @elseif ((Auth::user()->total_time) == 0)
                            <td class="value">0秒</td>
                        @endif
                    </tr>
                    
                </tbody>
                
            </table>
            <div class="footer">
                <a href="/">ホームに戻る</a>
            </div>
        </div>
    </body>
</html>
@endsection