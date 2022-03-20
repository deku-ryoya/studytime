// (function() {
    'use strict';
    
    const timer = document.getElementById('timer');
    
    let defaultTime = defaultValue * 1000;
    
    
    function defaultTimeText() {
        
        let h = Math.floor(defaultTime / 3600000);
        let m = Math.floor(defaultTime / 60000);
        let s = Math.floor(defaultTime % 60000 / 1000);
        
        //HTML上で表示の桁数を2桁に固定する 例（00:00:00）
        //文字列の末尾の2桁を表示する
        h = ('0' + h).slice(-2); 
        m = ('0' + m).slice(-2); 
        s = ('0' + s).slice(-2);
        
        //HTMLのid timer部分に表示させる
        // timer.textContent = h + '時間' + m + '分';
        timer.textContent = h + ':' + m + ':' + s;
    }
    defaultTimeText();
    
// })