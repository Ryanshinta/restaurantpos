@extends('layout')
@section('content')
    <div class="container">
        <div class="upper-section">
            <h2>Create new Product</h2>
            <form id="NewProduct" method="post" action="{{url('product')}}" enctype="multipart/form-data">
                @csrf
                <label for="name">Product Name :</label> <input type="text" name="name" id="name" required class=" @error('name') is-invalid @enderror"> <br> <br>

{{--                @error('name')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                    <strong>{{ $message }} </strong>--}}
{{--                </span>--}}
{{--                @enderror--}}
                <br>
                <label for="image">Product Image :</label> <input type="file" name="image" id="image"  required> <br> <br>
                <br>
                <label for="price">Product Price :</label> <input pattern="^\d+(?:\.\d{1,2})?$" name="price" id="price" required> <br> <br>
                <br>
                <label for="description">Product Description :</label> <input type="text"  name="description" id="description" required> <br> <br>
                <br>
                <label for="status">Status</label>
                <select name="status" class="form-control @error('productStatus') is-invalid @enderror" id="status">
                    <option value="1" {{old('productStatus') === 1 ? 'selected': ''}}>Active</option>
                    <option value="0" {{old('productStatus') === 0 ? 'selected': ''}}>Inactive</option>
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
