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
    <link rel="stylesheet" href="{{asset('/css/header.css')}}" />
    <style>

      ul{
        display:flex;
      }
      .main_container{
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
      @include('header')
      <main>
        <div class="main_container">
          <!-- 前のコマとcanvas描画エリアを横並びに表示するdiv -->
          <div class="content_flex">
            <!-- 前のコマを表示させるイメージ要素-->
            <img src="img/coma/{{ $comas->img_file }}" alt="前のコマを表示"  height="100px" width="100px;"/>
            <!-- canvasの描画エリア 未知なのでcanvas要素のみです -->
            <canvas
              id="canvas"
              width="600px"
              height="600px"
              style="border: black solid 1px;"
            ></canvas>
          </div>


        <div class="toolvar">
        <!-- テキスト編集 -->
          <div class="text">
                <label for="canvas-bg-color">選択中の色:</label>
                <input type="color" value="" id="canvas-bg-color" size="10" />
          </div>

          <div> 
          <!-- 色を選択できるカラーパレットを用意する。 -->
            <span id="color-palette"></span>
          </div>

          <div>
            <button id="draw-button">線を引く</button>
              <div id="bgcolor">
                <button id="bgcolor-button">背景色を変える</button>
                <p>■</p>
              </div>

            <button id="text-button">テキストを挿入</button>
            <!-- バグあります -->
            <label for="font-family" style="display:inline-block">フォント:</label>
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
            <!-- 以上バグあり -->
            
          <div id="t-bgColor">
            <button id="text-bgcolor-button">文字背景を変更</button>
            <p>■</p>
          </div>

          <div id="t-color">
            <button id="text-color-button">文字の色を変更</button>
            <p>■</p>
          </div>

            <button id="pev-button">戻る</button>
            <button id="next-button">すすむ</button>
            <button id="clear-button">全消し</button>

            <!-- 以下未実装 -->
            <!-- <label for="text-font-size">文字サイズ:</label>
            <input
              type="range"
              value=""
              min="1"
              max="120"
              step="1"
              id="text-font-size"
            />
          
            <label for="text-font-size">線の太さ:</label>
            <input
              type="range"
              value=""
              min="1"
              max="120"
              step="1"
              id="text-font-size"
            />

            <input type="checkbox" name="fonttype" id="text-cmd-bold" />
          太字
​
          <input type="checkbox" name="fonttype" id="text-cmd-italic" />
          斜体
​
          <input type="checkbox" name="fonttype" id="text-cmd-underline" />
          下線
​
          <input type="checkbox" name="fonttype" id="text-cmd-linethrough" />
          取消線 -->

          <!-- 未実装ここまで -->
          </div>
          <div>
            <button id="eraser-button">消しゴムモード</button>
          </div>
          
        </div>
      </div>

      <button id="download">編集完了</button>
     </div>
     </div>
      </main>

    </div>

    <!-- 編集完了後の確認画面モーダル -->
      <div class="modal_masc hidden"></div>
      <div class="hidden" id="modal">
        <form action ="{{ url('coma_create/save') }}" method="POST">
          {{ csrf_field() }}
          <div class="conf_contents">
            <h1 class="conf_title">こちらの画像を保存しますか？</h1>
            <div class="conf_img_container">
              <img src="" alt="確認画面" id="cofimg" height="300px" width="300px;">
            </div>
            <input id="modalData" type="hidden" name="data" value="">
            <input type="hidden" name="imgEmail" value="{{ Auth::user()->email }}">
            <input type="hidden" name="imgNamePev" value="{{ $comas->id }}">
            <div class="conf_btn">
              <input type="submit" value="保存" class="submit_btn"><br>
              <span class="rewrite" id="rewrite_btn">×</span>
            </div>
          </div>
        </form>
      </div>

    <!-- jqueryの読み込み -->
    <script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
    <script src="{{asset('/js/colorjoe.min.js')}}"></script>
    <script src="{{asset('/js/fabric.js')}}"></script>
    <script src="{{asset('/js/coma_create.js')}}"></script>
  
  </body>
</html>
