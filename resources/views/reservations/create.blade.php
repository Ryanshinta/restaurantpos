@extends('layouts.app')
@section('content')
<div class="container">
    <div class="upper-section">
        <h2>Add Reservation</h2>
        <form id="reservation-form" method="post" action="{{ url('reservations/') }}">
            {!! csrf_field() !!}
            <label>Reservation ID : </label><input type="text" name="reserveId" value="{{$reserveId}}" required="true" readonly/><br><br>

            <label>Date : </label><input type="date" name="reserveDate" value="" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $reserveDateErr;       ?></span><br><br>-->

            <label>Slot  : </label><input type="radio" name="reserveSlot" value="Morning Slot" required="true"/>Morning
            <input type="radio" name="reserveSlot" value="Evening Slot"/>Evening<br><br>
            <!--<span class="error"><?php // echo "* " . $reserveSlotErr;       ?></span><br><br>-->

            <label>Total table reserve : </label><input type="number" name="noTableReserve" value="" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $numTableReserveErr;       ?></span><br><br>-->

            <label>Total Seats   : </label><input type="number" name="noOfCust" value="" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $totalSeatsErr;       ?></span><br><br>-->

            <label>Name : </label><input type="text" name="custName" value="" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $cust_nameErr;       ?></span><br><br>-->

            <label>Phone no. : </label><input type="tel" name="custMobile" value="" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $cust_mobileErr;       ?></span><br><br>-->

        <a href="{{ url('/reservations/addTable') }}" title="Add New Reservation"><button class="btn btn-primary btn-sm" style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i aria-hidden="true"></i> Select Table</button></a>
            <!--<span class="error"><?php // echo $error             ?></span>-->
        </form>
    </div>
</div>
@stop
