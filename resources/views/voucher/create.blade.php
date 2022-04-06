@extends('layout')
@section('content')
    <div class="container">
        <div class="upper-section">
            <h2>Create new Voucher</h2>
            <form id="addVoucher" method="POST" action="/voucher" enctype="multipart/form-data">
                @csrf
                <label for="code"> Code :</label> <input type="text" name="code" id="code" required class=" @error('name') is-invalid @enderror"> <input type="checkbox" id="generateCode" name="generateCode" value="1">  Code Generate <br> <br>

                {{--                @error('name')--}}
                {{--                <span class="invalid-feedback" role="alert">--}}
                {{--                    <strong>{{ $message }} </strong>--}}
                {{--                </span>--}}
                {{--                @enderror--}}

                <br>
                <label for="type">type :</label>
                <select name="type">
                    <option value="fixed">fixed</option>
                    <option value="percentage">percentage</option>
                </select> <br> <br>
                <br>

                <label for="value">Value :RM/%</label> <input name="value" id="value" required> <br> <br>
                <br>
                <label for="expireDate">expire Date :</label><input type="date" name="expireDate" value=""/> <br> <br>
                <br>
                <label for="isActive">Status</label>
                <select name="isActive" class="form-control @error('isActive') is-invalid @enderror" id="isActive">
                    <option value="1" {{old('isActive') === 1 ? 'selected': ''}}>Active</option>
                    <option value="0" {{old('isActive') === 0 ? 'selected': ''}}>Inactive</option>
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
                <button class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>

@endsection

