@extends('staff_base')

<?php
$base_url = url("/");
?>
@section('content')
<div class="container" style="padding-bottom:30px;">
	<h3>Manage Rooms</h3>
</div>

<div class="container">
<form method="POST">
<table class="table table-striped">
	<thead>
		<tr>
			<th>Room Image</th>
			<th>Room Name</th>
			<th>Room Price</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($data["roomList"] as $room){ ?>
		<tr>
			<td><img src="{{$base_url}}/images/rooms/{{$room->room_type}}.jpg" style="max-width:100px; height:auto;" class="img-responsive"></td>
			<td>
			<div class="input-group">
			  <input type="text" name="roomName[{{$room->room_id}}]" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{ucwords($room->room_name)}}" required>
			</div>
			</td>
			<td>
			<div class="input-group">
			  <span class="input-group-addon">$</span>
			  <input type="text" name="roomPrice[{{$room->room_id}}]" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{ucwords($room->room_price)}}" required>
			  <span class="input-group-addon">.00</span>
			</div>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<div class="date_btn" style="display:block; margin:auto; width:100%;">
		<input type="submit" value="Update Rooms" style="background-color:#ffdc00; width:100% !important; margin:auto !important;"/>
</div>
</form>


</div>

<div style="height:150px"></div>

@stop
@section('end_script')
<script>
$( document ).ready(function() {
    $("#s_home").removeClass("active");
		$("#s_mr").addClass("active");
});
</script>
@stop
