<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;

class C_Auth extends Controller
{
    public function home()
    {
        if(Session::get('userRole')=='owner'){
            return view('owner.index');
        }else if(Session::get('userRole')=='pegawai'){
            return view('pegawai.index');
        }else{
            return view('login');
        }
    }
    public function owner()
    {
        return view('owner.index');
    }
    public function pegawai()
    {
        return view('pegawai.index');
    }
    
    public function login()
    {
        session()->forget('errorLogin');
        return view('login');
    }
    public function actionlogin(Request $request)
    {
        $user = User::where('username',$request->username)->where('password',$request->password)->first(); 
        if ($user) {
            $request->session()->put('idUser',$user->user_id);
            $request->session()->put('username',$user->username);
            $request->session()->put('userRole',$user->jabatan);
            $request->session()->put('namaUser',$user->nama);
            
            if ($user->jabatan=='owner') {
                return redirect('/owner');
            }else if($user->jabatan=='pegawai'){
                return redirect('/pegawai');
            }
        }else{
            Session::flash('errorLogin',"Username dan Password Salah!");
            return view('login');
        }
    }

    public function actionlogout()
    {
        Session::forget('idUser');
        Session::forget('username');
        Session::forget('userRole');
        Session::forget('namaUser');
        return redirect('/');
    }

}