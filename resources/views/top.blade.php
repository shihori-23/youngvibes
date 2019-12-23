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
    <link rel="stylesheet" href="{{asset('/css/top.css')}}" />

    <!-- cssファイルへのリンク -->
    <link rel="stylesheet" href="{{asset('/css/header.css')}}" />
    <style>
      body,html{
        width:100%;
        height:100%;
      }
      footer{
        width:100%;
        height:10px;
      }
    </style>
  </head>

  <body>
    <div id="wapper">
      @include('header')

      <main>
        <div class="long_story_container">
          <a href="/long_story" id="longStory_btn"><span class="btn_tx">ALL STORY</span></a>
        </div>
        <div class="zoom_container">
          <button id="zoomIn"><img class="zoomicon" src="{{asset('/img/logo/zoomin.png')}}" alt="zoomin"></button>
          <button id="zoomOut"><img class="zoomicon" src="{{asset('/img/logo/zoomout.png')}}" alt="zoomout"></button><br>
          <!-- DBからコマ数を取得 -->

            @if (count($comas) > 0)
            <span>現在</span><span>{{(count($comas))}}</span><span>コマ</span>
            <input type="hidden" value = "{{($comas[0]->id)}}" id="comaCount">
            @endif
            
        </div>

        <div class="main_container">
          <canvas id="canvas" width="1600" height="886"></canvas>
        </div>
        <!-- ストーリーをクリックしたときに表示されるモーダル※一旦コメントアウト -->
        <!-- <div class="modal">
          <div class="coma_img">
            <img src="" alt="コマの画像" />
          </div>
          <a href="">閉じる</a>
        </div> -->
        <!-- 全てのストーリーを見るボタン※一旦コメントアウト -->
        <!-- <a href="" class="fixed_btn"></a> -->
      </main>
    <!-- @include('footer') -->
    </div>

    <!-- jquery/fabricjsの読み込み -->
    <script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
    <script src="{{asset('/js/fabric.js')}}"></script>

    <!-- js処理ここから-->
    <script>  
    //canvas準備
    const can = $("#canvas")[0];
    const ctx = can.getContext("2d");

    //fabricjsで全コマ表示
    const comaCount = $("#comaCount").val();//service_contentsテーブルの最後のidを取得
    console.log(comaCount);
    let area = new fabric.Canvas('canvas');//canvasにfabricjsを準備
    //全コマをフォルダから取得してcanvasに表示
    $(function(){
        for(let i=1;i<=comaCount;i++){
          fabric.Image.fromURL(`{{asset('/img/coma/c_${i}.png')}}`, function(oImg) {
            //画像をランダム位置で表示
            const imgLeft = Math.ceil(Math.random() * 1500);//位置をランダムで指定 
            const imgTop = Math.ceil(Math.random() * 766); //位置をランダムで指定
            oImg.scaleToWidth(200);//画像の大きさ

            //作成後のコマだけ目立つ（テスト）
            // if(i == comaCount){
            //   oImg.set({
            //     left:800,//leftからの位置
            //     top:400,//topからの位置
            //     strokeWidth: 50, 
            //     stroke: 'rgba(255,0,0,1)',
            //     hasRotatingPoint: false,//回転を制限
            //     hasControls: false//拡大縮小を制限
            //   })
            // }else{
              oImg.set({
              left:50,//leftからの位置
              top:50,//topからの位置
              strokeWidth: 5, stroke: 'rgba(0,0,0,0.1)',
              hasRotatingPoint: false,//回転を制限
              hasControls: false//拡大縮小を制限
            });
            // }

            area.add(oImg);//追加
            //-----アニメーションテスト--- //
            oImg.animate('left',oImg.left === 300 ? 100 : imgLeft,{
              duration: 1000,
              onChange: area.renderAll.bind(area),
            })
            oImg.animate('top',oImg.left === 300 ? 100 : imgTop,{
              duration: 1000,
              onChange: area.renderAll.bind(area),
            })
        });
        };
    });

    //拡大・縮小
    let zoom = 200;
    let zoomStep = 20;

    // 拡大
    $('#zoomIn').click(function () {
        if (zoom < 500) {
            zoom += zoomStep;
            area.setZoom(zoom / 200);
            $('#zoom').val(zoom + '%');
        }
    });
    // 縮小
    $('#zoomOut').click(function () {
        if (zoom > 50) {
            zoom -= zoomStep;
            area.setZoom(zoom / 200);
            $('#zoom').val(zoom + '%');
        }

    });

    </script>
  </body>
</html>
