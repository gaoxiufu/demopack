<?php
//引入model类
class AdminInfoController extends PlatFormController {
   //写入方法 获取所有数据
    public function listAction(){       
        //取得model实例
        $model=new AdminInfoModel();
        // 调用方法取得数据
        $rows = $model->getList();
        //引入前端页面
        require CURRENT_VIEW_PATH."users/li.html";
    }
    //制作删除方法
    public function removeAction(){
        //获取id
        $id=$_GET["id"];
//        var_dump($id);exit;
        //取得model实例
        $model=new AdminInfoModel();
        //调用model的remove方法
        $model->remove($id);
        //删除成功后需要跳转
        header("location:index.php?p=Admin&c=users&a=list");
        
    }
    
    //添加login方法
    public function loginAction(){
        //载入登录的视图
        require CURRENT_VIEW_PATH.'users/login.html';
    }
    
    //添加用户验证的方法
    public function checkAction(){
        //记录session
             session_start();//开启session
          
        //获取客户端的数据
        $post=$_POST;
        if(!CaptchaTool::checkCode($post["code"])){
            static::jump("index.php?p=Admin&c=users&a=login",3,"验证码错误<br/>3秒后返回");
            exit;
        }
       
        //使用model 验证数据
        $model=new AdminInfoModel();
        //调用check方法
         $row =$model->check($post);
         //判定如果取得一条数据 表示 数据库验证成功
         if($row){
             
//             new SessionDBTool();
             //记录session
             $_SESSION["isLogin"]=true;
             //判定勾选
             if(isset($post["remember"])){
                 //记录cookie的值
                 setcookie("id",$row["id"],time()+3600);
                 setcookie("adminPwd",md5($row["adminPwd"]."myshop"),time()+3600);
             }else{
                 //设置cookie过期
                 setcookie("id",$row["id"],time()-1);
                 setcookie("adminPwd",md5($row["adminPwd"]."myshop"),time()-1);
             }
             //跳转 到后台首页
             static::jump("index.php?p=Admin&c=Main&a=show");
         }else{
             //验证不成功 跳转到登录界面
             static::jump("index.php?p=Admin&c=users&a=login",3,"用户名或密码错误<br/>3秒后返回");
         }
         
    }
    //添加show
    public function  showAction(){
        //判定session值
        //开启session
        session_start();
         if(isset($_SESSION["isLogin"])&&$_SESSION["isLogin"]==true){
             require  CURRENT_VIEW_PATH.'main.html';
         }
        //获取cookie进行验证 放置暴力进入
        elseif(!isset($_COOKIE["isLogin"])||$_COOKIE["isLogin"]!=true){
            static::jump("index.php?p=Admin&c=users&a=login");
        }else{
            require  CURRENT_VIEW_PATH.'main.html';
        }
    }
}

