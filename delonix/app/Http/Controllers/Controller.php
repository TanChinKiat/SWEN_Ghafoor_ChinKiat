<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Room, App\Customer, App\Admin, App\Reservation, App\Staff;
use Illuminate\Http\Request;
use Session, Redirect, DateTime;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function formatDateString($rawDate){
      $date = date_create_from_format('d/m/Y', $rawDate);
      $date2 = date_format($date, 'Y-m-d 14:00:00');
      $date3 = date("Y-m-d H:i:s", strtotime($date2));
      return $date3;
    }

    public function formatDateString2($rawDate){
      $date = date_create_from_format('d/m/Y', $rawDate);
      $date2 = date_format($date, 'Y-m-d 12:00:00');
      $date3 = date("Y-m-d H:i:s", strtotime($date2));
      return $date3;
    }

    public function checkAvailability($checkin, $checkout, $room_id){
      $errorCt = 0;
      $u_start = strtotime($checkin);
      $u_end = strtotime($checkout);
      $bookingList = Reservation::where("room_id","=",$room_id)->whereNull("deleted_at")->get();
      foreach ($bookingList as $booking){
        $s_start = strtotime($booking->checkin);
        $s_end = strtotime($booking->checkout);

        if (($u_end > $s_start)&&($u_end <= $s_end)){
          $errorCt++;
          break;
        }
        elseif (($u_start >= $s_start)&&($u_start < $s_end)){
          $errorCt++;
          break;
        }
        elseif (($u_start <= $s_start)&&($u_end >= $s_end)){
          $errorCt++;
          break;
        }
      }
      if ($errorCt>0) return false;
      else return true;
    }

    public function checkAvailability2($checkin, $checkout, $room_id, $currentRes){
      $errorCt = 0;
      $u_start = strtotime($checkin);
      $u_end = strtotime($checkout);
      $bookingList = Reservation::where("room_id","=",$room_id)->whereNull("deleted_at")->where("reservation_id","<>",$currentRes)->get();
      foreach ($bookingList as $booking){
        $s_start = strtotime($booking->checkin);
        $s_end = strtotime($booking->checkout);

        if (($u_end > $s_start)&&($u_end <= $s_end)){
          $errorCt++;
          break;
        }
        elseif (($u_start >= $s_start)&&($u_start < $s_end)){
          $errorCt++;
          break;
        }
        elseif (($u_start <= $s_start)&&($u_end >= $s_end)){
          $errorCt++;
          break;
        }
      }
      if ($errorCt>0) return false;
      else return true;
    }

    public function computeNights($checkin, $checkout){
      $checkin = new DateTime($checkin);
      $checkout = new DateTime($checkout);

      // this calculates the diff between two dates, which is the number of nights
      $numberOfNights= $checkout->diff($checkin)->format("%a");
      if ($numberOfNights==0) return 1;
      else return $numberOfNights+1;
    }

    public function home(){
      $data = [];
      $roomList = Room::whereNull("deleted_at")->get();
      $data["roomList"] = $roomList;
      return view("welcome")->with("data",$data);
    }



    public function viewPrices(Request $request){


      $input = $request->all();
      $blankCount = 0;
      foreach ($input as $i){
        if (trim($i)=="") $blankCount++;
      }
      if ($blankCount>0){
        Session::flash("danger","All fields are compulsory");
        return back();
      }

      $checkin = $this->formatDateString($input["checkin"]);
      $checkout = $this->formatDateString2($input["checkout"]);

      if (strtotime($checkout)<strtotime($checkin)){
        Session::flash("r_warning","Please verify your arrival and departure dates.");
        return back();
      }

      $room_id = $input["room"];



      if (!$this->checkAvailability($checkin, $checkout, $room_id)){
        Session::flash("r_warning","Sorry, the room you selected is not available during the dates.");
        return back();
      }else{
        $data = [];
        $room = Room::where("room_id","=",$input["room"])->whereNull("deleted_at")->get()[0];
        $data["room"] = $room;
        $data["form"] = $input;
        $reservation_details = [];
        $reservation_details["checkin"] = $checkin;
        $reservation_details["checkout"] = $checkout;
        $reservation_details["room_id"] = $room_id;
        $reservation_details["nights"] = $this->computeNights($checkin, $checkout);
        $reservation_details["total_price"] = number_format((float)($room->room_price * $reservation_details["nights"]),2,'.','');
        $data["reservation_details"] = $reservation_details;
        //Session::put("req",$request);

        return view("view_prices")->with("data",$data);
      }
    }
    public function book(Request $request){

      $input = $request->all();
      $blankCount = 0;
      foreach ($input as $i){
        if (trim($i)=="") $blankCount++;
      }
      if ($blankCount>0){
        Session::flash("r_danger","Reservation failed, please try again.");
        return Redirect::to("/");
      }

      $room = Room::where("room_id","=",$input["room"])->whereNull("deleted_at")->get()[0];

      $cust = new Customer();
      $cust->cust_name = $input["cust_name"];
      $cust->cust_email = $input["cust_email"];
      $cust->cust_no = $input["cust_no"];
      $cust->Cust_address = $input["cust_address"];
      $cust->cust_creditcard = $input["cust_cc"];
      $cust->cust_creditcard_mm = $input["cust_mm"];
      $cust->cust_creditcard_yy = $input["cust_yy"];
      $cust->save();

      $res = new Reservation();
      $res->room_id = $input["room"];
      $res->cust_id = $cust->cust_id;
      $res->checkin = $input["checkin"];
      $res->checkout = $input["checkout"];
      $res->paymentstatus = "PAID";
      $res->transaction_id = md5(date("Y-m-d H:i:s").$cust->cust_id.rand(0,9999));
      $res->paymentmethod = "Credit Card";
      $res->amount = (float)($this->computeNights($input["checkin"], $input["checkout"])*$room->room_price);
      $res->save();

      $res->nights = $this->computeNights($input["checkin"], $input["checkout"]);

      $data = [];
      $data["room"] = $room;
      $data["customer"] = $cust;
      $data["reservation"] = $res;

      return view("booking-confirmation")->with("data",$data);



    }

    public function staffLogin(Request $request){
      $input = $request->all();
      $blankCount = 0;
      foreach ($input as $i){
        if (trim($i)=="") $blankCount++;
      }
      if ($blankCount>0){
        return Redirect::to("/");
      }
      $adminCt = Admin::where("admin_username","=",$input["d_login"])->where("admin_password","=",md5($input["d_password"]))->count();
      if ($adminCt!=1){
        return Redirect::to("/");
      }else{
        $admin = Admin::where("admin_username","=",$input["d_login"])->where("admin_password","=",md5($input["d_password"]))->get()[0];

        Session::put("session_hash",md5(date("Y-m-d H:i:s").rand(0,9999)));
        Session::put("session_user",$admin);

        return Redirect::to("/staff");
      }

    }


    public function staffHome(){
      $data = [];

      $now = date("Y-m-d H:i:s");

      //Generate Room list
      $roomList = Room::whereNull("deleted_at")->get();

      foreach($roomList as $room){
        //check if room is occupied
        $resCt = Reservation::where("room_id","=",$room->room_id)->whereNull("deleted_at")->where("checkin","<=",$now)->where("checkout",">=",$now)->count();

        if ($resCt==0) $room->status = "<span class='label label-success'>Available</span>";
        else $room->status = "<span class='label label-danger'>Occupied</span>";


      }

      $data["roomList"] = $roomList;




      return view("staff_home")->with("data",$data);
    }

    public function manageRooms(){
      $data = [];

      $now = date("Y-m-d H:i:s");

      //Generate Room list
      $roomList = Room::whereNull("deleted_at")->get();

      foreach($roomList as $room){
        //check if room is occupied
        $resCt = Reservation::where("room_id","=",$room->room_id)->whereNull("deleted_at")->where("checkin","<=",$now)->where("checkout",">=",$now)->count();

        if ($resCt==0) $room->status = "<span class='label label-success'>Available</span>";
        else $room->status = "<span class='label label-danger'>Occupied</span>";


      }

      $data["roomList"] = $roomList;




      return view("staff_manage_rooms")->with("data",$data);
    }


    public function manageRooms2(Request $request){

      $input = $request->all();


      $data = [];

      $now = date("Y-m-d H:i:s");

      //Generate Room list
      $roomList = Room::whereNull("deleted_at")->get();

      foreach($roomList as $room){

        $room->room_price = $input["roomPrice"][$room->room_id];
        $room->room_name = $input["roomName"][$room->room_id];
        $room->touch();
        $room->save();

      }

      Session::flash("success","Room information updated!");
      return back();
    }

    public function manageBookings(){
      $data = [];

      $now = date("Y-m-d H:i:s");

      //Generate Room list
      $reservation = Reservation::whereNull("deleted_at")->get();

      foreach($reservation as $res){

        $res->room = Room::where("room_id","=",$res->room_id)->get()[0];
        $res->customer = Customer::where("cust_id","=",$res->cust_id)->get()[0];

      }

      $data["reservationList"] = $reservation;




      return view("staff_manage_bookings")->with("data",$data);
    }

    public function manageBookings3(Request $request){
        $input = $request->all();
      $data = [];

      $now = date("Y-m-d H:i:s");

      $checkin = $this->formatDateString($input["checkin"]);
      $checkout = $this->formatDateString($input["checkout"]);


      //Generate Room list
      $reservation = Reservation::whereNull("deleted_at")->where("checkin",">=",$checkin)->where("checkin","<=",$checkout)->get();

      foreach($reservation as $res){

        $res->room = Room::where("room_id","=",$res->room_id)->get()[0];
        $res->customer = Customer::where("cust_id","=",$res->cust_id)->get()[0];

      }

      $data["reservationList"] = $reservation;
      $data["dateRange"] = $input["checkin"]." to ".$input["checkout"];




      return view("staff_manage_bookings")->with("data",$data);
    }

    public function listStaff(){
      $data = [];

      $now = date("Y-m-d H:i:s");

      //Generate Room list
      $staffList = Staff::whereNull("deleted_at")->get();


      $data["staffList"] = $staffList;




      return view("staff_list_staff")->with("data",$data);
    }

    public function viewBooking($transaction_id){

      $resCt = Reservation::where("transaction_id","=",$transaction_id)->whereNull("deleted_at")->count();
      if ($resCt!=1){
        Session::flash("danger","Reservation not found.");
        return Redirect::to("/staff");
      }
      $data = [];
      $now = date("Y-m-d H:i:s");
      $reservation = Reservation::where("transaction_id","=",$transaction_id)->whereNull("deleted_at")->get()[0];
      $reservation->room = Room::where("room_id","=",$reservation->room_id)->get()[0];
      $reservation->customer = Customer::where("cust_id","=",$reservation->cust_id)->get()[0];
      $data["reservation"] = $reservation;

      $roomList = Room::whereNull("deleted_at")->get();
      $data["roomList"] = $roomList;

      return view("staff_view_booking")->with("data",$data);
    }

    public function deleteBooking($transaction_id){

      $resCt = Reservation::where("transaction_id","=",$transaction_id)->whereNull("deleted_at")->count();
      if ($resCt!=1){
        Session::flash("danger","Reservation not found.");
        return Redirect::to("/staff");
      }
      $data = [];
      $now = date("Y-m-d H:i:s");
      $reservation = Reservation::where("transaction_id","=",$transaction_id)->whereNull("deleted_at")->get()[0];
      $reservation->deleted_at = date("Y-m-d H:i:s");
      $reservation->touch();
      $reservation->save();
      Session::flash("success","Reservation ($transaction_id) deleted.");
      return back();
    }

    public function updateBooking(Request $request){

      $input = $request->all();
      $blankCount = 0;
      foreach ($input as $i){
        if (trim($i)=="") $blankCount++;
      }
      if ($blankCount>0){
        Session::flash("danger","Please check inputs.");
        return back();
      }

      $checkin = $this->formatDateString($input["checkin"]);
      $checkout = $this->formatDateString2($input["checkout"]);

      $room = Room::where("room_id","=",$input["room_id"])->whereNull("deleted_at")->get()[0];



      $res = Reservation::where("reservation_id","=",$input["reservation_id"])->get()[0];


      if (!$this->checkAvailability2($checkin, $checkout, $input["room_id"], $res->reservation_id)){
        Session::flash("danger","Selected room is not available during the dates.");
        return back();
      }

      $res->room_id = $input["room_id"];
      $res->checkin = $checkin;
      $res->checkout = $checkout;
      $res->amount = (float)($this->computeNights($checkin, $checkout)*$room->room_price);
      $res->touch();
      $res->save();

      Session::flash("success","Reservation details updated.");
      return back();



    }


    public function updateCustomer(Request $request){

      $input = $request->all();
      $blankCount = 0;
      foreach ($input as $i){
        if (trim($i)=="") $blankCount++;
      }
      if ($blankCount>0){
        Session::flash("danger","Please check inputs.");
        return back();
      }

      $custCt = Customer::where("cust_id","=",$input["cust_id"])->whereNull("deleted_at")->count();
      if ($custCt!=1){
        Session::flash("danger","Customer not found.");
        return back();
      }
      $cust = Customer::where("cust_id","=",$input["cust_id"])->whereNull("deleted_at")->get()[0];
      $cust->cust_name = $input["cust_name"];
      $cust->cust_email = $input["cust_email"];
      $cust->cust_no = $input["cust_no"];
      $cust->Cust_address = $input["cust_address"];

      $cust->touch();
      $cust->save();

      Session::flash("success","Customer details updated.");
      return back();



    }

    public function updateStaff(Request $request){

      $input = $request->all();


      $data = [];

      $now = date("Y-m-d H:i:s");

      //Generate Room list
      $staffList = Staff::whereNull("deleted_at")->get();

      foreach($staffList as $staff){

        $staff->staff_username = $input["staff_username"][$staff->staffid];
        $staff->staff_bankaccount = $input["staff_bankaccount"][$staff->staffid];
        $staff->staff_dob = $input["staff_dob"][$staff->staffid];
        $staff->staff_address = $input["staff_address"][$staff->staffid];
        $staff->staff_name = $input["staff_name"][$staff->staffid];
        $staff->staff_no = $input["staff_no"][$staff->staffid];

        if ($staff->staff_password!=md5($input["staff_password"][$staff->staffid])){
          $staff->staff_password = md5($input["staff_password"][$staff->staffid]);
        }

        $staff->touch();
        $staff->save();



      }

      Session::flash("success","Staff information updated!");
      return back();
    }

    public function newStaff(Request $request){

      $input = $request->all();

      $blankCount = 0;
      foreach ($input as $i){
        if (trim($i)=="") $blankCount++;
      }
      if ($blankCount>0){
        Session::flash("danger","All fields are compulsory");
        return back();
      }


      $data = [];

      $now = date("Y-m-d H:i:s");

        $staff = new Staff();
        $staff->staff_username = $input["staff_username"];
        $staff->staff_bankaccount = $input["staff_bankaccount"];
        $staff->staff_dob = $input["staff_dob"];
        $staff->staff_address = $input["staff_address"];
        $staff->staff_name = $input["staff_name"];
        $staff->staff_no = $input["staff_no"];
        $staff->staff_password = md5($input["staff_password"]);
        $staff->save();


      Session::flash("success","New Staff ".$input["staff_name"]." created!");
      return back();
    }

    public function deleteStaff($staffid){

      $staffCt = Staff::where("staffid","=",$staffid)->whereNull("deleted_at")->count();
      if ($staffCt!=1){
        Session::flash("danger","Staff not found.");
        return back();
      }
      $data = [];
      $now = date("Y-m-d H:i:s");
      $staff = Staff::where("staffid","=",$staffid)->whereNull("deleted_at")->get()[0];
      $staff->deleted_at = date("Y-m-d H:i:s");
      $staff->touch();
      $staff->save();
      Session::flash("success","Staff (".$staff->staff_name.") deleted.");
      return back();
    }

    public function signOut()
	{
	 session()->flush();
	 return Redirect::to('/staff');


	}
}
