@extends('layouts.app')
@section('content')

<div class="container">
    <div class="upper-section">
        <h2>Cart ({{ count((array) session('cart')) }})</h2>
        <table class="table">
            <tbody>
                <div className="row">
                    <div className="col-smd-6 col-lg-4">
                        <div className="row mb-2">
                        </div>
                        <div className="card">
                            <a href="{{ url('orders/add') }}" title="Add New Product">
                                <button class="btn btn-primary btn-sm" style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i aria-hidden="true"></i>Add Product</button></a>
                            <a href="{{ url('/showOrder') }}" title="Show Order">
                                <button class="btn btn-primary btn-sm" style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i aria-hidden="true"></i> Show Order</button></a>
                            @if (session('success'))
                            <div>{{ session('success') }}</div>
                            @endif
                            <table className="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php $total = 0 @endphp
                                @foreach((array) session('cart') as $id => $item)
                                @php $total += $item['price'] * $item['quantity'] @endphp
                                @endforeach
                                <tbody>
                                    @if(session('cart'))
                                    @foreach(session('cart') as $id => $item)
                                    <tr data-id="{{$id}}">
                                        <td>{{ $item['name'] }}</td>
                                        <td><img src="{{ Storage::url($item['image']) }}" width="100px" /></td>
                                        <td data-th="Price">RM{{ $item['price'] }}</td>
                                        <td data-th="Quantity">
                                            <input type="number" value="{{ $item['quantity'] }}" class="form-control quantity update-cart" />
                                        </td>
                                        <td data-th="Subtotal" class="text-center">RM{{ $item['price'] * $item['quantity'] }}</td>
                                        <td class="actions">
                                            <form method="POST" action="{{ url('remove-from-cart') }}" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$id}}">
                                                <button type="submit" style="height: 28px; width: 85px;" class="btn btn-danger btn-sm" title="Delete Product"><i aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div className="row">
                                <div className="col">Total:RM{{ $total }}</div>
                                <div className="col text-right"></div>
                            </div>
                            <div className="col">
                                <a href="{{ url('orders/create') }}">
                                    <button type="submit" name="submit" class="btn btn-primary btn-sm" style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i aria-hidden="true">Submit</a>
                                <?php if (isset($_GET['submit'])) {
                                    $doc = new \DOMDocument();
                                    $doc->preserveWhiteSpace = false;
                                    $doc->load('xml/orderDetails.xml');
                                    $xpath = new \DOMXPath($doc);
                                    $x_ID = $_GET['ID'];
                                    $x_Status = $_GET['status'];
                                    $x_totalprice = $_GET['total_price'];
                                    $x_createdAt = $_GET['created_at'];
                                    $x_updatedAt = $_GET['updated_at'];
                                    $query = "//orders/order[id[(contains(text(),'$x_id'))]
                                    and status[(contains(text(),'$x_Status'))]
                                    and total_price[(contains(text(),'$x_totalprice'))] 
                                    and created_at[(contains(text(),'$x_createdAt'))]
                                    and updated_at[(contains(text(),'$x_updatedAt'))]]";
                                    $entries = $xpath->query($query);
                                ?>
                                    <table class="table">
                                        <tr>
                                            <td>ID</td>
                                            <td>Status</td>
                                            <td>totalPrice</td>
                                            <td>createdAt</td>
                                            <td>updatedAt</td>
                                        </tr>
                                        <tbody>
                                            @foreach($entries as $entry)
                                            <tr>
                                                <td>{{ $entry->nodeValue }}</td>
                                                <td>{{ $entry->nextSibling->nextSibling->nodeValue }}</td>
                                                <td>{{ $entry->nextSibling->nextSibling->nextSibling->nodeValue }}</td>
                                                <td>{{ $entry->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nodeValue }}</td>
                                                <td>{{ $entry->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nodeValue }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table><br><br><?php } ?>

                                <button class="btn btn-primary btn-sm" style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i aria-hidden="true"></i> Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </tbody>
    </table>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(".update-cart").change(function(e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: "{{ route('update.cart') }}",
            method: "post",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function(response) {
                window.location.reload();
            }
        });
    });
</script>
@endsection