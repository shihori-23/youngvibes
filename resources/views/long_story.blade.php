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
        
        <canvas id="canvas" width="1600" height="886"></canvas>

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
          //fabricjsで全コマ表示
    const comaCount = $("#comaCount").val();//service_contentsテーブルの最後のidを取得
    console.log(comaCount);
    let area = new fabric.Canvas('canvas');//canvasにfabricjsを準備
    //全コマをフォルダから取得してcanvasに表示
    $(function(){
        for(let i=1;i<=2;i++){
          fabric.Image.fromURL(`{{asset('/img/coma/c_${i}.png')}}`, function(oImg) {
            //画像をランダム位置で表示
            const imgLeft = Math.ceil(Math.random() * 1600);//位置をランダムで指定 
            const imgTop = Math.ceil(Math.random() * 866); //位置をランダムで指定
            oImg.scaleToWidth(200);//画像の大きさ
            oImg.set({
              left:imgLeft,//leftからの位置
              top:imgTop,//topからの位置
              strokeWidth: 5, stroke: 'rgba(0,0,0,0.1)',
              hasRotatingPoint: false,//回転を制限
              hasControls: false//拡大縮小を制限
            });
            area.add(oImg);//追加
        });
        };
    });
    </script>
  </body>
</html>
