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
          <a href="">閉じる</a>
        </div>
      </main>
      <footer>(c)///////サービス名が入ります//////</footer>
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
    autoScroll();
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


    //fabricjs準備
    const canvas = this.__canvas = new fabric.Canvas('c');
    fabric.Object.prototype.originX = fabric.Object.prototype.originY = 'center';
      
    //全コマをフォルダから取得してcanvasに表示
    const comaId_array = JSON.parse('<?= $comas; ?>').reverse();//コマのidを配列で取得して逆順にする
    $(function(){
        for(let i=0,left =200,top=500;i<comaId_array.length;i++,left +=400){
          
          if(i%2 == 0 && i != comaId_array.length-1){
            //------つむぐ線を表示-----//
            var line = new fabric.Path('M 65 0 Q 100, 100, 200, 0', { fill: '', stroke: 'rgb(25, 51, 82)',strokeWidth: 5, objectCaching: false });
            //pathの座標
            line.path[0][1] = left;//start_left
            line.path[0][2] = top;//start_top

            line.path[1][1] = left + 200;//curvepoint_left
            line.path[1][2] = 100;//curvepoint_top

            // line.path[1][3] = 500;//stop_left
            // line.path[1][4] = 500;//stop_top
            line.path[1][3] = left + 400;//stop_left
            line.path[1][4] = top;//stop_top
            line.selectable = false;
            canvas.add(line);
          }else if(i%2 == 1 && i != comaId_array.length-1){
            //------つむぐ線を表示-----//
            var line = new fabric.Path('M 65 0 Q 100, 100, 200, 0', { fill: '',stroke: 'rgb(25, 51, 82)',strokeWidth: 5, objectCaching: false});
            //pathの座標
            line.path[0][1] = left;//start_left
            line.path[0][2] = top;//start_top

            line.path[1][1] = left + 200;//curvepoint_left
            line.path[1][2] = 900;//curvepoint_top

            // line.path[1][3] = 500;//stop_left
            // line.path[1][4] = 500;//stop_top
            line.path[1][3] = left + 400;//stop_left
            line.path[1][4] = top;//stop_top
            line.selectable = false;
            canvas.add(line);
          }
            //-------コマを表示--------// 
            const comaId = comaId_array[i].id;
            fabric.Image.fromURL(`{{asset('/img/coma/c_${comaId}.png')}}`, function(oImg) {
            //画像をランダム位置で表示
            const imgLeft = Math.ceil(Math.random() * 1600);//位置をランダムで指定 
            const imgTop = Math.ceil(Math.random() * 866); //位置をランダムで指定
            oImg.scaleToWidth(200);//画像の大きさ
            oImg.set({
              left:left,//leftからの位置
              top:top,//topからの位置
              strokeWidth: 5, stroke: 'rgba(0,0,0,0.1)',
              selectable:false,
              hasRotatingPoint: false,//回転を制限
              hasControls: false//拡大縮小を制限
            });
            canvas.add(oImg);//追加
            });
        };
    });

    //-------テスト--------//


  canvas.on({
    'object:selected': onObjectSelected,
    'object:moving': onObjectMoving,
    'before:selection:cleared': onBeforeSelectionCleared
  });
    let img1 =[],img2 = [];
    new fabric.Image.fromURL(`{{asset('/img/coma/c_1.png')}}`, 
    function(oImg1) {
            //画像をランダム位置で表示
            // const imgLeft = Math.ceil(Math.random() * 1600);//位置をランダムで指定 
            // const imgTop = Math.ceil(Math.random() * 866); //位置をランダムで指定
            oImg1.scaleToWidth(200);//画像の大きさ
            oImg1.set({
              left:100,//leftからの位置
              top:100,//topからの位置
              strokeWidth: 5, stroke: 'rgba(0,0,0,0.1)',
              hasRotatingPoint: false,//回転を制限
              hasControls: false,//拡大縮小を制限
              lockMovementX:true,
              lockMovementY:true,
              // パラメータ付与
              line1:"line1",
              line2:"line2",
              line3:"line3",
              name:"p0"
            });
            img1.push(oImg1.left,oImg1.top);//位置を配列に格納
            // canvas.add(oImg1);//追加
        });

    new fabric.Image.fromURL(`{{asset('/img/coma/c_2.png')}}`,
    function(oImg2) {
            // 画像をランダム位置で表示
            // const imgLeft = Math.ceil(Math.random() * 1600);//位置をランダムで指定 
            // const imgTop = Math.ceil(Math.random() * 866); //位置をランダムで指定
            oImg2.scaleToWidth(200);//画像の大きさ
            oImg2.set({
              left:600,//leftからの位置
              top:100,//topからの位置
              strokeWidth: 5, stroke: 'rgba(0,0,0,0.1)',
              hasRotatingPoint: false,//回転を制限
              hasControls: false,//拡大縮小を制限
              lockMovementX:true,
              // パラメータ付与
              line1:"line1",
              line2:"line2",
              line3:"line3",
              name:"p2"
            });
            img2.push(oImg2.left,oImg2.top);//位置を配列に格納
            // canvas.add(oImg2);//追加
        });

        // console.log(img1)
        // console.log(img2)

var line = new fabric.Path('M 65 0 Q 100, 100, 200, 0', { fill: '', stroke: 'black', objectCaching: false });
//pathの座標
line.path[0][1] = 100;//start_left
line.path[0][2] = 100;//start_top

line.path[1][1] = 200;//curvepoint_left
line.path[1][2] = 200;//curvepoint_top

// line.path[1][3] = 500;//stop_left
// line.path[1][4] = 500;//stop_top
line.path[1][3] = 600;//stop_left
line.path[1][4] = 100;//stop_top

line.selectable = false;
// canvas.add(line);


var p1 = makeCurvePoint(200, 200, null, line, null)
    p1.name = "p1";
    // canvas.add(p1);


    //オブジェクトが選択されたら
    function onObjectSelected(e) {
    var activeObject = e.target;
    console.log(activeObject);
    if (activeObject.name == "p0" || activeObject.name == "p2") {
      activeObject['line2'].animate('opacity', '1', {
        duration: 200,
        onChange: canvas.renderAll.bind(canvas),
      });
      activeObject.line2.selectable = true;
    }
  }

  //カーブポイント生成
  function makeCurvePoint(left, top, line1, line2, line3) {
    var c = new fabric.Circle({
      left: left,
      top: top,
      strokeWidth: 8,
      radius: 14,
      fill: '#fff',
      stroke: '#666'
    });

    c.hasBorders = c.hasControls = false;

    c.line1 = line1;
    c.line2 = line2;
    c.line3 = line3;

    return c;
  }


  function onBeforeSelectionCleared(e) {
    var activeObject = e.target;
    if (activeObject.name == "p0" || activeObject.name == "p2") {
      activeObject.line2.animate('opacity', '0', {
        duration: 200,
        onChange: canvas.renderAll.bind(canvas),
      });
      activeObject.line2.selectable = false;
    }
    else if (activeObject.name == "p1") {
      activeObject.animate('opacity', '0', {
        duration: 200,
        onChange: canvas.renderAll.bind(canvas),
      });
      activeObject.selectable = false;
    }
  }

  //オブジェクトが動いた時
  function onObjectMoving(e) {
    if (e.target.name == "p0" || e.target.name == "p2") {
      var p = e.target;

      if (p.line1) {
        p.line1.path[0][1] = p.left;
        p.line1.path[0][2] = p.top;
        p.line1.path
      }
      else if (p.line3) {
        p.line3.path[1][3] = p.left;
        p.line3.path[1][4] = p.top;
      }
    }
    else if (e.target.name == "p1") {
      var p = e.target;

      if (p.line2) {
        p.line2.path[1][1] = p.left;
        p.line2.path[1][2] = p.top;
      }
    }
    else if (e.target.name == "p0" || e.target.name == "p2") {
      var p = e.target;

      p.line1 && p.line1.set({ 'x2': p.left, 'y2': p.top });
      p.line2 && p.line2.set({ 'x1': p.left, 'y1': p.top });
      p.line3 && p.line3.set({ 'x1': p.left, 'y1': p.top });
      p.line4 && p.line4.set({ 'x1': p.left, 'y1': p.top });
    }
  }

    </script>
  </body>
</html>
