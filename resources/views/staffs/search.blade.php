@extends('layout')
@section('content')
<?php
$xml = new \DOMDocument();
$xml->load('xml/staff_info.xml');

$xsl = new \DOMDocument();
$xsl->load('xml/staff_info.xslt');

$proc = new \XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXml($xml);
?>
