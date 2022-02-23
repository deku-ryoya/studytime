<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/assets/css/tasks.css">

        <title>StudyTime</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="main">
            <div class="container">
                <h1>本日のタスク</h1>
                <h2>本日のタスクを追加する</h2>
            </div>
            <form action="/tasks" method="POST">
                @csrf
                <div class="form_group">
                    <!--<label>本日のタスクを追加してください！</label>-->
                    <input type="text" name="todo[body]" class="task_form" placeholder="タスク" value="{{ old('todo.body') }}">
                    @if ($errors->has('todo.body'))
                        <p class="body__error">タスクを記入してください</p>
                    @endif
                    <input type="text" name="todo[task_target_time]" class="task_time_form" placeholder="目標時間(0時間00分)" value="{{ old('todo.task_target_time') }}">
                    @if ($errors->has('todo.task_target_time'))
                        <p class="body__error">目標時間を記入してください</p>
                    @endif
                </div>
                <button type="submit" class="btn add_task">追加</button>
            </form>
            
            <table class="task_table">
                <thead>
                    <tr>
                        <th></th>
                        <th>目標時間</th>
                        <th>達成時間</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)
                        <tr>
                            <td class="task_content" id="target{{ $todo->id }}">{{ $todo->body }}</td>
                            <td class="task_time">{{ $todo->task_target_time }}</td>
                            @foreach ((array)$todo->tasks_time as $elapsedtime)
                                @if (($elapsedtime) >= 3600)
                                    <td>{{ floor($elapsedtime / 3600) }}時間</td>
                                @elseif (($elapsedtime) >= 60)
                                    <td>{{ floor($elapsedtime / 60) }}分</td>
                                @elseif (($elapsedtime) >= 0)
                                    <td>{{ $elapsedtime }}秒</td>
                                @elseif (!isset($elapsedtime))
                                    <td>0分(null)</td>
                                @else
                                    <td>0分(null)</td>
                                @endif
                            @endforeach
                    
                            <td>
                                <a href="/times/{{ $todo->id }}">勉強を始める</a>
                            </td>
                            <td>
                                <button id="clear_btn" onclick="clearBtn('target{{ $todo->id }}');">達成</button>
                            </td>
                            <td>
                                <form action="/tasks/{{ $todo->id }}" id="form_delete" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return deleteTodo(this);" class="btn delete_task">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
            
                
            <div class="footer">
                <!--<a href="/times">勉強に戻る</a>-->
                <a href="/">ホームに戻る</a>
            </div>
        </div>
        <script type="text/javascript" src="assets/js/tasks.js"></script>
    </body>
</html>
