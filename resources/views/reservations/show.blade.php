@extends('layout')
@section('content')
<link rel="stylesheet" href="resources/css/app.css">
<div class="container">
    <div class="upper-section">
        <h2>Reservation Details</h2>
        <h3>Reserve Date : {{ $reservations->reserveDate }}</h3><br>
        <label>Reserve ID : </label><label style="color: blue">{{ $reservations->reserveId }}</label><br><br>
        <label>Reserve Slot : </label><label style="color: blue">{{ $reservations->reserveSlot }}</label><br><br>
        <label>Reserve Status : </label><label style="color: blue">{{ $reservations->reserveStatus }}</label><br><br>
        <label>Total Table Reserve : </label><label style="color: blue">{{ $reservations->noTableReserve }}</label><br><br>
        <label>Total Customers : </label><label style="color: blue">{{ $reservations->noOfCust }}</label><br><br>
        <label>Customer's Name : </label><label style="color: blue">{{ $reservations->custName }}</label><br><br>
        <label>Phone no. : </label><label style="color: blue">{{ $reservations->custMobile }}</label><br><br>

        <button style="width: 100px; height: 28px;" onclick="history.back()">Go Back</button><br><br>
    </div>
</div>
<!--<span class="error"><?php // echo $error     ?></span>-->
