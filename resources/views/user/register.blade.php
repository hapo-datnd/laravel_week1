<?php
/**
 * Created by PhpStorm.
 * User: Dat
 * Date: 2/22/2019
 * Time: 10:03 AM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
    <form action="add" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
            <label type="text">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" name="pass">
        </div>
        <div class="form-group">
            <label for="pwd">Retype password:</label>
            <input type="password" class="form-control" id="pwd" name="passAgain">
        </div>
        <div class="form-group">
            <label>Phân Quyền</label>
            <select class="form-control" name="level" id="level">
                @foreach ($level as $lvl )
                    @if( $lvl->id_lvl < 3)
                        <option value="{{$lvl->id_lvl}}">{{$lvl->name_level}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group flex flex-row-reverse">
            <button type="submit" name="submit" class="btn btn-primary mb-2">Đăng ký</button>
        </div>
    </form>
</div>
</body>
</html>
