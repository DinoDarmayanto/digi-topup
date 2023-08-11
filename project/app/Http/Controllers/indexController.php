<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Berita;
class indexController extends Controller
{
    public function create()
    {
        
        return view('template.index', [
            'kategori' => Kategori::where('status', 'active')->get(),
            'banner' => Berita::where('tipe', 'banner')->get(),
            'logoheader' => Berita::where('tipe', 'logoheader')->latest()->first(),
            'logofooter' => Berita::where('tipe', 'logofooter')->latest()->first(),
            'popup' => Berita::where('tipe', 'popup')->latest()->first(),
            'pay_method' => \App\Models\Method::all()
        ]);
    }
    
    public function cariIndex(Request $request)
    {
        if($request->ajax()){
            
            $data = Kategori::where('nama','LIKE','%'.$request->data.'%')->where('status','active')->limit(6)->get();
            
            
            $res = '';
            
           
            foreach($data as $d){
                
                $res .= '
                
                           <li>
                                <a class="dropdown-item" style="color:#dee2e6" href="'.url("/order").'/'.$d->kode.'">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="'.$d->thumbnail.'" alt="" class="img-fluid">
                                            </div>
                                            <div class="col-9">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <b>'.$d->nama.'</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                ';
                
            }
            
            return $res;
            
            
        }
    }
}
