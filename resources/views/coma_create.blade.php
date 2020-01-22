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
        margin-top:30px;
      }
      .content_flex img{
        width:300px;
        height:300px;
        border:1px solid #000;
        margin-right:60px;
        position: relative;
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
        <!-- 前のコマにつむぐコメントを表示 -->
        <div class="fukidashi_com">
          <div class="balloon2-top">
            <p class="fukidashi_p">こちらのコマの続きを<br>つむいでください</p>
          </div>
        </div>

        <div class="main_container">
          <!-- 前のコマとcanvas描画エリアを横並びに表示するdiv -->
          <div class="content_flex">
            <div>
              <!-- 前のコマを表示させるイメージ要素-->
              <div class="light-cover" >
                <img id="preComa" src="img/coma/{{ $comas->img_file }}" name="{{ $comas->img_file }}" alt="前のコマを表示"  height="100px" width="100px;"/>
              </div>
              <input type="hidden" id="preComaId" value="{{ $comas->id }}">
                <!-- コマの追加が会った際のfeedin -->
                <div id="changeAlert" style="margin-top:10%;display:none;">
                  <p>新たなストーリーがつむがれました</p>
                </div>
            </div>
            <!-- canvasの描画エリア 未知なのでcanvas要素のみです -->
            <canvas
              id="canvas"
              width="500px"
              height="500px"
              style="border: black solid 1px;"
            ></canvas>
          </div>


        <div class="toolvar">
          <!-- 選択ボタン -->
          <div class="f_tool_var">
            <div class="tool">
              <button id="select-button"><img class="icon_img" src="{{asset('/img/logo/tool_icon/select.png')}}" alt="選択"></button>
            </div>

            <div class="tool">
              <button id="circle-button"><img class="icon_img" src="{{asset('/img/logo/tool_icon/circular.png')}}" alt="丸"></button>
            </div>

            <div class="tool">
              <button id="triangle-button"><img class="icon_img" src="{{asset('/img/logo/tool_icon/triangle.png')}}" alt="三角"></button>
            </div>

            <div class="tool">
              <button id="rect-button"><img class="icon_img" src="{{asset('/img/logo/tool_icon/square.png')}}" alt="選択"></button>
            </div>

            <div class="tool" id="fk">
              <img class="icon_img" src="{{asset('/img/logo/tool_icon/fukidashi_st.png')}}" alt="選択">
            </div>
            
            <div class="stamp_container none">
              <button id="stamp_btn1"><img id="stamp1" src="{{asset('/img/fukidashi/fukidashi1.png')}}" alt="吹き出し" srcset="" width="50px" height="auto"></button>
              <button id="stamp_btn2"><img id="stamp2" src="{{asset('/img/fukidashi/fukidashi2.png')}}" alt="吹き出し" srcset="" width="50px" height="auto"></button>
              <button id="stamp_btn3"><img id="stamp3" src="{{asset('/img/fukidashi/fukidashi3.png')}}" alt="吹き出し" srcset="" width="50px" height="auto"></button>
              <!-- <button id="stamp_btn4"><img id="stamp4" src="{{asset('/img/fukidashi/fukidashi4.png')}}" alt="吹き出し" srcset="" width="50px" height="auto"></button> -->
              <button id="stamp_btn5"><img id="stamp5" src="{{asset('/img/fukidashi/fukidashi5.png')}}" alt="吹き出し" srcset="" width="50px" height="auto"></button>
              <button id="stamp_btn6"><img id="stamp6" src="{{asset('/img/fukidashi/fukidashi6.png')}}" alt="吹き出し" srcset="" width="50px" height="auto"></button>
            </div>
            
          </div> 

          <div class="s_tool_var">
            <!-- ペンボタン -->
            <div class=tool>
              <button id="draw-button"><img class="icon_img" src="{{asset('/img/logo/tool_icon/pen.png')}}" alt="ペン"></button>
            </div>

            <div class="tool">
              <button id="text-button"><img class="icon_img" src="{{asset('/img/logo/tool_icon/text.png')}}" alt="ペン"></button>
            </div>

            <div id="t-bgColor" class="tool">
              <button id="text-bgcolor-button"><img class="icon_img" src="{{asset('/img/logo/tool_icon/text2.png')}}" alt="文字背景塗り潰し"></button>
            </div>  

            <!-- 消しゴム -->
            <div class="tool">
              <button id="eraser-button"><img class="icon_img" src="{{asset('/img/logo/tool_icon/eraser.png')}}" alt="消しゴム"></button>
            </div>

            <div id="bgcolor" class="tool">
            <button id="bgcolor-button"><img class="icon_img" src="{{asset('/img/logo/tool_icon/bucket.png')}}" alt="背景塗り潰し"></button>
          </div>

          </div>
             
            <!-- 線の太さを選択 -->
          <input type="range" min="0" max="100" value="5" id="lineWidth"><br>
            <!-- バグあります -->
            <div class="select_font cp_sl01">
              <select id="font-family">
                <option value="" hidden>フォントを選んでください</option>
                <option value="Meiryo">メイリオ</option>
                <option value="Hiragino Kaku Gothic ProN">ヒラギノ角</option>
                <option value="TsukuBRdGothic-Regular">筑紫B丸</option>
                <option value="Wawati SC">Wawati SC</option>
                <option value="Andale Mono">Andale Mono</option>
                <option value="Bradley Hand">BradleyHand</option>
                <option value="arial">Arial</option>
                <option value="helvetica">Helvetica</option>
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
            </div>
            <!-- 以上バグあり -->
            
          
          <!-- きいてないかも・・・ -->
          <!-- <div id="t-color">
            <button id="text-color-button">文字の色を変更</button>
          </div> -->

          <div class="text">
                <label class="lb_color" for="canvas-bg-color">選択中の色:</label>
                <input type="color" value="" id="canvas-bg-color" size="10" />
                <input type="hidden" value="5" id="canvas-brush-width"/>
          </div>
          <!-- 色を選択できるカラーパレットを用意する。 -->
          <div>
            <span id="color-palette"></span>
          </div>

          

           <!--未実装 <div>
            <button id="inversion-button">反転する</button>
          </div> -->

         <div class="l_tool_container">
          <button id="pev-button"><img class="icon_img l_icon" src="{{asset('/img/logo/tool_icon/pev2.png')}}" alt="戻る"></button>
          <!-- <button id="next-button">すすむ</button> -->
          <button id="clear-button"><img class="icon_img l_icon" src="{{asset('/img/logo/tool_icon/dust.png')}}" alt="戻る"></button>

          <label class="originalFileBtn ">画像を読み込む
            <input type="file" id="file_img_canvas" style="display:none">
          </label>
          <button id="download">つむぐ</button>
          </div>
         

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
      </div>
      </div>
      
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
            <h1 class="conf_title">こちらのコマをつむぎますか？</h1>
            <div class="conf_img_container">
              <img src="" alt="確認画面" id="cofimg" height="300px" width="300px;">
            </div>
            <input id="modalData" type="hidden" name="data" value="">
            <input type="hidden" name="imgEmail" value="{{ Auth::user()->email }}">
            <input type="hidden" name="imgNamePev" value="{{ $comas->id }}">
            <div class="conf_btn">
              <input type="submit" value="つむぐ" class="submit_btn"><br>
              <span class="rewrite" id="rewrite_btn">×</span>
            </div>
          </div>
        </form>
      </div>



    <!-- jqueryの読み込み -->
    <script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
    <script src="{{asset('/js/colorjoe.min.js')}}"></script>
    <script src="{{asset('/js/leader-line.min.js')}}"></script>
    <script src="{{asset('/js/fabric.js')}}"></script>
    <script src="{{asset('/js/coma_create.js')}}"></script>
    <script src="{{asset('/js/header.js')}}"></script>

  <script>
  //前のコマが更新された場合にimgを変更するエフェクト関数
      function changeAlert(){
        $("#changeAlert").fadeIn(3000);
        $("#changeAlert").fadeOut(3000);
      }

  //ajaxでservece_contentsテーブルの最新idを取得する関数
  function getComaCount(){
    let preComaId = $("#preComaId").val();//前のコマのIDをbuttonに隠して取得
    // console.log(preComaId);
    $(function(){
      $.ajax({
        type: 'get',
        datatype: 'json',
        url: '{{asset('get_count')}}',
        })
        .done(function(data){ //ajaxの通信に成功した場合
          let img_file = JSON.parse(data).slice(-1)[0].img_file;//配列の末尾(最新の追加コマのimg名)を取得
          let id = JSON.parse(data).slice(-1)[0].img_file;//配列の末尾(最新の追加コマのid)を取得
          // console.log(JSON.parse(data))
          if(preComaId !== id){
            //1000msの間imgをvisibility:hiddenに変える
            $('#preComa').css('display', "none");
            //前のコマのIDを更新
            $("#preComaId").val(id);
            //imgのsrc部分を作成
            const src = `img/coma/${img_file}`;
            //↑を挿入してimgタグを変更
            $("#preComa").attr('src',src);
            setTimeout(function(){
              $('#preComa').fadeIn('slow');
              //文字表示
              changeAlert();
            },1500);
          }
        })
        .fail(function(data){ //ajaxの通信に失敗した場合
        // alert("error!");
        console.log("error!")
      });
    });
  }
  //5秒ごとに関数を実行実行
  setInterval("getComaCount()",5000);
  </script>
  </body>
</html>
