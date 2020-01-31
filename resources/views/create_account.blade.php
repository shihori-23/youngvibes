<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Chumugu</title>
    <!-- Google fontを使用する場合、下記にcdnを記述 -->

    <!-- reset.cssへのリンク -->
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}" />

    <!-- cssファイルへのリンク -->
    <link rel="stylesheet" href="" />
  </head>

  <body>
    <div id="wapper">
      <!-- アカウント作成ページはheaderなくてもいいかも -->
      <header>
        <a href="#" class="logo">
          <img src="" alt="logo" width="180" height="100" />
        </a>
      </header>
      <main>
        <div class="main_container">
          <div class="left_container"></div>
          <div class="right_container">
            <h1 class="main_title">サービス名</h1>
            <!-- bootstrapを使用する場合のクラス名をつけてます-->
            <form
              class="form-horizontal form_container"
              method="POST"
              action=""
            >
              <h2 class="form_title">アカウント作成</h2>
              <div class="form-group">
                <label class="form_lb">ユーザー名</label>
                <input
                  type="text"
                  class="form-control"
                  name=""
                  id=""
                  placeholder="ユーザー名"
                  value=""
                />
              </div>
              <div class="form-group">
                <label class="form_lb">Login ID</label>
                <input
                  type="text"
                  class="form-control"
                  name=""
                  id=""
                  placeholder="Email"
                  value=""
                />
              </div>
              <div class="form-group">
                <label class="form_lb">Password</label>
                <input
                  type="password"
                  name=""
                  class="form-control"
                  id=""
                  placeholder="Password"
                />
              </div>
              <button type="submit" class="btn btn-default form_btn">
                送信
              </button>
              <div class="forget_container">
                <a href="" class="login_btn"
                  >既にアカウントをお持ちの方はこちら</a
                >
              </div>
            </form>
          </div>
        </div>
      </main>
      <footer>(c)///////サービス名が入ります///////</footer>
    </div>

    <!-- jqueryの読み込み -->
    <script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
    <!-- jsファイルの読み込み -->
    <script src=""></script>
  </body>
</html>
