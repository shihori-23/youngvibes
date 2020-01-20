    <header>
      <a class="header-logo" href="/top"><img class="header_logo_img" src="{{asset('/img/logo/Chumugu_logo.png')}}"></a>
      <ul class="header-menu">
        <li class="menu">
          <a href="#" class="arrow-mark">コマ</a>
          <ul class="menu-open">
              <li><a href="/top">コマを見る</a></li>
              <li><a href="/coma_create">コマを作る</a></li>
          </ul>
        </li>
        <li class="menu">
          <a href="#" class="arrow-mark">Re:ストーリー</a>
          <ul class="menu-open">
              <li><a href="/story_all">Re:ストーリーを見る</a></li>
              <li><a href="/story_create">Re:ストーリーを作る</a></li>
          </ul>
        </li>
        <li><a href="/mypage">マイページ</a></li>
        <li><a href="{{ route('user.logout') }}">ログアウト</a></li>
      </ul>
      <a id="helpbtn"><img class="header_help_icon" src="{{asset('/img/logo/help.png')}}"></a>
    </header>

    <!-- 編集完了後の確認画面モーダル -->
    <div class="help_modal_masc hidden"></div>
      <div class="hidden" id="help_modal">
          <div class="help_contents">

            <h1 class="conf_title">Chumuguでの遊び方</h1>

            <div class="help_content1">
              <p class="help_title">１</p>
                <div class="help_content_btn">
                  <input type="submit" value="次へ" class="next_btn1"><br>
                  <span class="close_btn">×</span>
                </div>
            </div>
            <div class="help_content2">
            <p class="help_title">2</p>
                <div class="help_content_btn">
                  <input type="submit" value="戻る" class="prev_btn2">
                  <input type="submit" value="次へ" class="next_btn2"><br>
                  <span class="close_btn">×</span>
                </div>
            </div>
            <div class="help_content3">
            <p class="help_title">3</p>
                <div class="help_content_btn">
                  <input type="submit" value="戻る" class="prev_btn3">
                  <input type="submit" value="次へ" class="next_btn3"><br>
                  <span class="close_btn">×</span>
                </div>
            </div>
            <div class="help_content4">
            <p class="help_title">4</p>
                <div class="help_content_btn">
                <input type="submit" value="戻る" class="prev_btn4"><br>
                  <span class="close_btn">×</span>
                </div>
            </div>
          </div>
        </form>
      </div>

