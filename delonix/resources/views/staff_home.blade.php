@extends('staff_base')

<?php
$base_url = url("/");
?>
@section('content')
<div class="container" style="padding-bottom:30px;">
	<h3>Room Booking Overview <small>(Updated on {{date("d M Y h:i A")}})</small></h3>
</div>

<div class="container">

<table class="table table-striped">
	<thead>
		<tr>
			<th>Room Image</th>
			<th>Room Name</th>
			<th>Room Price</th>
			<th>Room Status</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($data["roomList"] as $room){ ?>
		<tr>
			<td><img src="{{$base_url}}/images/rooms/{{$room->room_type}}.jpg" style="max-width:100px; height:auto;" class="img-responsive"></td>
			<td>{{ucwords($room->room_name)}}</td>
			<td>${{$room->room_price}}</td>
			<td><?php echo $room->status; ?></td>
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
		$("#s_home").addClass("active");
});
</script>
@stop
