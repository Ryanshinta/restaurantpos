@extends('layout')
@section('content')
<link rel="stylesheet" href="resources/css/app.css">
<div class="container">
    <div class="upper-section">
        <h2>Staff Details</h2>
        <h3>Name : {{ $staffs->name }}</h3><br>
        <label>IC Number : </label><label style="color: blue">{{ $staffs->icNumber }}</label><br><br>
        <label>Position : </label><label style="color: blue">{{ $staffs->position }}</label><br><br>
        <label>Password : </label><label style="color: blue">{{ $staffs->password }}</label><br><br>
        <label>Gender : </label><label style="color: blue">{{ $staffs->gender }}</label><br><br>
        <label>Phone no. : </label><label style="color: blue">{{ $staffs->mobile }}</label><br><br>
        <label>Email : </label><label style="color: blue">{{ $staffs->email }}</label><br><br>
        <label>Birthday : </label><label style="color: blue">{{ $staffs->birthday }}</label><br><br>
        <label>Address : </label><label style="color: blue">{{ $staffs->address }}</label><br><br>

        <button style="width: 100px; height: 28px;" onclick="history.back()">Go Back</button><br><br>
    </div>
</div>
<!--<span class="error"><?php // echo $error  ?></span>-->