@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="upper-section">
            <h2>Update Voucher</h2>
            <form id="editVoucher" method="POST" action="{{route('voucher.update',['voucher' => $voucher->code])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label for="code"> Code :</label> <input type="text" name="code" value="{{old('code',$voucher->code)}}" id="code" readonly class=" @error('name') is-invalid @enderror"> <br> <br>
                <br>
                <label for="type">type :</label>
                <select name="type">
                    @if($voucher->type == 'fixed')
                        <option value="fixed" selected>fixed</option>
                        <option value="percentage">percentage</option>
                    @else
                        <option value="fixed" >fixed</option>
                        <option value="percentage" selected>percentage</option>
                    @endif
                </select> <br> <br>
                <br>

                <label for="value">Value :RM/%</label> <input name="value" id="value" value="{{old('code',$voucher->value)}}" required> <br> <br>
                <br>
                <label for="expireDate">expire Date :</label><input type="date" name="expireDate" value="{{ date('Y-m-d',strtotime($voucher->expireDate))}}"/> <br> <br>
                <br>
                <label for="isActive">Status</label>
                <select name="isActive" class="form-control @error('isActive') is-invalid @enderror" id="isActive">
                    <option value="1" {{old('isActive',$voucher->isActive) === 1 ? 'selected': ''}}>Active</option>
                    <option value="0" {{old('isActive',$voucher->isActive) === 0 ? 'selected': ''}}>Inactive</option>
                </select>
                @if ($errors->any())
                    <div>
                        @foreach($errors->all() as $error)
                            <li style="color: red;">
                                {{ $error }}
                            </li>
                        @endforeach
                    </div>
                @endif
                <br>
                <br>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection

