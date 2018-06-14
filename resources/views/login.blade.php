@extends('layouts/admin') {{-- Load the simple layout --}}
@section('css')
<link rel="stylesheet" href="resources/vendor/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="resources/css/login.css" />
@stop
@section('body')
<div class="fullscreen-bg">
	<video loop muted autoplay poster="resources/img/bg.jpg" class="fullscreen-bg_video">
		<source src="resources/img/bg.mp4" type="video/mp4" />
	</video>
</div>
<div class = "container">
	<div class="wrapper draggable">
		<form action="login.php?action=login" method="post" name="for-login" class="form-signin">       
		    <h3 class="form-signin-heading"><i class="fa fa-pagelines"></i> {{$app_name}}</h3>
			  <hr class="colorgraph"><br>
        	  <input type="text" class="form-control" name="username" placeholder="{{$user_label}}" required="" autofocus="" />
			  <input type="password" class="form-control" name="password" placeholder="{{$user_password}}" required=""/>     		  
			  <button class="btn btn-lg btn-warning btn-block" name="submit" value="{{$user_acceder}}" type="submit">Login</button>  			
		</form>			
	</div>
</div>
@stop
@section('scripts')
<script src="resources/js/login.js"></script>
<script src="resources/vendor/bootstrap/js/bootstrap.min.js"></script>
@stop