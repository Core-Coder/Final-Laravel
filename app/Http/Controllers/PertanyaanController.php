<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pertanyaan;
use App\jawaban;
use App\login;
use App\komentar;
use App\vote;

use DB;

class PertanyaanController extends Controller
{
    public function home()
    {

        $name = session()->get('name');
        $iduser = session()->get('iduser');
        // return $iduser;
        // die();

        $pertanyaan = pertanyaan::all();
        $user = [];

        for ($i = 0; $i < count($pertanyaan); $i++) {
            $user[] = login::where('iduser', $pertanyaan[$i]['iduser'])->get();
        }


        return view('layouts.home', ['pertanyaan' => $pertanyaan, 'user' => $user, 'iduser' => $iduser]);
    }
    public function show($idpertanyaan)
    {
        $name = session()->get('name');
        $iduser = session()->get('iduser');


        $pertanyaan = pertanyaan::where('idpertanyaan', $idpertanyaan)->get();

        $jawaban = jawaban::where('idpertanyaan', $idpertanyaan)->get();
        $komentar = komentar::where('idtujuan', 'pertanyaan,' . $idpertanyaan)->get();
        $vote = vote::where('idtujuan', 'pertanyaan,' . $idpertanyaan)->get();
        $jumlah = 0;
        for ($i = 0; $i < count($vote); $i++) {
            $jumlah += $vote[$i]->poin;
        }

        $user = [];
        $userkomentar = [];
        for ($i = 0; $i < count($jawaban); $i++) {
            $user[] = login::where('iduser', $jawaban[$i]['iduser'])->get();
        }
        for ($i = 0; $i < count($komentar); $i++) {
            $userkomentar[] = login::where('iduser', $komentar[$i]['iduser'])->get();
        }

        return view('layouts.pertanyaandetail', ['pertanyaan' => $pertanyaan, 'user' => $user, 'jawaban' => $jawaban, 'iduser' => $iduser, 'userkomentar' => $userkomentar, 'komentar' => $komentar, 'jumlah' => $jumlah]);
    }
    public function buat()
    {
        $name = session()->get('name');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            return view('layouts.formbuatpertanyaan');
        }
    }
    public function buatpertanyaan(Request $request)
    {
        $name = session()->get('name');
        $iduser = session()->get('iduser');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            $judul = $request->input('judul');
            $isi = $request->input('isi');
            $tag = $request->input('tag');
            $baru = date('Y-m-d H:i:s');

            $data = array('judul' => $judul, "isi" => $isi, "tag" => $tag, 'iduser' => $iduser, 'created_at' => $baru, 'updated_at' => $baru);
            DB::table('pertanyaan')->insert($data);
            return redirect('/');
        }
    }
    public function edit($idpertanyaan)
    {

        $name = session()->get('name');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            $pertanyaan = pertanyaan::where('idpertanyaan', $idpertanyaan)->get();

            return view('layouts.formeditpertanyaan', ['pertanyaan' => $pertanyaan[0]]);
        }
    }
    public function editsimpan(Request $request)
    {
        $name = session()->get('name');
        $iduser = session()->get('iduser');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            $judul = $request->input('judul');
            $isi = $request->input('isi');
            $tag = $request->input('tag');
            $baru = date('Y-m-d H:i:s');
            $idpertanyaan = $request->route('idpertanyaan');
            DB::table('pertanyaan')->where('idpertanyaan', $idpertanyaan)->update([
                'judul' => $judul,
                'isi' => $isi,
                'tag' => $tag,
                'updated_at' => $baru
            ]);
            $pertanyaan = pertanyaan::all();
            $user = [];

            for ($i = 0; $i < count($pertanyaan); $i++) {
                $user[] = login::where('iduser', $pertanyaan[$i]['iduser'])->get();
            }


            return view('layouts.home', ['pertanyaan' => $pertanyaan, 'user' => $user, 'iduser' => $iduser]);
        }
    }
    public function delete($idpertanyaan)
    {
        $name = session()->get('name');
        $iduser = session()->get('iduser');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            DB::table('pertanyaan')->where('idpertanyaan', $idpertanyaan)->delete();
            $pertanyaan = pertanyaan::all();
            $user = [];

            for ($i = 0; $i < count($pertanyaan); $i++) {
                $user[] = login::where('iduser', $pertanyaan[$i]['iduser'])->get();
            }


            return view('layouts.home', ['pertanyaan' => $pertanyaan, 'user' => $user, 'iduser' => $iduser]);
        }
    }
}
