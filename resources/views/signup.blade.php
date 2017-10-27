@extends('layouts.app')

@section('title')
    登録
@endsection

@section('content')
    <form action="{{ route('post_sign_up') }}" method="post">
        {!! csrf_field() !!}
        <sign-up></sign-up>
    </form>
@endsection