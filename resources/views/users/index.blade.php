@extends('layouts.default')
@section('content')
<h1>ユーザ一覧</h1>
{!! link_to_action('UserController@create', '新規登録') !!}
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ユーザID</th>
            <th>メールアドス</th>
            <th>電話番号</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
    <tr>
        <td>{!! link_to_action('UserController@edit', $user->id, [$user->id]) !!}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
@stop