@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/assets/css/profile.css">

        <title>StudyTime</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="main">
            <h1>プロフィール</h1>
            <table class="profile_table">
                <tbody>
                    <tr>
                        <td class="title">ユーザー名</td>
                        <td class="value">{{ Auth::user()->name}}</td>
                    </tr>
                    <tr>
                        <td class="title">総勉強時間</td>
                        @if (($user->total_time) >= 3600)
                            <td class="value">{{ floor($user->total_time / 3600) }}時間</td>
                        @elseif (($user->total_time) >= 60)
                            <td class="value">{{ floor($user->total_time / 60) }}分</td>
                        @elseif (($user->total_time) > 0)
                            <td class="value">{{ $user->total_time }}秒</td>
                        @else 
                            <td class="value">0秒</td>
                        @endif
                    </tr>
                    <tr>
                        <td class="title">ランキング</td>
                        <td class="value">{{ $result }}位</td>
                    </tr>
                    <tr>
                        <td class="title">総達成タスク数</td>
                        @if ($user->total_task > 0)
                            <td class="value">{{ $user->total_task }}個</td>
                        @else
                            <td class="value">0個</td>
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