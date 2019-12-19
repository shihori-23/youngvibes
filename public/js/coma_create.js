// fabric.Object.prototype.transparentCorners = false;
// fabric.Object.prototype.padding = 5;

// const canvas = (this.__canvas = new fabric.Canvas("canvas1"));

window.addEventListener("load", () => {
  const canvas = document.querySelector("#draw-area");
  const context = canvas.getContext("2d");
  const lastPosition = { x: null, y: null };
  let isDrag = false;

  // 現在の線の色を保持する変数(デフォルトは黒(#000000)とする)
  let currentColor = "#000000";

  function draw(x, y) {
    if (!isDrag) {
      return;
    }
    context.lineCap = "round";
    context.lineJoin = "round";
    context.lineWidth = 5;
    context.strokeStyle = currentColor;
    if (lastPosition.x === null || lastPosition.y === null) {
      context.moveTo(x, y);
    } else {
      context.moveTo(lastPosition.x, lastPosition.y);
    }
    context.lineTo(x, y);
    context.stroke();

    lastPosition.x = x;
    lastPosition.y = y;
  }

  function clear() {
    context.clearRect(0, 0, canvas.width, canvas.height);
  }

  function dragStart(event) {
    context.beginPath();

    isDrag = true;
  }

  function dragEnd(event) {
    context.closePath();
    isDrag = false;
    lastPosition.x = null;
    lastPosition.y = null;
  }

  function initEventHandler() {
    const clearButton = document.querySelector("#clear-button");
    clearButton.addEventListener("click", clear);

    // 消しゴムモードを選択したときの挙動
    const eraserButton = document.querySelector("#eraser-button");
    eraserButton.addEventListener("click", () => {
      // 消しゴムと同等の機能を実装したい場合は現在選択している線の色を
      // 白(#FFFFFF)に変更するだけでよい
      currentColor = "#FFFFFF";
    });

    canvas.addEventListener("mousedown", dragStart);
    canvas.addEventListener("mouseup", dragEnd);
    canvas.addEventListener("mouseout", dragEnd);
    canvas.addEventListener("mousemove", event => {
      draw(event.layerX, event.layerY);
    });
  }

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
    });
  }

  initEventHandler();

  // カラーパレット情報を初期化する
  initColorPalette();
});

// 川邊ゾーンです
//テキスト追加のクリックイベント
// function Addtext() {
//   canvas.add(
//     new fabric.IText("Tap して編集", {
//       left: 50,
//       top: 100,
//       fontFamily: "arial black",
//       fill: "#333",
//       fontSize: 35
//     })
//   );
// }

//テキストの色を変更（動きません）
document.getElementById("text-color").onchange = function() {
  canvas.getActiveObject().setFill(this.value);
  canvas.renderAll();
};

//背景の色を変更
document.getElementById("canvas-bg-color").onchange = function() {
  canvas.setBackgroundColor(this.value);
  canvas.renderAll();
};

//   canvasを画像で保存;
$("#download").click(function() {
  canvas = document.getElementById("canvas1");
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
