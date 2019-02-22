<?php
/**
 * Created by PhpStorm.
 * User: Dat
 * Date: 2/20/2019
 * Time: 3:37 PM
 */

namespace App\Http\Controllers\layout;

use Illuminate\Http\Request;
use App\User;
use App\Level;
use App\Http\Controllers\Controller;

class layoutController extends Controller
{
    public function quantri() {
        return view('layout/quantri');
    }

    public function getIndex() {
        return view('layout/index');
    }

    public function postIndex(Request $request) {


        $level = Level::get();
        $count = 0;

        $this->validate($request,
            [
                'email' => 'required',
                'pass' => 'required'
            ],
            [
                'email.required'=>'Bạn chưa nhập email',
                'pass.required'=>'Bạn chưa nhập password'
            ]
        );
        $user = User::where('name',$request->name);

        if (isset($user))
        {
            if ($user->password === $request->pass)
            {

            }
        }
    }
}
