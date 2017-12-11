@extends('staff_base')

<?php
$base_url = url("/");
?>
@section('head')
<style>
.row div{
	padding-bottom:10px !important;
}
</style>
@stop
@section('content')
<div class="container" style="padding-bottom:30px;">
	<h3>Manage Reservation</h3>
</div>

<div class="container">
	<h4 style="font-weight:bold; text-decoration:underline !important;">Reservation Details</h4>
<form action="{{$base_url}}/staff/update-booking" method="POST">
<div class="row" style="width:100% !important; margin:10px !important;">
<div class="col-xs-4 col-md-2" style="font-weight:bold;">Transaction ID</div>
<div class="col-xs-8 col-md-10">{{$data["reservation"]->transaction_id}}</div>


<div class="col-xs-4 col-md-2" style="font-weight:bold;">Room Type</div>
<div class="col-xs-8 col-md-10">
	<select id="room" name="room_id" onchange="change_country(this.value)" class="frm-field required" style="height:38px;" required>
		<?php foreach ($data["roomList"] as $room){ ?>
	<option value="{{$room->room_id}}" <?php if ($room->room_id == $data["reservation"]->room->room_id) echo "selected"; ?>>{{ strtoupper($room->room_name)}}</option>
	<?php } ?>

	</select>
</div>

<div class="col-xs-4 col-md-2" style="font-weight:bold;">Check In</div>
<div class="col-xs-8 col-md-10">
	<div class="book_date">
		<input class="date" id="datepicker" style="background:none !important;" name="checkin" type="text" value="{{date('d/m/Y',strtotime($data['reservation']->checkin))}}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '{{date('d/m/Y',strtotime($data['reservation']->checkin))}}';}" required>
	</div>
</div>

<div class="col-xs-4 col-md-2" style="font-weight:bold;">Check Out</div>
<div class="col-xs-8 col-md-10">
	<div class="book_date">
		<input class="date" id="datepicker1" style="background:none !important;" name="checkout" type="text" value="{{date('d/m/Y',strtotime($data['reservation']->checkout))}}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '{{date('d/m/Y',strtotime($data['reservation']->checkout))}}';}" required>
	</div>
</div>








<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="reservation_id" value="{{$data['reservation']->reservation_id}}">

<div class="col-xs-4 col-md-2" style="font-weight:bold;">Amount</div>
<div class="col-xs-8 col-md-10">${{$data["reservation"]->amount}}</div>

<div class="col-xs-4 col-md-2" style="font-weight:bold;"></div>
<div class="col-xs-8 col-md-10">
	<div class="date_btn" style="display:block; margin:auto; width:100%;">
			<input type="submit" value="Update Reservation" style="background-color:#ffdc00; width:100% !important; margin:auto !important;"/>
	</div>
</div>

</div>

</form>



<h4 style="font-weight:bold; text-decoration:underline !important;">Customer Details</h4>
<form action="{{$base_url}}/staff/update-customer" method="POST">
<div class="row" style="width:100% !important; margin:10px !important;">
<div class="col-xs-4 col-md-2" style="font-weight:bold;">Customer Name</div>
<div class="col-xs-8 col-md-10">
<input type="text" class="form-control" name="cust_name" value="{{$data['reservation']->customer->cust_name}}" required>
</div>

<div class="col-xs-4 col-md-2" style="font-weight:bold;">Customer Email</div>
<div class="col-xs-8 col-md-10">
<input type="text" class="form-control" name="cust_email" value="{{$data['reservation']->customer->cust_email}}" required>
</div>

<div class="col-xs-4 col-md-2" style="font-weight:bold;">Customer No</div>
<div class="col-xs-8 col-md-10">
<input type="text" class="form-control" name="cust_no" value="{{$data['reservation']->customer->cust_no}}" required>
</div>

<div class="col-xs-4 col-md-2" style="font-weight:bold;">Customer Address</div>
<div class="col-xs-8 col-md-10">
<input type="text" class="form-control" name="cust_address" value="{{$data['reservation']->customer->Cust_address}}" required>
</div>

<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="cust_id" value="{{$data['reservation']->customer->cust_id}}">



<div class="col-xs-4 col-md-2" style="font-weight:bold;"></div>
<div class="col-xs-8 col-md-10">
<div class="date_btn" style="display:block; margin:auto; width:100%;">
		<input type="submit" value="Update Customer" style="background-color:#ffdc00; width:100% !important; margin:auto !important;"/>
</div>
</div>

</div>

</form>



</div>

<div style="height:150px"></div>

@stop
@section('end_script')
<script>
$( document ).ready(function() {
    $("#s_home").removeClass("active");
		$("#s_mb").addClass("active");
});
</script>
@stop
