<!DOCTYPE html>
<html lang="ja">
<head>

   <!-- reset.cssへのリンク -->
   <link rel="stylesheet" href="{{asset('/css/reset.css')}}" />
   <!-- cssファイルへのリンク -->
   <link rel="stylesheet" href="{{asset('/css/tutorial.css')}}" />



   <!-- <link rel="stylesheet" type="text/css" href="css/tutorial.css">
   <link rel="stylesheet" href="css/reset.css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <script type="text/javascript" src="js/test.js"></script> -->
   <title>Document</title>
</head>
<body>
   <section class="block block-one">
      <img src="{{ asset('public/img/tutorial/chumugu_icon.png') }}" alt="ロゴ" height="100px" width="100px;"/>
         <p class="effect-fade">Chumuguは、作って、並べて、眺めて、つながる、<br>
         <p class="effect-fade">エンターテイメントクリエイションツールです。</p>
   </section>

   <section class="block block-two">
      <section class="block-two-img">
         <section class="two-img1">
         <img src="{{ asset('public/img/tutorial/penicon.png') }}" alt="ペン" width="120" height="120" class="effect-fade"/>      
      </section>
         <section class="two-img2">
            <img src="{{ asset('public/img/tutorial/palette.png') }}" alt="パレット" width="120" height="120" class="effect-fade"/>      
         </section>
         <section class="two-img3">
            <img src="{{ asset('public/img/tutorial/camera.png') }}" alt="カメラ" width="120" height="120" class="effect-fade"/>   
         </section>
      </section>
      <section class="block-two-sentence">
         <h2>表現する</h2>
            <p class="effect-fade">まずはここから。</p><br>
            <p class="effect-fade">頭の中にあるアイディアを</p><br>
            <p class="effect-fade">文章・イラスト・写真で</p><br>
            <p class="effect-fade">自由に表現してみましょう。</p>
      </section>
   </section>
   <section class="block block-three">

      <section class="box2">
         <h3>組み立てる</h3>
            <p class="effect-fade">さらにそこから、他の人が形にしたアイディアと</p><br>
            <p class="effect-fade">自分のアイディアを並べて</p><br>
            <p class="effect-fade">1つの物語を組み立てることができます。</p>
      </section>
      <section class="box1">
         <ul class="effect-fade">
            <li class="effect-fade"><img src="{{ asset('public/img/tutorial/london.png') }}" alt="旅行" width="120" height="120" /></li>
            <li class="effect-fade"><img src="{{ asset('public/img/tutorial/zayn.png') }}" alt="ゼイン" width="120" height="120" /></li>
            <li class="effect-fade"><img src="{{ asset('public/img/tutorial/apple.png') }}" alt="アップル" width="120" height="120" /></li>
            <li class="effect-fade"><img src="{{ asset('public/img/tutorial/potato.png') }}" alt="イラスト" width="120" height="120" /></li>
         </ul>
   </section>
   </section>

   <section class="block block-four">
      <section class="block-four-sentence">
         <h4>つむぐ<h4>
            <p class="effect-fade">最後に、あなたの作った作品は</p><br>
            <p class="effect-fade">他の作者が作ったすべての作品とつながり、</p><br>
            <p class="effect-fade">1つの大きなストーリーをつむぐことになります。</p>
      </section>
      <section class="effect-fade">
      <img src="{{ asset('public/img/tutorial/square.png') }}" alt="スクエア" width="130" height="130" class="effect-fade"/>  
      <img src="{{ asset('public/img/tutorial/line.png') }}" alt="ライン" width="130" height="130" class="effect-fade"/>
      <img src="{{ asset('public/img/tutorial/square.png') }}" alt="スクエア" width="130" height="130" class="effect-fade"/>  
      <img src="{{ asset('public/img/tutorial/line.png') }}" alt="ライン" width="130" height="130" class="effect-fade"/>
      <img src="{{ asset('public/img/tutorial/square.png') }}" alt="スクエア" width="130" height="130" class="effect-fade"/>  
      <img src="{{ asset('public/img/tutorial/line.png') }}" alt="ライン" width="130" height="130" class="effect-fade"/>
      <img src="{{ asset('public/img/tutorial/square.png') }}" alt="スクエア" width="130" height="130" class="effect-fade"/> 
      </section>
   </section>
   <div class="block block-five">
      <p>さあ、つくることを楽しみましょう！</p>
   </div>
   <div id="page_top"><a href="#"></a></div>
</body>
</html>