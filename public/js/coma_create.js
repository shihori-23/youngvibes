fabric.Object.prototype.transparentCorners = false;
fabric.Object.prototype.padding = 5;

// var $ = function(id) {
//   return document.getElementById(id);
// };

var canvas = (this.__canvas = new fabric.Canvas("canvas1"));
canvas.setHeight(400);
canvas.setWidth(300);

var imgElement1 = document.getElementById("my_image1");
$("#my_image1").click(function() {
  var imgInstance1 = new fabric.Image(imgElement1, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance1);
});

var imgElement2 = document.getElementById("my_image2");
$("#my_image2").click(function() {
  var imgInstance2 = new fabric.Image(imgElement2, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance2);
});

var imgElement3 = document.getElementById("my_image3");
$("#my_image3").click(function() {
  var imgInstance3 = new fabric.Image(imgElement3, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance3);
});

var imgElement4 = document.getElementById("my_image4");
$("#my_image4").click(function() {
  var imgInstance4 = new fabric.Image(imgElement4, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance4);
});

var imgElement5 = document.getElementById("my_image5");
$("#my_image5").click(function() {
  var imgInstance5 = new fabric.Image(imgElement5, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance5);
});

var imgElement6 = document.getElementById("my_image6");
$("#my_image6").click(function() {
  var imgInstance6 = new fabric.Image(imgElement6, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance6);
});

var imgElement7 = document.getElementById("my_image7");
$("#my_image7").click(function() {
  var imgInstance7 = new fabric.Image(imgElement7, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance7);
});

var imgElement8 = document.getElementById("my_image8");
$("#my_image8").click(function() {
  var imgInstance8 = new fabric.Image(imgElement8, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance8);
});

var imgElement9 = document.getElementById("my_image9");
$("#my_image9").click(function() {
  var imgInstance9 = new fabric.Image(imgElement9, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance9);
});

var imgElement10 = document.getElementById("my_image10");
$("#my_image10").click(function() {
  var imgInstance10 = new fabric.Image(imgElement10, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance10);
});

var imgElement11 = document.getElementById("my_image11");
$("#my_image11").click(function() {
  var imgInstance11 = new fabric.Image(imgElement11, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance11);
});

var imgElement12 = document.getElementById("my_image12");
$("#my_image12").click(function() {
  var imgInstance12 = new fabric.Image(imgElement12, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance12);
});

var imgElement13 = document.getElementById("my_image13");
$("#my_image13").click(function() {
  var imgInstance13 = new fabric.Image(imgElement13, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance13);
});

var imgElement14 = document.getElementById("my_image14");
$("#my_image14").click(function() {
  var imgInstance14 = new fabric.Image(imgElement14, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance14);
});

var imgElement15 = document.getElementById("my_image15");
$("#my_image15").click(function() {
  var imgInstance15 = new fabric.Image(imgElement15, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance15);
});

var imgElement16 = document.getElementById("my_image16");
$("#my_image16").click(function() {
  var imgInstance16 = new fabric.Image(imgElement16, {
    left: 0,
    top: 0
  });
  canvas.add(imgInstance16);
});

function Addtext() {
  canvas.add(
    new fabric.IText("Tap して編集", {
      left: 50,
      top: 100,
      fontFamily: "arial black",
      fill: "#333",
      fontSize: 35
    })
  );
}
// function Addstamp(){
//   canvas.add(
//     new fabric.Image.fromURL('../php/onna.png',function(oImg) {
// canvas.add(oImg)
//     })
//   );
// }
// $(function(){
//   var canvas =new fabric.Canvas('canvas1');
//   new fabric.Image.fromURL('onna.png',function(oImg){
//     oImg.scale(0.5);
//     canvas.add(oImg);
//   });
// });

// document.getElementById('text-color').onchange = function() {
//     canvas.getActiveObject().setFill(this.value);
//     canvas.renderAll();
// };
document.getElementById("text-color").onchange = function() {
  canvas.getActiveObject().setFill(this.value);
  canvas.renderAll();
};

document.getElementById("canvas-bg-color").onchange = function() {
  canvas.setBackgroundColor(this.value);
  canvas.renderAll();
};

// document.getElementById("text-bg-color").onchange = function() {
//   canvas.getActiveObject().setBackgroundColor(this.value);
//   canvas.renderAll();
// };

document.getElementById("text-lines-bg-color").onchange = function() {
  canvas.getActiveObject().setTextBackgroundColor(this.value);
  canvas.renderAll();
};

document.getElementById("text-stroke-color").onchange = function() {
  canvas.getActiveObject().setStroke(this.value);
  canvas.renderAll();
};

document.getElementById("text-stroke-width").onchange = function() {
  canvas.getActiveObject().setStrokeWidth(this.value);
  canvas.renderAll();
};

document.getElementById("font-family").onchange = function() {
  canvas.getActiveObject().setFontFamily(this.value);
  canvas.renderAll();
};

document.getElementById("text-font-size").onchange = function() {
  canvas.getActiveObject().setFontSize(this.value);
  canvas.renderAll();
};

document.getElementById("text-line-height").onchange = function() {
  canvas.getActiveObject().setLineHeight(this.value);
  canvas.renderAll();
};

document.getElementById("text-align").onchange = function() {
  canvas.getActiveObject().setTextAlign(this.value);
  canvas.renderAll();
};

radios5 = document.getElementsByName("fonttype"); // wijzig naar button
for (var i = 0, max = radios5.length; i < max; i++) {
  radios5[i].onclick = function() {
    if (document.getElementById(this.id).checked == true) {
      if (this.id == "text-cmd-bold") {
        canvas.getActiveObject().set("fontWeight", "bold");
      }
      if (this.id == "text-cmd-italic") {
        canvas.getActiveObject().set("fontStyle", "italic");
      }
      if (this.id == "text-cmd-underline") {
        canvas.getActiveObject().set("textDecoration", "underline");
      }
      if (this.id == "text-cmd-linethrough") {
        canvas.getActiveObject().set("textDecoration", "line-through");
      }
      if (this.id == "text-cmd-overline") {
        canvas.getActiveObject().set("textDecoration", "overline");
      }
    } else {
      if (this.id == "text-cmd-bold") {
        canvas.getActiveObject().set("fontWeight", "");
      }
      if (this.id == "text-cmd-italic") {
        canvas.getActiveObject().set("fontStyle", "");
      }
      if (this.id == "text-cmd-underline") {
        canvas.getActiveObject().set("textDecoration", "");
      }
      if (this.id == "text-cmd-linethrough") {
        canvas.getActiveObject().set("textDecoration", "");
      }
      if (this.id == "text-cmd-overline") {
        canvas.getActiveObject().set("textDecoration", "");
      }
    }
    canvas.renderAll();
  };
}

// function downloadimage(){
//   html2canvas(document.getElementById("canvas1"),{
//   onrendered: function(canvas){
//   var dataURI = canvas.toDataURL();
//   var pdf = new jsPDF();
//   var width = pdf.internal.pageSize.width;
//   pdf.addimage(canvas,'JPEG',0,0,width,0);
//   pdf.save('test.pdf')
//   console.log(dataURI);
// }
// })
// }

//   canvasを画像で保存;
$("#download").click(function() {
  canvas = document.getElementById("canvas1");
  const base64 = canvas.toDataURL("image/jpeg");
  document.getElementById("download").href = base64;
  $("#modal").toggleClass("hidden");
  $("#modal").toggleClass("hidden");
});

function setBgColor() {
  // canvasの背景色を設定(指定がない場合にjpeg保存すると背景が黒になる)
  ctx.fillStyle = bgColor;
  ctx.fillRect(0, 0, cnvWidth, cnvHeight);
}
