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
        <div class="zoom_container">
          <button id="zoomIn"><img class="zoomicon" src="{{asset('/img/logo/zoomin.png')}}" alt="zoomin"></button>
          <button id="zoomOut"><img class="zoomicon" src="{{asset('/img/logo/zoomout.png')}}" alt="zoomout"></button><br>
          <!-- DBからコマ数を取得 
          ＊＊＊＊＊＊＊＊＊ ここ変える！！ ＊＊＊＊＊＊＊＊＊＊＊
          -->
          <!-- 

            <span>現在</span><span>

            </span><span>コマ</span>
            <input type="text" value = "

            " id="comaCount">
          -->
            
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
      //DBからRe:ストーリーのデータを取得
      const reStory_array = JSON.parse('<?= $comas; ?>');
      const reStoryCount = reStory_array.length;

      console.log(reStoryCount) ;
      console.log(reStory_array[0].merge_img_file) ;

    // const comaCount = $("#comaCount").val();//service_contentsテーブルの最後のidを取得
    // console.log(comaCount);

    //canvasにfabricjsを準備
    let area = new fabric.Canvas('canvas');
    //全コマをフォルダから取得してcanvasに表示
    $(function(){
        for(let i=1;i<reStoryCount;i++){
          // setTimeout(() => {
            fabric.Image.fromURL('img/story/' + reStory_array[i].merge_img_file, function(oImg) {
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
          // }, 1000);
     
        };
    });

     //拡大・縮小
     let zoom = 200;
    let zoomStep = 20;

    //デフォルトで縮小する
    area.setZoom(150 / 200);
    $('#zoom').val(zoom + '%');

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
      if(zoom == 200){
        zoom -= zoomStep + 50;
        area.setZoom(zoom / 200);
        $('#zoom').val(zoom + '%');
      }else if(zoom > 50) {
            zoom -= zoomStep;
            area.setZoom(zoom / 200);
            $('#zoom').val(zoom + '%');
        }
    });

    </script>
  </body>
</html>
