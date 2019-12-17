<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title></title>
    <!-- Google fontを使用する場合、下記にcdnを記述 -->

    <!-- reset.cssへのリンク -->
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}" />

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
          <!-- jsで生成するかもしれないけど一応。自分が作成したコマが一覧表示される際のそれぞれの枠組 -->
          <!-- content5つで横１列-->
          <div class="flex_content">
            <div class="content">
              <div class="content_img">
                <img src="" alt="自分が作成したコマ" />
              </div>
              <p class="content_p">
                ものがたりに使用された回数:<span>1</span>回
              </p>
            </div>

            <div class="content">
              <div class="content_img">
                <img src="" alt="自分が作成したコマ" />
              </div>
              <p class="content_p">
                ものがたりに使用された回数:<span>1</span>回
              </p>
            </div>

            <div class="content">
              <div class="content_img">
                <img src="" alt="自分が作成したコマ" />
              </div>
              <p class="content_p">
                ものがたりに使用された回数:<span>1</span>回
              </p>
            </div>
            <div class="content">
              <div class="content_img">
                <img src="" alt="自分が作成したコマ" />
              </div>
              <p class="content_p">
                ものがたりに使用された回数:<span>1</span>回
              </p>
            </div>

            <div class="content">
              <div class="content_img">
                <img src="" alt="自分が作成したコマ" />
              </div>
              <p class="content_p">
                ものがたりに使用された回数:<span>1</span>回
              </p>
            </div>
          </div>

          <div class="prof_content">プロフィールページがいるならこちらに</div>
        </div>
      </main>
      <footer>(c)///////サービス名が入ります//////</footer>
    </div>

    <!-- jqueryの読み込み -->
    <script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
    <!-- jsファイルの読み込み -->
    <script src=""></script>
  </body>
</html>
