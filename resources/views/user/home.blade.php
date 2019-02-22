<?php
/**
 * Created by PhpStorm.
 * User: Dat
 * Date: 2/21/2019
 * Time: 1:58 PM
 */
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-4.2.1-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Adnmin</title>
</head>
<body>
<div class="container">
    @if(session('thongbao'))
        <div class="alert alert-danger">
            {{session('thongbao')}}
        </div>
    @endif
    <p>Xin chào <b>{{$userMain->name}}</b>! Bạn đang ở trang cá nhân của bạn! </p>
    <div class="flex flex-row-reverse header">
        <a href="change">Change Profile</a>
    </div>
    <div class="flex flex-row-reverse footer">
        <a href="logout">Log Out</a>
    </div>
</div>
</body>
</html>
