@extends('layouts.default')
@section('content')

<h1>会員登録</h1>

{{-- 会員登録完了時にフラッシュメッセージを表示 --}}
@if(Session::has('success'))
    <div class="bg-info">
        <p>{{ Session::get('success') }}</p>
    </div>
@endif

{!! Form::open(['route' => 'users.store'], array('class' => 'form-horizontal')) !!}

    <div class="form-group">
        {{-- バリデーションのエラー表示 --}}
        @foreach($errors->get('email') as $message)
            <span class="bg-danger">{{ $message }}</span>
        @endforeach
        <label for="email" class="col-sm-2 control-label">メールアドレス</label>
        <div class="col-sm-10">
            <input name="email" type="email" class="form-control">
        </div>
    </div>

    <div class="form-group">
        {{-- バリデーションのエラー表示 --}}
        @foreach($errors->get('password') as $message)
            <span class="bg-danger">{{ $message }}</span>
        @endforeach
        <label for="password" class="col-sm-2 control-label">パスワード</label>
        <div class="col-sm-10">
            <input name="password" type="password" class="form-control">
        </div>
    </div>

    <div class="form-group">
        {{-- バリデーションのエラー表示 --}}
        @foreach($errors->get('password_confirmation') as $message)
            <span class="bg-danger">{{ $message }}</span>
        @endforeach
        <label for="password_confirmation" class="col-sm-2 control-label">パスワードの確認</label>
        <div class="col-sm-10">
            <input name="password_confirmation" type="password" class="form-control">
        </div>
    </div>

    <div class="form-group">
        {{-- バリデーションのエラー表示 --}}
        @foreach($errors->get('phone') as $message)
            <span class="bg-danger">{{ $message }}</span>
        @endforeach
        <label for="phone" class="col-sm-2 control-label">電話番号</label>
        <div class="col-sm-10">
            <input name="phone" type="phone" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">会員登録する</button>
    </div>

{!! Form::close() !!}
{!! link_to_action('UserController@index', 'ユーザ一覧に戻る') !!}
@stop