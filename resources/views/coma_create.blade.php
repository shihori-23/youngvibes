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
    <link rel="stylesheet" href="{{asset('/css/coma_create.css')}}" />

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
              id="canvas1"
              width="700"
              height="500"
              style="border: black solid 1px;"
            ></canvas>
          </div>
          <div class="toolvar">

      <!-- テキスト編集 -->
      <div class="text">
        <p class="moji">文字編集</p>
        <button onclick="Addtext()">テキスト追加</button>
        <div id="text-controls">
          文字の色:
          <input type="color" value="" id="text-color" size="10" />
          <br />
          <div>
            <label for="canvas-bg-color">背景の色:</label>
            <input type="color" value="" id="canvas-bg-color" size="10" />
          </div>

          <label for="font-family" style="display:inline-block"
            >フォント:</label
          >
          <select id="font-family">
            <option value="Meiryo">メイリオ</option>
            <option value="Hiragino Kaku Gothic ProN">ヒラギノ角</option>
            <option value="TsukuBRdGothic-Regular">筑紫B丸</option>
            <option value="Wawati SC" selected>Wawati SC</option>
            <option value="Andale Mono">Andale Mono</option>
            <option value="Bradley Hand" selected>BradleyHand</option>
            <option value="arial">Arial</option>
            <option value="helvetica" selected>Helvetica</option>
            <option value="myriad pro">Myriad Pro</option>
            <option value="delicious">Delicious</option>
            <option value="verdana">Verdana</option>
            <option value="georgia">Georgia</option>
            <option value="courier">Courier</option>
            <option value="comic sans ms">Comic Sans MS</option>
            <option value="impact">Impact</option>
            <option value="monaco">Monaco</option>
            <option value="optima">Optima</option>
            <option value="hoefler text">Hoefler Text</option>
            <option value="plaster">Plaster</option>
            <option value="engagement">Engagement</option>
          </select>
          <br />
          <label for="text-align" style="display:inline-block">整列: </label>
          <select id="text-align">
            <option value="left">左寄せ</option>
            <option value="center">中央</option>
            <option value="right">右寄せ</option>
          </select>
          <!-- <div>
            <label for="text-bg-color">オブジェクト背景:</label>
            <input type="color" value="" id="text-bg-color" size="10" />
          </div> -->
          <div>
            <label for="text-lines-bg-color">文字背景:</label>
            <input type="color" value="" id="text-lines-bg-color" size="10" />
          </div>
          <div>
            <label for="text-stroke-color">文字枠色:</label>
            <input type="color" value="" id="text-stroke-color" />
          </div>
          <div>
            <label for="text-stroke-width">枠の太さ:</label>
            <input
              type="range"
              value="1"
              min="1"
              max="5"
              id="text-stroke-width"
            />
          </div>
          <div>
            <label for="text-font-size">文字サイズ:</label>
            <input
              type="range"
              value=""
              min="1"
              max="120"
              step="1"
              id="text-font-size"
            />
          </div>
          <div>
            <label for="text-line-height">段落間隔:</label>
            <input
              type="range"
              value=""
              min="0"
              max="10"
              step="0.1"
              id="text-line-height"
            />
          </div>
        </div>
        <div id="text-controls-additional">
          <input type="checkbox" name="fonttype" id="text-cmd-bold" />
          太字

          <input type="checkbox" name="fonttype" id="text-cmd-italic" />
          斜体

          <input type="checkbox" name="fonttype" id="text-cmd-underline" />
          下線

          <input type="checkbox" name="fonttype" id="text-cmd-linethrough" />
          取消線

          <!-- <input type='checkbox' name='fonttype'  id="text-cmd-overline" >
    Overline -->
        </div>
      </div>

      <button id="download">編集完了</button>

    <!-- 編集完了後の確認画面モーダル -->
      <div class="hidden" id="modal">
        <form action ="" method="POST">
          <img src="" alt="確認画面">
          <input id="modal"type="hidden" name="data" value="">
        </from>
      </div>

     </div>
     </div>
      </main>
      <footer>(c)///////サービス名が入ります//////</footer>
    </div>

    <!-- jqueryの読み込み -->
    <script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
    <script src="{{asset('/js/fabric.js')}}"></script>
    <script src="{{asset('/js/coma_create.js')}}"></script>
  
  </body>
</html>
