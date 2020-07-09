<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', 'LoginController@home');
Route::post('/login', 'LoginController@login');

Route::get('/logout', 'LoginController@logout');

Route::get('/register', 'LoginController@register');
Route::post('/register', 'LoginController@registertambah');

Route::get('/', 'PertanyaanController@home');
Route::get('/pertanyaan/create', 'PertanyaanController@buat');
Route::post('/pertanyaan', 'PertanyaanController@buatpertanyaan');
Route::get('/pertanyaan/{idpertanyaan}', 'PertanyaanController@show');
Route::get('/pertanyaan/{idpertanyaan}/edit', 'PertanyaanController@edit');
Route::put('/pertanyaan/{idpertanyaan}', 'PertanyaanController@editsimpan');
Route::delete('/pertanyaan/{idpertanyaan}', 'PertanyaanController@delete');


Route::get('/jawaban/create/{idpertanyaan}', 'JawabanController@form');
Route::get('/jawaban/detail/{idjawaban}', 'JawabanController@jawabandetail');
Route::post('/jawaban/{idpertanyaan}', 'JawabanController@buatsimpan');


Route::get('/komentar/createpertanyaan/{idpertanyaan}', 'KomentarController@formpertanyaan');
Route::get('/komentar/createjawaban/{idjawaban}', 'KomentarController@formjawaban');
Route::post('/komentar/{idpertanyaan}/pertanyaan/', 'KomentarController@simpankomentarpertanyaan');
Route::post('/komentar/{idjawaban}/jawaban/', 'KomentarController@simpankomentarjawaban');


Route::get('/tandai/{idjawaban}/jawaban/{idpertanyaan}', 'VoteJawabanController@tandai');
Route::get('/down/{idjawaban}/jawaban/{idpertanyaan}', 'VoteJawabanController@down');
Route::get('/up/{idjawaban}/jawaban/{idpertanyaan}', 'VoteJawabanController@up');


Route::get('/up/{idpertanyaan}/pertanyaan', 'VotePertanyaanController@up');
Route::get('/down/{idpertanyaan}/pertanyaan', 'VotePertanyaanController@down');


// Route::get('/artikel', 'ArtikelController@artikel');
// Route::get('/artikel/create', 'ArtikelController@create');
// Route::post('/artikel', 'ArtikelController@simpan');
// Route::get('/artikel/{id}', 'ArtikelController@show');
// Route::get('/artikel/{id}/edit', 'ArtikelController@edit');
// Route::put('/artikel/{id}', 'ArtikelController@editsimpan');
// Route::delete('/artikel/{id}', 'ArtikelController@hapus');


// Route::get('/items/create', 'ItemController@create'); // menampilkan halaman form
// Route::post('/items', 'ItemController@store'); // menyimpan data
// Route::get('/items', 'ItemController@index'); // menampilkan semua
// Route::get('/items/{id}', 'ItemController@show'); // menampilkan detail item dengan id 
// Route::get('/items/{id}/edit', 'ItemController@edit'); // menampilkan form untuk edit item
// Route::put('/items/{id}', 'ItemController@update'); // menyimpan perubahan dari form edit
// Route::delete('/items/{id}', 'ItemController@destroy'); // menghapus data dengan id