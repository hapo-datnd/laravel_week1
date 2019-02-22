<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
    <form action="login" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
            <label type="text">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label type="text">Password:</label>
            <input type="password" class="form-control" id="pass" name="pass">
        </div>
        <div class="form-group flex flex-row-reverse">

            <button type="submit" name="submit" class="btn btn-primary mb-2">Login</button>
        </div>
    </form>
    <div class="flex flex-row-reverse">
        <a href="register">Register</a>
    </div>
</div>
</body>
</html>
