<?php
Route::get('/', function () {
    $wsdl = 'http://192.168.0.250:8015/hy.asmx?WSDL';
//    $wsdl = 'http://ddwxjk.dongdasm.com/hy.asmx?WSDL';
    $hy = app(\Prezent\Soap\Client\SoapClient::class, [$wsdl]);

    $qryHydaXml = <<<r
<?xml version="1.0" encoding="UTF-8"?>
<request>
    <gs>xz</gs>
    <custid>888020036</custid>
    <custname></custname>
    <custsjh></custsjh>
    <custsfz></custsfz>
    <ynallnew></ynallnew>
</request>
r;

    $res = $hy->readhyda([
        'pm_qryhydaxml' => $qryHydaXml
    ]);

    dd($res);
})->name('home');






