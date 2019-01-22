<?php
/**
 * Created by PhpStorm.
 * User: dongq
 * Date: 2019/1/22
 * Time: 18:02
 */

$http = new swoole_http_server('0.0.0.0',8811);
$http->set(
    [
        'enable_static_handler'=>true,
        'document_root'=>__DIR__.'/../public/static',
    ]
);

$http->on('request',function ($request ,$response){
    $response->end('sss'.json_encode($request->get));
});

$http->start();