@extends('base')

<?php
$base_url = url("/");
?>
@section('content')
<div class="online_reservation">
		   <div class="b_room">

         <form method="post" action="{{$base_url}}/view-prices">
			  <div class="booking_room">
				  <div class="reservation">
            @if(Session::has('r_warning'))
                  <div class="alert alert-warning alert-dismissible show" role="alert" style="margin:8px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4><i class="icon fa fa-warning"></i> Notice!</h4>
                    {{Session::get('r_warning')}}
                  </div>
                @endif
                @if(Session::has('r_danger'))
                  <div class="alert alert-danger alert-dismissible show" role="alert" style="margin:8px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                    {{Session::get('r_danger')}}
                  </div>
                @endif
                @if(Session::has('r_success'))
                  <div class="alert alert-success alert-dismissible show" role="alert" style="margin:8px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {{Session::get('r_success')}}
                  </div>
                @endif
					  <ul>
						 <li  class="span1_of_1 left">
							 <h5>Arrival</h5>
							 <div class="book_date">
								 <input class="date" id="datepicker" name="checkin" type="text" value="{{date('d/m/Y')}}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '2/08/2013';}">
							 </div>
						 </li>
						 <li  class="span1_of_1 left">
							 <h5>Depature</h5>
							 <div class="book_date">
								<input class="date" id="datepicker1" name="checkout" type="text" value="{{date('d/m/Y')}}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '22/08/2013';}">
						     </div>
						 </li>
						 <li class="span1_of_1">
							 <h5>Room type</h5>
							 <!----------start section_room----------->
							 <div class="section_room">
							      <select id="room" name="room" onchange="change_country(this.value)" class="frm-field required" style="height:38px;">
                      <?php foreach ($data["roomList"] as $room){ ?>
										<option value="{{$room->room_id}}">{{ strtoupper($room->room_name)}}</option>
                  <?php } ?>

							      </select>
							 </div>
						 </li>
						 <li class="span1_of_3">

								<div class="date_btn">
										<input type="submit" value="View Prices" style="background-color:#ffdc00;"/>
								</div>
						 </li>
						 <div class="clearfix"></div>
					 </ul>
				 </div>
			  </div>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
      </form>
				<div class="clearfix"></div>
		  </div>
	  </div>
</div>
<!---->
<div style="height:60px"></div>
<!---->
<!---->
<div class="rooms text-center">
	 <div class="container">
		 <h3>Our Room Types</h3>
		 <div class="room-grids">
			 <div class="col-md-4 room-sec">
				 <img src="images/pic1.jpg" alt=""/>
				 <h4>Single Room</h4>
				 <p>This room is perfect for people who like to travel alone or have their own room.</p>
				 <div class="items">
					 <li><a href="#"><span class="img1"> </span></a></li>
					 <li><a href="#"><span class="img2"> </span></a></li>
					 <li><a href="#"><span class="img3"> </span></a></li>
					 <li><a href="#"><span class="img4"> </span></a></li>
					 <li><a href="#"><span class="img5"> </span></a></li>
					 <li><a href="#"><span class="img6"> </span></a></li>
				 </div>
			 </div>
			 <div class="col-md-4 room-sec">
				 <img src="images/pic2.jpg" alt=""/>
				 <h4>Double Room</h4>
				 <p>This room is for couple or friends who want to have a more luxury experience as this room is bigger than our Single Room </p>
				 <div class="items">
					 <li><a href="#"><span class="img1"> </span></a></li>
					 <li><a href="#"><span class="img2"> </span></a></li>
					 <li><a href="#"><span class="img3"> </span></a></li>
					 <li><a href="#"><span class="img4"> </span></a></li>
					 <li><a href="#"><span class="img5"> </span></a></li>
					 <li><a href="#"><span class="img6"> </span></a></li>
				 </div>
			 </div>
			 <div class="col-md-4 room-sec">
				 <img src="images/pic3.jpg" alt=""/>
				 <h4>Triple Room</h4>
				 <p>This room is most suitable for a large group of friends or family as this room can have up to 3 people. This room also come with kitchen and toilet in all the rooms</p>
				 <div class="items">
					 <li><a href="#"><span class="img1"> </span></a></li>
					 <li><a href="#"><span class="img2"> </span></a></li>
					 <li><a href="#"><span class="img3"> </span></a></li>
					 <li><a href="#"><span class="img4"> </span></a></li>
					 <li><a href="#"><span class="img5"> </span></a></li>
					 <li><a href="#"><span class="img6"> </span></a></li>
				 </div>
			 </div>
			 <div class="clearfix"></div>
			 <div class="col-md-4 room-sec">
				 <img src="images/pic4.jpg" alt=""/>
				 <h4>Quad Room</h4>
				 <p>This is an upgraded version of the triple room for those who want more.</p>
				 <div class="items">
					 <li><a href="#"><span class="img1"> </span></a></li>
					 <li><a href="#"><span class="img2"> </span></a></li>
					 <li><a href="#"><span class="img3"> </span></a></li>
					 <li><a href="#"><span class="img4"> </span></a></li>
					 <li><a href="#"><span class="img5"> </span></a></li>
					 <li><a href="#"><span class="img6"> </span></a></li>
				 </div>
			 </div>
			 <div class="col-md-4 room-sec">
				 <img src="images/pic5.jpg" alt=""/>
				 <h4>King Room</h4>
				 <p>This is the best version of single room having the best furnitures and latest gadgets in the room.</p>
				 <div class="items">
					 <li><a href="#"><span class="img1"> </span></a></li>
					 <li><a href="#"><span class="img2"> </span></a></li>
					 <li><a href="#"><span class="img3"> </span></a></li>
					 <li><a href="#"><span class="img4"> </span></a></li>
					 <li><a href="#"><span class="img5"> </span></a></li>
					 <li><a href="#"><span class="img6"> </span></a></li>
				 </div>
			 </div>
			 <div class="col-md-4 room-sec">
				 <img src="images/pic6.jpg" alt=""/>
				 <h4>Hollywood Twin Room</h4>
				 <p>One of the best rooms we offer in this hotel for special guests that visit us.</p>
				 <div class="items">
					 <li><a href="#"><span class="img1"> </span></a></li>
					 <li><a href="#"><span class="img2"> </span></a></li>
					 <li><a href="#"><span class="img3"> </span></a></li>
					 <li><a href="#"><span class="img4"> </span></a></li>
					 <li><a href="#"><span class="img5"> </span></a></li>
					 <li><a href="#"><span class="img6"> </span></a></li>
				 </div>
			 </div>
			 <div class="clearfix"></div>
		 </div>
	 </div>
</div>

@stop
