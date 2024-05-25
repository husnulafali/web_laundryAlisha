<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promo;
use Illuminate\Support\Facades\Storage; 

class promoController extends Controller
{
    public function index(){
        $promo = Promo::orderBy('created_at', 'desc')->get();
        return view('admin.promo.index', compact('promo'));
    }
    public function add()
    {
        return view('admin.promo.add');
    }
    public function store(Request $request)
    {
        $rules = [
            'promo_name' => 'required',
            'image_promo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ];
        $messages = [
            'promo_name.required' => 'Judul Promo Harus Diisi.',
            'image_promo.required' => 'File Harus Diisi.',
            'image_promo.image' => 'File harus berupa gambar.',
            'image_promo.mimes' => 'File harus berformat jpeg, png, jpg, atau gif.',
            'image_promo.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ];
    
        $request->validate($rules, $messages);
    
        if ($request->hasFile('image_promo')) {
            $image = $request->file('image_promo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/promo_images', $imageName); 
        } else {
            $imageName = null;
        }
    
        $promo = new Promo();
        $promo->promo_name = $request->input('promo_name'); 
        $promo->image_promo = $imageName;
    
        $promo->save();
        return redirect()->route('promo.index')->with('success', 'Promo berhasil ditambahkan');
    }
    public function edit(Request $request, $id){
        $editData = Promo::findOrFail($id);
         return view('admin.promo.edit', compact('editData'));
    }
    public function update(Request $request, $id){
        $rules = [
            'promo_name' => 'required',
            'image_promo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ];
        $messages = [
            'promo_name.required' => 'Judul Promo Harus Diisi.',
            'image_promo.required' => 'File Harus Diisi.',
            'image_promo.image' => 'File harus berupa gambar.',
            'image_promo.mimes' => 'File harus berformat jpeg, png, jpg, atau gif.',
            'image_promo.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ];
    
        $request->validate($rules, $messages);
    
        if ($request->hasFile('image_promo')) {
            $image = $request->file('image_promo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/promo_images', $imageName); 
        } else {
            $imageName = null;
        }
    
        $promo = Promo::findOrFail($id);
        $promo->promo_name = $request->input('promo_name'); 
        $promo->image_promo = $imageName;
    
        $promo->save();
        return redirect()->route('promo.index')->with('success', 'Promo berhasil ditambahkan');
    }
    public function delete($id){
   
    $promo = Promo::findOrFail($id);
    if ($promo->image_promo) {
        Storage::delete('public/promo_images/' . $promo->image_promo);
    }
    $promo->delete();
    return redirect()->route('promo.index')->with('success', 'Promo berhasil dihapus');
}
}
