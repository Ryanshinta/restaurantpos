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
        <h2>Order ID : {{$order[0]->orderID}}</h2>
        <h2>Table : </h2>
        
        <table>


            <tr>
                <th >Product ID</th>
<!--                <th >Product Name</th>
                <th >Price</th>-->
                <th >Quantity</th>
                <th >Subtotal</th>
            </tr>

            <tbody>
                @foreach($order_details as $item)
                <tr>
                    <td>{{ $item->productID}}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->subtotal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <form>
            <table>
                <tr>
                    <td>Subtotal  :   {{$order[0]->ttlPrice}}</td>
                    <td></td>
                </tr>

                <tr>
                    <td>SST (10%) :   {{$order[0]->ttlPrice*0.1}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Voucher   :   </td>
                    <td>
                        <input type="text" maxlength="10" ><input type="submit" name="Apply">
                    </td>
                </tr>
                <tr>
                    <td>Total     :   {{$order[0]->ttlPrice*1.1 }}</td>
                    <td></td>
                </tr>
            </table>
        </form>



        <h5>Payment Method :</h5>
        <table class = 'paymentMethod'>
            <tr>
                <td>
                    <input type = 'radio' id = 'R1' name = 'cash' value = 'cash' ><label>Cash </label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type = 'radio' id = 'R1' name = 'creditCard' value = 'creditCard' ><label>Credit Card</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type = 'radio' id = 'R1' name = 'payment' value = 'Visa'><img src = 'images/Visa-Brand-Markvbm_blugrad01.jpg' alt = 'Visa'/>
                </td>
                <td>
                    <input type = 'radio' id = 'R2' name = 'payment' value = 'MasterCard'><img src = 'images/MasterCard_logo.jpg' alt = 'MasterCard' />
                </td>
                <td>
                    <input type = 'radio' id = 'R3' name = 'payment' value = 'UnionPay'><img src = 'images/unionpay.png' alt = 'UnionPay'/>
                </td>
            </tr>
        </table>

        <form>
            <input type="submit" name="pay" value="PAY">
        </form>

    </div>
</div>
<?php
// put your code here
?>
@endsection
