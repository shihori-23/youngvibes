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
    <!-- cssファイルへのリンク -->
    <link rel="stylesheet" href="{{asset('/css/colorjoe.css')}}" />
    <style>
      header {
        width: 100%;
        height: 100px;
        background: #f0e68c;
      }

      ul{
        display:flex;
      }
      .content_flex{
        display:flex;
        margin-top:50px;
      }
      .content_flex img{
        width:300px;
        height:300px;
        border:1px solid #000;
        margin-right:50px;
      }
      /* 確認画面のモーダルの非表示 */
      .hidden {
        display: none;
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
          <!-- 前のコマとcanvas描画エリアを横並びに表示するdiv -->
          <div class="content_flex">
            <!-- 前のコマを表示させるイメージ要素-->
            <img src="{{ $comas->img_file }}" alt="前のコマを表示"  height="100px" width="100px;"/>
            <!-- canvasの描画エリア 未知なのでcanvas要素のみです -->
            <canvas
              id="canvas"
              width="700"
              height="700"
              style="border: black solid 1px;"
            ></canvas>
          </div>


        <div class="toolvar">
        <!-- テキスト編集 -->
          <div class="text">
            <p class="moji">文字編集</p>
            <!-- <button onclick="Addtext()">テキスト追加</button> -->
                <label for="canvas-bg-color">背景の色:</label>
                <input type="color" value="" id="canvas-bg-color" size="10" />
          </div>

          <div> 
          <!-- 色を選択できるカラーパレットを用意する。【未実装】 -->
          <span id="color-palette"></span>
          </div>
          <div>
            <button id="draw-button">線を引く</button>
            <button id="text-button">テキストを挿入</button>
            <button id="pev-button">戻る</button>
            <button id="next-button">すすむ</button>
            <button id="clear-button">全消し</button>
          </div>
          <div>
            <button id="eraser-button">消しゴムモード</button>
          </div>
          
        </div>
      </div>

      <button id="download">編集完了</button>

    <!-- 編集完了後の確認画面モーダル -->
      <div class="" id="modal">
        <form action ="{{ url('coma_create/save') }}" method="POST">
          {{ csrf_field() }}
          <!-- <img src="../public/img/test.jpeg" alt="確認画面" id="cofimg"> -->
          <img src="" alt="確認画面" id="cofimg" height="100px" width="100px;">
          <input id="modalData" type="hidden" name="data" value="">
 
          <input type="hidden" name="imgNamePev" value="{{ $comas->c_id }}">
  
          <input type="submit" value="これでOK">
        </from>
      </div>

     </div>
     </div>
      </main>
      <footer>(c)///////サービス名が入ります//////</footer>
    </div>

    <!-- jqueryの読み込み -->
    <script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
    <script src="{{asset('/js/colorjoe.min.js')}}"></script>
    <script src="{{asset('/js/fabric.js')}}"></script>
    <script src="{{asset('/js/coma_create.js')}}"></script>
  
  </body>
</html>
