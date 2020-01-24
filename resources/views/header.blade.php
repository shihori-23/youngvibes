    <?php
     $userRole = Auth::user()->role_id;
    ?>
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
      
        @if(Auth::user()->role == 0)
        <a href="/admin">admin</a>
        @endif

    </header>

    <!-- 編集完了後の確認画面モーダル -->
    <div class="help_modal_masc hidden"></div>
      <div class="hidden" id="help_modal">
          <div class="help_contents">
            <div class="title_wrap">
              <h1 class="conf_title1">Chumuguでの遊び方</h1>
            </div>

            <div class="help_content1">
              <div class="help_subcontent">

                <p class="help_detail1">はじめまして、Chumuguです。</p>
                <p class="help_detail2">さあ、これからChumuguでのクリエイションが始まります！</p>
                <p class="help_detail3">あなたがクリエイションを存分に楽しめるように、<br>Chumuguではどんなことができるのか、これから遊び方をご紹介します！</p>
                <p class="help_detail4">あなたの頭の中のアイディアを自由に表現してみましょう！</p>
                
                <div class="help_img_flex">
                <img src="{{asset('/img/help/c_1.png')}}" alt="コマ作成ページのスクショ">
                <img src="{{asset('/img/help/c_2.png')}}" alt="コマ作成ページのスクショ">
                <img src="{{asset('/img/help/c_3.png')}}" alt="コマ作成ページのスクショ">
                </div>
                <div class="help_content_btn">
                  <input type="submit" value="遊び方を見る" class="next_btn1"><br>
                  <span class="close_btn">×</span>
                </div>
              </div>
            </div>
            <div class="help_content2">
              <div class="help_subcontent">
              <p class="help_title">1.コマをつくろう</p>
                <div class="help_img">
                <img src="{{asset('/img/help/help_img3.png')}}" alt="コマ作成ページのスクショ">
                </div>
                <p class="help_detail">右側にあるパレットにさまざまなツールが準備されています。イラストを描いたり、図形を組み合わせたり、文字を入力したり、お気に入りの写真をアップしたりして、あなただけの1コマを完成させましょう！</p>
                <div class="help_content_btn">
                  <input type="submit" value="戻る" class="prev_btn2">
                  <input type="submit" value="次へ" class="next_btn2"><br>
                  <span class="close_btn">×</span>
                </div>
              </div>
            </div>
            <div class="help_content3">
            <div class="help_subcontent">
              <p class="help_title">2.ストーリーとしてつむがれる</p>
              <div class="help_img">
                  <img src="{{asset('/img/help/help_img2.png')}}" alt="コマ作成ページのスクショ">
              </div>
                <p class="help_detail">あなたのコマと、他の作者が作成したコマを組み合わせてみましょう！左画面に浮遊するコマから、あなたの好きなコマを好きなだけセレクトして、好きな構成で並べてみてください。あたらしい文脈を持った物語の完成です！</p>
                  <div class="help_content_btn">
                    <input type="submit" value="戻る" class="prev_btn3">
                    <input type="submit" value="次へ" class="next_btn3"><br>
                    <span class="close_btn">×</span>
                  </div>
            </div>
            </div>
            <div class="help_content4">
            <div class="help_subcontent">
              <p class="help_title">3.Re:ストーリーのつくろう</p>
              <div class="help_img">
                  <img src="{{asset('/img/help/help_img4.png')}}" alt="コマ作成ページのスクショ">
              </div>
                <p class="help_detail">あなたのコマと、他の作者が作成したコマを組み合わせてみましょう！左画面に浮遊するコマから、あなたの好きなコマを好きなだけセレクトして、好きな構成で並べてみてください。あたらしい文脈を持った物語の完成です！</p>
                  <div class="help_content_btn">
                    <input type="submit" value="戻る" class="prev_btn4"><br>
                    <span class="close_btn">×</span>
                  </div>
            </div>
            </div>

          </div>
        </form>
      </div>

