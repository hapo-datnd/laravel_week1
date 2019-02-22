<?php
/**
 * Created by PhpStorm.
 * User: Dat
 * Date: 2/19/2019
 * Time: 10:17 AM
 */

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Level;
use App\Users;
use Illuminate\Http\Request;


class adminController extends Controller
{
    public function show(Request $request) {
        if (session('login')and !session('log'))
        {
            $id = session('login');
            $request->session()->put('log', $id);
            $user = Users::get();
            $userMain = Users::find($id);
            return view('user/show',['users' => $user],['userMain'=>$userMain]);
        }
        elseif (!session('login')and session('log'))
        {
            $id = session('log');
            $user = Users::get();
            $userMain = Users::find($id);
            return view('user/show',['users' => $user],['userMain'=>$userMain]);
        }
        elseif (session('login')and session('log'))
        {
            $id = session('login');
            $request->session()->put('log', $id);
            $user = Users::get();
            $userMain = Users::find($id);
            return view('user/show',['users' => $user],['userMain'=>$userMain]);
        }
        elseif(!session('login')and!session('log'))
        {
            return redirect()->route('loginReal');
        }

    }

    public function getAdd() {
        if (session('log'))
        {
            $level = Level::get();
            return view('user/add',['level'=>$level]);
        }
        elseif (!session('log'))
        {
            return redirect()->route('loginReal');
        }

    }

    public function postAdd(Request $request) {
        $this->validate($request,
            [
                'name' => 'required|min:3|max:32',
                'email' => 'required|unique:users,email',
                'pass' => 'required|min:8|max:32',
                'passAgain' => 'required|same:pass|'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.min' => 'Bạn phải nhập tên trên 3 kí tự',
                'name.max' => 'Bạn phải nhập tên dưới 32 kí tự',
                'email.required' => 'Bạn chưa nhập email',
                'email.unique' => 'Email bạn nhập đã được đăng kí',
                'pass.required' => 'Bạn chưa nhập password',
                'pass.min' => 'Bạn phải nhập mật khẩu trên 8 kí tự',
                'pass.max' => 'Bạn phải nhập mật khẩu dưới 32 kí tự',
                'passAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passAgain.same' => 'Bạn nhập lại mật khẩu chưa khớp'
            ]
        );
        $user = new Users;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->pass;
        $user->level = $request->level;
        $user->save();
        return redirect()->route('show')->with('login',session('log'));
    }

    public function getUpdate($id) {
        if (session('log'))
        {
            $user = Users::find($id);
            $level = Level::get();
            return view('user/update',['user'=>$user,'level'=>$level]);
        }
        elseif (!session('log'))
        {
            return redirect()->route('loginReal');
        }

    }

    public function postUpdate(Request $request,$id) {

        $this->validate($request,
            [
                'name' => 'required|min:3|max:32',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.min' => 'Bạn phải nhập tên trên 3 kí tự',
                'name.max' => 'Bạn phải nhập tên dưới 32 kí tự'
            ]
        );

        $user = Users::find($id);
        $user->name = $request->name;
        $user->level = $request->level;
        $user->save();
        return redirect()->route('show')->with('login',session('log'));
    }

    public function getDelete($id) {
        $user = Users::find($id);
        $user->delete();
        return redirect()->route('show')->with('login',session('log'));
    }

    public function getLogin() {
        if (session('log'))
        {
            $id = session('log');
            $user = Users::get();
            $userMain = Users::find($id);
            return view('user/show',['users' => $user],['userMain'=>$userMain]);
        }
        if(session('log-user'))
        {
            $id = session('log-user');
            return redirect()->route('home')->with('login-user',$id);
        }
        elseif(!session('log'))
        {
            return view('user/login');
        }
    }

    public function postLogin(Request $request) {

        $this->validate($request,
            [
                'email' => 'required|min:3|max:32',
                'pass' => 'required|min:8'
            ],
            [
                'email.required' => 'Bạn chưa nhập Email',
                'pass.required' => 'Mật khẩu phải trên 8 ký tự'
            ]
        );
        $count = Users::where('email',$request->email)->count();
        if ($count === 1 )
        {
            $user = Users::where('email',$request->email)->get();

            foreach($user as $users)
            {
                $pass = $users->password;
                $level = $users->level;
                $id = $users->id;
            }


            if (($pass === $request->pass)and($level<3))
            {
                return redirect()->route('home')->with('login-user',$id);
            }
            elseif (($pass === $request->pass)and($level===3))
            {
                return redirect()->route('show')->with('login',$id);
            }
            elseif (($pass !== $request->pass))
            {
                return redirect('user/login')->with ('thongbao','Bạn đã nhập sai mật khẩu');
            }
        }
        elseif ($count !== 1)
        {
            return redirect('user/login')->with ('thongbao','Bạn đã nhập sai gmail, hoặc gmail bạn chưa được đăng ký');
        }


    }

    public function getLogout(Request $request) {
        if (session('log')|!session('log-user'))
        {
            $request->session()->forget('log');
            return redirect()->route('loginReal');
        }
        elseif (!session('log')|session('log-user'))
        {
            $request->session()->forget('log-user');
            return redirect()->route('loginReal');
        }
        elseif (!session('log')and!session('log-user'))
        {
            return redirect()->route('loginReal');
        }
    }

    public function getHome(Request $request) {
        if (session('login-user')and !session('log-user'))
        {
            $id = session('login-user');
            $request->session()->put('log-user', $id);
            $userMain = Users::find($id);
            return view('user/home',['userMain'=>$userMain]);
        }
        elseif (!session('login-user')and session('log-user'))
        {
            $id = session('log-user');
            $userMain = Users::find($id);
            return view('user/home',['userMain'=>$userMain]);
        }
        elseif (session('login-user')and session('log-user'))
        {
            $id = session('login-user');
            $request->session()->put('log-user', $id);
            $userMain = Users::find($id);
            return view('user/home',['userMain'=>$userMain]);
        }
        elseif(!session('login-user')and!session('log-user'))
        {
            return redirect()->route('loginReal');
        }
    }

    public function getRegister() {
        if (session('log'))
        {
            return redirect()->route('addMember');
        }
        elseif (!session('log'))
        {
            $level = Level::get();
            return view('user/register',['level'=>$level]);
        }
    }

    public function postRegister(Request $request) {
        $this->validate($request,
            [
                'name' => 'required|min:3|max:32',
                'email' => 'required|unique:users,email',
                'pass' => 'required|min:8|max:32',
                'passAgain' => 'required|same:pass|'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.min' => 'Bạn phải nhập tên trên 3 kí tự',
                'name.max' => 'Bạn phải nhập tên dưới 32 kí tự',
                'email.required' => 'Bạn chưa nhập email',
                'email.unique' => 'Email bạn nhập đã được đăng kí',
                'pass.required' => 'Bạn chưa nhập password',
                'pass.min' => 'Bạn phải nhập mật khẩu trên 8 kí tự',
                'pass.max' => 'Bạn phải nhập mật khẩu dưới 32 kí tự',
                'passAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passAgain.same' => 'Bạn nhập lại mật khẩu chưa khớp'
            ]
        );
        $user = new Users;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->pass;
        $user->level = $request->level;
        $user->save();
        return redirect()->route('loginReal');
    }

    public function getChange () {
        if (session('log-user'))
        {
            $user = Users::find(session('log-user'));
            return view('user/change',['user'=>$user]);
        }
        elseif(session('log'))
        {
            $user = Users::find(session('log'));
            return view('user/change',['user'=>$user]);
        }
        elseif (!session('log-user'))
        {
            return redirect()->route('loginReal');
        }
    }

    public function postChange(Request $request) {
        $this->validate($request,
            [
                'name' => 'required|min:3|max:32',
                'oldPass' => 'required|min:8|max:32',
                'newPass' => 'required|min:8|max:32',
                'passNewAgain' => 'required|same:newPass|'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.min' => 'Bạn phải nhập tên trên 3 kí tự',
                'name.max' => 'Bạn phải nhập tên dưới 32 kí tự',
                'oldPass.required' => 'Bạn chưa nhập password',
                'oldPass.min' => 'Bạn phải nhập mật khẩu trên 8 kí tự',
                'oldPass.max' => 'Bạn phải nhập mật khẩu dưới 32 kí tự',
                'newPass.required' => 'Bạn chưa nhập password',
                'newPass.min' => 'Bạn phải nhập mật khẩu trên 8 kí tự',
                'newPass.max' => 'Bạn phải nhập mật khẩu dưới 32 kí tự',
                'passNewAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passNewAgain.same' => 'Bạn nhập lại mật khẩu chưa khớp'
            ]
        );
        if (session('log-user')) {
            $user = Users::find(session('log-user'));
            if ($user->password === $request->oldPass)
            {
                $user->password = $request ->newPass;
                $user->name = $request->name;
                $user->save();
                return redirect()->route('home')->with('thongbao','Bạn đã thay đổi thông tin cá nhân thành công');
            }
            elseif ($user->password !== $request->oldPass)
            {
                return redirect()->route('change')->with('thongbao','Bạn đã nhập sai mật khẩu');
            }
        }

        if (session('log')) {
            $user = Users::find(session('log'));
            if ($user->password === $request->oldPass)
            {
                $user->password = $request ->newPass;
                $user->name = $request->name;
                $user->save();
                return redirect()->route('show')->with('thongbao','Bạn đã thay đổi thông tin cá nhân thành công');
            }
            elseif ($user->password !== $request->oldPass)
            {
                return redirect()->route('change')->with('thongbao','Bạn đã nhập sai mật khẩu');
            }
        }


    }


}
