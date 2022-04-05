@extends('layout')
@section('content')
<div class="container">
    <div class="upper-section">
        <h2>Update Table</h2>
        <form method="POST" action="{{ url('restaurantTable/' .$restauranttables->tableNo) }}">
            {!! csrf_field() !!}
            @method("PATCH")
            <h3>Table No. : {{ $restauranttables->tableNo }}</h3><br>

            <label>Table Type : </label>
            <select name="tableType" id="tableType" value="{{$restauranttables->tableType}}">
                <option value="1" {{old('tableType') === 1 ? 'selected': ''}}>Indoor</option>
                <option value="2" {{old('tableType') === 2 ? 'selected': ''}}>Outdoor</option>
            </select>
            <br><br>

            <label>Max Seats : </label><input type="number" name="maxSeats" value="{{$restauranttables->maxSeats}}" required="true" max="12" min="1"/><br><br>
            <!--<span class="error"><?php // echo "* " . $reserveDateErr;    ?></span><br><br>-->

            <label>Status  : </label><select name="tableStatus" value="{{$restauranttables->tableStatus}}">
                <option value="Available">Available</option>
                <option value="Reserved">Reserved</option>
                <option value="Served">Served</option>
            </select><br><br>

            <label>Created At : </label><label style="color: blue">{{ $restauranttables->created_at }}</label><br><br>
            <label>Updated At : </label><label style="color: blue">{{ $restauranttables->updated_at }}</label><br><br>


            <input style="width: 100px; height: 28px;" type="submit" name="update" value="Update"/>

        </form>

        <button style="width: 100px; height: 28px;" onclick="history.back()">Back</button><br><br>
    </div>
</div>
@stop
