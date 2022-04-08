@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="resources/css/app.css">
<div class="container">
    <div class="upper-section">
        <h2>Staff Details</h2>
        <h3>Name : {{ $user->name }}</h3><br>
        <label>IC Number : </label><label style="color: blue">{{ $user->icNumber }}</label><br><br>
        <label>Staff Role : </label><label style="color: blue">{{ $user->role }}</label><br><br>
        <label>Password : </label><label style="color: blue">{{ $user->password }}</label><br><br>
        <label>Gender : </label><label style="color: blue">{{ $user->gender }}</label><br><br>
        <label>Salary (RM) : </label><label style="color: blue">{{ $user->salary }}</label><br><br>
        <label>Phone no. : </label><label style="color: blue">{{ $user->mobile }}</label><br><br>
        <label>Email : </label><label style="color: blue">{{ $user->email }}</label><br><br>
        <label>Birthday : </label><label style="color: blue">{{ $user->birthday }}</label><br><br>
        <label>Address : </label><label style="color: blue">{{ $user->address }}</label><br><br>

        <button style="width: 100px; height: 28px;" onclick="history.back()">Go Back</button><br><br>
    </div>
</div>
