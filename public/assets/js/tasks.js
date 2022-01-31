'use strict';

function deleteTodo(e) {
    if (confirm('本当に削除してよろしいでしょうか？')) {
        return true;
        // document.getElementById('form_delete').submit();
    }else {
        return false;
    }
}
// function deleteTodo(e) {
//     if (confirm('本当に削除してよろしいでしょうか？')) {
//         document.getElementById('form_{{ $todo->id }}').submit();
//     }
// }