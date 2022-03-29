@extends('layout')
@section('content')
<div class="container">
    <div class="upper-section">
        <h2>Reservations</h2>
        <a href="{{ url('/reservation/create') }}" title="Add New Reservation"><button class="btn btn-primary btn-sm" style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i aria-hidden="true"></i> Add New</button></a>
        <table class="table">
            <tr>
                <th>Reservation ID</th>
                <th>Date</th>
                <th>Slot</th>
                <th>Status</th>
<!--                <th>Total table</th>
                <th>Total Seats</th>-->
                <th>Name</th>
                <th>Phone no.</th>
                <th>Edit</th>
            </tr>
            <tbody>
                @foreach($reservations as $item)
                <tr>
                    <td>{{ $item->reserveId }}</td>
                    <td>{{ $item->reserveDate }}</td>
                    <td>{{ $item->reserveSlot }}</td>
                    <td>{{ $item->reserveStatus }}</td>
                    <!--<td>{{ $item->gender }}</td>-->
                    <!--<td>{{ $item->mobile }}</td>-->
                    <td>{{ $item->custName }}</td>
                    <td>{{ $item->custMobile }}</td>
                    <!--<td>{{ $item->address }}</td>-->
                    <td>
                        <a href="{{ url('/reservation/' . $item->reserveId) }}" title="View Reservation"><button style="height: 28px; width: 85px;" class="btn btn-info btn-sm"><i aria-hidden="true"></i> View</button></a>
                        <a href="{{ url('/reservation/' . $item->reserveId . '/edit') }}" title="Edit Reservation"><button style="height: 28px; width: 85px;" class="btn btn-primary btn-sm"><i aria-hidden="true"></i> Edit</button></a>
{{--                        <form method="POST" action="{{ url('/reservation' . '/' . $item->reserveId) }}" accept-charset="UTF-8" style="display:inline">--}}
{{--                            {{ method_field('DELETE') }}--}}
{{--                            {{ csrf_field() }}--}}
{{--                            <button type="submit" style="height: 28px; width: 85px;" class="btn btn-danger btn-sm" title="Delete Reservation" onclick="return confirm( & quot; Confirm delete? & quot; )"><i aria-hidden="true"></i> Delete</button>--}}
{{--                        </form>--}}
                        <button class="btn btn-danger btn-delete"
                                data-url="{{route('reservation.destroy', $item)}}"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
