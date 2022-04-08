@extends('layout')
@section('content')

<div class="container">
    <div class="upper-section">
        <h2>Table Information</h2>
        <form id="register-form" method="get" action="">
            <h3>Filters to search</h3><br>
            <label>Table Status : </label>
            <select name="tablestatus" id="tableType">
                <option value="">--Choose one--</option>
                <option value="1" >Available</option>
                <option value="2" >Served</option>
                <option value="3" >Reserved</option>
            </select><br><br>
            
            
            <label>Table Type : </label>
            <select name="tableType" id="tableType">
                <option value="">--Choose one--</option>
                <option value="1" >Indoor</option>
                <option value="2" >Outdoor</option>
            </select><br><br>
            <label>Max Seats : <input type="number" name="maxSeats" ><br><br>
            <label>Order ID : </label><input type="number" name="orderid" ><br><br>
            <input style="width:100px; height: 28px;" type="submit" name="submit" value="Search"/><br><br>
            <?php
            if (isset($_GET['submit'])) {
                $doc = new \DOMDocument();
                $doc->preserveWhiteSpace = false;
                $doc->load('xml/TableInfo.xml');
                $xpath = new \DOMXPath($doc);
                $x_status = $_GET['tablestatus'];
                $x_type = $_GET['tableType'];
                $x_seats = $_GET['maxSeats'];
                $x_orderid = $_GET['orderid'];
                $query = "//tables/table
                [
                    tableStatus[(contains(text(),'$x_status'))]
                and tableType[(contains(text(),'$x_type'))]
                and maxSeats[(contains(text(),'$x_seats'))]
                and orderID[(contains(text(),'$x_orderid'))]/tableStatus";
                
                $entries = $xpath->query($query);
                ?>
                <table class="table">
                    <tr>
                        <td>Table Status</td>
                        <td>Table Type</td>
                        <td>Max Seats</td>
                        <td>Order ID</td>
                        <td>Date Created</td>
                    </tr>
                    <tbody>
                        @foreach($entries as $entry)
                        <tr>
                            <td>{{ $entry->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nextSibling->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nextSibling->nextSibling->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nextSibling->nextSibling->nextSibling->nodeValue }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table><br><br><?php } ?>

            <h3>Select sorting element</h3><br>
            
            <label>Sort By : </label><select name="sortElement" value="">
                <option value="-">--Choose one--</option>
                <option value="Table Status">Table Status</option>
                <option value="Table Type">Table Type</option>
                <option value="Max Seats">Max Seats</option>
                <option value="Order ID">Order ID</option>
                <option value="Date Created">Date Created</option>
            </select><br><br>
            <label>All the Tables record is sorted by : <?php
                if (isset($_GET['sort'])) {
                    echo $_GET['sortElement'];
                };
                ?></label><br><br>

            <input style="width:100px; height: 28px;" type="submit" name="sort" value="Sort"/>
            <button style="width: 100px; height: 28px;"><a style="color: black; text-decoration: none; "
                                                           href="javascript:history.back()"><i
                        aria-hidden="true"></i> Back</a></button>
            <br><br>
        </form>
    </div>
    <?php
    if (!isset($_GET['sort'])) {
        echo "No record being sort";
        echo "<br><br>";
    };
    ?>
</div>
<?php
//sort function
if (isset($_GET['sort'])) {
    $value = $_GET['sortElement'];

    $xml = new \DOMDocument();
    $xml->load('xml/TableInfo.xml');

    $xsl = new \DOMDocument();

    if ($value == "Table Status") {
        $xsl->load('xml/Table_sort_status.xslt');
    }
    if ($value == "Table Type") {
        $xsl->load('xml/Table_sort_type.xslt');
    }
    if ($value == "Max Seats") {
        $xsl->load('xml/Table_sort_seat.xslt');
    }
    if ($value == "Order ID") {
        $xsl->load('xml/Table_sort_orderid.xslt');
    }
    if ($value == "Date Created") {
        $xsl->load('xml/Table_sort_date.xslt');
    }
    if ($value == "-") {
        $xsl->load('xml/TableInfo.xslt');
    }

    $proc = new \XSLTProcessor();
    $proc->importStylesheet($xsl);

    echo $proc->transformToXml($xml);
    echo "<br><br>";
}
?>
@stop
