@extends('layout')
@section('content')
<div class="container">
    <div class="upper-section">
        <h2>Staffs</h2>
        <a href="{{ url('/staff/create') }}" title="Add New Staff"><button class="btn btn-primary btn-sm" style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i aria-hidden="true"></i> Add New</button></a>
        <a href="{{ url('/staffDisplay') }}" title="Filter Record"><button class="btn btn-primary btn-sm" style="margin-left: 10px; margin-top: 10px; height: 28px; width: 100px;"><i aria-hidden="true"></i> Search & Filter</button></a>
        <table class="table">
            <tr>
                <th>IC Number</th>
                <th>Name</th>
                <th>Position</th>
                <!--<th>Password</th>-->
                <!--<th>Gender</th>-->
                <th>Phone no.</th>
                <!--<th>Email</th>-->
                <!--<th>Birthday</th>-->
                <!--<th>Address</th>-->
                <th>Edit/Delete</th>>
            </tr>
            <tbody>
                @foreach($staffs as $item)
                <tr>
                    <td>{{ $item->icNumber }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->position }}</td>
                    <!--<td>{{ $item->password }}</td>-->
                    <!--<td>{{ $item->gender }}</td>-->
                    <td>{{ $item->mobile }}</td>
                    <!--<td>{{ $item->email }}</td>-->
                    <!--<td>{{ $item->birthday }}</td>-->
                    <!--<td>{{ $item->address }}</td>-->
                    <td>
                        <a href="{{ url('/staff/' . $item->id) }}" title="View Student"><button style="height: 28px; width: 85px;" class="btn btn-info btn-sm"><i aria-hidden="true"></i> View</button></a>
                        <a href="{{ url('/staff/' . $item->id . '/edit') }}" title="Edit Student"><button style="height: 28px; width: 85px;" class="btn btn-primary btn-sm"><i aria-hidden="true"></i> Edit</button></a>
                        <form method="POST" action="{{ url('/staff' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" style="height: 28px; width: 85px;" class="btn btn-danger btn-sm" title="Delete Contact" onclick="return confirm( & quot; Confirm delete? & quot; )"><i aria-hidden="true"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
