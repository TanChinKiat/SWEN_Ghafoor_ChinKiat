@extends('staff_base')

<?php
$base_url = url("/");
?>
@section('head')
<style>
.form-control{
	font-size:8pt !important;
	height:30px !important;
}
</style>
@stop
@section('content')
<div class="container" style="padding-bottom:30px;">
	<h3>Manage Staff</h3>
</div>

<div class="container">

	<form method="POST" action="{{$base_url}}/staff/new-staff">
	<table class="table table-striped" style="font-size:8pt;">
	<thead>
		<tr>
			<th>Name</th>
			<th>Username</th>
			<th>Password</th>
			<th>Bank Account</th>
			<th>DOB</th>
			<th>Address</th>
			<th>No</th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td><input type="text" name="staff_name" value="" class="form-control" required></td>
			<td><input type="text" name="staff_username" value="" class="form-control" required></td>
			<td><input type="password" name="staff_password" value="" class="form-control" required></td>
			<td><input type="text" name="staff_bankaccount" value="" class="form-control" required></td>
			<td><input type="text" name="staff_dob" value="" class="form-control" required></td>
			<td><input type="text" name="staff_address" value="" class="form-control" required></td>
			<td><input type="text" name="staff_no" value="" class="form-control" required></td>
			<td>
				<div class="date_btn" style="display:block; margin:auto; width:100%;">
					<input type="submit" value="Create" style="background-color:#ffdc00; width:100% !important; margin:auto !important;"/>
				</div>
			</td>


		</tr>
	</tbody>
	</table>
	<input type="hidden" name="_token" value="{{csrf_token()}}">


	</form>



	<form method="POST" action="{{$base_url}}/staff/update-staff">
<table class="table table-striped" style="font-size:8pt;">
	<thead>
		<tr>
			<th>Staff ID</th>
			<th>Name</th>
			<th>Username</th>
			<th>Password</th>
			<th>Bank Account</th>
			<th>DOB</th>
			<th>Address</th>
			<th>No</th>
			<th>Delete</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($data["staffList"] as $staff){ ?>
		<tr>
			<td>{{$staff->staffid}}</td>
			<td><input type="text" name="staff_name[{{$staff->staffid}}]" value="{{$staff->staff_name}}" class="form-control" required></td>
			<td><input type="text" name="staff_username[{{$staff->staffid}}]" value="{{$staff->staff_username}}" class="form-control" required></td>
			<td><input type="password" name="staff_password[{{$staff->staffid}}]" value="{{$staff->staff_password}}" class="form-control" required></td>
			<td><input type="text" name="staff_bankaccount[{{$staff->staffid}}]" value="{{$staff->staff_bankaccount}}" class="form-control" required></td>
			<td><input type="text" name="staff_dob[{{$staff->staffid}}]" value="{{$staff->staff_dob}}" class="form-control" required></td>
			<td><input type="text" name="staff_address[{{$staff->staffid}}]" value="{{$staff->staff_address}}" class="form-control" required></td>
			<td><input type="text" name="staff_no[{{$staff->staffid}}]" value="{{$staff->staff_no}}" class="form-control" required></td>

			<td><a href="{{$base_url}}/staff/delete-staff/{{$staff->staffid}}" class="btn btn-sm btn-block btn-danger">Delete</a></td>

		</tr>
	<?php } ?>
	</tbody>
</table>
<input type="hidden" name="_token" value="{{csrf_token()}}">

<div class="date_btn" style="display:block; margin:auto; width:100%;">
		<input type="submit" value="Update Staff" style="background-color:#ffdc00; width:100% !important; margin:auto !important;"/>
</div>
</form>

</div>

<div style="height:150px"></div>

@stop
@section('end_script')
<script>
$( document ).ready(function() {
    $("#s_home").removeClass("active");
		$("#s_ms").addClass("active");
});
</script>
@stop
