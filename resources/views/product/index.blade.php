@extends('layout')
@section('content')
    <div class="container">
        <div class="upper-section">
            <h2>Product</h2>
            <a href="{{ url('/product/create') }}" title="Add New Product"><button class="btn btn-primary btn-sm" style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i aria-hidden="true"></i> Add New</button></a>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>
                            <img src="{{ Storage::url($product->image) }}" alt="" width="100">
                        </td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->description}}</td>
                        <td>
                        <span
                            class="right badge badge-{{ $product->status ? 'success' : 'danger' }}">{{$product->status ? 'Active' : 'Inactive'}}</span>
                        </td>
                        <td>{{$product->created_at}}</td>
                        <td>{{$product->updated_at}}</td>
                        <td>
{{--                            <a href="{{ route('product.edit', $product) }}" class="btn btn-primary"><i--}}

                          <a href="#" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete" data-url="{{route('product.destroy', $product)}}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"> </script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-delete', function () {
                $this = $(this);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to delete this product?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                            $this.closest('tr').fadeOut(500, function () {
                                $(this).remove();
                            })
                        })
                    }
                })
            })
        })
    </script>
@endsection
