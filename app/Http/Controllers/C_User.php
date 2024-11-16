<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;

class C_User extends Controller
{
    // form tambah user
    public function index()
    {
        $users = User::where('jabatan', 'pegawai')->get();
        return view('owner.user', compact('users'));
    }

    // tambah user baru
    public function store(Request $request){
        if ($request->ajax()) {
            $user = User::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'noHp' => $request->noHp,
                'username' => $request->username,
                'password' => $request->password,
                'jabatan' => 'pegawai'
            ]);
            $users = User::where('jabatan', 'pegawai')->get();
            $response["message"] = "Data Karyawan Berhasil Di Tambahkan !";
            $response["data"] = compact('users');
            return response()->json($response, 200);
        }
    }
    // form 
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->user_id)->update([
                'nama' => $request->nama,
                'alamat'=> $request->alamat,
                'email' => $request->email,
                'noHp' => $request->noHp,
                'username' => $request->username,
                'password' => $request->password,
            ]);

            $users = User::where('jabatan', 'pegawai')->get();
            $response["message"] = "Data Karyawan Berhasil Di Update !";
            $response["data"] = compact('users');
            return response()->json($response, 200);
        }
    }

    public function edit($id)
    {
        $users = User::where('user_id', $id)->first();
        return response($users);
    }

    public function destroy(Request $request,$id)
    {
        if ($request->ajax()) {
            User::destroy($id);

            $users = User::where('jabatan', 'pegawai')->get();
            $response["message"] = "Data Berhasil Di hapus !";
            $response["data"] = compact('users');
            return response()->json($response, 200);
        }
    }

    public function hapus($id)
    {
        User::destroy($id);
        $users = User::where('jabatan', 'pegawai')->get();
        $response["message"] = "Data Berhasil Di hapus !";
        $response["data"] = compact('users');
        return response()->json($response, 200);
    }
    public function addUser(Request $request)
    {
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'noHp' => $request->noHp,
            'username' => $request->username,
            'password' => $request->password,
            'jabatan' => $request->jabatan
        ]);

        Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
        return redirect('register');
    }
    
    // login
    public function login()
    {
        if (Auth::check()) {
            return redirect('home');
        }else{
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            if (auth()->user()->jabatan === 'owner') {
                // jika user admin
                return redirect()->intended('/admin');
            } else {
                // jika user pegawai
                return redirect()->intended('/pegawai');
            }
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}