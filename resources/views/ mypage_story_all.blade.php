<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title></title>
    <!-- Google fontを使用する場合、下記にcdnを記述 -->

    <!-- reset.cssへのリンク -->
    <link rel="stylesheet" href="reset.css" />

    <!-- cssファイルへのリンク -->
    <link rel="stylesheet" href="" />
  </head>

  <body>
    <div id="wapper">
      <header>
        <a href="#" class="logo">
          <img src="" alt="logo" width="180" height="100" />
        </a>
        <nav>
          <ul class="nav_flex">
            <li><a href="#">トップ（コマ一覧）</a></li>
            <li><a href="#">作品を見る</a></li>
            <li><a href="#">作品を作る</a></li>
            <li><a href="#">コマを作る</a></li>
            <li><a href="#">マイページ</a></li>
            <li><a href="#">ログアウト</a></li>
          </ul>
        </nav>
      </header>
      <main>
        <div class="main_container">
          <canvas id="canvas" width="" height=""></canvas>
          <!-- ストーリーをクリックしたときに表示されるモーダル -->
          <div class="modal">
            <h1 class="story_title">タイトル</h1>
            <div class="story_img">
              <img src="" alt="ストーリーの画像" />
            </div>
            <a href="">いいね</a>
            <a href="">閉じる</a>
          </div>
        </div>
      </main>
      <footer>(c)///////サービス名が入ります//////</footer>
    </div>

    <!-- jqueryの読み込み -->
    <script src="jquery-2.1.3.min.js"></script>
    <!-- jsファイルの読み込み -->
    <script src=""></script>
  </body>
</html>
