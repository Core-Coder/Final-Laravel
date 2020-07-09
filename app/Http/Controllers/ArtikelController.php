<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\artikels;
use DB;

class ArtikelController extends Controller
{
    public function artikel()
    {
        $artikel = artikels::all();

        // mengirim data pegawai ke view pegawai

        return view('layouts.artikel', ['artikel' => $artikel]);
    }
    public function show($id)
    {

        $artikel = artikels::where('id', $id)->get();

        // mengirim data pegawai ke view pegawai
        return view('layouts.artikeldetail', ['artikel' => $artikel]);
    }
    public function create()
    {
        return view('layouts.formartikel');
    }
    public function edit($id)
    {
        $artikel = artikels::where('id', $id)->get();
        return view('layouts.formartikeledit', ['artikel' => $artikel]);
    }
    public function editsimpan(Request $request)
    {
        $judul = $request->input('judul');
        session()->put('id', 1);
        $id = session()->get('id');
        $isi = $request->input('isi');

        $tag = $request->input('tag');
        $slug = explode(" ", strtolower($judul));
        $slug1 = "";

        for ($i = 0; $i < count($slug); $i++) {

            $slug1 .= $slug[$i] . "-";
        }
        $slug1 = substr($slug1, 0, -1);
        $idartikel = $request->route('id');

        DB::table('artikels')->where('id', $idartikel)->update([
            'judul' => $judul,
            'isi' => $isi,
            'slug' => $slug1,
            'tag' => $tag

        ]);
        $artikel = artikels::all();

        // mengirim data pegawai ke view pegawai
        return view('layouts.artikel', ['artikel' => $artikel]);
    }
    public function hapus($id)
    {
        DB::table('artikels')->where('id', $id)->delete();
        $artikel = artikels::all();
        return view('layouts.artikel', ['artikel' => $artikel]);
    }
    public function simpan(Request $request)
    {
        $judul = $request->input('judul');
        session()->put('id', 1);
        $id = session()->get('id');

        $isi = $request->input('isi');
        $tag = $request->input('tag');
        $slug = explode(" ", strtolower($judul));
        $slug1 = "";

        for ($i = 0; $i < count($slug); $i++) {

            $slug1 .= $slug[$i] . "-";
        }
        $slug1 = substr($slug1, 0, -1);

        $data = array('judul' => $judul, "isi" => $isi, "slug" => $slug1, "tag" => $tag, 'iduser' => $id);
        DB::table('artikels')->insert($data);
        return redirect('/artikel');
    }
    public function gambar()
    {
        $path = public_path() . '/images/erdartikel.png';
        $headers = array(
            'Content-Type:image/jpg',
        );


        return response()->file($path, $headers);
    }
}
