@extends('layout')
@section('content')
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="container">
    <div class="upper-section">
        <!-- Modal content -->
        <form id="NewProduct" method="post" action="{{url('payment')}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <?php
                if ($_POST['payment'] == 'Visa' || $_POST['payment'] == 'MasterCard') {
                    ?>

                <label>Credit Card No : </label><input type = "text" class = "card" placeholder="xxx"><br><br>
                    <?php
                }
                ?>
                <label>Order Total  :   <strong>RM {{$_POST['total']}}</strong></label><br><br>


                <label>Pay          :   </label><input value="<?php
                if ($_POST['payment'] == 'Visa' || $_POST['payment'] == 'MasterCard') {
                    echo $_POST['total'];
                }
                ?>" type="number" name="pay" id="pay" min="{{$_POST['total']}}" step=".01" 
                                                       <?php
                                                       if ($_POST['payment'] == 'Visa' || $_POST['payment'] == 'MasterCard') {
                                                           echo "disabled";
                                                       }
                                                       ?>
                                                       ><br><br>
                <input type="hidden" name="total" value="{{$_POST['total'] }}">
                <input type="hidden" name="orderid" value="{{$_POST['orderid'] }}">
                <input type="hidden" name="tax" value="{{$_POST['tax'] }}">
                <input type="hidden" name="discount" value="{{$_POST['discount'] }}">
                <input type="hidden" name="voucher" value="{{$_POST['voucher'] }}">

                <input type="submit" value='pay' name="pay">
            </div>
        </form>



    </div>
</div>
<?php
// put your code here
?>


<script>
    .modal {
    display: block; /* Hidden by default */
    position: fixed; /* Stay in place */
    z - index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100 % ; /* Full width */
    height: 100 % ; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background - color: rgb(0, 0, 0); /* Fallback color */
    background - color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal - content {
    background - color: #fefefe;
    margin: 15 % auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 60 % ; /* Could be more or less, depending on screen size */
    }
</script>

@endsection