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
        'worker_num'=>5,
    ]
);

$http->on('WorkerStart',function (swoole_server $server,$worker_id){
//    define('APP_PATH',__DIR__.'/../application/');
    require __DIR__ . '/../thinkphp/base.php';
});

$http->on('request',function ($request ,$response) use($http){
    if(!empty($request->get)){
//        $_GET =[];
        $_GET = $request->get;
    }
    if(!empty($request->post)){
//        $_POST =[];
        $_POST = $request->post;
    }
    if(!empty($request->cookie)){
//        $_COOKIE =[];
        $_COOKIE = $request->cookie;
    }
    if(!empty($request->files)){
//        $_FILES =[];
        $_FILES = $request->files;
    }
    if(!empty($request->server)){
//        $_SERVER =[];
        foreach ($request->server as $key =>$value){
            $_SERVER[strtoupper($key)] = $value;
        }
    }
    ob_start();
    try{
        think\Container::get('app')->run()->send();
    }catch (\Exception $exception){

    }
    $res = ob_get_contents();
    ob_end_clean();
    if(is_array($res)){
        $res = json($res);
    }
    $response->end($res);
});

$http->start();