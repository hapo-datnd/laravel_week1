<?php
/**
 * Created by PhpStorm.
 * User: Dat
 * Date: 2/22/2019
 * Time: 10:48 AM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADD Member</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-4.2.1-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<div class="container">
    @if(count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                {{$err}}<br>
            @endforeach
        </div>
    @endif
    @if(session('thongbao'))
        <div class="alert alert-danger">
            {{session('thongbao')}}
        </div>
    @endif
    <form action="change" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
            <label type="text">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="pwd">Old Password:</label>
            <input type="password" class="form-control" id="pwd" name="oldPass">
        </div>
        <div class="form-group">
            <label for="pwd">New Password:</label>
            <input type="password" class="form-control" id="pwd" name="newPass">
        </div>
        <div class="form-group">
            <label for="pwd">Retype new password:</label>
            <input type="password" class="form-control" id="pwd" name="passNewAgain">
        </div>
        <div class="form-group flex flex-row-reverse">
            <button type="submit" name="submit" class="btn btn-primary mb-2">Update Profile</button>
        </div>
    </form>
</div>
</body>
</html>

