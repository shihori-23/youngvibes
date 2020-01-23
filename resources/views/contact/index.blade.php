@extends('layout')
 
@section('content')
<form method="POST" action="{{ route('contact.confirm') }}">
    @csrf

    <label>メールアドレス</label>
    <input
        name="email"
        value="{{ old('email') }}"
        type="text">
    @if ($errors->has('email'))
        <p class="error-message">{{ $errors->first('email') }}</p>
    @endif

    <label>タイトル</label>
    <input
        name="title"
        value="{{ old('title') }}"
        type="text">
    @if ($errors->has('title'))
        <p class="error-message">{{ $errors->first('title') }}</p>
    @endif


    <label>お問い合わせ内容</label>
    <textarea name="content">{{ old('content') }}</textarea>
    @if ($errors->has('content'))
        <p class="error-message">{{ $errors->first('content') }}</p>
    @endif

    <button type="submit">
        入力内容確認
    </button>
</form>
@endsection