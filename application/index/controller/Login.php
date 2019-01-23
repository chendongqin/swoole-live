<?php
/**
 * Created by PhpStorm.
 * User: dongq
 * Date: 2019/1/23
 * Time: 21:56
 */

namespace app\index\controller;

use think\console\command\make\Controller;
use think\Session;

class Login extends Controller{

    public function index(){
        $request = request();
        $mobile = $request->get('phone_num');
        $code = $request->get('code');
        $virefy = Session::get('liveLogin'.$mobile);
        if(!$virefy){
            $data = array('msg'=>'验证码已过期','status'=>false,'code'=>2000,'data'=>[]);
            return json($data);
        }
        if($code != $virefy){
            $data = array('msg'=>'验证码不正确','status'=>false,'code'=>2001,'data'=>[]);
            return json($data);
        }
        $data = array('msg'=>'登陆成功','status'=>true,'code'=>0,'data'=>[]);
        return json($data);
    }

}