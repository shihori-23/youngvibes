// 現在の色を保持する変数(デフォルトは黒(#000000)とする)
let currentColor = "#000000";//線の色
let bgColor = "#fff";//背景色

//fabricjs用のcanvasを定義
const canvas = new fabric.Canvas("canvas", {
  isDrawingMode: false,
  selection: true,
  stateful: true,
  backgroundColor: bgColor//背景色
});
let ctx = canvas.getContext("2d");
var undoBuffer = [];

//テスト中(いろいろ設定できるみたい)
canvas.freeDrawingBrush = new fabric.PencilBrush(canvas); //ブラシ

canvas.freeDrawingBrush.color = currentColor; //色
canvas.freeDrawingBrush.width = 5; //太さ
canvas.freeDrawingBrush.shadowBlur = 0; //影
canvas.hoverCursor = "move"; //分からん

//線を引くボタン
$("#draw-button").click(function() {
  canvas.isDrawingMode = true; //ここでbloomを切り替える
});


//マウスアップの際にundoBuffer保存
  $("canvas").mouseup(function() {
    if(canvas.isDrawingMode == true){
    undoBuffer.push(canvas.toDatalessJSON());
  }
  });


  canvas.observe("object:moved", function () {
    undoBuffer.push(canvas.toDatalessJSON());
    console.log(undoBuffer)
  });
  
  //マウスが離れた際にundoBuffer保存
  // $("canvas").mouseleave(function() {
  //   if(canvas.isDrawingMode == true){
  //   undoBuffer.push(canvas.toDatalessJSON());
  //   }
  // });


// //マウスダウンの際にundoBuffer保存
// $("canvas").mousedown(function() {
//   undoBuffer.push(canvas.toDatalessJSON());
// });

// //マウスが離れた際にundoBuffer保存
// $("canvas").mousemove(function() {
//   undoBuffer.push(canvas.toDatalessJSON());
// });

//テキストを挿入
$("#text-button").click(function() {
  canvas.isDrawingMode = false;
  undoBuffer.push(canvas.toDatalessJSON());
  let text = new fabric.IText("なんか書いてね", {
    fontFamily: "Fredoka One", //フォント指定
    top: 100, //位置
    left: 100, //位置
    fontSize: 20, //サイズ
    fill: currentColor
  });
  canvas.add(text);
  undoBuffer.push(canvas.toDatalessJSON());
  canvas.renderAll;
});

//背景色変更ボタン
$("#bgcolor-button").click(function() {
  // canvas.isDrawingMode = true;
  undoBuffer.push(canvas.toDatalessJSON());
  bgColor = currentColor;
  canvas.backgroundColor = bgColor;
  canvas.renderAll();
});

//全消しボタン
$("#clear-button").click(function() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
});

//消しゴムモード
$("#eraser-button").click(function() {
  canvas.isDrawingMode = true;
  canvas.freeDrawingBrush.color = "white"; //白にするだけ
});

//戻る
$("#pev-button").click(function() {
  canvas.loadFromJSON(undoBuffer.pop()).renderAll();
  console.log(undoBuffer);
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
  });
}

// カラーパレット情報を初期化する
initColorPalette();


//   canvasを画像で保存;
$("#download").click(function() {
  canvas = document.getElementById("canvas");
  //base64に変換
  const base64 = canvas.toDataURL();
  console.log(base64);
  // $("#modal").toggleClass("hidden");//確認画面のモーダルを表示
  $("#modalData").val(base64);
  $("#cofimg").attr("src", base64); //イメージタグへの表示
});

function setBgColor() {
  // canvasの背景色を設定(指定がない場合にjpeg保存すると背景が黒になる)
  ctx.fillStyle = bgColor;
  ctx.fillRect(0, 0, cnvWidth, cnvHeight);
}
