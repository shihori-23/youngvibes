<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <!-- reset.cssへのリンク -->
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}" />

    <!-- cssファイルへのリンク -->
    <link rel="stylesheet" href="{{asset('/css/mypage.css')}}" />
    {{-- <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/mypage.css" /> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <section class="mypage">
      <div class="header">
        <div class="header-logo">Chumugu</div>
        <a class="menu-trigger" href="#">
          <span></span>
          <span></span>
          <span></span>
        </a>
      </div>
      <div class="main-contents">
        <div class="container">
          <div class="outside-circle">
            <div class="inner-circle">
              <div class="user-profile">
                {{-- データベースにユーザー情報が入り次第下記に変える --}}
                <h1 class="user-name">{{ Auth::user()->name }}</h1>                 
                {{-- <h1 class="user-name">{{$user->name}}</h1> --}}              
                <ul class="profile-menu">
                  <li><a href="{{ route('user.logout') }}">Logout</a></li>
                  <li>Update Profile</li>
                  <li>Your Story</li>
                  <li>Your History</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="scroll-contents">
      {{-- <img src="img/jain1.jpg" /> --}}
      @foreach($service_contents as $service_content)
            <img src='img/<?= $service_content['img_file'] ?>' alt="">
      @endforeach
      {{-- <img src="img/jain2.jpeg" />
      <img src="img/jain3.jpeg" />
      <img src="img/jain4.jpeg" />
      <img src="img/jain5.jpeg" />
      <img src="img/jain6.jpeg" />
      <img src="img/jain7.jpeg" />
      <img src="img/jain8.jpeg" /> --}}
    </div>

    <div class="scroll-contents1">
      {{-- <img src="img/jain1.jpg" /> --}}
      @foreach($service_contents as $service_content)
            <img src='img/<?= $service_content['img_file'] ?>' alt="">
      @endforeach
    </div>

    <script>
      //画面の高さに合わせてheightを可変的に設定
      const realHeight = window.innerHeight;
      $(function() {
        $(".mypage").css("height", realHeight);

        const outsideCircle = $(".outside-circle").width();
        $(".outside-circle").css("height", outsideCircle);
        console.log(outsideCircle);
      });
    </script>
  </body>
</html>
