'use strict';

function deleteTodo(e) {
    if (confirm('本当に削除してよろしいでしょうか？')) {
        return true;
        // document.getElementById('form_delete').submit();
    }else {
        return false;
    }
}

// function clearBtn(e){
//     const button = document.getElementById("form_delete{{ $todo->id }}");
//     button.disabled = true;
//     console.log("owari");
// }


// // function clearBtn(clear_btn){
//     var clearbtn = document.getElementById(clear_btn);
//     if(clearbtn.{
//      clearbtn.classList.add('del');
//     }else{
//      clearbtn.style.textDecoration = "underline overline line-through";
//     }
// }