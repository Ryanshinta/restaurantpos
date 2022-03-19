@extends('layout')
@section('content')
<link rel="stylesheet" href="resources/css/app.css">
<div class="container">
    <div class="upper-section">
        <h2>Table Info</h2>
        <h3>Table No. : {{ $restauranttables->tableNo }}</h3><br>
        <label>Max Seats : </label><label style="color: blue">{{ $restauranttables->maxSeats }}</label><br><br>
        <label>Status : </label><label style="color: blue">{{ $restauranttables->tableStatus }}</label><br><br>

        <button style="width: 100px; height: 28px;" onclick="history.back()">Go Back</button><br><br>
    </div>
</div>
<!--<span class="error"><?php // echo $error  ?></span>-->