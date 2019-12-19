@extends('layouts.app')

@section('content')
<!-- <link rel="stylesheet" href="{{ asset('css/login.css') }}">
<script src="{{ asset('/js/jquery-3.1.1.min.js') }}"></script> -->

<div class="container">
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
                                    ログイン
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    パスワードを忘れましたか?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



    <div class="start">
        <div class="inner">
    <p class="title">
    つくることは、つむぐこと。
    </p>
    <p class = "first">    
    Chumuguは、つくることを楽しむ場です。<br>
    </p>

    <p class="second">
    まずは目の前に広がる他の作者の作品を、<br>
    見て楽しむことから始まります。<br>
    </p>

    <p class="second2">
    そして、今度はあなたが、文章・イラスト・写真で、<br>
    頭の中にあるアイディアを自分なりに表現してみましょう。<br>
    それは「1コマ」という形で1つの作品になります。<br>
    </p>
    <p class="third">
    さらにそこから、他の人が形にした作品と自分の作品を並べて、<br>
    1つの物語を組み立てることができます。<br>
    その組み立てた物語は、コラージュとして<br>
    新しい「作品」に生まれ変わります。<br>
    </p>

    <p class="forth">
    あなたと同じように、他の誰かもあなたの作品を選んで<br>
    物語を組み立てることができるので、<br>
    自分の作った作品がどのような物語に加わるかも、<br>
    同時に楽しむことができます。<br>
    </p>

    <p class="fifth">
    最後、あなたの作った作品は、<br>
    他の作者が作ったすべての作品とつながり、<br>
    1つの大きなストーリーをつむぐことになります。<br>
    </p>
    <p class="six">
    さあ、つくることを楽しみましょう！
    </p>
    </div>
</div>

    <script>
    $(function() {
	setTimeout(function(){
        $('.start').fadeIn(1600);
        $('.inner').fadeIn(400);
	},500); //0.5秒後にロゴをフェードイン!
	setTimeout(function(){
		$('.start').fadeOut(500);
		$('.inner').fadeOut(500);
	},2500); //2.5秒後にロゴ含め真っ白背景をフェードアウト！
    });
    </script>


@endsection
