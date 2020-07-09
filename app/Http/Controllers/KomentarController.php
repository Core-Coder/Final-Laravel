<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pertanyaan;
use App\jawaban;
use App\login;
use DB;

class KomentarController extends Controller
{
    public function formpertanyaan($idpertanyaan)
    {
        $name = session()->get('name');
        $iduser = session()->get('iduser');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            $pertanyaanget = pertanyaan::where('idpertanyaan', $idpertanyaan)->get();



            return view('layouts.formbuatkomentarpertanyaan', ['pertanyaan' => $pertanyaanget, 'iduser' => $iduser]);
        }
    }

    public function simpankomentarpertanyaan(Request $request)
    {
        $name = session()->get('name');
        $iduser = session()->get('iduser');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {

            $isi = $request->input('isi');

            $idpertanyaan = "pertanyaan," . $request->route('idpertanyaan');
            $data = array("isi" => $isi, "idtujuan" => $idpertanyaan, 'iduser' => $iduser);
            DB::table('komentar')->insert($data);
            $idpertanyaan = explode(",", $idpertanyaan);
            return redirect('/pertanyaan/' . $idpertanyaan[1]);
        }
    }
}
