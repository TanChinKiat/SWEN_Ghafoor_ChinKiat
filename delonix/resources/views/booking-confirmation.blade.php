@extends('base')

<?php
$base_url = url("/");
?>
@section('content')
<div class="container" style="padding-bottom:30px;">
	<h3>Booking Confirmation</h3>
</div>

<div class="container">



		<div class="col-md-4">
			<img src="{{$base_url}}/images/rooms/{{$data['room']->room_type}}.jpg" class="img-responsive">
			<div>
				<div><strong>Transaction ID: </strong>{{$data["reservation"]->transaction_id}}</div>
				<div><strong>Room Type: </strong>{{ucwords($data['room']->room_name)}}</div>
				<div><strong>Check-in: </strong>{{date("d/m/Y",strtotime($data["reservation"]->checkin))}}</div>
				<div><strong>Check-out: </strong>{{date("d/m/Y",strtotime($data["reservation"]->checkout))}}</div>
				<div>{{$data['reservation']->nights}} Night(s) x ${{number_format($data['room']->room_price,2,'.','')}} per night</div>
				<div><strong>Total Price: ${{$data['reservation']->amount}}</strong></div>

			</div>
		</div>
		<div class="col-md-8">
			<div class="" style="margin:15px">
					<div class="form-group">
				    <label for="">Full Name <span style="color:red;">*</span></label>
				    <div>{{$data["customer"]->cust_name}}</div>
				  </div>
				  <div class="form-group">
				    <label for="">Email address <span style="color:red;">*</span></label>
				    <div>{{$data["customer"]->cust_email}}</div>
				  </div>
					<div class="form-group">
				    <label for="">Contact Number <span style="color:red;">*</span></label>
				    <div>{{$data["customer"]->cust_no}}</div>
				  </div>
					<div class="form-group">
				    <label for="">Address <span style="color:red;">*</span></label>
				    <div>{{$data["customer"]->Cust_address}}</div>
				  </div>
					<div class="form-group">
				    <label for="">Credit Card Number <span style="color:red;">*</span></label>
				    <div>{{$data["customer"]->cust_creditcard}}</div>
				  </div>
					<div class="form-group col-xs-6" style="padding-left:0;">
				    <label for="">Credit Card Expiry (Month) <span style="color:red;">*</span></label>
				    <div>{{$data["customer"]->cust_creditcard_mm}}</div>
				  </div>
					<div class="form-group col-xs-6" style="padding-left:0;">
				    <label for="">Credit Card Expiry (Year) <span style="color:red;">*</span></label>
				    <div>{{$data["customer"]->cust_creditcard_yy}}</div>
				  </div>


			</div>
		</div>

</div>
<a class="btn btn-default" href="{{$base_url}}" style="display:block; margin:auto;">Return to Main</a>
<div style="height:150px"></div>

@stop
