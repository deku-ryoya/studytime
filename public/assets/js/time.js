// (function() {
    'use strict';
    
    const timer = document.getElementById('timer');
    const tasks_timer = document.getElementById('tasks_timer');
    const start = document.getElementById('start');
    const stop = document.getElementById('stop');
    const end = document.getElementById('end');
    const disable = document.getElementsByClassName('disable');
    const hiddenField = document.getElementById('input_time');
    
    //クリック時の時間を保持するための変数定義
    let startTime;
    //経過時刻を更新するための変数。 初めはだから0で初期化
    let elapsedTime = 0;
    let tasks_elapsedTime = 0;
    //タイマーを止めるためのclearTimeoutの引数に渡すためのタイマーのidが必要
    let timerId;
    //タイマーを再開させたときに0になるのを避けるための変数
    let timeToadd = 0;
    let tasks_timeToadd = 0;
    
    let total_time = 0;
    
    //ミリ秒単位から秒、分、時単位にするための関数
    function updateTimeText() {
        //h=時, m=分、s=秒
        let h = Math.floor(elapsedTime / 3600000);
        let m = Math.floor(elapsedTime / 60000);
        let s = Math.floor(elapsedTime % 60000 / 1000);
        
        let th = Math.floor(tasks_elapsedTime / 3600000);
        let tm = Math.floor(tasks_elapsedTime / 60000);
        let ts = Math.floor(tasks_elapsedTime % 60000 / 1000);
        
        //HTML上で表示の桁数を2桁に固定する 例（00:00:00）
        //文字列の末尾の2桁を表示する
        h = ('0' + h).slice(-2); 
        m = ('0' + m).slice(-2); 
        s = ('0' + s).slice(-2);
        
        th = ('0' + th).slice(-2); 
        tm = ('0' + tm).slice(-2); 
        ts = ('0' + ts).slice(-2);
        
        //HTMLのid timer部分に表示させる
        timer.textContent = h + '時間' + m + '分';
        tasks_timer.textContent = th + ':' + tm + ':' + ts;
    }
    
    
    //再帰的に使える用の関数
    function countUp() {
        
        //timerId変数はsetTimeoutの返り値になるので代入する
        timerId = setTimeout(function() {
            
             //経過時刻はDate.now()からstartを押した時の時刻(startTime)を引く
            elapsedTime = Date.now() - startTime + timeToadd;
            tasks_elapsedTime = Date.now() - startTime + tasks_timeToadd;
            updateTimeText();
            
            countUp();
        },100);
    }
    
    
    // 状態:初期
   function setButtonStateInitial() {
       start.classList.remove('inactive'); // 活性
       stop.classList.add('inactive'); // 非活性
       end.classList.add('inactive'); // 非活性
    //   end.classList.add('disable'); // 非活性
   }
   
   
    // 状態:タイマー動作中
   function setButtonStateRunning() {
       start.classList.add('inactive'); // 非活性
       stop.classList.remove('inactive'); // 活性
       end.classList.add('inactive'); // 非活性
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
   
   
    
    // ボタンを'初期'状態とする
    setButtonStateInitial();
    
    
    
    //startボタンにクリック時のイベントを追加(タイマースタートイベント)
    start.addEventListener('click', function() {
        if (start.classList.contains('inactive')) {
            return;
        }
            
        //ボタンを'動作'状態とする
        setButtonStateRunning();
        
        //在時刻を示すDate.nowを代入
        startTime = Date.now();
        
        //再帰的に使えるように関数を作る
        countUp();
            
    });
    
    
    
    
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
      tasks_timeToadd += Date.now() - startTime;
      hiddenField.value = elapsedTime;
    });
    
    
     //終了ボタンにクリック時のイベントを追加(タイマーリセットイベント)
    end.addEventListener('click',function(){
        if (end.classList.contains('inactive')) {
            return;
        } 
        if (confirm('本当に終了しますか?？')) {
            
            
            
            let minutes = Math.floor(elapsedTime / 60000);
            let second = Math.floor(elapsedTime % 60000 / 1000);
            
            
            total_time = total_time + elapsedTime;
            
            let total_minutes = Math.floor(total_time / 60000);
            let total_second = Math.floor(total_time % 60000 / 1000);
            // console.log(total_time);
            
            alert(`今回は${minutes}分${second}秒勉強しました`);
            alert(`総勉強時間${total_minutes}分${total_second}秒です！`);
            
            //経過時刻を更新するための変数elapsedTimeを0にしてあげつつ、updateTimetTextで0になったタイムを表示。
            tasks_elapsedTime = 0;
            elapsedTime = 0;
        
            //リセット時に0に初期化したいのでリセットを押した際に0を代入してあげる
            timeToadd = 0;
            
            setButtonStateInitial();
        
            //updateTimetTextで0になったタイムを表示
            updateTimeText();
        }
    
    });
    
// })