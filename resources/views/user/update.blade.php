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
    <form action="{{$user->id}}" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
            <label type="text">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label>Phân Quyền</label>
            <select class="form-control" name="level" id="level">
                @foreach ($level as $lvl )
                    <option @if($user->level === $lvl->id_lvl) selected="selected" @endif value="{{$lvl->id_lvl}}">{{$lvl->name_level}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group flex flex-row-reverse">
            <button type="submit" name="submit" class="btn btn-primary mb-2">Update member</button>
        </div>
    </form>
</div>
</body>
</html>
