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

    <!-- jqueryの読み込み -->
    <script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
    <script src="{{asset('/js/fabric.js')}}"></script>
    <!-- js処理ここから-->
    <script>  
    const can = $("#canvas")[0];
    const ctx = can.getContext("2d");
    //fabricjs準備
    $(function(){
        let area = new fabric.Canvas('canvas');
        for(let i=0;i<10;i++){
          fabric.Image.fromURL('{{asset('/img/test.jpeg')}}', function(oImg) {
            const imgLeft = Math.ceil(Math.random() * 1600); //小数点
            const imgTop = Math.ceil(Math.random() * 866); //小数点
            oImg.scaleToWidth(200);
            oImg.set('left', imgLeft);
            oImg.set('top', imgTop);
            area.add(oImg);
        });
        }
    });

    </script>
  </body>
</html>
