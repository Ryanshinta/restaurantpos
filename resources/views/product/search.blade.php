@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="upper-section">
            <h2>Product Information</h2>
            <form id="register-form" method="get" action="">
                <h3>Filters to search</h3><br>
                <label>Product ID: </label><input type="text" name="ID" id="ID" /><br><br>
                <label>Name : </label><input type="text" name="name" id="name"/><br><br>
                <label>Price (Greater than) : </label><input type="text" name="priceGreater" id="priceGreater" value=""/><br><br>
                <label>Price (Small than) : </label><input type="text" name="priceSmall" id="priceSmall" value=""/><br><br>
                <input style="width:100px; height: 28px;" type="submit" name="submit" value="Search"/><br><br>

                <?php if (isset($_GET['submit'])){
                $doc = new \DOMDocument();
                $doc->preserveWhiteSpace = false;
                $doc->load('xml/ProductInfo.xml');
                $xpath = new \DOMXPath($doc);

                $ID = $_GET['ID'];
                $name = $_GET['name'];

                $priceGreater = $_GET['priceGreater'];
                if ($priceGreater == null){
                    $priceGreater = 0;
                }
                $priceSmall = $_GET['priceSmall'];
                if ($priceSmall == null){
                    $priceSmall = PHP_INT_MAX;
                }
            $query =
                "//Products/Product[
                       ID[(contains(text(),'$ID'))]
                   and name[(contains(text(),'$name'))]
                   and price <= '$priceSmall'
                   and price >= '$priceGreater'

                   ]/ID";

                $entries = $xpath->query($query);
                ?>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Image</th>
                    </tr>
                    <tbody>
                    @foreach($entries as $entry)
                        <tr>
                            <td>{{ $entry->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nextSibling->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nextSibling->nextSibling->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nextSibling->nextSibling->nextSibling->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nodeValue }}</td>
                            <td><img width="100" src="{{ $entry->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nodeValue }}"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            <br><br><?php }?>
            </form>
            <h3>After sort by price</h3><br><br>
        <?php


    $xml = new \DOMDocument();
    $xml->load('xml/ProductInfo.xml');
    $xsl = new \DOMDocument();
    $xsl->load('xml/ProductInfoSortPrice.xslt');

    $proc = new \XSLTProcessor();
    $proc->importStylesheet($xsl);
    echo $proc->transformToXml($xml);
    echo "<br><br>";

    ?>
        </div>
    </div>
@stop
