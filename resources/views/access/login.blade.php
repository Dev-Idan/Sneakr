<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS-->
	<link rel="stylesheet" href="{{ asset('lib/indecor/css/bootstrap.min.css') }}">

  <style media="screen">

    body{
      background-color: #ddd;
    }

    .mini {
      background-color: #fff;
      box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
      border-radius: 0.7rem !important;
    }

  </style>

  <script>

		const BASE_URL = "{{ url('') }}/";
		const ASSET_URL = "{{ asset('') }}";

	</script>

  <title>Sneakr {{ !empty($page_title) ? $page_title : '' }}</title>
</head>
<body>


  <div class="container-fluid">
    <div class="row mt-5 pt-5">
    </div>
    <div class="row mt-4">
      <div class="col-md-3 mx-auto my-5 px-5">
        <div class="mini pb-5 px-5 pt-4">

            <img width="150" class="mx-auto d-block pb-4" src="{{ asset('imgs/logo.png') }}" alt="site logo">

          <form action="" method="POST" autocomplete="off" novalidate>
            @csrf()
            <div class="form-group">
              <input type="text" name="user" id="user" placeholder="Username" class="form-control mb-2">
            </div>
            <div class="form-group">
              <input type="password" name="password" id="password" placeholder="Password" class="form-control mb-2">
            </div>

            <input type="submit" name="submit" value="Login" class="btn btn-primary btn-lg btn-block font-weight-bold mt-4">

          </form>
        </div>
      </div>
    </div>
  </div>




  <!--Jquery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!--Popper-->
  <script src="{{ asset('lib/indecor/js/popper.min.js') }}"></script>
  <!--Bootstrap-->
  <script src="{{ asset('lib/indecor/js/bootstrap.min.js') }}"></script>

</body>
</html>
