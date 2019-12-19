@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="container">

    <div class="box">
    <p>
    つくることは、つむぐこと。<br>
    Chumuguは、つくることを楽しむ場です。<br>

    まずは目の前に広がる他の作者の作品を、<br>
    見て楽しむことから始まります。<br>

    そして、今度はあなたが、文章・イラスト・写真で、<br>
    頭の中にあるアイディアを自分なりに表現してみましょう。<br>
    それは「1コマ」という形で1つの作品になります。<br>

    さらにそこから、他の人が形にした作品と自分の作品を並べて、<br>
    1つの物語を組み立てることができます。<br>
    その組み立てた物語は、コラージュとして<br>
    新しい「作品」に生まれ変わります。<br>

    あなたと同じように、他の誰かもあなたの作品を選んで物語を組み立てることができるので、<br>
    自分の作った作品がどのような物語に加わるかも、同時に楽しむことができます。<br>

    最後、あなたの作った作品は、他の作者が作ったすべての作品とつながり、<br>
    1つの大きなストーリーをつむぐことになります。<br>

    さあ、つくることを楽しみましょう！
    </p>
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
@endsection
