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
              <li><a href="/long_story">Re:ストーリーを見る</a></li>
              <li><a href="/story_create">Re:ストーリーを作る</a></li>
          </ul>
        </li>
        <li><a href="/mypage">マイページ</a></li>
        <li><a href="{{ route('user.logout') }}">ログアウト</a></li>
      </ul>
    </header>
