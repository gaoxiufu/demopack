<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of platFromController
 *
 * @author Administrator
 */
class PlatFormController extends Controller {
    //声明构造方法
    public function __construct() {
        parent::__construct();
        if(PLAT_FORM=="Admin"&&CONTROLLER_NAME=="Members"&&  in_array(ACTION, array("login","check"))){
             return;
        }
        //验证代码
//         new SessionDBTool();
        session_start();
        if(!isset($_SESSION["isLogin"])||$_SESSION["isLogin"]!=true){
            //验证Cookie的值
            if(isset($_COOKIE["id"])&&isset($_COOKIE["adminPwd"])){
                //通过cookie中id 读取数据库中的数据
                $id=$_COOKIE["id"];
                //读取数据 调用model中的方法
                 $model=new AdminInfoModel();
                 //获取一行数据
                  $row=$model->getRowById($id);
                  //判定
                  if(md5($row["username"]."myshop")==$_COOKIE["adminPwd"]){
                      $_SESSION["isLogin"]=true;
//                    require CURRENT_VIEW_PATH."Main/main.html";
                  }else{
                      static::jump("index.php?p=Admin&c=Members&a=login");
                  }                
            }else{
                static::jump("index.php?p=Admin&c=Members&a=login");
            }            
        }
    }
    
}
