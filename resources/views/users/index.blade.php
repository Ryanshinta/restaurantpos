@extends('layouts.app')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="container">
        <div class="upper-section">
            <h2>Staffs</h2>
            <a href="{{ url('/users/create') }}" title="Add New Staff">
                <button class="btn btn-primary btn-sm"
                        style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i
                        aria-hidden="true"></i> Add New
                </button>
            </a>
            <a href="{{ url('/userDisplay') }}" title="Filter Record">
                <button class="btn btn-primary btn-sm"
                        style="margin-left: 10px; margin-top: 10px; height: 28px; width: 100px;"><i
                        aria-hidden="true"></i> Search
                </button>
            </a>
            <table class="table">
                <tr>
                    <th>IC Number</th>
                    <th>Name</th>
                    <th>Role</th>
                    <!--<th>Password</th>-->
                    <!--<th>Gender</th>-->
                    <th>Phone no.</th>
                    <th>Email</th>
                    <th>Salary(RM)</th>
                    <!--<th>Address</th>-->
                    <th>Actions</th>
                </tr>
                <tbody>
                @foreach($users as $item)
                    <tr>
                        <td>{{ $item->icNumber }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->role }}</td>
{{--                    <!--<td>{{ $item->password }}</td>-->--}}
{{--                    <!--<td>{{ $item->gender }}</td>-->--}}
                        <td>{{ $item->mobile }}</td>
                        <td>{{ $item->email }}</td>
                    <td>{{ $item->salary }}</td>
{{--                    <!--<td>{{ $item->address }}</td>-->--}}
                        <td>
                            <a href="{{ url('/users/' . $item->id) }}" title="View Staff">
                                <button style="height: 28px; width: 85px;" class="btn btn-info btn-sm"><i
                                        aria-hidden="true"></i> View
                                </button>
                            </a>
                            <a href="{{ url('/users/' . $item->id . '/edit') }}" title="Edit Student">
                                <button style="height: 28px; width: 85px;" class="btn btn-primary btn-sm"><i
                                        aria-hidden="true"></i> Edit
                                </button>
                            </a>
                            <button class="btn btn-danger btn-delete" style="height: 28px; width: 85px;"
                                    data-url="{{route('users.destroy', $item->id)}}"><i
                                    aria-hidden="true"></i>Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
