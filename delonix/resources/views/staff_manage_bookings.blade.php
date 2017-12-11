@extends('staff_base')

<?php
$base_url = url("/");
?>
@section('content')
<div class="container" style="padding-bottom:30px;">
	<h3>Manage Reservations <?php if (isset($data["dateRange"])){  ?><small>({{$data["dateRange"]}})</small> <?php } ?></h3>
</div>

<div class="container">

<div style="padding:10px; margin-bottom:30px;">
<form method="POST" action="{{$base_url}}/staff/manage-booking">
	<div class="col-xs-5 col-md-2">
		<div class="book_date">
			<label>Report From</label>
			<input class="date" id="datepicker" style="background:none !important;" name="checkin" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '{{date('d/m/Y')}}';}" required>
		</div>
	</div>
	<div class="col-xs-5 col-md-2">
		<div class="book_date">
			<label>Report To</label>
			<input class="date" id="datepicker1" style="background:none !important;" name="checkout" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '{{date('d/m/Y')}}';}" required>
		</div>
	</div>
	<div class="col-xs-5 col-md-2" style="margin-bottom:30px;">
	<div class="date_btn" style="display:block; margin-top:20px; width:100%;">
		<input type="submit" value="Generate" style="background-color:#ffdc00; width:100% !important; margin:auto !important;"/>
		</div>
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
</div>

<table class="table table-striped" style="font-size:10pt; margin-top:30px !important;">
	<thead>
		<tr>
			<th>Transaction ID</th>
			<th>Room Image</th>
			<th>Room Name</th>
			<th>Customer Name</th>
			<th>Check In</th>
			<th>Check Out</th>
			<th>Amount</th>
			<th>Manage</th>
			<th>Delete</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($data["reservationList"] as $res){ ?>
		<tr>
			<td>{{$res->transaction_id}}</td>
			<td><img src="{{$base_url}}/images/rooms/{{$res->room->room_type}}.jpg" style="max-width:100px; height:auto;" class="img-responsive"></td>
			<td>{{$res->room->room_name}}</td>
			<td>{{$res->customer->cust_name}}</td>
			<td>{{date("d/m/Y",strtotime($res->checkin))}}</td>
			<td>{{date("d/m/Y",strtotime($res->checkout))}}</td>
			<td>${{$res->amount}}</td>
			<td><a href="{{$base_url}}/staff/manage-booking/{{$res->transaction_id}}" class="btn btn-sm btn-block btn-default">Manage</a></td>
			<td><a href="{{$base_url}}/staff/delete-booking/{{$res->transaction_id}}" class="btn btn-sm btn-block btn-danger">Delete</a></td>

		</tr>
	<?php } ?>
	</tbody>
</table>



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
