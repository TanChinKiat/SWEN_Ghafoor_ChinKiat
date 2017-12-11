@extends('base')

<?php
$base_url = url("/");
?>
@section('content')
<div class="container" style="padding-bottom:30px;">
	<h3>Congratulations! The <strong>{{ucwords($data['room']->room_name)}}</strong> room you selected is available from <strong>{{$data['form']['checkin']}}</strong> to <strong>{{$data['form']['checkout']}}</strong>!</h3>
</div>

<div class="container">



		<div class="col-md-4">
			<img src="{{$base_url}}/images/rooms/{{$data['room']->room_type}}.jpg" class="img-responsive">
			<div>
				<div><strong>{{ucwords($data['room']->room_name)}}</strong></div>
				<div>{{$data['reservation_details']['nights']}} Night(s) x ${{number_format($data['room']->room_price,2,'.','')}} per night</div>
				<div><strong>Total Price: ${{$data['reservation_details']['total_price']}}</strong></div>

			</div>
		</div>
		<div class="col-md-8">
			<h4>Please complete the following form to reserve the room:</h4>
			<div class="" style="margin:15px">
				<form action="{{$base_url}}/book" method="POST">
					<div class="form-group">
				    <label for="">Full Name <span style="color:red;">*</span></label>
				    <input type="text" name="cust_name" class="form-control" placeholder="Full Name" required="true">
				  </div>
				  <div class="form-group">
				    <label for="">Email address <span style="color:red;">*</span></label>
				    <input type="email" name="cust_email" class="form-control" placeholder="Email" required="true">
				  </div>
					<div class="form-group">
				    <label for="">Contact Number <span style="color:red;">*</span></label>
				    <input type="text" name="cust_no" class="form-control" placeholder="Contact Number" required="true">
				  </div>
					<div class="form-group">
				    <label for="">Address <span style="color:red;">*</span></label>
				    <input type="text" name="cust_address" class="form-control" placeholder="Address" required="true">
				  </div>
					<div class="form-group">
				    <label for="">Credit Card Number <span style="color:red;">*</span></label>
				    <input type="text" name="cust_cc" class="form-control" placeholder="16-digit Credit Card Number" required="true">
				  </div>
					<div class="form-group col-xs-6" style="padding-left:0;">
				    <label for="">Credit Card Expiry (Month) <span style="color:red;">*</span></label>
				    <input type="text" name="cust_mm" class="form-control" placeholder="MM" maxlength="2" required="true">
				  </div>
					<div class="form-group col-xs-6" style="padding-left:0;">
				    <label for="">Credit Card Expiry (Year) <span style="color:red;">*</span></label>
				    <input type="text" name="cust_yy" class="form-control" placeholder="YY" maxlength="2" required="true">
				  </div>
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="checkin" value="{{$data['reservation_details']['checkin']}}">
					<input type="hidden" name="checkout" value="{{$data['reservation_details']['checkout']}}">
					<input type="hidden" name="room" value="{{$data['reservation_details']['room_id']}}">




  			<button type="submit" class="btn btn-success">Book Now</button>
</form>
			</div>
		</div>

</div>

<div style="height:150px"></div>

@stop
