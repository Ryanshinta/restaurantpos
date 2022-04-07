@extends('layouts.app')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="container">
        <div class="upper-section">
            <h2>Role Management</h2>
            @can('role-create')
                <a href="{{ route('roles.create') }}" title="Add New Staff">
                    <button class="btn btn-primary btn-sm"
                            style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i
                            aria-hidden="true"></i> Add New
                    </button>
                </a>
            @endcan
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('roles.show',$role->id) }}" title="View">
                                <button style="height: 28px; width: 85px;" class="btn btn-info btn-sm"><i
                                        aria-hidden="true"></i> View
                                </button>
                            </a>
                            @can('role-edit')
                                <a href="{{ route('roles.edit',$role->id) }}" title="Edit">
                                    <button style="height: 28px; width: 85px;" class="btn btn-primary btn-sm"><i
                                            aria-hidden="true"></i> Edit
                                    </button>
                                </a>
                            @endcan
                            @can('role-delete')
                                <a href="{{ route('roles.destroy',$role->id) }}" title="Delete">
                                    <button style="height: 28px; width: 85px;" class="btn btn-danger btn-delete"><i
                                            aria-hidden="true"></i> Delete
                                    </button>
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    {!! $roles->render() !!}
@endsection
