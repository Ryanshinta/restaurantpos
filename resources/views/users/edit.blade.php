@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="upper-section">
            <h2>Update Account</h2>
            <form method="POST" action="{{ url('users/' .$users->id) }}">
                {!! csrf_field() !!}
                @method("PATCH")
                <div class="left" style="float: left; width: 50%;">
                    <label>IC Number : </label><label style="color: blue">{{$users->icNumber}}</label><br><br>
                    <label>Full Name : </label><input type="text" name="name" value="{{$users->name}}"/><br><br>
                <!--<span class="error"><?php // echo "* " . $nameError;    ?></span><br><br>-->

                    <label>Staff Role : </label><select name="role" value="">
                        <option value="{{$users->role}}" selected>{{$users->role}}</option>
                        <option value="Waiter">Waiter</option>
                        <option value="Chef">Chef</option>
                        <option value="Manager">Manager</option>
                        <option value="Admin">Admin</option>
                    </select><br><br>

                    <label>Password : </label><input type="password" name="password"
                                                     value="{{$users->password}}"/><br><br>
                <!--<span class="error"><?php // echo "* " . $passwordError;    ?></span><br><br>-->
                    <label>Confirm Password : </label><input type="password" name="c_password"
                                                             value="{{$users->password}}"/><br><br>
                <!--<span class="error"><?php // echo "* " . $c_passwordError;    ?></span><br><br>-->

                    <label>Gender : </label><label style="color: blue">{{$users->gender}}</label><br><br>

                    <label>Phone no. : </label><input type="tel" name="mobile" value="{{$users->mobile}}"/><br><br>
                <!--<span class="error"><?php // echo "* " . $mobileError;    ?></span><br><br>-->

                    <label>Email : </label><input type="email" name="email" value="{{$users->email}}"/><br><br>
                    <label>Birthday : </label><label style="color: blue">{{$users->birthday}}</label><br><br>
                    <label>Address : </label><input type="text" name="address" value="{{$users->address}}"/><br><br>
                </div>
                <h2>Calculate Salary</h2>
                <div class="right" style="">
                    <label>Base Salary : </label><input type="number" name="base" value=""/><br><br>
                    <label>Deduction : </label><input type="number" name="deduction" value=""/><br><br>
                    <label>Over Time : </label><input type="number" name="overTime" value=""><br><br>
                    <label>Bonus Rate : </label><input type="number" name="bonusRate" value=""/><br><br>
                    <label>Total (RM) : </label><input style="color: blue" value="{{$user->salary}}"/><br><br>
                </div>
                <input style="width: 100px; height: 28px;" type="submit" name="update" value="Update"/>
                <a href="{{ url('/users') }}" title="Back">
                    <button class="btn btn-primary btn-sm"
                            style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i
                            aria-hidden="true"></i> Back
                    </button>
                </a>
            </form>
        </div>
    </div>
@stop
