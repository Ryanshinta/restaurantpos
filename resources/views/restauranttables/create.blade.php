@extends('layouts.app')
@section('content')
<div class="container">
    <div class="upper-section">
        <h2>Add Table</h2>
        <form id="reservation-form" method="POST" action="{{ url('restaurantTable') }}">
            {!! csrf_field() !!}
            <label>Table No : </label>{{$tableNum}}<br><br>

            <label>Table Type : </label>
            <select name="tableType" id="tableType">
                <option value="1" >Indoor</option>
                <option value="2" >Outdoor</option>
            </select>
            <br><br>

            <label>Max Seats : </label><input type="number" name="maxSeats" value="" required="true" max="12" min="1"/><br><br>

            <input style="width:100px; height: 28px;" type="submit" name="submit" value="Add"/>
            <button style="width: 100px; height: 28px;" ><a style="color: black; text-decoration: none; " href="javascript:history.back()"><i aria-hidden="true"></i> Back</a></button><br><br>
        </form>
    </div>
</div>
@stop
