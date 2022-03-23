// (function() {
    'use strict';
    
    const timer = document.getElementById('timer');
    const start = document.getElementById('start');
    const stop = document.getElementById('stop');
    const end = document.getElementById('end');
    const hiddenField = document.getElementById('input_time');
    
    //クリック時の時間を保持するための変数定義
    let startTime = Date.now();
    //経過時刻を更新するための変数。 初めはだから0で初期化
    let elapsedTime = 0;
    //タイマーを止めるためのclearTimeoutの引数に渡すためのタイマーのidが必要
    let timerId;
    //タイマーを再開させたときに0になるのを避けるための変数
    let timeToadd = 0;
    let defaultTime = restartTime * 1000;
    
    
    //ミリ秒単位から秒、分、時単位にするための関数
    function updateTimeText() {
        //h=時, m=分、s=秒
        let h = Math.floor(elapsedTime / 3600000);
        let m = Math.floor(elapsedTime % 3600000 / 60000);
        let s = Math.floor(elapsedTime % 60000 / 1000);
        
        //HTML上で表示の桁数を2桁に固定する 例（00:00:00）
        //文字列の末尾の2桁を表示する
        h = ('0' + h).slice(-2); 
        m = ('0' + m).slice(-2); 
        s = ('0' + s).slice(-2);

        //HTMLのid timer部分に表示させる
        timer.textContent = h + ':' + m + ':' + s;
    }
    
    
    //再帰的に使える用の関数
    function countUp() {
        
        //timerId変数はsetTimeoutの返り値になるので代入する
        timerId = setTimeout(function() {
            
             //経過時刻はDate.now()からstartを押した時の時刻(startTime)を引く
            elapsedTime = Date.now() + defaultTime - startTime + timeToadd;
            updateTimeText();

            countUp();
        },100);
    }
    
    
    // 状態:タイマー動作中
  function setButtonStateRunning() {
    //   start.classList.add('inactive'); // 非活性
      stop.classList.remove('inactive'); // 活性
    //   end.classList.add('inactive'); // 非活性
    //   end.classList.add('disable'); // 非活性
    //   stop.classList.add('disable'); // 非活性
  }
   
   
    // 状態:タイマーストップ中
  function setButtonStateStopped() {
      start.classList.remove('inactive'); // 活性
      stop.classList.add('inactive'); // 非活性
      end.classList.remove('inactive'); // 活性
      end.classList.remove('disable'); //活性
      stop.classList.remove('disable'); //活性
  }
   
    
    // ボタンを'動作'状態とする
    setButtonStateRunning();
    
    countUp();
    
    //stopボタンにクリック時のイベントを追加(タイマーストップイベント)
    stop.addEventListener('click',function(){
      if (stop.classList.contains('inactive')) {
          return;
      }
    
        //タイマーを止めるためのclearTimeoutの引数に渡すためのタイマーのidが必要
      clearTimeout(timerId);
    
      setButtonStateStopped();
    
        //タイマーに表示される時間elapsedTimeが現在時刻かたスタートボタンを押した時刻を引いたものなので、
        //タイマーを再開させたら0になってしまう。elapsedTime = Date.now - startTime
        //それを回避するためには過去のスタート時間からストップ時間までの経過時間を足してあげなければならない。
        //elapsedTime = Date.now - startTime + timeToadd (timeToadd = ストップを押した時刻(Date.now)から直近のスタート時刻(startTime)を引く)
      timeToadd += Date.now() - startTime;
      hiddenField.value = elapsedTime;
    });
    
// })