@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="login-container">
            <div id="output"></div>
            <div class="avatar"></div>
            <div class="form-box">
                <form action="" method="">
                    <input name="user" type="text" placeholder="username">
                    <input type="password" placeholder="password">
                    <button class="btn btn-info btn-block login" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
{{--  need some cs and js  --}}
@section('embedCSS')
    <link href="{{ asset('default/css/login.css') }}" rel="stylesheet">
@endsection
@section('embedJS')
        <script src="{{ asset('default/js/login.js') }}"></script>    
@endsection