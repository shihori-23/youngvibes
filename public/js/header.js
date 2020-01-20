//ヘルプボタンが押されたらモーダルを閉じる
$("#helpbtn").click(function() {
  $("#help_modal").toggleClass("hidden");
  $(".help_modal_masc").toggleClass("hidden");
  $(".help_content1").removeClass("hidden");
  $(".help_content2").removeClass("hidden");
  $(".help_content3").removeClass("hidden");
  $(".help_content4").removeClass("hidden");
});

//モーダルの周りをクリックしたときの処理
$(".help_modal_masc").click (function(){
  $("#help_modal").toggleClass("hidden");
  $(".help_modal_masc").toggleClass("hidden");
})


//戻ると次へを押したときの処理
$(".next_btn1").click(function() {
  $(".help_content1").toggleClass("hidden");
});

$(".next_btn2").click(function() {
  $(".help_content2").toggleClass("hidden");
});
$(".prev_btn2").click(function() {
  $(".help_content1").toggleClass("hidden");
});

$(".next_btn3").click(function() {
  $(".help_content3").toggleClass("hidden");
});
$(".prev_btn3").click(function() {
  $(".help_content2").toggleClass("hidden");
});

$(".prev_btn4").click(function() {
  $(".help_content3").toggleClass("hidden");
});

//閉じるボタンを押したときの処理
$(".close_btn").click(function() {
  $("#help_modal").toggleClass("hidden");
  $(".help_modal_masc").toggleClass("hidden");
});

