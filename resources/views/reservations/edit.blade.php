@extends('layouts.app')
@section('content')
<div class="container">
    <div class="upper-section">
        <h2>Update Reservation</h2>
        <form method="POST" action="{{ url('reservation/' .$reservations->reserveId) }}">
            {!! csrf_field() !!}
            @method("PATCH")
            <label>Reservation ID : </label><input type="text" name="reserveId" value="{{$reservations->reserveId}}" required="true"/><br><br>

            <label>Date : </label><input type="date" name="reserveDate" value="{{$reservations->reserveDate}}" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $reserveDateErr; ?></span><br><br>-->

            <label>Slot  : </label><select name="reserveSlot" value="" required="true">
                <option value="{{$reservations->reserveSlot}}" selected>{{$reservations->reserveSlot}}</option>
                <option value="Morning Slot">Morning Slot</option>
                <option value="Evening Slot">Evening Slot</option>
            </select><br><br>
            <!--<span class="error"><?php // echo "* " . $reserveSlotErr; ?></span><br><br>-->

            <label>Status  : </label><select name="reserveStatus" value="">
                <option value="{{$reservations->reserveStatus}}" selected>{{$reservations->reserveStatus}}</option>
                <option value="Pending">Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Canceled">Canceled</option>
                <option value="Closed">Closed</option>
                <option value="No Show">No Show</option>
                <option value="Arrived">Arrived</option>
            </select><br><br>

            <label>Total table reserve : </label><input type="number" name="noTableReserve" value="{{$reservations->noTableReserve}}" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $numTableReserveErr; ?></span><br><br>-->

            <label>Total Seats   : </label><input type="number" name="noOfCust" value="{{$reservations->noOfCust}}" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $totalSeatsErr; ?></span><br><br>-->

            <label>Name : </label><input type="text" name="custName" value="{{$reservations->custName}}" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $cust_nameErr; ?></span><br><br>-->

            <label>Phone no. : </label><input type="tel" name="custMobile" value="{{$reservations->custMobile}}" required="true"/><br><br>

            <input style="width: 100px; height: 28px;" type="submit" name="update" value="Update"/>
            <button style="width: 100px; height: 28px;" onclick="history.back()">Back</button><br><br>
                <!--<span class="error"><?php // echo $error   ?></span>-->
        </form>
    </div>
</div>
@stop
