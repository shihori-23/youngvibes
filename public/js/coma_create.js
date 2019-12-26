// 現在の色を保持する変数(デフォルトは黒(#000000)とする)
let currentColor = "#000000"; //線の色
let bgColor = "#fff"; //背景色
let brushWidth = 5; //ブラシのサイズ

//fabricjs用のcanvasを定義
let canvas = new fabric.Canvas("canvas", {
  isDrawingMode: false,
  selection: true,
  stateful: true,
  backgroundColor: bgColor //背景色
});
let ctx = canvas.getContext("2d");

//戻るボタン用のbuffer
let undoBuffer = [];

//線の太さを変える（バグあり）
$("#lineWidth").change(function() {
  const brushWidthStr = $(this).val();
  $("#canvas-brush-width").val(brushWidthStr);
  let brushWidthInt = parseInt(brushWidthStr);
  brushWidth = brushWidthInt;
  // console.log(brushWidth);
});

//線を引くボタン
$("#draw-button").click(function() {
  canvas.isDrawingMode = true; //ここでbloomを切り替える
  let brushSize = $("#canvas-brush-width").val(); //ブラシのサイズ
  let brushWidth = parseInt(brushSize);
  //書き込み線設定
  canvas.freeDrawingBrush = new fabric.PencilBrush(canvas); //ブラシ
  canvas.freeDrawingBrush.color = currentColor; //色
  canvas.freeDrawingBrush.width = brushWidth; //太さ
  canvas.freeDrawingBrush.shadowBlur = 0; //影
  canvas.hoverCursor = "move"; //分からん
});

//マウスアップの際にundoBuffer保存
$("canvas").mouseup(function() {
  if (canvas.isDrawingMode == true) {
    undoBuffer.push(canvas.toDatalessJSON());
  }
});

//オブジェクトが移動されたらundoBuffer保存
canvas.observe("object:moved", function() {
  undoBuffer.push(canvas.toDatalessJSON());
  // console.log(undoBuffer);
});

//テキストを挿入
let font = $("#font-family").val(); //初期値
$("#font-family").change(function() {
  font = $("option:selected").val();
  // console.log(font);
});

//テキストの背景色変更
let textBgColor = "white"; //初期値
$("#text-bgcolor-button").click(function() {
  textBgColor = currentColor;
  $("#t-bgColor").css("color", textBgColor);
  canvas.renderAll();
});

//テキストカラーを変更
let textColor = "black"; //初期値
$("#text-color-button").click(function() {
  textColor = currentColor;
  $("#t-color").css("color", textColor);
  canvas.renderAll();
});

//テキストを挿入ボタン
$("#text-button").click(function() {
  canvas.isDrawingMode = false;
  undoBuffer.push(canvas.toDatalessJSON());
  let text = new fabric.IText("なんか書いてね", {
    fontFamily: font, //フォント指定
    textBackgroundColor: textBgColor, //フォント背景色
    top: 100, //位置
    left: 100, //位置
    fontSize: 20, //サイズ
    fill: currentColor
  });
  canvas.add(text);
  undoBuffer.push(canvas.toDatalessJSON());
  canvas.renderAll();
});

//背景色変更ボタン
$("#bgcolor-button").click(function() {
  // canvas.isDrawingMode = true;
  undoBuffer.push(canvas.toDatalessJSON());
  bgColor = currentColor;
  canvas.backgroundColor = bgColor;
  $("#bgcolor").css("color", bgColor);
  canvas.renderAll();
});

//全消しボタン
$("#clear-button").click(function() {
  ret = confirm("canvasの内容を削除します。");
  // アラートで「OK」を選んだ時
  if (ret == true) {
    undoBuffer = [];
    canvas.clear();
  }
});

//消しゴムモード
$("#eraser-button").click(function() {
  canvas.isDrawingMode = true;
  let brushSize = $("#canvas-brush-width").val(); //ブラシのサイズ
  let brushWidth = parseInt(brushSize);
  canvas.freeDrawingBrush.color = "white"; //白にするだけ
  canvas.freeDrawingBrush.width = brushWidth; //白にするだけ
});

//戻る
$("#pev-button").click(function() {
  canvas.loadFromJSON(undoBuffer.pop()).renderAll();
  // console.log(undoBuffer);
});

//手書きモードの解除
$("#select-button").click(function() {
  canvas.isDrawingMode = false; //
});

//図形の挿入（丸）：辻編集
$("#circle-button").click(function() {
  canvas.isDrawingMode = false;
  undoBuffer.push(canvas.toDatalessJSON());
  let circle = new fabric.Circle({
    radius: 20,
    top: 100, //位置
    left: 100, //位置
    fill: currentColor
  });
  canvas.add(circle);
  undoBuffer.push(canvas.toDatalessJSON());
  canvas.renderAll();
});

//図形の挿入（三角）：辻編集
$("#triangle-button").click(function() {
  canvas.isDrawingMode = false;
  undoBuffer.push(canvas.toDatalessJSON());
  let triangle = new fabric.Triangle({
    top: 100, //位置
    left: 100, //位置
    fill: currentColor
  });
  canvas.add(triangle);
  undoBuffer.push(canvas.toDatalessJSON());
  canvas.renderAll();
});

//図形の挿入（四角）：辻編集
$("#rect-button").click(function() {
  canvas.isDrawingMode = false;
  undoBuffer.push(canvas.toDatalessJSON());
  let rect = new fabric.Rect({
    top: 100, //位置
    left: 100, //位置
    width: 50,
    height: 50,
    fill: currentColor
  });
  canvas.add(rect);
  undoBuffer.push(canvas.toDatalessJSON());
  canvas.renderAll();
});

//スタンプの挿入(吹き出しスタンプ１)：辻編集
const stampImg1 = document.getElementById("stamp1");
$("#stamp1").click(function() {
  canvas.isDrawingMode = false;
  undoBuffer.push(canvas.toDatalessJSON());
  const stamp1 = new fabric.Image(stampImg1, {
    left: 0,
    top: 0
  });
  canvas.add(stamp1);
  undoBuffer.push(canvas.toDatalessJSON());
  canvas.renderAll();
});

//スタンプの挿入(吹き出しスタンプ2)：辻編集
const stampImg2 = document.getElementById("stamp2");
$("#stamp2").click(function() {
  canvas.isDrawingMode = false;
  const stamp2 = new fabric.Image(stampImg2, {
    left: 0,
    top: 0
  });
  canvas.add(stamp2);
  undoBuffer.push(canvas.toDatalessJSON());
  canvas.renderAll();
});

//スタンプの挿入(吹き出しスタンプ3)：辻編集
const stampImg3 = document.getElementById("stamp3");
$("#stamp3").click(function() {
  canvas.isDrawingMode = false;
  const stamp3 = new fabric.Image(stampImg3, {
    left: 0,
    top: 0
  });
  canvas.add(stamp3);
  undoBuffer.push(canvas.toDatalessJSON());
  canvas.renderAll();
});

//スタンプの挿入(吹き出しスタンプ5)：辻編集
const stampImg5 = document.getElementById("stamp5");
$("#stamp5").click(function() {
  canvas.isDrawingMode = false;
  const stamp5 = new fabric.Image(stampImg5, {
    left: 0,
    top: 0
  });
  canvas.add(stamp5);
  undoBuffer.push(canvas.toDatalessJSON());
  canvas.renderAll();
});

//スタンプの挿入(吹き出しスタンプ5)：辻編集
const stampImg6 = document.getElementById("stamp6");
$("#stamp6").click(function() {
  canvas.isDrawingMode = false;
  const stamp6 = new fabric.Image(stampImg6, {
    left: 0,
    top: 0
  });
  canvas.add(stamp6);
  undoBuffer.push(canvas.toDatalessJSON());
  canvas.renderAll();
});

// カラーパレットの設置を行う
function initColorPalette() {
  const joe = colorjoe.rgb("color-palette", currentColor);

  // 'done'イベントは、カラーパレットから色を選択した時に呼ばれるイベント
  // ドキュメント: https://github.com/bebraw/colorjoe#event-handling
  joe.on("done", color => {
    // コールバック関数の引数からcolorオブジェクトを受け取り、
    // このcolorオブジェクト経由で選択した色情報を取得する

    // color.hex()を実行すると '#FF0000' のような形式で色情報を16進数の形式で受け取れる
    // draw関数の手前で定義されている、線の色を保持する変数に代入して色情報を変更する
    currentColor = color.hex();
    canvas.freeDrawingBrush.color = currentColor; //色
    $("#canvas-bg-color").val(currentColor);
  });
}

// カラーパレット情報を初期化する
initColorPalette();

//canvasを画像で保存
$("#download").click(function() {
  //base64に変換
  const base64 = canvas.toDataURL();
  // console.log(base64);
  $("#modal").toggleClass("hidden"); //確認画面のモーダルを表示
  $(".modal_masc").toggleClass("hidden"); //確認画面のモーダルを表示
  $("#modalData").val(base64);
  $("#cofimg").attr("src", base64); //イメージタグへの表示
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

//canvas内への画像の読み込み
$(function() {
  $("#file_img_canvas").on("change", function(e) {
    let imageReader = new FileReader();
    imageReader.onload = function(e) {
      let image = new Image();
      image.onload = function() {
        let fabricImage = new fabric.Image(image); //画像描画の準備
        let height = fabricImage.height; //描画する際の高さを定義
        let width = fabricImage.width; //描画する際の幅を定義
        // // Fabric.jsのImageオブジェクトを作成
        fabricImage.set({
          selectable: true, // マウスで動かせるようにする
          width: width,
          height: height
        });
        // 画像をcanvasに描画する
        canvas.add(fabricImage);
        undoBuffer.push(canvas.toDatalessJSON());
      };
      image.src = e.target.result;
    };
    imageReader.readAsDataURL(e.target.files[0]); // フォームで選択された画像をセット
    undoBuffer.push(canvas.toDatalessJSON());
    canvas.renderAll();
  });
});

//画像の回転
//選択しているオブジェクトを取得
$("#inversion-button").click(function() {
  if (!canvas.getActiveObject()) {
    return;
  }

  let activeObjects = canvas.getActiveObjects();
  if (!activeObjects) return;
  console.log(activeObjects);
});

//コマ同士を繋ぐライン(leader-line.min.jsを使用)
let startElement = document.getElementById("preComa");
let endElement = document.getElementById("canvas");
new LeaderLine(startElement, endElement, {
  color: "#001e43",
  endPlug: "behind"
});

//スタンプコンテイナーをホバーイベントで表示
$(".stamp_container").hover(function() {
  $(".stamp_container").toggleClass("none");
});

$("#fk").hover(function() {
  $(".stamp_container").toggleClass("none");
});

//ツールボタンのクリックイベント
$(".tool").click(function() {
  $(".tool").removeClass("use_now");
  $(this).toggleClass("use_now");
});
