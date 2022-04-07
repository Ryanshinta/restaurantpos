@extends('layouts.app')
@section('content')
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
                @foreach($order__details as $item)
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

                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <form >
            @csrf

            <h4>Voucher</h4>
            <table style="width:40%;">
                <tr>
                    <td>
                        <label style="padding-right:15px;">Enter Voucher Code :       </label>
                        <input type="text" id="voucher" name="voucher" />
                        <button  class="btn btn-primary btn-sm"style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;">
                            Use
                        </button>
                    </td>
                </tr>
            </table>
        </form>

        <h4>Payment Details</h4>
        <table style="width:40%;">
            <tr>
                <td>Subtotal  :   </td>
                <td></td>
            </tr>

            <tr>
                <td>SST (10%) :   </td>
                <td></td>
            </tr>
            <tr>
                <td>Voucher   :   </td>
                <td> RM 0</td>
            </tr>
            <tr>
                <td>Total     :  </td>
                <td></td>
            </tr>
        </table>



        <h4>Payment Method :</h4>

        <table class = 'paymentMethod'>
            <tr>

                <td>
                    <input  name="credit" type = 'radio' id = 'R1' name = 'payment' value = 'Cash' ><label style="padding-left:10px;">Cash </label>
                </td>

                <td>
                    <input name="credit"  type = 'radio' id = 'R3' name = 'payment' value = 'Visa'><img src = 'images/Visa-Brand-Markvbm_blugrad01.jpg' alt = 'Visa'/>
                </td>
                <td>
                    <input  name="credit"  type = 'radio' id = 'R4' name = 'payment' value = 'MasterCard'><img src = 'images/MasterCard_logo.jpg' alt = 'MasterCard' />
                </td>
            </tr>
        </table>


        <div id="showCard" style="display:none;">
            <label>Credit Card No   : </label><input type="text" class="card">
        </div>

        <input id="myBtn" type="submit" name="pay" value="PAY">


        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <label>Order Total  :   <strong>RM 900</strong></label><br><br>
                <label>Pay          :   </label><input type="number" id="pay" min="0" step=".01" required><br><br>
                <label>Balance  :   <strong>RM 900</strong></label><br><br>
            </div>

        </div>
    </div>

</div>




<style>
    td, th{
        text-align: center !important;
    }

    .modal {
        display: none; /* Hidden by default */
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
