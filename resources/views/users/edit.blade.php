@extends('layouts.default')
@section('content')
<h1>ユーザ一情報更新</h1>
{!! Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) !!}
<table class="table table-bordered">
    <tbody>
        <tr><th>ユーザID</th><td>{{ $user->id}}</td></tr>
        <tr><th>メールアドス</th><td>{!! Form::text('email', null, array('class' => 'form-control')) !!}</td></tr>
        <tr><th>電話番号</th><td>{!! Form::text('phone', null, array('class' => 'form-control')) !!}</td></tr>
    </tbody>
</table>
<div class="form-group">
    <button type="submit" class="btn btn-primary">ユーザ情報を更新する</button>
</div>
{!! Form::close() !!}
{!! link_to_action('UserController@index', 'ユーザ一覧に戻る') !!}
@stop
