@extends('layout')
@section('content')
<div class="container">
    <div class="upper-section">

        <h2>Kitchen</h2>
        <table>
            <tr>
                <th>Orders </th>

            </tr>

            @foreach($orders as $data)
            <tr>
                <td>
                    <div class="item">
                        <a class="sub-btn" style="width: 100%;"><pre>Order ID :  {{$data->id}}                                                                                    Table No.                                                                                           Status :   {{$data->status}}          <i class="fas fa-angle-right dropdown"></i></pre></a>
                        
                        <div class="sub-menu" style="background-color: #CBD5E0;">

                            @foreach($orders_list as $item)
                            <?php
                            if ($item->order_id == $data->id) {
                                ?>


                                    @foreach($products as $product)
                                <?php
                                if ($product->id == $item->product_id) {
                                    ?>
                                                <form method="post" action="{{ route('kitchen.update',$data->id) }}">
          {{ csrf_field() }}
        {{ method_field('PUT') }}
                                            <img src='{{ Storage::url($product->image) }}' width='150px' height="100px" style="margin-left: 2%; margin-right:10%;"/>
                                            <label style="margin-right:25%;">{{ $product->name}}</label>
                                            <label style="margin-right:25%;">{{$item->quantity}}</label>
                                            <label>Status : </label>
                                            
                                            <select name="status" id="tableType">
                                                <option value="Preparing" {{old('status',$item->status) === 'Preparing' ? 'selected': ''}}>Preparing</option>
                                                <option value="Cooking" {{old('status',$item->status) === 'Cooking' ? 'selected': ''}}>Cooking</option>
                                                <option value="Served" {{old('status',$item->status) === 'Served' ? 'selected': ''}}>Served</option>
                                            </select>
                                            <input type="hidden" name="detailid" value="{{$item->id}}">
                                            <input type="submit" name="ChgStatus" value="Update">
                                            <br>
                                            <hr>
                                             </form>

                                    <?php
                                }
                                ?>

                                    @endforeach


                                <?php
                            }
                            ?>
                            @endforeach
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach

        </table>




    </div>
</div>

@endsection