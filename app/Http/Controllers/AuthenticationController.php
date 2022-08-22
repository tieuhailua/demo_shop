<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class AuthenticationController extends Controller
{
    public function login() {
        // $credentials = [
        //     'email'    => 'quang@gmail.com',
        //     'password' => '1',
        // ];
        // $user = Sentinel::registerAndActivate($credentials);
        return view('authentication.login');
    }
    
    public function processLogin(Request $request) {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];
        if ($user = Sentinel::authenticate($credentials)) {
            // login thành công
            $user = Sentinel::getUser();
            $role = Sentinel::getRoleRepository()->findBySlug('admin');
            if (!$user->inRole($role)) {
                return redirect()->route('home');
            } else {
                return redirect()->route('admin.index');
            }
        } else {
            // wrong username or password
            return view('authentication.login');
        }
    }
}
