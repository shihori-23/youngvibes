<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title></title>
    <!-- Google fontを使用する場合、下記にcdnを記述 -->

    <!-- reset.cssへのリンク -->
    <link rel="stylesheet" href="reset.css" />

    <!-- cssファイルへのリンク -->
    <link rel="stylesheet" href="" />
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
          <!-- 前のコマとcanvas描画エリアを横並びに表示するdiv -->
          <div class="content_flex">
            <!-- 前のコマを表示させるイメージ要素-->
            <img src="" alt="前のコマを表示" />
            <!-- canvasの描画エリア 未知なのでcanvas要素のみです -->
            <canvas
              id="canvas"
              width="700"
              height="500"
              style="border: black solid 1px;"
            ></canvas>
            <img
              src="img/a.jpg"
              id="my-image"
              class="hidden"
              width="50px"
              height="50px"
            />
          </div>
        </div>
      </main>
      <footer>(c)///////サービス名が入ります//////</footer>
    </div>

    <!-- jqueryの読み込み -->
    <script src="jquery-2.1.3.min.js"></script>
    <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.5.0/fabric.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.5.0/fabric.js"></script>

    <!-- jsファイルの読み込み -->
    <script>
      // create a wrapper around native canvas element (with id="c")
      const canvas = new fabric.Canvas("canvas");

      // create a rectangle object
      const rect = new fabric.Rect({
        left: 100,
        top: 100,
        fill: "red",
        width: 20,
        height: 20
      });
      // "add" rectangle onto canvas
      canvas.add(rect);

      var imgElement = document.getElementById("my-image");
      var imgInstance = new fabric.Image(imgElement, {
        left: 100,
        top: 100,
        // angle: 30,
        opacity: 0.85
      });
      canvas.add(imgInstance);
    </script>
  </body>

  <style>
    .hidden {
      display: none;
    }
  </style>
</html>
