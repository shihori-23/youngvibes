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
      main{
        position: absolute;
        top: 100px;
        bottom: 0;
        width: 100%;
        height: 100%;
        background-color: transparent;
      }
      
      .canvas_container{
        display:flex;
      }

      /* .canvas1{
        width: calc(50%);
        border-right: 2px dashed darkgray;
      }

      .canvas2{
        width: calc(50%);
        border-right: 2px dashed darkgray;
      } */

      .content{
        margin-left:50px;
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
            <!-- canvasの描画エリア 未知なのでcanvas要素のみです -->
            <div class="canvas_container">
              <div class="content">
                <canvas
                  id="canvas"
                  class="canvas1"
                  width="600px"
                  height="600px"
                  style="border: black solid 1px;"
                ></canvas>
              </div>
              <div class="content">
                <canvas
                  id="canvas_st"
                  class="canvas2"
                  width="600px"
                  height="600px"
                  style="border: black solid 1px;"
                ></canvas>
              </div>
            </div>
          </div>
     </div>
      </main>

    </div>

  

    <!-- jqueryの読み込み -->
    <script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
    <script src="{{asset('/js/colorjoe.min.js')}}"></script>
    <script src="{{asset('/js/fabric.js')}}"></script>
  
    <script>

    // 現在の色を保持する変数(デフォルトは黒(#000000)とする)
    let currentColor = "#000000"; //線の色
    let bgColor = "#fff"; //背景色

    //fabricjs用のcanvas1を定義
    let canvas = new fabric.Canvas("canvas", {
    isDrawingMode: false,
    selection: true,
    stateful: true,
    backgroundColor: bgColor //背景色
    });
    let ctx = canvas.getContext("2d");

    //fabricjs用のcanvas_stを定義
    let canvas_st = new fabric.Canvas("canvas_st", {
    isDrawingMode: false,
    selection: true,
    stateful: true,
    backgroundColor: bgColor //背景色
    });
    let ctx_st = canvas_st.getContext("2d");

    //起源不明の画像を許可するように指示する記述
    let config = { crossOrigin: 'anonymous' };

    let baseUrl = "http://mbnsay.com/rayys/images";
    let url0 = "img/coma/c_1.png";
    let url1 = "img/coma/c_2.png";
    let url2 = "img/coma/c_3.png";


    //画像の読み込み
    fabric.Image.fromURL("img/logo/pen_icon.png",function(oImg){
    canvas.add(oImg);
    });

    fabric.Image.fromURL("img/logo/text_icon.png",function(oImg){
    canvas.add(oImg);
    });
    
    fabric.Image.fromURL("img/logo/zoomin.png",function(oImg){
    canvas.add(oImg);
    });

    //タッチイベントの取得
    let isTouchDevice = false;
    window.addEventListener("touchstart", function() {
        isTouchDevice = true;
    });

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

    let onObjectMoving = function(p) {
        let viewport = p.target.canvas.calcViewportBoundaries();
        // console.log(p);

        if (p.target.canvas === canvas) {
            if (p.target.left > viewport.br.x) {
                console.log("Migrate: left -> center");
                migrateItem(canvas, canvas_st, p.target);
                return;
            }
        }
        if (p.target.canvas === canvas_st) {
            if (p.target.left < viewport.tl.x) {
                console.log("Migrate: center -> left");
                migrateItem(canvas_st, canvas, p.target);
                return;
            }
        }
    };

    canvas.on("object:moving", onObjectMoving);
    canvas_st.on("object:moving", onObjectMoving);
    
    console.log(canvas);
    // console.log(canvas_st);
    </script>
  </body>
</html>
