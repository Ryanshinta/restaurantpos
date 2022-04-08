@extends('layout')


@section('content')

<?php

use App\Http\Controllers\PaymentController;
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="container">
    <div class="upper-section">
        @method("PATCH")
        <h2>Order ID : {{$orders[0]->id}}</h2>
        <h2>Table : </h2>

        <table style="">


            <tr>
                <th>Product Image</th>
                <th >Product ID</th>
<!--                <th >Product Name</th>
                <th >Price</th>-->
                <th >Quantity</th>
                <th >Subtotal</th>
            </tr>

            <tbody>
                @foreach($orders_list as $item)
                <tr>
                    @foreach($products as $product)
                    <?php
                    if ($product->id == $item->product_id) {
                        ?>
                        <td style="width: 20%;"><img src='{{ Storage::url($product->image) }}' width='150px' height="100px"/></td>
                        <td>{{ $product->name}}</td>
                        <?php
                    }
                    ?>

                    @endforeach

                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->subtotal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <form id="checkVoucher" method="get" enctype="multipart/form-data">
            @csrf

            <h4>Voucher</h4>
            <table style="width:40%;">
                <tr>
                    <td>
                        <label style="padding-right:15px;">Enter Voucher Code :       </label>
                        <input type="text" id="voucher" name="voucher" />
                        <button class="btn btn-primary btn-sm"
                                style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;">
                            Use
                        </button>
                        <?php
                        $checkVoucher=0;
                        $code = null;
                        if ($_SERVER["REQUEST_METHOD"] == "GET") {
                            $bool = false;

                            if (!empty($_GET['voucher'])) {
                                $checkVoucher = $_GET['voucher'];

                                foreach ($voucher as $data) {
                                    if ($checkVoucher == $data->code) {
                                        $checkVoucher = $data;
                                        $code = $data->id;
                                        $bool = true;
                                    }
                                }
                                echo '<br>';
                                if ($bool == false) {
                                    $checkVoucher = 0;
                                    echo "Voucher Code Not Found !!";
                                } else {
                                    echo "Voucher Applied";
                                }
                            }
                        }
                        ?>

                    </td>
                </tr>
            </table>
        </form>





        <h4>Payment Details</h4>
        <table style="width:40%;">
            <tr>
                <td>Subtotal  :   </td>
                <td>RM {{$orders[0]->total_price}}</td>
            </tr>

            <tr>
                <td>SST (10%) :   </td>
                <td>RM {{$orders[0]->total_price *0.1}}</td>
            </tr>
            <tr>
                <td>Voucher   :   </td>
                <td> (-)RM 
                    <?php
                    $tax = $orders[0]->total_price * 0.1;
                    $deduc = 0;
                    if (!empty($checkVoucher)) {
                        if ($checkVoucher->type == 'percentage') {
                            $rate = $checkVoucher->value / 100;
                            $deduc = $orders[0]->total_price * $rate;
                            echo $deduc . "(" . $checkVoucher->value . "%)";
                        } else {
                            $deduc = $checkVoucher->value;
                            echo $deduc;
                        }
                    } else {
                        echo $deduc;
                    }
                    ?>
                </td>

            </tr>
            <tr>
                <td>Total     :   </td>
                <td>RM {{$orders[0]->total_price  + $tax - $deduc }}</td>
            </tr>
        </table>

        <form id="checkVoucher" method="post" action="{{ url('/payment/create', $orders[0]->id) }}" enctype="multipart/form-data">

            @csrf
            <h4>Payment Method :</h4>

            <table class = 'paymentMethod' >
                <tr>

                    <td>
                        <input type = 'radio' id = 'R1' name = 'payment' value = 'Cash' ><label style="padding-left:10px;">Cash </label>
                    </td>

                    <td>
                        <input  type = 'radio' id = 'R3' name = 'payment' value = 'Visa'><img src = 'images/Visa-Brand-Markvbm_blugrad01.jpg' alt = 'Visa'/>
                    </td>
                    <td>
                        <input  type = 'radio' id = 'R4' name = 'payment' value = 'MasterCard'><img src = 'images/MasterCard_logo.jpg' alt = 'MasterCard' />
                        <input type="hidden" name="total" value="{{$orders[0]->total_price + $tax - $deduc }}">
                        <input type="hidden" name="orderid" value="{{$orders[0]->id }}">
                        <input type="hidden" name="tax" value="{{$tax }}">
                        <input type="hidden" name="discount" value="{{$deduc }}">
                        <input type="hidden" name="voucher" value="{{$code }}">
                        
                        
                    </td>
                </tr>
            </table>
            <input id="myBtn" type="submit" name="pay" value="create">
        </form>




    </div>


</div>




<style>
    td, th{
        text-align: center !important;
    }

    .modal {
        display: none;/* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 60%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


</script>
<?php
// put your code here
?>
@endsection