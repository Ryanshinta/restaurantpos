@extends('layout')
@section('content')
<div class="container">
    <div class="upper-section">
        <h2>Staffs</h2>
        <a href="{{ url('/user/create') }}" title="Add New Staff"><button class="btn btn-primary btn-sm" style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i aria-hidden="true"></i> Add New</button></a>
        <a href="{{ url('/userDisplay') }}" title="Filter Record"><button class="btn btn-primary btn-sm" style="margin-left: 10px; margin-top: 10px; height: 28px; width: 100px;"><i aria-hidden="true"></i> Search & Filter</button></a>
        <table class="table">
            <tr>
                <th>IC Number</th>
                <th>Name</th>
                <th>Role</th>
                <!--<th>Password</th>-->
                <!--<th>Gender</th>-->
                <th>Phone no.</th>
                <th>Email</th>
                <!--<th>Birthday</th>-->
                <!--<th>Address</th>-->
                <th>Edit/Delete</th>>
            </tr>
            <tbody>
                @foreach($users as $item)
                <tr>
                    <td>{{ $item->icNumber }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->role }}</td>
                    <!--<td>{{ $item->password }}</td>-->
                    <!--<td>{{ $item->gender }}</td>-->
                    <td>{{ $item->mobile }}</td>
                    <td>{{ $item->email }}</td>
                    <!--<td>{{ $item->birthday }}</td>-->
                    <!--<td>{{ $item->address }}</td>-->
                    <td>
                        <a href="{{ url('/user/' . $item->id) }}" title="View Student"><button style="height: 28px; width: 85px;" class="btn btn-info btn-sm"><i aria-hidden="true"></i> View</button></a>
                        <a href="{{ url('/user/' . $item->id . '/edit') }}" title="Edit Student"><button style="height: 28px; width: 85px;" class="btn btn-primary btn-sm"><i aria-hidden="true"></i> Edit</button></a>
{{--                        <form method="POST" action="{{ url('/user' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">--}}
{{--                            {{ method_field('DELETE') }}--}}
{{--                            {{ csrf_field() }}--}}
{{--                            <button type="submit" style="height: 28px; width: 85px;" class="btn btn-danger btn-sm" title="Delete Contact" onclick="return confirm( & quot; Confirm delete? & quot; )"><i aria-hidden="true"></i> Delete</button>--}}
{{--                        </form>--}}
                        <button class="btn btn-danger btn-delete"
                                data-url="{{route('user.destroy', $item)}}"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
