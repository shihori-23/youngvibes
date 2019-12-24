<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>top</title>
    <!-- Google fontを使用する場合、下記にcdnを記述 -->

    <!-- reset.cssへのリンク -->
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}" />

    <!-- cssファイルへのリンク -->
    <link rel="stylesheet" href="{{asset('/css/story_create.css')}}" />

    <!-- cssファイルへのリンク -->
    <link rel="stylesheet" href="{{asset('/css/header.css')}}" />
    <style>
     

    </style>
  </head>

  <body>
    <div id="wapper">
      @include('header')

      <main>
        <div class="zoom_container">
          <button id="zoomIn"><img class="zoomicon" src="{{asset('/img/logo/zoomin.png')}}" alt="zoomin"></button>
          <button id="zoomOut"><img class="zoomicon" src="{{asset('/img/logo/zoomout.png')}}" alt="zoomout"></button><br>
          <!-- DBからコマ数を取得 -->

            @if (count($service_contents) > 0)
            <input type="hidden" value = "{{($service_contents[0]->id)}}" id="comaCount">
            @endif
            
        </div>

        <div class="main_container">
          <canvas id="canvas" width="940px" height="900px"></canvas>
            <div class="story_container">
              <div class="content">
              <h2 class="content_title">Re:ストーリーをつくろう</h2>
             <div class="form_flex">
              <input class="storyTitle" type="text" id="title_h1" value="" placeholder="タイトルを入力してください"><span id="download">つくる</span></div>
                <canvas
                  id="canvas_st"
                  class="canvas2"
                  width="160px"
                  height="600px"
                  style="border: black solid 1px; margin-left:50px;"
                ></canvas>

               
              </div>
            </div>
      
        </div>
      </main>
    </div>

        <!-- 編集完了後の確認画面モーダル -->
      <div class="modal_masc hidden"></div>
      <div class="hidden" id="modal">
        <form action ="{{ url('story_create/save') }}" method="POST">
          {{ csrf_field() }}
          <div class="conf_contents">
            <h1 class="conf_title">Confirm</h1>
            <h2 class="conf_title2">こちらのRe:ストーリーでよろしいですか？</h1>
            <h2 class="conf_title2">タイトルを確認して「つくる」を押してください。</h1>
            <div class="conf_img_container">
              <div class="title_container">
                <!-- <label class="cof_calm">タイトル</label> -->
                <input class="storyTitle" id="titleData" type="text" name="title_data" value=""><br>
              </div>
                <img src="" alt="確認画面" id="cofimg" height="400px" width="100px;">
            </div>
            <input id="modalData" type="hidden" name="data" value="">
            <input id="comaData" type="hidden" name="coma_data" value="">
            <div class="conf_btn">
              <input type="submit" value="つくる" class="submit_btn"><br>
              <span class="rewrite" id="rewrite_btn">×</span>
            </div>
          </div>
        </form>
      </div>

    <!-- jquery/fabricjsの読み込み -->
    <script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
    <script src="{{asset('/js/fabric.js')}}"></script>

    <!-- js処理ここから-->
    <script>  
    //canvas準備
    const can = $("#canvas")[0];
    const ctx = can.getContext("2d");


    //canvasのheightとwidthを画面幅の7割にする
    const realHeight = window.innerHeight;
    const header = document.querySelector('header').clientHeight;
    const canvasHeight = realHeight - header;
    const realWidth = window.innerWidth;
    console.log(realHeight);
    console.log(canvasHeight);
    console.log(header);
    can.height = canvasHeight;
    can.width = realWidth*0.7;

    //div.story_containerのwidthとheightの指定
    $(function(){
      $('.story_container').css('height',canvasHeight);
      $('.story_container').css('width', realWidth*0.3);
    })


     // 現在の色を保持する変数(デフォルトは黒(#000000)とする)
    let currentColor = "#000000"; //線の色
    let bgColor = "#fff"; //背景色

    //fabricjsで全コマ表示
    const comaCount = $("#comaCount").val();//service_contentsテーブルの最後のidを取得
    console.log(comaCount);
    let area = new fabric.Canvas('canvas');//canvasにfabricjsを準備
    //全コマをフォルダから取得してcanvasに表示
    $(function(){
        for(let i=1;i<=comaCount;i++){
          fabric.Image.fromURL(`{{asset('/img/coma/c_${i}.png')}}`, function(oImg) {
            //画像をランダム位置で表示
            const imgLeft = Math.ceil(Math.random() * 940);//位置をランダムで指定 
            const imgTop = Math.ceil(Math.random() * 900); //位置をランダムで指定
            oImg.scaleToWidth(150);//画像の大きさ
            oImg.set({
              left:imgLeft,//leftからの位置
              top:imgTop,//topからの位置
              strokeWidth: 5, stroke: 'rgba(0,0,0,0.1)',
              hasRotatingPoint: false,//回転を制限
              hasControls: true,//拡大縮小を制限
              name:i
            });
            area.add(oImg);//追加
        });
        };
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

    //fabricjs用のcanvas_stを定義
    let canvas_st = new fabric.Canvas("canvas_st", {
    isDrawingMode: false,
    selection: true,
    stateful: true,
    backgroundColor: bgColor //背景色
    });
    let ctx_st = canvas_st.getContext("2d");


    //タッチイベントの取得
    let isTouchDevice = false;
    window.addEventListener("touchstart", function() {
        isTouchDevice = true;
    });

    //キャンバス感の移動
    let migrateItem = function(fromCanvas, toCanvas, pendingImage) {
        fromCanvas.remove(pendingImage);

        let pendingTransform = fromCanvas._currentTransform;
        fromCanvas._currentTransform = null;

        let removeListener = fabric.util.removeListener;
        let addListener = fabric.util.addListener; 
        {
            removeListener(fabric.document, 'mouseup', fromCanvas._onMouseUp);
            removeListener(fabric.document, 'touchend', fromCanvas._onMouseUp);

            removeListener(fabric.document, 'mousemove', fromCanvas._onMouseMove);
            removeListener(fabric.document, 'touchmove', fromCanvas._onMouseMove);

            addListener(fromCanvas.upperCanvasEl, 'mousemove', fromCanvas._onMouseMove);
            addListener(fromCanvas.upperCanvasEl, 'touchmove', fromCanvas._onMouseMove, {
                passive: false
            });

            if (isTouchDevice) {
                // Wait 500ms before rebinding mousedown to prevent double triggers
                // from touch devices
                let _this = fromCanvas;
                setTimeout(function() {
                    addListener(_this.upperCanvasEl, 'mousedown', _this._onMouseDown);
                }, 500);
            }
        } 
        {
            addListener(fabric.document, 'touchend', toCanvas._onMouseUp, {
                passive: false
            });
            addListener(fabric.document, 'touchmove', toCanvas._onMouseMove, {
                passive: false
            });

            removeListener(toCanvas.upperCanvasEl, 'mousemove', toCanvas._onMouseMove);
            removeListener(toCanvas.upperCanvasEl, 'touchmove', toCanvas._onMouseMove);

            if (isTouchDevice) {
                // Unbind mousedown to prevent double triggers from touch devices
                removeListener(toCanvas.upperCanvasEl, 'mousedown', toCanvas._onMouseDown);
            } else {
                addListener(fabric.document, 'mouseup', toCanvas._onMouseUp);
                addListener(fabric.document, 'mousemove', toCanvas._onMouseMove);
            }
        }

        setTimeout(function() {
            pendingImage.scaleX *= 1; //画像の反転
            pendingImage.canvas = toCanvas;
            pendingImage.migrated = true;
            toCanvas.add(pendingImage);

            toCanvas._currentTransform = pendingTransform;
            toCanvas._currentTransform.scaleX *= 1;
            toCanvas._currentTransform.original.scaleX *= 1;
            toCanvas.setActiveObject(pendingImage);
        }, 10);
    };

    //コマが移動した時にイメージnameを入れるオブジェクトを
    const imgElementArray =  [];

    let onObjectMoving = function(p) {
        let viewport = p.target.canvas.calcViewportBoundaries();
        let comaImgName = p.target.name;

        if (p.target.canvas === area) {
            if (p.target.left > viewport.br.x) {
                // console.log("Migrate: left -> center");
                migrateItem(area, canvas_st, p.target);
                imgElementArray.push(comaImgName);
                return;
            }
        }
        if (p.target.canvas === canvas_st) {
            if (p.target.left < viewport.tl.x) {
                // console.log("Migrate: center -> left");
                migrateItem(canvas_st, area, p.target);

                imgElementArray.some(function(v, i){
                if (v==comaImgName) imgElementArray.splice(i,1);    
                });
                return;
            }
        }
        console.log(imgElementArray);
    };

    area.on("object:moving", onObjectMoving);
    canvas_st.on("object:moving", onObjectMoving);

    //確認画面のモーダル表示
       $("#download").click(function() {
      //base64に変換
      const base64 = canvas_st.toDataURL();
      // console.log(base64);
      let storyTitleInput = $("#title_h1").val();
      $("#titleData").val(storyTitleInput); //確認画面へタイトルを代入
      $("#modal").toggleClass("hidden"); //確認画面のモーダルを表示
      $(".modal_masc").toggleClass("hidden"); //確認画面のモーダルを表示
      $("#modalData").val(base64); //POSTするデータの用意
      $("#cofimg").attr("src", base64); 
      $("#comaData").val(imgElementArray);//イメージタグへの表示

    });

    function setBgColor() {
      // canvasの背景色を設定(指定がない場合にjpeg保存すると背景が黒になる)
      ctx.fillStyle = bgColor;
      ctx.fillRect(0, 0, cnvWidth, cnvHeight);
    }

    //×ボタンが押されたらモーダルを閉じる
    $("#rewrite_btn").click(function() {
      $("#modal").toggleClass("hidden");
      $(".modal_masc").toggleClass("hidden");
    });



    </script>
  </body>
</html>
