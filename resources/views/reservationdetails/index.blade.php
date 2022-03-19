@extends('layout')
@section('content')
<div class="container">
    <div class="upper-section">
        <h2>Reservations</h2>
        <a href="{{ url('/restauranttable/create') }}" title="Add New Table"><button class="btn btn-primary btn-sm" style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i aria-hidden="true"></i> Add New</button></a>
        <table class="table">
            <tr>
                <th>Table No.</th>
                <th>Max Seats</th>
                <th>Edit</th>
            </tr>
            <tbody>
                @foreach($restauranttables as $item)
                <tr>
                    <td>{{ $item->tableNo }}</td>
                    <td>{{ $item->maxSeats }}</td>
                    <td>
                        <a href="{{ url('/restauranttable/' . $item->id) }}" title="View Table"><button style="height: 28px; width: 85px;" class="btn btn-info btn-sm"><i aria-hidden="true"></i> View</button></a>
                        <a href="{{ url('/restauranttable/' . $item->id . '/edit') }}" title="Edit Table"><button style="height: 28px; width: 85px;" class="btn btn-primary btn-sm"><i aria-hidden="true"></i> Edit</button></a>
                        <form method="POST" action="{{ url('/restauranttable' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" style="height: 28px; width: 85px;" class="btn btn-danger btn-sm" title="Delete Table" onclick="return confirm( & quot; Confirm delete? & quot; )"><i aria-hidden="true"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection