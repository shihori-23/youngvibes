    <header>
      <div class="header-logo"><img class="header_logo_img" src="{{asset('/img/logo/Chumugu_logo.png')}}"></div>
      <ul class="header-menu">
        <li class="menu">
          <a href="#" class="arrow-mark">作品</a>
          <ul class="menu-open">
              <li><a href="/top">作品を見る</a></li>
              <li><a href="/coma_create">作品を作る</a></li>
          </ul>
        </li>
        <li class="menu">
          <a href="#" class="arrow-mark">ストーリー</a>
          <ul class="menu-open">
              <li><a href="/story">ストーリーを見る</a></li>
              <li><a href="/story_create">ストーリーを作る</a></li>
          </ul>
        </li>
        <li><a href="/mypage">マイページ</a></li>
        <li><a href="{{ route('user.logout') }}">ログアウト</a></li>
      </ul>
    </header>
