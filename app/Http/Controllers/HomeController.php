<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.~
     *
     * @return void
     */
    public function __construct() 
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function kategori()

    {
        $kategori = Kategori::all();
        return view('kategori',['kategori' => $kategori]);
    }

    public function kategori_tambah()
    {
        return view('kategori_tambah');
    }

    public function kategori_aksi(Request $data)
    {
        $data->validate([
            'kategori' => 'required|string|unique:kategori,kategori'

        ]);
        $kategori = $data->kategori; Kategori::insert([
            'kategori' => $kategori
        ]);
        return redirect('kategori')->with("sukses","Kategori berhasil tersimpan");
    }

    public function kategori_edit($id)
    {
        $kategori = Kategori::find($id); 
        return view('kategori_edit',['kategori' => $kategori]);
    }

    public function kategori_update($id, Request $data)
    {
        $data->validate([
            'kategori' => 'required|string|unique:kategori,kategori,'.$id
        ]);
        $nama_kategori = $data->kategori;

        $kategori = Kategori::find($id);
        $kategori->kategori = $nama_kategori;
        $kategori->save();
 
        return redirect('kategori')->with("sukses","Kategori berhasil diubah");
    }

    public function kategori_hapus($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect('kategori')->with("sukses","Kategori berhasil dihapus");
    }

}