@extends('layout')
@section('content')
    <?php
    $xml = new \DOMDocument();
    $xml->load('xml/ProductInfo.xml');

    $xsl = new \DOMDocument();
    $xsl->load('xml/ProductInfo.xslt');

    $proc = new \XSLTProcessor();
    $proc->importStylesheet($xsl);

    echo $proc->transformToXml($xml);
    ?>
