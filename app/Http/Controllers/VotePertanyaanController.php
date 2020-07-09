<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pertanyaan;
use App\jawaban;
use App\login;
use App\komentar;
use App\vote;
use DB;

class VotePertanyaanController extends Controller
{
    public function up($idpertanyaan)
    {
        $iduser = session()->get('iduser');
        $name = session()->get('name');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            $votetandai = vote::where([['idtujuan', 'pertanyaan,' . $idpertanyaan], ['poin', 10]])->get();
            if ($votetandai->count() > 0) {
                session()->put('uppertanyaan', 'tidak bisa upvote lagi');
                return redirect('/pertanyaan/' . $idpertanyaan);
            } else {

                $data = array('poin' => 10, "idtujuan" => 'pertanyaan,' . $idpertanyaan, 'iduser' => $iduser);
                DB::table('vote')->insert($data);
                session()->put('uppertanyaan', 'berhasil upvote');
                return redirect('/pertanyaan/' . $idpertanyaan);
            }
        }
    }
    public function down($idpertanyaan)
    {
        $iduser = session()->get('iduser');
        $name = session()->get('name');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            $votetandai = vote::where([['idtujuan', 'pertanyaan,' . $idpertanyaan], ['poin', -1]])->get();
            if ($votetandai->count() > 0) {
                session()->put('downpertanyaan', 'tidak bisa downvote lagi');
                return redirect('/pertanyaan/' . $idpertanyaan);
            } else {
                $votetandai = vote::where([['idtujuan', 'pertanyaan,' . $idpertanyaan]])->get();
                $jumlah = 0;
                for ($i = 0; $i < count($votetandai); $i++) {
                    $jumlah += $votetandai[$i]->poin;
                }
                if ($jumlah < 16) {
                    session()->put('downpertanyaan', 'maaf tidak bisa downvote karena poin kurang dari 15');
                    return redirect('/pertanyaan/' . $idpertanyaan);
                } else {
                    $data = array('poin' => -1, "idtujuan" => 'pertanyaan,' . $idpertanyaan, 'iduser' => $iduser);
                    DB::table('vote')->insert($data);
                    session()->put('downpertanyaan', 'berhasil downvote');
                    return redirect('/pertanyaan/' . $idpertanyaan);
                }
            }
        }
    }
}
