<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Berita;

class RegisterController extends Controller
{
    public function create()
    {
        
        
        return view('template.register',[
        'logoheader' => Berita::where('tipe', 'logoheader')->latest()->first(),
        'logofooter' => Berita::where('tipe', 'logofooter')->latest()->first(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|min:3|unique:users,username|max:255',
            'password' => 'required|min:6|max:255',
            'no_wa' => 'required|numeric|unique:users,no_wa'
        ], [
            'nama.required' => 'Harap isi kolom nama!',
            'username.required' => 'Harap isi kolom username!',
            'username.min' => 'Panjang username minimal 3 huruf',
            'username.unique' => 'Username telah digunakan',
            'username.max' => 'Panjang username maximal 255 huruf',
            'password' => 'Harap isi kolom password',
            'password.min' => 'Panjang password minimal 6 huruf',
            'password.max' => 'Panjang password maximal 255 huruf',
            'no_wa.required' => 'Harap isi no whatsapp!',
            'no_wa.numeric' => 'No whatsapp tidak valid!',
            'no_wa.unique' => 'No whatsapp telah digunakan'
        ]);
        
        $no = $request->no_wa;
        
        if($no[0] == 0){
            
            $no = str_replace($no[0],'62',$no);
            
        }
        
        $user = new User();
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->balance = 0;
        $user->no_wa = $no;
        $user->role = 'Member';
        $user->save();

        return redirect(route('login'))->with('success', 'Berhasil melakukan pendaftaran, silakan masuk menggunakan akun anda');
    }
}
