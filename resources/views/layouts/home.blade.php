@extends('layouts/master')

@section('content')
<div class="card-body">
  <form method="GET" action="/pertanyaan/create">



    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Buat Pertanyaan">
    </div>
  </form>
  <div class="table-responsive">
  <h3>Poin Anda : {{$poinuser}}</h3>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Isi</th>
          <th>Tag</th>
          <th>Nama User</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 0; ?>
        @foreach($pertanyaan as $s)

        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$s->judul}}</td>
          <td>{{$s->isi}}</td>
          <td>{{$s->tag}}</td>
          <td>{{$user[$loop->iteration-1][0]->name}}</td>

          <td>
            <?php $i++; ?>


            <?php
            if ($iduser == $s->iduser) { ?>
              <form method="POST" action="/pertanyaan/{{$s->idpertanyaan}}/">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}


                <div class="form-group">
                  <input type="submit" class="btn btn-danger" value="Hapus">
                </div>
              </form>
              <form method="GET" action="/pertanyaan/{{$s->idpertanyaan}}/edit">



                <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Edit">
                </div>
              </form>
            <?php }
            ?>
            <form method="GET" action="/pertanyaan/{{$s->idpertanyaan}}/">



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
@endsection