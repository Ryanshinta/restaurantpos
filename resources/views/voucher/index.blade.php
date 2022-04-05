@extends('layout')
@section('content')
    <div class="container">
        <div class="upper-section">
            <h2>Voucher</h2>



            <a href="{{ url('/voucher/create') }}" title="Add New Voucher">
                <button class="btn btn-primary btn-sm"
                        style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i
                        aria-hidden="true"></i> Add New
                </button>
            </a>

            <table class="table">
                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>isActive</th>
                    <th>expireDate</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                @foreach($Vouchers as $voucher)
                    <tr>
                        <td>{{$voucher->code}}</td>
                        <td>{{$voucher->type}}</td>
                        @if($voucher->type == 'fixed')
                            <td>RM {{$voucher->value}}</td>
                        @else
                            <td>{{$voucher->value}} %</td>
                        @endif

                        @if($voucher->isActive == 1)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif
                        <td>{{$voucher->expireDate}}</td>
                        <td>{{$voucher->updated_at}}</td>
                        <td>{{$voucher->created_at}}</td>

                        <td>
                            <a href="#" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete"
                                    data-url="{{route('voucher.destroy',$voucher->code)}}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

