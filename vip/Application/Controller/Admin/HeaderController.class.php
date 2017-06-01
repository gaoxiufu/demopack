<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/11 0011
 * Time: 10:03
 */
class HeaderController{
        //  显示所有数据
    private $catcha_id = '0c786af0cae579777bab9b7ff69ccb51';
    private $private_key = 'cb9c583bbf22bbe3e2cddc160ce72256 ';
    public function showAction(){
        $GtSdk = new GeetestLibTool($this->catcha_id, $this->private_key);
        session_start();
        $user_id = "test";
        $status = $GtSdk->pre_process($user_id);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $user_id;
        echo $GtSdk->get_response_str();
    }
}