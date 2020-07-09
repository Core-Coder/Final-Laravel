@extends('layouts/master')






@section('content')
<div class="card">
  <div class="card-body">


    @foreach($jawaban as $s)

    <div class="row">
      <div class="col-9">
        <h3 style="font-weight:bold">Judul :{{$s->judul}}</h3>

        <br>
        <h3>Isi : {!! $s->isi !!}</h3>
        <br>
        <h3>poin : {{$jumlah}}</h3>


        <br>

      </div>

    </div>
    <br><br>
    <div class="row">

      <?php
      if ($iduser != $s->iduser) { ?>

        <form method="GET" action="/komentar/createpertanyaan/{{$s->idpertanyaan}}/">
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Komen">
          </div>
        </form>
      <?php }
      ?>


    </div>


    @endforeach

  </div>
</div>

<div class="card-body">
  <h1>Daftar komentar</h1>
  <div class="table-responsive">

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>No</th>

          <th>Isi</th>
          <th>Nama User</th>


        </tr>
      </thead>
      <tbody>
        @foreach($komentar as $s)
        <tr>
          <td>{{$loop->iteration}}</td>

          <td>{{$s->isi}}</td>
          <td>{{$user[$loop->iteration-1][0]->name}}</td>



        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection