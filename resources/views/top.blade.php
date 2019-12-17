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

    <!-- cssファイルへのリンク -->
    <link rel="stylesheet" href="" />
    <style>
      body,html{
        width:100%;
        height:100%;
      }
      header{
        width:100%;
        height:100px;
        background-color:rgb(252, 213, 95);
      }
      nav ul{
        display:flex;
      }
      footer{
        width:100%;
        height:10px;
      }

    /* ズームできるようにする */
    /* .main_container{
      border: 10px solid #999;
      cursor:crosshair;
      width:400px;
      height:200px;
      float:left;
      overflow: hidden;
    }
    #canvas{
          -moz-transform-origin:0 0;
          -ms-transform-origin:0 0;
          -webkit-transform-origin:0 0;
          transform-origin:0 0;
    } */

    </style>
  </head>

  <body>
    <div id="wapper">
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
          <button id="zoomIn">拡大</button>
          <button id="zoomOut">縮小</button>
        </nav>
      </header>
      <main>
        <div class="main_container">
          <canvas id="canvas" width="1600" height="886" style="border:1px solid #000"></canvas>
        </div>
        <!-- ストーリーをクリックしたときに表示されるモーダル -->
        <div class="modal">
          <div class="coma_img">
            <img src="" alt="コマの画像" />
          </div>
          <a href="">閉じる</a>
        </div>
        <!-- 全てのストーリーを見るボタン -->
        <a href="" class="fixed_btn"></a>
      </main>
      <footer>(c)///////サービス名が入ります//////</footer>
    </div>

    <!-- jquery/fabricjsの読み込み -->
    <script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
    <script src="{{asset('/js/fabric.js')}}"></script>

    <!-- js処理ここから-->
    <script>  
    //canvas準備
    const can = $("#canvas")[0];
    const ctx = can.getContext("2d");

    //fabricjsで画像表示
    let area = new fabric.Canvas('canvas');
    $(function(){
        for(let i=0;i<10;i++){
          fabric.Image.fromURL('{{asset('/img/test.jpeg')}}', function(oImg) {
            //画像をランダム位置で表示
            const imgLeft = Math.ceil(Math.random() * 1600);//位置をランダムで指定 
            const imgTop = Math.ceil(Math.random() * 866); //位置をランダムで指定
            oImg.scaleToWidth(200);//画像の大きさ
            oImg.set('left', imgLeft);//leftからの位置
            oImg.set('top', imgTop);//topからの位置
            oImg.set({hasRotatingPoint: false});//回転を制限
            area.add(oImg);//追加
        });
        }
    });

    //拡大・縮小
    let zoom = 100;
    let zoomStep = 10;

    // 拡大
    $('#zoomIn').click(function () {
        if (zoom < 100) {
            zoom += zoomStep;
            area.setZoom(zoom / 100);
            $('#zoom').val(zoom + '%');
        }
    });
    // 縮小
    $('#zoomOut').click(function () {
        if (zoom > 50) {
            zoom -= zoomStep;
            area.setZoom(zoom / 100);
            $('#zoom').val(zoom + '%');
        }
    });

    </script>
  </body>
</html>
