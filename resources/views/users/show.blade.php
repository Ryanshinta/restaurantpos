@extends('layout')
@section('content')
<link rel="stylesheet" href="resources/css/app.css">
<div class="container">
    <div class="upper-section">
        <h2>Staff Details</h2>
        <h3>Name : {{ $users->name }}</h3><br>
        <label>IC Number : </label><label style="color: blue">{{ $users->icNumber }}</label><br><br>
        <label>Staff Role : </label><label style="color: blue">{{ $users->role }}</label><br><br>
        <label>Password : </label><label style="color: blue">{{ $users->password }}</label><br><br>
        <label>Gender : </label><label style="color: blue">{{ $users->gender }}</label><br><br>
        <label>Phone no. : </label><label style="color: blue">{{ $users->mobile }}</label><br><br>
        <label>Email : </label><label style="color: blue">{{ $users->email }}</label><br><br>
        <label>Birthday : </label><label style="color: blue">{{ $users->birthday }}</label><br><br>
        <label>Address : </label><label style="color: blue">{{ $users->address }}</label><br><br>

        <button style="width: 100px; height: 28px;" onclick="history.back()">Go Back</button><br><br>
    </div>
</div>
<!--<span class="error"><?php // echo $error  ?></span>-->
