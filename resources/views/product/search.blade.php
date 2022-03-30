@extends('layout')
@section('content')
    <?php
//    $xml = new DOMDocument();
//    $xml->load('xml/ProductInfo.xml');
//
//    $xsl = new DOMDocument();
//    $xsl->load('xml/ProductInfo.xslt');
//
//    $proc = new XSLTProcessor();
//    $proc->importStylesheet($xsl);

    $SimpleXML = simplexml_load_file('xml/ProductInfo.xml');

    $xPath = $SimpleXML->xpath('/Products/Product[2]');

    foreach ($xPath as $item){
        $xml = $item;
        $xsl = simplexml_load_file('xml/ProductInfo.xslt');
        $xslt = new XSLTProcessor();
        $xslt->importStylesheet($xsl);
        echo '<div>'.$xslt->transformToXML($xml).'</div>';
    }







    ?>
