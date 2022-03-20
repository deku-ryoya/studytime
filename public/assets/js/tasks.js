'use strict';

function deleteTodo(e) {
    if (confirm('本当に削除してよろしいでしょうか？')) {
        return true;
    }else {
        return false;
    }
}
