@extends('layout')
@section('content')
<div class="container">
    <div class="upper-section">
        <h2>Add Table</h2>
        <form id="reservation-form" method="POST" action="{{ url('restauranttable') }}">
            {!! csrf_field() !!}
            <label>Table No : </label><input type="text" name="tableNo" value="" required="true"/><br><br>

            <label>Max Seats : </label><input type="number" name="maxSeats" value="" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $reserveDateErr;  ?></span><br><br>-->

            <input style="width:100px; height: 28px;" type="submit" name="submit" value="Add"/>
            <button style="width: 100px; height: 28px;" ><a style="color: black; text-decoration: none; " href="javascript:history.back()"><i aria-hidden="true"></i> Back</a></button><br><br>
                <!--<span class="error"><?php // echo $error        ?></span>-->
        </form>
    </div>
</div>
@stop