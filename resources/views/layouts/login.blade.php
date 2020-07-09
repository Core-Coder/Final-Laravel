<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href={{asset("sbadmin2/vendor/fontawesome-free/css/all.min.css")}} rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href={{asset("sbadmin2/css/sb-admin-2.min.css")}} rel="stylesheet">

</head>
<body id="page-top">

<div class="container" style="margin-top:20px">
<form action="/login" method="POST">
{{ csrf_field() }}
  <div class="form-group row">
    <label for="username" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username">
    </div>
  </div>
  <div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
  </div>
      </div>
    </div>
  </fieldset>
  <div class="form-group row">
    <div class="col-sm-12" style="text-align:center">
    <?php if(isset($data)){
        echo "<script>alert('$data')</script>";
    }?>
      <button style="margin:auto"  type="submit" name="submit" class="btn btn-primary">Sign in</button>
    </div>
  </div>
</form>

</div>
<script src={{asset("sbadmin2/vendor/jquery/jquery.min.js")}}></script>
  <script src={{asset("sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js")}}></script>

  <!-- Core plugin JavaScript-->
  <script src={{asset("sbadmin2/vendor/jquery-easing/jquery.easing.min.js")}}></script>

  <!-- Custom scripts for all pages-->
  <script src={{asset("sbadmin2/js/sb-admin-2.min.js")}}></script>

  <!-- script tambahan sweet alert, bukan dari bawaan sb-admin-2 -->
 
  <script src={{asset("sbadmin2/js/swal.min.js")}}></script>
 

</body>

</html>