@extends('layouts.app')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="container">
        <div class="upper-section">
            <h2>Reservations</h2>
            <a href="{{ url('/reservations/create') }}" title="Add New Reservation">
                <button name="search" class="btn btn-primary btn-sm"
                        style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i
                        aria-hidden="true"></i> Add New
                </button>
            </a>

            <table class="table">
                <tr>
                    <th>Reservation ID</th>
                    <th>Date</th>
                    <th>Slot</th>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Phone no.</th>
                    <th>Table no.</th>
                    <th>Edit</th>
                </tr>
                <tbody>
                @foreach($reservations as $item)
                    <tr>
                        <td>{{ $item->reserveId }}</td>
                        <td>{{ $item->reserveDate }}</td>
                        <td>{{ $item->reserveSlot }}</td>
                        <td>{{ $item->reserveStatus }}</td>
                        {{--                    <!--<td>{{ $item->gender }}</td>-->--}}
                        {{--                    <!--<td>{{ $item->mobile }}</td>-->--}}
                        <td>{{ $item->custName }}</td>
                        <td>{{ $item->custMobile }}</td>
                        <td>{{ $item->tableNo }}</td>
                        {{--                    <!--<td>{{ $item->address }}</td>-->--}}
                        <td>
                            <a href="{{ url('/reservations/' . $item->reserveId) }}" title="View Reservation">
                                <button style="height: 28px; width: 85px;" class="btn btn-info btn-sm"><i
                                        aria-hidden="true"></i> View
                                </button>
                            </a>
                            @can('reservation-edit')
                                <a href="{{ url('/reservations/' . $item->reserveId . '/edit') }}"
                                   title="Edit Reservation">
                                    <button style="height: 28px; width: 85px;" class="btn btn-primary btn-sm"><i
                                            aria-hidden="true"></i> Edit
                                    </button>
                                </a>
                            @endcan
                            {{--                        <form method="POST" action="{{ url('/reservation' . '/' . $item->reserveId) }}" accept-charset="UTF-8" style="display:inline">--}}
                            {{--                            {{ method_field('DELETE') }}--}}
                            {{--                            {{ csrf_field() }}--}}
                            {{--                            <button type="submit" style="height: 28px; width: 85px;" class="btn btn-danger btn-sm" title="Delete Reservation" onclick="return confirm( & quot; Confirm delete? & quot; )"><i aria-hidden="true"></i> Delete</button>--}}
                            {{--                        </form>--}}
                            @can('reservation-delete')
                                <button class="btn btn-danger btn-delete" style="height: 28px; width: 85px;"
                                        data-url="{{route('reservations.destroy', $item->reserveId)}}"></i>Delete</button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
