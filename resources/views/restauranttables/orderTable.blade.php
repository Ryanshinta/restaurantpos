@extends('layout')
@section('content')
<div class="container">
    <div class="upper-section">

        <h2>Order Tables</h2>

        <table class="table">
            <tr>
                <th>Table No.</th>
                <th>Type</th>
                <th>Max Seats</th>
                <th>Status</th>
                <th>Select</th>
            </tr>
            <tbody>
                @foreach($restauranttables as $item)
                <tr>
                    <td>{{ $item->tableNo }}</td>
                    <td>
                        <span class="right badge badge-{{ $item->tableType ? 'success' : 'danger' }}">
                            {{$item->tableType==1 ? 'Indoor' : 'Outdoor'}}
                        </span>
                    </td>
                    <td>{{ $item->maxSeats }}</td>
                    <td>{{ $item->tableStatus }}</td>


                    <td>


                        <form method="POST" action="{{ url('/orderUpdate') }}" accept-charset="UTF-8" style="display:inline">

                            {!! csrf_field() !!}
                            <input type="hidden" value="{{ $item->tableNo }}" name="tableNo">
                            <button type="submit" style="height: 28px; width: 85px;" class="btn btn-danger btn-sm" title="Select Table" ><i aria-hidden="true"></i> Select</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <!--        <div >
                    <h2>Restaurant Name</h2>
                    <table class="tableMap">
                        <tr class="tableRow">
                            <td><a href="Home.php">01</a></td>
                            <td><a href="Home.php">01</a></td>
                        </tr>
                    </table>
        
                </div>-->
    </div>
</div>


@endsection