@extends('layouts/master')






@section('content')
<div class="card">
  <div class="card-body">


    @foreach($artikel as $s)

    <div class="row">
      <div class="col-9">
        <h3 style="font-weight:bold">Judul :{{$s->judul}}</h3>
        <br>
        <h3>Slug :{{$s->slug}}</h3>
        <br>
        <h3>Isi :{{$s->isi}}</h3>
        <br>

        <?php
        $tag = $s->tag;
        $tag1 = explode(",", strtolower($tag));

        for ($i = 0; $i < count($tag1); $i++) { ?>
          <button class="btn btn-success">{{$tag1[$i]}}</button>
        <?php  }

        ?>

        <br>

      </div>
      <div class="col-3">
      </div>
    </div>



    @endforeach

  </div>
</div>

@endsection