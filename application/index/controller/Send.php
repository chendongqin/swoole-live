<?php
/**
 * Created by PhpStorm.
 * User: dongq
 * Date: 2019/1/23
 * Time: 21:42
 */

namespace app\index\controller;

use think\console\command\make\Controller;
use think\process\Utils;
use think\Session;

class Send extends Controller{


    public function index(){
        $mobile = request()->get('mobile','');
        if(empty($mobile)){
            $data = array('msg'=>'手机号不能为空','status'=>false,'code'=>1000,'data'=>[]);
            return $data;
        }
        $code = '0000';
        Session::set('liveLogin'.$mobile, $code, 120);
        $data = array('msg'=>'发送成功','status'=>true,'code'=>0,'data'=>[]);
        return $data;
    }

}