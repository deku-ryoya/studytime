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
                    <input type="text" name="todo[body]" class="task_form" placeholder="タスク">
                    @if ($errors->has('todo.body'))
                        <p class="body__error">タスクを記入してください</p>
                    @endif
                </div>
                <button type="submit" class="btn add_task">追加</button>
            </form>
            
            <table class="task_table">
                <thead>
                    <tr>
                        <!--<th>本日のタスク</th>-->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)
                        <tr>
                            <td class="task_content">{{ $todo->body }}</td>
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
                <a href="/times">勉強に戻る</a>
                <a href="/">ホームに戻る</a>
            </div>
        </div>
        <script type="text/javascript" src="assets/js/tasks.js"></script>
    </body>
</html>
