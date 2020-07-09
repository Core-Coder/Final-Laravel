@extends('layouts/master')

@section('content')

<form action="/register" method="POST">
{{ csrf_field() }}
{{ method_field('POST') }}
  <div class="form-group">
    <label for="username">username</label>
    <input type="text" name="username"  class="form-control" id="userna,e" aria-describedby="emailHelp" >
    
  </div>
 
  <div class="form-group">
    <label for="password">password</label>
    <input type="password" name="password"  class="form-control" id="password" aria-describedby="emailHelp" >
  </div>
  
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection



@push('scripts')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'textarea.isi',
        width: 900,
        height: 300
    });
</script>
@endpush
