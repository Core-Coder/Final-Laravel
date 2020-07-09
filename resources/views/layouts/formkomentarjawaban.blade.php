@extends('layouts/master')

@section('content')
<h1>Form Komentar Pertanyaan</h1>
<form action="/komentar/{{$jawaban[0]->idjawaban}}/jawaban" method="POST">
{{ csrf_field() }}
 
  <div class="form-group">
    <label for="isi">ISI </label>
    <textarea name="isi" id="isi" class="isi form-control" cols="30" rows="10"></textarea>
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