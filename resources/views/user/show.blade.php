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
        <p>Xin chào <b>{{$userMain->name}}</b>! Bạn đang ở trang quản trị users </p>
        <div class="flex flex-row-reverse header">
            <a href="add">Thêm thành viên</a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>User Name</td>
                <td>Email</td>
                <td>Phân Quyền</td>
                <td>Hành Động</td>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->level === 1)
                                Candidate
                            @elseif($user->level === 2)
                                HR
                            @elseif($user->level === 3)
                                Admin
                            @endif
                        </td>
                        <td class="justify-content-center flex align-content-around">
                            <a href="update/{{$user->id}}">Sửa</a>
                            <a href="delete/{{$user->id}}">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex flex-row-reverse footer">
            <a href="logout">Log Out</a>
            <a href="change">Change Profile</a>
        </div>
    </div>
</body>
</html>
