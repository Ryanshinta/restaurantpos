@extends('layout')
@section('content')
<div class="container">
    <div class="upper-section">
        <h2>Update Table</h2>
        <form method="POST" action="{{ url('restauranttable/' .$restauranttables->id) }}">
            {!! csrf_field() !!}
            @method("PATCH")
            <label>Table No. : </label><input type="text" name="tableNo" value="{{$restauranttables->tableNo}}" required="true"/><br><br>

            <label>Max Seats : </label><input type="number" name="maxSeats" value="{{$restauranttables->maxSeats}}" required="true"/><br><br>
            <!--<span class="error"><?php // echo "* " . $reserveDateErr; ?></span><br><br>-->
            
            <label>Status  : </label><select name="tableStatus" value="">
                <option value="{{$restauranttables->tableStatus}}" selected>{{$restauranttables->tableStatus}}</option>
                <option value="Available">Available</option>
                <option value="Reserved">Reserved</option>
                <option value="Served">Served</option>
            </select><br><br>

            <input style="width: 100px; height: 28px;" type="submit" name="update" value="Update"/>
            <button style="width: 100px; height: 28px;" onclick="history.back()">Back</button><br><br>
                <!--<span class="error"><?php // echo $error   ?></span>-->
        </form>
    </div>
</div>
@stop
