<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Auth;


class MembershipController extends Controller
{
    public function membership()
    {
        // return view('components.dashboarduser',[
        //     'data' => \App\Models\Pembelian::where('username', Auth::user()->username)->get(),
        //     'logoheader' => Berita::where('tipe', 'logoheader')->latest()->first(),
        //     'logofooter' => Berita::where('tipe', 'logofooter')->latest()->first(),
        // ]);
        
        return view('template.membership',[
            'data' => \App\Models\Pembelian::where('username', Auth::user()->username)->get(),
            'logoheader' => Berita::where('tipe', 'logoheader')->latest()->first(),
            'logofooter' => Berita::where('tipe', 'logofooter')->latest()->first(),
        ]);
    }
    
    
}