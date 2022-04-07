@extends('layout')
@section('content')
<?php
$SimpleXML = simplexml_load_file('xml/orderDetails.xml');

$xPath = $SimpleXML->xpath('/orders/order[2]');

foreach ($xPath as $item) {
    $xml = $item;
    $xsl = simplexml_load_file('xml/orderDetails.xslt');
    $xslt = new XSLTProcessor();
    $xslt->importStylesheet($xsl);
    echo '<div>' . $xslt->transformToXML($xml) . '</div>';
}
?>