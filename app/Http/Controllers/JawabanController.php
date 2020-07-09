<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pertanyaan;
use App\jawaban;
use App\login;
use App\komentar;
use App\vote;
use DB;

class JawabanController extends Controller
{
    public function form($idpertanyaan)
    {
        $name = session()->get('name');
        $iduser = session()->get('iduser');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            $pertanyaanget = pertanyaan::where('idpertanyaan', $idpertanyaan)->get();
            if ($pertanyaanget[0]->iduser == $iduser) {

                return redirect('/pertanyaan/' . $idpertanyaan);
            } else {


                return view('layouts.formbuatjawaban', ['pertanyaan' => $pertanyaanget]);
            }
        }
    }
    public function buatsimpan(Request $request)
    {
        $name = session()->get('name');
        $iduser = session()->get('iduser');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            $judul = $request->input('judul');
            $isi = $request->input('isi');
            $idpertanyaan = $request->route('idpertanyaan');


            $baru = date('Y-m-d H:i:s');

            $data = array('judul' => $judul, "isi" => $isi, "idpertanyaan" => $idpertanyaan, 'iduser' => $iduser, 'created_at' => $baru, 'updated_at' => $baru);
            DB::table('jawaban')->insert($data);
            return redirect('/pertanyaan/' . $idpertanyaan);
        }
    }
    public function jawabandetail($idjawaban)
    {
        $name = session()->get('name');
        $iduser = session()->get('iduser');
        $jawaban  = jawaban::where('idjawaban', $idjawaban)->get();
        $komentar  = komentar::where('idtujuan', 'jawaban,' . $idjawaban)->get();
        $vote = vote::where('idtujuan', 'jawaban,' . $idjawaban)->get();
        $jumlah = 0;
        for ($i = 0; $i < count($vote); $i++) {
            $jumlah += $vote[$i]->poin;
        }
        $user = [];
        for ($i = 0; $i < count($komentar); $i++) {
            $user[] = login::where('iduser', $komentar[$i]['iduser'])->get();;
        }


        return view('layouts.detailjawaban', ['jawaban' => $jawaban, 'user' => $user, 'iduser' => $iduser, 'komentar' => $komentar, 'jumlah' => $jumlah]);
    }
}
