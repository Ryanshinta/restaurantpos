@extends('layouts.app')
@section('content')
<div class="container">
    <div class="upper-section">

        <form id="reservation-form" method="POST" action="{{ url('reservations/addTable') }}">
            {!! csrf_field() !!}
            <h2>Select Table</h2>
            <div id="table-list">
                <p>Please select {{ $n }} tables with {{ $t }} seats for :<input type="text" name="reserveId" value="{{ $r }}" readonly="true"> </p><br>
                <table class="table" style="width: 30%; margin-bottom: 15px;">
                    <tr style="background-color: gainsboro;">
                        <th>Table No.</th>
                        <th>Max Seats</th>
                        <th>Select</th>
                    </tr>
                    <tbody>
                        @foreach($restauranttables as $item)
                        <tr>
                            <td>{{ $item->tableNo }}</td>
                            <td>{{ $item->maxSeats }}</td>
                            <td>
                                <input type="checkbox" name="tableNo[]" value="{{ $item->tableNo }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <input style="width:100px; height: 28px;" type="submit" name="submit" value="Add"/>
                <button style="width: 100px; height: 28px;" ><a style="color: black; text-decoration: none; " href="javascript:history.back()"><i aria-hidden="true"></i> Back</a></button><br><br>

            </div>
        </form>
    </div>
</div>
@endsection
