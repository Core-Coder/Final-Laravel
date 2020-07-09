<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\login;
use App\pertanyaan;
use App\vote;
use DB;
class LoginController extends Controller
{
    public function login(Request $request){
        
        $name = $request->input('username');
        $password = $request->input('password');
        $user = DB::table('user')->where([['name', $name],['pasword',$password]])->get();
        if($user->count()>0){

            session()->put('name',$name);
            session()->put('iduser',$user[0]->iduser);
            $name = session()->get('name');
            $iduser = session()->get('iduser');
            // return $iduser;
            // die();
            $pointuser=0;
            if($iduser!=""){
                $idpertanyaanpengguna = pertanyaan::where('iduser', $iduser)->get();
            $idjawabanpengguna = pertanyaan::where('iduser', $iduser)->get();
            $pointuser=0;
            
            for($i=0;$i<count($idpertanyaanpengguna);$i++){
                $nilaivote = vote::where('idtujuan','pertanyaan,'.$idpertanyaanpengguna[$i]->idpertanyaan)->get();
                
                for($j=0;$j<count($nilaivote);$j++){
                    $pointuser += $nilaivote[$j]->poin;
                }
            }
            for($i=0;$i<count($idjawabanpengguna);$i++){
                $nilaivote1 = vote::where('idtujuan','jawaban,'.$idjawabanpengguna[$i]->idjawaban)->get();
                
                for($j=0;$j<count($nilaivote1);$j++){
                    $pointuser += $nilaivote1[$j]->poin;
                }
            }}
                $pertanyaan = pertanyaan::all();
                $user=[];
                
                for($i=0;$i<count($pertanyaan);$i++){
                    $user[] = login::where('iduser', $pertanyaan[$i]['iduser'])->get();
                    
                }
               
                
                return view('layouts.home', ['pertanyaan'=>$pertanyaan, 'user'=>$user, 'iduser'=>$iduser,'poinuser'=>$pointuser]);
     
            die();
            
        }
            
        return view('layouts.login',['data'=>'gagal login']);
            
        
        
        
    }
    public function home(){
        $name = session()->get('name');
        if($name!=""){
            $name = session()->get('name');
            $iduser = session()->get('iduser');
            // return $iduser;
            // die();
            $pointuser=0;
            if($iduser!=""){
                $idpertanyaanpengguna = pertanyaan::where('iduser', $iduser)->get();
            $idjawabanpengguna = pertanyaan::where('iduser', $iduser)->get();
            $pointuser=0;
            
            for($i=0;$i<count($idpertanyaanpengguna);$i++){
                $nilaivote = vote::where('idtujuan','pertanyaan,'.$idpertanyaanpengguna[$i]->idpertanyaan)->get();
                
                for($j=0;$j<count($nilaivote);$j++){
                    $pointuser += $nilaivote[$j]->poin;
                }
            }
            for($i=0;$i<count($idjawabanpengguna);$i++){
                $nilaivote1 = vote::where('idtujuan','jawaban,'.$idjawabanpengguna[$i]->idjawaban)->get();
                
                for($j=0;$j<count($nilaivote1);$j++){
                    $pointuser += $nilaivote1[$j]->poin;
                }
            }
            

            }
        
                $pertanyaan = pertanyaan::all();
                $user=[];
                
                for($i=0;$i<count($pertanyaan);$i++){
                    $user[] = login::where('iduser', $pertanyaan[$i]['iduser'])->get();
                    
                }
               
                
                return view('layouts.home', ['pertanyaan'=>$pertanyaan, 'user'=>$user, 'iduser'=>$iduser,'poinuser'=>$pointuser]);
           
        }else{
        return view('layouts.login');
        }
    }
    public function logout(){
        $name = session()->get('name');
        if($name!=""){
            session()->flush();
            return redirect('/');
        }
    }
    public function register(){
        return view('layouts.register');
    }
    public function registertambah(Request $request){
        $name = $request->input('username');
        $password = $request->input('password');
        
        $data=array('name'=>$name,"pasword"=>$password);
        DB::table('user')->insert($data);
        session()->put('name', $name);
        $login = login::where('name', $name)->get();
        if($login->count()>0){
            session()->put('iduser', $login[0]->iduser);
        }
        return redirect('/');
    }
}