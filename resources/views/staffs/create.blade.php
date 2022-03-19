@extends('layout')
@section('content')
<div class="container">
    <div class="upper-section">
        <h2>Register Account</h2>
        <form id="register-form" method="POST" action="{{ url('staff') }}">
            {!! csrf_field() !!}
            <label>IC Number : </label><input type="text" name="icNumber" id="icNumber" value="" placeholder="xxxxxx-xx-xxxx" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $icNumberError;      ?></span><br><br>-->

            <label>Full Name : </label><input type="text" name="name" value="" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $nameError;      ?></span><br><br>-->

            <label>Position  : </label><select name="position" value="" required="true">
                <option value="Waiter">Waiter</option>
                <option value="Chef">Chef</option>
                <option value="Manager">Manager</option>
                <option value="Admin">Admin</option>
            </select><br><br>

            <label>Enter Password  : </label><input type="password" name="password" value="" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $passwordError;      ?></span><br><br>-->

            <label>Confirm Password  : </label><input type="password" name="c_password" value="" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $c_passwordError;      ?></span><br><br>-->

            <label>Gender    : </label><input type="radio" name="gender" value="Female" required/>Female
            <input type="radio" name="gender" value="Male"/>Male<br><br>
            <!--<span class="error"><?php // echo "* " . $genderError;      ?></span><br><br>-->

            <label>Phone no. : </label><input type="tel" name="mobile" value="" placeholder="xxx-xxxxxxx" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $mobileError;      ?></span><br><br>-->

            <label>Email     : </label><input type="text" name="email" value="" placeholder="example@email.com"/><br><br>
            <!--<span class="error"><?php // echo $emailErr;      ?></span><br><br>-->

            <label>Birthday  : </label><input type="date" name="birthday" value=""/><br><br>

            <label>Address   : </label><input type="text" name="address" value=""/><br><br>

            <input style="width:100px; height: 28px;" type="submit" name="submit" value="Add"/>
            <button style="width: 100px; height: 28px;" ><a style="color: black; text-decoration: none; " href="javascript:history.back()"><i aria-hidden="true"></i> Back</a></button><br><br>
                <!--<span class="error"><?php // echo $error      ?></span>-->
            @if ($errors->any())
            <div>
                @foreach($errors->all() as $error)
                <li style="color: red;">
                    {{ $error }}
                </li>
                @endforeach
            </div>
            @endif
        </form>
    </div>
</div>
@stop