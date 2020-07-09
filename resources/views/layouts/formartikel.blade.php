@extends('layouts/master')

@section('content')
<form action="/artikel" method="POST">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="judul">Judul</label>
    <input type="text" name="judul" class="form-control" id="judul" aria-describedby="emailHelp" placeholder="Judul">

  </div>
  <div class="form-group">
    <label for="isi">ISI Artikel</label>
    <textarea name="isi" id="isi" class="form-control" cols="30" rows="10"></textarea>
  </div>
  <div class="form-group">
    <label for="tag">Tag</label>
    <input type="text" name="tag" class="form-control" id="tag" aria-describedby="emailHelp" placeholder="Tag1, Tag2, Tag3">
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection