@extends('layouts/master')

@section('content')
<?php if (session()->get('tanda') != "") {
  $tanda = session()->get('tanda');
  echo "<script>alert('$tanda')</script>";
  session()->forget('tanda');
} ?>
<?php if (session()->get('up') != "") {
  $tanda = session()->get('up');
  echo "<script>alert('$tanda')</script>";
  session()->forget('up');
} ?>
<?php if (session()->get('down') != "") {
  $tanda = session()->get('down');
  echo "<script>alert('$tanda')</script>";
  session()->forget('down');
} ?>
<?php if (session()->get('downpertanyaan') != "") {
  $tanda = session()->get('downpertanyaan');
  echo "<script>alert('$tanda')</script>";
  session()->forget('downpertanyaan');
} ?>
<?php if (session()->get('uppertanyaan') != "") {
  $tanda = session()->get('uppertanyaan');
  echo "<script>alert('$tanda')</script>";
  session()->forget('uppertanyaan');
} ?>
<div class="card">
  <div class="card-body">


    @foreach($pertanyaan as $s)

    <div class="row">
      <div class="col-9">
        <h3 style="font-weight:bold">Judul : {{$s->judul}}</h3>

        <br>
        <h3>Isi : {!! $s->isi !!}</h3>
        <br>

        <h3>Poin : {{$jumlah}}</h3>
        <?php
        $tag = $s->tag;
        $tag1 = explode(",", strtolower($tag));

        for ($i = 0; $i < count($tag1); $i++) { ?>
          <button class="btn btn-success">{{$tag1[$i]}}</button>
        <?php  }

        ?>

        <br>

      </div>

    </div>
    <br><br>
    <div class="row">

      <?php
      if ($iduser !== $s->iduser) { ?>
        <form style="margin-left:10px" method="GET" action="/jawaban/create/{{$s->idpertanyaan}}/">
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Jawab">
          </div>
        </form>
        
        <form style="margin-left:10px" method="GET" action="/komentar/createpertanyaan/{{$s->idpertanyaan}}/">
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Komen">
          </div>
        </form>

        <form style="margin-left:10px" method="GET" action="/up/{{$s->idpertanyaan}}/pertanyaan">
          <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fas fa-angle-up"></i></button>
          </div>
        </form>

        <form style="margin-left:10px" method="GET" action="/down/{{$s->idpertanyaan}}/pertanyaan">
          <div class="form-group">
            <button type="submit" class="btn btn-danger"><i class="fas fa-angle-down"></i></button>
          </div>
        </form>

      <?php }

      ?>


    </div>


    @endforeach

  </div>
</div>

<div class="card-body">
  <h1>Daftar Jawaban</h1>
  <div class="table-responsive">

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Isi</th>
          <th>Nama User</th>
          <th>Tanggal di buat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($jawaban as $s)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$s->judul}}</td>
          <td>{!! $s->isi !!}</td>
          <td>{{$user[$loop->iteration-1][0]->name}}</td>
          <td>{{$s->created_at->format('H:i:s Y-m-d')}}</td>


          <td>

            <?php
            if ($iduser !== $s->iduser) { ?>

              <form method="GET" action="/up/{{$s->idjawaban}}/jawaban/{{$pertanyaan[0]->idpertanyaan}}">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-angle-up"></i></button>
                </div>
              </form>

              <form method="GET" action="/down/{{$s->idjawaban}}/jawaban/{{$pertanyaan[0]->idpertanyaan}}">
                <div class="form-group">
                  <button type="submit" class="btn btn-danger"><i class="fas fa-angle-down"></i></button>
                </div>
              </form>

              <form method="GET" action="/tandai/{{$s->idjawaban}}/jawaban/{{$pertanyaan[0]->idpertanyaan}}">
                <div class="form-group">
                  <input type="submit" class="btn btn-success" value="Pin Jawaban">
                </div>
              </form>
              
              <?php }
            ?>
            <form method="GET" action="/jawaban/detail/{{$s->idjawaban}}/">
              
              

              <div class="form-group">
                <input type="submit" class="btn btn-success" value="Detail">
              </div>
            </form>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


<br>


<div class="card-body">
  <h1>Daftar Komentar</h1>
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

          <td>{!! $s->isi !!}</td>
          <td>{{$userkomentar[$loop->iteration-1][0]->name}}</td>



        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


@endsection