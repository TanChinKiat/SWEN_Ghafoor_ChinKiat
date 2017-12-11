
<?php
session_start();
$base_url = url("/");
?>


<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Hotel Delonix</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Pinyon+Script' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Quicksand:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link href="{{$base_url}}/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">

@section('head')
  @show
</head>
<body>
<!--header starts-->
<div class="header">
	 <div class="top-header">
		 <div class="container">
			 <div class="logo">
				 	<a href="{{$base_url}}" style="color:#fff;"><img src="{{$base_url}}/images/logo-01.png" style="max-height:56px; width:auto; margin-top:-14px;" class="img-responsive"></a>
			 </div>
			 <span class="menu"> </span>
			 <div class="m-clear"></div>
			 <div class="top-menu">
				<ul>
					 <li id="s_home" class=""><a href="{{$base_url}}/staff">HOME</a></li>
					 <li id="s_mb"><a class="scroll" href="{{$base_url}}/staff/manage-booking">MANAGE BOOKINGS</a></li>
           <li id="s_mr"><a class="scroll" href="{{$base_url}}/staff/manage-room">MANAGE ROOMS</a></li>
           <li id="s_ms"><a class="scroll" href="{{$base_url}}/staff/manage-staff">MANAGE STAFF</a></li>
           <li><a class="scroll" href="{{$base_url}}/staff/sign-out">SIGN OUT</a></li>
				</ul>

			 </div>
			 <div class="clearfix"></div>
		  </div>
	  </div>
		@if(Session::has('warning'))
          <div class="alert alert-warning alert-dismissible show" role="alert" style="margin:8px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4><i class="icon fa fa-warning"></i> Notice!</h4>
            {{Session::get('warning')}}
          </div>
        @endif
        @if(Session::has('danger'))
          <div class="alert alert-danger alert-dismissible show" role="alert" style="margin:8px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            {{Session::get('danger')}}
          </div>
        @endif
        @if(Session::has('success'))
          <div class="alert alert-success alert-dismissible show" role="alert" style="margin:8px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{Session::get('success')}}
          </div>
        @endif
		<div style="height:80px"></div>

</div>
<!---strat-date-piker---->
<link rel="stylesheet" href="{{$base_url}}/css/jquery-ui.css" />

<!---/End-date-piker---->
<link type="text/css" rel="stylesheet" href="{{$base_url}}/css/JFFormStyle-1.css" />



@section('content')


@show
<!---->

<!---->
<div class="fotter-info">
	  <div class="container">
	      <div class="col-md-5 details">
			 <div class="hotel-info">
				 <h4>ABOUT THIS HOTEL</h4>
				 <p>Suspendisse erat mi, tincidunt sit amet massa quis, commodo fermentum diam. Sed nec dui nec nunc tempor interdum.</p>
				 <p>Ut vulputate augue urna, ut porta dolor imperdiet a. Vestibulum nec leo eu magna aliquam ornare.</p>
			 </div>
			 <div class="news">
				 <h4>LATEST NEWS</h4>
				 <h5>Grand Hotel Joins DeluxelHotels</h5>
				 <a href="#">15 AUG</a>
				 <h5>Happy Chirstmas To Everyone</h5>
				 <a href="#">15 AUG</a>
				 <h5>Best Places To Visit 2014</h5>
				 <a href="#">15 AUG</a>
				 <h5>Various Offers</h5>
				 <a href="#">15 AUG</a>
			 </div>
				<div class="clearfix"></div>
		 </div>
		 <div class="col-md-7 details">
			 <div class="join">
				 <h4>JOIN DELUXEHOTELS</h4>
				 <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus vestibulum blandit egestas.
				 Nam id lectus vel orci luctus consectetur eget id elit. In tortor odio, pellentesque eu arcu sit amet, lacinia euismod nisi. Aliquam sodales tristique mauris ac fermentum.
				 Donec vel varius ipsum. Pellentesque vitae mollis massa. </p>
				 <p>There is no costs or whatsoever so sign up today!</p>
				 <a href="#">READ MORE</a>
			 </div>
			 
			 <div class="clearfix"></div>
		 </div>
		 <div class="clearfix"></div>
	  </div>
	 <h6>Template by <a href="http://w3layouts.com/">W3layouts</h6>
</div>
<!---->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="{{$base_url}}/js/jquery-ui.js"></script>
		  <script>
				  $(function() {
				    $( "#datepicker,#datepicker1" ).datepicker({ dateFormat: 'dd/mm/yy' });
				  });
		  </script>

<!-- Set here the key for your domain in order to hide the watermark on the web server -->

<script>
	$("span.menu").click(function(){
		$(".top-menu ul").slideToggle(200);
	});
</script>

@section('end_script')
  @show

</body>
</html>
