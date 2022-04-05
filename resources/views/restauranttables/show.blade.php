@extends('layout')
@section('content')
<link rel="stylesheet" href="resources/css/app.css">
<div class="container">
    <div class="upper-section">
        <h2>Table Info</h2>
        <h3>Table No. : {{ $restauranttables->tableNo }}</h3><br>
        <label>Type : </label>
        <span class="right badge badge-{{ $restauranttables->tableType ? 'success' : 'danger' }}" style="color: blue">
            {{$restauranttables->tableType ? 'Indoor' : 'Outdoor'}}
        </span>
        <br><br>

        <label>Max Seats : </label><label style="color: blue">{{ $restauranttables->maxSeats }}</label><br><br>
        <label>Status : </label><label style="color: blue">{{ $restauranttables->tableStatus }}</label><br><br>

        <label>Created At : </label><label style="color: blue">{{ $restauranttables->created_at }}</label><br><br>
        <label>Updated At : </label><label style="color: blue">{{ $restauranttables->updated_at }}</label><br><br>

        <button style="width: 100px; height: 28px;" onclick="history.back()">Go Back</button><br><br>
    </div>
</div>
<!--<span class="error"><?php // echo $error    ?></span>-->