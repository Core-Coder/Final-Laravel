@extends('layouts/master')

@section('content')
<div class="card-body">
  <form method="GET" action="/artikel/create">



    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Tambah">
    </div>
  </form>
  <div class="table-responsive">

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Isi</th>
          <th>Slug</th>
          <th>Tag</th>
          <th>id User</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($artikel as $s)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$s->judul}}</td>
          <td>{{$s->isi}}</td>
          <td>{{$s->slug}}</td>
          <td>{{$s->tag}}</td>
          <td>{{$s->iduser}}</td>

          <td>
            <form method="POST" action="/artikel/{{$s->id}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}

              <div class="form-group">
                <input type="submit" class="btn btn-danger delete-user" value="Delete">
              </div>
            </form>

            <form method="GET" action="/artikel/{{$s->id}}/edit/">



              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Edit">
              </div>
            </form>
            <form method="GET" action="/artikel/{{$s->id}}/">



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










@push('scripts')
<script>
  Swal.fire({
    title: 'Berhasil!',
    text: 'Memasangkan script sweet alert',
    icon: 'success',
    confirmButtonText: 'Cool'
  })
</script>
@endpush