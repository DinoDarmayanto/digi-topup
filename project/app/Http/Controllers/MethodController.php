<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Method;

class MethodController extends Controller
{
    public function create()
    {
        return view('components.admin.method', ['data' => method::orderBy('name', 'asc')->paginate(100)]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'images' => 'required|file|mimes:jpg,png,webp',
            'code' => 'required',
            'keterangan' => 'required',
            'tipe' => 'required'
        ]);

        $file = $request->file('images');
        $folder = 'assets/thumbnail';
        $file->move($folder, $file->getClientOriginalName());    
        $method = new method();
        $method->name = $request->name;
        $method->code = $request->code;
        $method->keterangan = $request->keterangan;
        $method->tipe = $request->tipe;
        $method->images = "/".$folder."/".$file->getClientOriginalName();
        $method->save();

        return back()->with('success', 'Berhasil menambahkan payment');
    }

    public function delete($id)
    {
        try{
            $data = method::where('id', $id)->select('images')->first();
            unlink(public_path($data->images));
            method::where('id', $id)->delete();
            return back()->with('success', 'Berhasil hapus!');
        }catch(\Exception $e){
            method::where('id', $id)->delete();
            return back()->with('success', 'Berhasil hapus!');
        }
    }

public function detail($id)
    {
        $data = method::where('id', $id)->first();
        
        $send = "
                <form action='".route("method.detail.update", [$id])."' method='POST' enctype='multipart/form-data'>
                    <input type='hidden' name='_token' value='".csrf_token()."'>
                    <div class='mb-3 row'>
                        <label class='col-lg-2 col-form-label' for='example-fileinput'>Nama</label>
                        <div class='col-lg-10'>
                            <input type='text' class='form-control' value='".$data->name. "' name='name'>
                        </div>
                    </div>    
                    <div class='mb-3 row'>
                        <label class='col-lg-2 col-form-label' for='example-fileinput'>Kode</label>
                        <div class='col-lg-10'>
                            <input type='text' class='form-control' value='" . $data->code . "' name='code'>
                        </div>
                    </div>
                    <div class='mb-3 row'>
                        <label class='col-lg-2 col-form-label' for='example-fileinput'>Keterangan</label>
                        <div class='col-lg-10'>
                            <input type='text' class='form-control' value='" . $data->keterangan . "' name='keterangan'>
                        </div>
                    </div>
                    <div class='mb-3 row'>
                        <label class='col-lg-2 col-form-label'>Tipe</label>
                        <div class='col-lg-10'>
                            <select class='form-select' name='tipe'>
                                <option value='qris'>QRIS</option>
                                <option value='e-walet'>E-Wallet</option>
                                <option value='virtual-account'>Virtual Account</option>
                                <option value='convenience-store'>Convenience Store</option>
                            </select>
                        </div>
                    </div>    
                    <div class='mb-3 row'>
                        <label class='col-lg-2 col-form-label' for='example-fileinput'>Thumbnail</label>
                        <div class='col-lg-10'>
                            <input type='file' class='form-control' value='" . $data->images . "' name='images'>
                        </div>
                    </div>             
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' class='btn btn-primary'>Simpan</button>
                    </div>
                </form>
        ";

        return $send;        
    }  
    
    public function patch(Request $request, $id)
    {
        if($request->file('images')){
            $file = $request->file('images');
            $folder = 'assets/thumbnail';
            $file->move($folder, $file->getClientOriginalName());      
            method::where('id', $id)->update([
                'images' => "/".$folder."/".$file->getClientOriginalName()
            ]);
        }
        
        $method = method::where('id', $id)->update([
            'name' => $request->name,
            'code' => $request->code,
            'keterangan' => $request->keterangan,
            'tipe' => $request->tipe,
        ]);
           
        return back()->with('success', 'Berhasil update payment');        
    }        
}
