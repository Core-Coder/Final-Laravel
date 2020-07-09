<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pertanyaan;
use App\jawaban;
use App\login;
use App\komentar;
use App\vote;
use DB;

class VoteJawabanController extends Controller
{
    public function tandai($idjawaban, $idpertanyaan)
    {
        $name = session()->get('name');
        $iduser = session()->get('iduser');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            $votetandai = vote::where([['idtujuan', 'jawaban,' . $idjawaban], ['poin', 15]])->get();
            if ($votetandai->count() > 0) {
                session()->put('tanda', 'mengahapus tanda');
                DB::table('vote')->where([['idtujuan', 'jawaban,' . $idjawaban], ['poin', 15]])->delete();
                return redirect('/pertanyaan/' . $idpertanyaan);
            } else {

                $data = array('poin' => 15, "idtujuan" => 'jawaban,' . $idjawaban, 'iduser' => $iduser);
                DB::table('vote')->insert($data);
                session()->put('tanda', 'menandai');
                return redirect('/pertanyaan/' . $idpertanyaan);
            }
        }
    }
    public function down($idjawaban, $idpertanyaan)
    {
        $iduser = session()->get('iduser');
        $name = session()->get('name');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            $votetandai = vote::where([['idtujuan', 'jawaban,' . $idjawaban], ['poin', -1]])->get();
            if ($votetandai->count() > 0) {
                session()->put('down', 'tidak bisa downvote lagi');
                return redirect('/pertanyaan/' . $idpertanyaan);
            } else {
                $votetandai = vote::where([['idtujuan', 'jawaban,' . $idjawaban]])->get();
                $jumlah = 0;
                for ($i = 0; $i < count($votetandai); $i++) {
                    $jumlah += $votetandai[$i]->poin;
                }
                if ($jumlah < 16) {
                    session()->put('down', 'maaf tidak bisa downvote karena poin kurang dari 15');
                    return redirect('/pertanyaan/' . $idpertanyaan);
                } else {
                    $data = array('poin' => -1, "idtujuan" => 'jawaban,' . $idjawaban, 'iduser' => $iduser);
                    DB::table('vote')->insert($data);
                    session()->put('down', 'berhasil downvote');
                    return redirect('/pertanyaan/' . $idpertanyaan);
                }
            }
        }
    }
    public function up($idjawaban, $idpertanyaan)
    {
        $iduser = session()->get('iduser');
        $name = session()->get('name');
        if ($name == "") {
            return view('layouts.login', ['data' => 'belum login']);
        } else {
            $votetandai = vote::where([['idtujuan', 'jawaban,' . $idjawaban], ['poin', 10]])->get();
            if ($votetandai->count() > 0) {
                session()->put('up', 'tidak bisa mengup lagi');
                return redirect('/pertanyaan/' . $idpertanyaan);
            } else {

                $data = array('poin' => 10, "idtujuan" => 'jawaban,' . $idjawaban, 'iduser' => $iduser);
                DB::table('vote')->insert($data);
                session()->put('up', 'berhasil mengup');
                return redirect('/pertanyaan/' . $idpertanyaan);
            }
        }
    }
}
