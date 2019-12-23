<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title></title>
    <!-- Google fontを使用する場合、下記にcdnを記述 -->

    <!-- reset.cssへのリンク -->
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}" />
    <link rel="stylesheet" href="{{asset('/css/header.css')}}" />

    <!-- cssファイルへのリンク -->
    <link rel="stylesheet" href="" />
    <style>
    header{
        position: fixed;
        top: 0;
        right: 0;
      }
    </style>
  </head>

  <body>
    {{-- <div id="wapper">
      <header>
        <a href="#" class="logo">
          <img src="" alt="logo" width="180" height="100" />
        </a>
        <nav>
          <ul class="nav_flex">
            <li><a href="#">トップ（コマ一覧）</a></li>
            <li><a href="#">作品を見る</a></li>
            <li><a href="#">作品を作る</a></li>
            <li><a href="#">コマを作る</a></li>
            <li><a href="#">マイページ</a></li>
            <li><a href="#">ログアウト</a></li>
          </ul>
        </nav>
      </header>
      <main> --}}
        @include('header')
        <div class="main_container">
        @if (count($comas) > 0)
          <span>現在</span><span>{{(count($comas))}}</span><span>コマ</span>
          <input type="text" value = "{{($comas[0]->id)}}" id="comaCount">
        @endif
        <div id="canvas">
        <canvas id="c" height="886"></canvas>
        </div>
        <!-- 後で消すかも -->
          
        </div>
      </main>
      
    </div>

    <!-- jqueryの読み込み -->
    <script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
    <!-- jsファイルの読み込み -->
    <script src="{{asset('/js/fabric.js')}}"></script>
    <script>

    const comaCount = $("#comaCount").val();//service_contentsテーブルの最後のidを取得

    //コマ数に応じてcanvasのwidthを指定
    const can = document.getElementById("c");
    const ctx = can.getContext("2d");
    const canDiv = $("#canvas");
    
    // -----------テスト中----------- //
    can.width = 500*comaCount;//350×コマ数をcanvasのwidthに指定
    
    //ロード時に右へスクロールさせる
    // autoScroll();
    function autoScroll() {
      let $scrollX = 0;
      if(scrollX <= can.width - 2000) {
        scrollX+= 1;
        setTimeout( "scroll(scrollX,0)", 10 );
        console.log(scrollX)
        setTimeout( "autoScroll()", 1 );
      }else{
        return;
      }
    }
    // -----------テストここまで----------- //



    //fabricjs準備
    const canvas = this.__canvas = new fabric.Canvas('c');
    fabric.Object.prototype.originX = fabric.Object.prototype.originY = 'center';

    //イベントを取得して各関数を実行
    canvas.on({
    // 'object:selected': onObjectSelected,
    'object:moving': onObjectMoving
    // 'before:selection:cleared': onBeforeSelectionCleared
    });

    //全コマをフォルダから取得してcanvasに表示
    const comaId_array = JSON.parse('<?= $comas; ?>').reverse();//コマのidを配列で取得して逆順にする
    let preline = null;//コマの前につながってる線の情報をいれる用の変数
    $(function(){
        for(let i=0,left =200,top=500;i<comaId_array.length;i++,left +=400){//線の上下を判定するために条件分岐
          const comaId = comaId_array[i].id;//コマのid取得

          //奇数と偶数で分岐 + 最後のコマ以降に線を引かないようにする
          if(i%2 == 0 && i != comaId_array.length-1){
            //つむぐ線を表示
            let line = lineDisplay(top,left,top-500,left+200,left+400,250);
            //コマ表示
            if(i ==0 ){//最初のコマだけname変える 
              let p1 = comaDisplay(comaId,"p0_f",left,top,line,"p1",null,null);
            }else{  
              let p1 = comaDisplay(comaId,"p0",left,top,line,"p1",null,preline);
            }

            console.log(preline)
              //前の線を取得してグローバル変数に格納
              preline = line;
          }
          else if(i%2 == 1 && i != comaId_array.length-1){
            //つむぐ線を表示
            let line = lineDisplay(top,left,top+400,left+200,left+400,700);

            //コマ表示(name:"p1")
            let p2 = comaDisplay(comaId,"p2",left,top,null,"p1",line,preline);
            //前の線を取得してグローバル変数に格納
            preline = line;
          }
          else {
            //最後のコマを表示(線を続けないために分岐してる)
            //[TODO]ひとまずline部分はnull
            let p1 = comaDisplay(comaId,"p0_e",left,top,null,"p1",null,preline);
          }
        };//for文終わり
    });//関数終わり

    //表示するコマのパラメータ付与する関数
    function comaDisplay(id,name,left,top,line1,line2,line3,preline){
      fabric.Image.fromURL(`{{asset('/img/coma/c_${id}.png')}}`, function(oImg) {
            //画像をランダム位置で表示
            const imgLeft = Math.ceil(Math.random() * 1600);//位置をランダムで指定 
            const imgTop = Math.ceil(Math.random() * 866); //位置をランダムで指定
            //パラメータをオブジェクトに格納
            oImg.scaleToWidth(200);//画像の大きさ
            oImg.set({
              left:left,//leftからの位置
              top:top,//topからの位置
              strokeWidth: 5, stroke: 'rgba(0,0,0,0.1)',
              // selectable:false,
              hasRotatingPoint: false,//回転を制限
              hasControls: false,//拡大縮小を制限
              name:name,
              line1:line1,
              line2:line2,
              line3:line3,
              preline:preline
            });
            canvas.add(oImg);//追加
            return oImg;
            // console.log(oImg);
            });
    }

    //線を表示する関数(引数:start_top,start_left,curve_top,curve_left,stop_left,curve_point_top)
    const lineObj = null;
    function lineDisplay(top,left,c_top,c_left,s_left,c_p_top){
      var line = new fabric.Path('M 65 0 Q 100, 100, 200, 0', { fill: '',stroke: 'rgb(25, 51, 82)',strokeWidth: 5, objectCaching: false});
            //pathの座標
            line.path[0][1] = left;//start_left
            line.path[0][2] = top;//start_top

            line.path[1][1] = c_left;//curvepoint_left
            line.path[1][2] = c_top;//curvepoint_top

            line.path[1][3] = s_left;//stop_left
            line.path[1][4] = top;//stop_top

            line.selectable = false;
            line.name = "line";
            canvas.add(line);
            //カーブポイント生成
            let p1 = makeCurvePoint(line.path[1][1],c_p_top, null, line, null);
            p1.name = "p1";
            canvas.add(p1);
            return line;
            // console.log(line);
            // console.log(lineObj);
    }


  //カーブポイント生成
  function makeCurvePoint(left, top, line1, line2, line3) {
    var c = new fabric.Circle({
      left: left,
      top: top,
      strokeWidth: 8,
      radius: 14,
      fill: '',
      stroke: ''
    });

    c.hasBorders = c.hasControls = false;

    c.line1 = line1;
    c.line2 = line2;
    c.line3 = line3;

    return c;
  }

  //オブジェクトが動いた時に線と画像を移動に合わせて連携させる
  function onObjectMoving(e) {
    if (e.target.name == "p0" || e.target.name == "p2") {
      var p = e.target;
      //[TODO]つながってる先の線も連動させる
      if (p.line1) {
        console.log(p.preline)
        p.line1.path[0][1] = p.left;//start_left
        p.line1.path[0][2] = p.top;//start_top
        p.preline.path[1][3] = p.left;
        p.preline.path[1][4] = p.top;

        p.line1.path
      }
      else if (p.line3) {
        p.line3.path[0][1] = p.left;
        p.line3.path[0][2] = p.top;
        p.preline.path[1][3] = p.left;
        p.preline.path[1][4] = p.top;
      }
    }
    else if (e.target.name == "p1") {
      var p = e.target;

      //移動後の位置をsetしてる?
      if (p.line2) {
        p.line2.path[1][1] = p.left;
        p.line2.path[1][2] = p.top - 200;
      }
    }
    else if (e.target.name == "p0" || e.target.name == "p2") {
      var p = e.target;
      // p.line1 && p.line1.set({ 'x2': p.left, 'y2': p.top });
      // p.line2 && p.line2.set({ 'x1': p.left, 'y1': p.top });
      // p.line3 && p.line3.set({ 'x1': p.left, 'y1': p.top });
      // p.preline && p.preline.set({ 'x2': p.left, 'y2': p.top });
    }else if(e.target.name == "p0_f") {
      var p = e.target;
      p.line1.path[0][1] = p.left;//start_left
      p.line1.path[0][2] = p.top;//start_top
      //[TODO]つながってる先の線も連動させる
    }else if(e.target.name == "p0_e"){
      var p = e.target;
      p.preline.path[1][3] = p.left;
      p.preline.path[1][4] = p.top;
    }
}

    //-------テストここまで--------//
    //下記必要なさそうなのでコメントアウト中
  // function onBeforeSelectionCleared(e) {
  //   var activeObject = e.target;
  //   if (activeObject.name == "p0" || activeObject.name == "p2") {
  //     activeObject.line2.animate('opacity', '0', {
  //       duration: 200,
  //       onChange: canvas.renderAll.bind(canvas),
  //     });
  //     activeObject.line2.selectable = false;
  //   }
  //   else if (activeObject.name == "p1") {
  //     activeObject.animate('opacity', '0', {
  //       duration: 200,
  //       onChange: canvas.renderAll.bind(canvas),
  //     });
  //     activeObject.selectable = false;
  //   }
  // }

      //オブジェクトが選択されたら
  //   function onObjectSelected(e) {
  //   var activeObject = e.target;
  //   console.log(activeObject);
  //   if (activeObject.name == "p1" || activeObject.name == "p2") {
  //     activeObject['line'].animate('opacity', '1', {
  //       duration: 200,
  //       onChange: canvas.renderAll.bind(canvas),
  //     });
  //     activeObject.line2.selectable = true;
  //   }
  // }
    </script>
  </body>
</html>
