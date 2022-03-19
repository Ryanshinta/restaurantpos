@extends('layout')
@section('content')
<div class="container">
    <div class="upper-section">
        <h2>Update Account</h2>
        <form method="POST" action="{{ url('staff/' .$staffs->id) }}">
            {!! csrf_field() !!}
            @method("PATCH")
            <label>IC Number : </label><label style="color: blue">{{$staffs->icNumber}}</label><br><br>
            <label>Full Name : </label><input type="text" name="name" value="{{$staffs->name}}"/><br><br>
            <!--<span class="error"><?php // echo "* " . $nameError;    ?></span><br><br>-->

            <label>Position  : </label><select name="position" value="">
                <option value="{{$staffs->position}}" selected>{{$staffs->position}}</option>
                <option value="Waiter">Waiter</option>
                <option value="Chef">Chef</option>
                <option value="Manager">Manager</option>
                <option value="Admin">Admin</option>
            </select><br><br>

            <label>Password  : </label><input type="password" name="password" value="{{$staffs->password}}"/><br><br>
            <!--<span class="error"><?php // echo "* " . $passwordError;    ?></span><br><br>-->
            <label>Confirm Password  : </label><input type="password" name="c_password" value="{{$staffs->password}}"/><br><br>
            <!--<span class="error"><?php // echo "* " . $c_passwordError;    ?></span><br><br>-->

            <label>Gender    : </label><label style="color: blue">{{$staffs->gender}}</label><br><br>

            <label>Phone no. : </label><input type="tel" name="mobile" value="{{$staffs->mobile}}"/><br><br>
            <!--<span class="error"><?php // echo "* " . $mobileError;    ?></span><br><br>-->

            <label>Email     : </label><input type="email" name="email" value="{{$staffs->email}}"/><br><br>
            <label>Birthday  : </label><label style="color: blue">{{$staffs->birthday}}</label><br><br>
            <label>Address   : </label><input type="text" name="address" value="{{$staffs->address}}"/><br><br>

            <input style="width: 100px; height: 28px;" type="submit" name="update" value="Update"/>
            <button style="width: 100px; height: 28px;" onclick="history.back()">Back</button><br><br>
                <!--<span class="error"><?php // echo $error   ?></span>-->
        </form>
    </div>
</div>
@stop
