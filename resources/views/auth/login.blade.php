@extends('layouts.app')

@section('content')
<!-- <link rel="stylesheet" href="{{ asset('css/login.css') }}">
<script src="{{ asset('/js/jquery-3.1.1.min.js') }}"></script> -->

<div class="container">

    <div class="start">
        <div class="start_content">
        <div class="logo_img">
            <img class="logo" src="{{ asset('img/logo/Chumugu_logo.png') }}" alt="logo" height="80px" width="auto">
        </div>
        <!-- <div class="inner"> -->
        <p class="title">
        つくることは、つむぐこと。
        </p>
        <p class = "first">    
        Chumuguは、つくることを楽しむ場です。<br>
        </p>

        <p class="second">
        あなたの「つくる」が、誰かの素敵なアイディアになる。<br>
        誰かの「つくる」が、あなたの素敵なアイディアになる。<br>
        </p>

        <p class="third">
        そして物語はつむがれる。<br>
        さあ、つくることを楽しもう！<br>
        </p>

        </div>
    </div>
        
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button><br>
                            </div>
                                <a class="btn-link" href="{{ route('password.request') }}">
                                    パスワードを忘れた方はこちら
                                </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
</div>

</div>
    <!-- 背景にコマを飛ばすためのリスト -->
    <!-- <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul> -->
</div>

    <!-- <script>
    $(function() {
	setTimeout(function(){
        $('.start').fadeIn(1600);
        $('.inner').fadeIn(400); -->
	<!-- },500); //0.5秒後にロゴをフェードイン!
	setTimeout(function(){
		$('.start').fadeOut(500);
		$('.inner').fadeOut(500);
	},2500); //2.5秒後にロゴ含め真っ白背景をフェードアウト！
    });
    </script> -->
    <script>
        //画面の高さに合わせてheightを可変的に設定
        const realHeight = window.innerHeight;
        $(function() {
            $("body").css("height", realHeight);

            const outsideCircle = $(".outside-circle").width();
            $(".outside-circle").css("height", outsideCircle);
            console.log(outsideCircle);
        });
        </script>

@endsection
