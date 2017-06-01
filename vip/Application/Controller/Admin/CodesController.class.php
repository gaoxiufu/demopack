<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/10
 * Time: 19:26
 */
class CodesController extends Controller{
    //创建show 方法
    public function showAction(){

        $pageSize=3;
        //获取当前所在的页码 当前的页面
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //判定当前页面不能小于等于0
        if($pageIndex<=0) $pageIndex=1;
        //寻找数据的总条数
        //从model中读取所有数据
        $model=new CodesModel();
        //获取数据的总条数
        $num = $model->getRecordsCount();
        //计算总页数
        $pageTotal=  ceil($num/$pageSize);
        //验证临界点最大页码
        if($pageIndex>=$pageTotal) $pageIndex=$pageTotal;
        //调用getList方法
        $rows=$model->getList("*",$pageIndex,$pageSize);

        $this->assign('rows',$rows);
        $this->assign('pageSize',$pageSize);
        $this->assign('pageIndex',$pageIndex);
        $this->assign('pageTotal',$pageTotal);
        $this->assign('num',$num);
//载入视图模板
        $this->display("list");
    }


    //创建 remove 方法删除数据
    public function removeAction(){
        $id=$_GET['id'];

        //实例化model
        $model= new CodesModel();
        $rows = $model->getRowByKey($id);

        if($rows['status']=="未使用"){
            false;
            static::jump("index.php?p=Admin&c=Codes&a=show",2,"此代金券未使用不能删除！");
        }elseif($model->remove($id)){
            static::jump("index.php?p=Admin&c=Codes&a=show");
        }

    }

    //创建add 方法
    public function addAction(){
        require CURRENT_VIEW_PATH ."Codes/add.html";
    }



    //创建edit 方法 绑定查看代金券信息
    public function editAction(){
        $id = $_GET['id'];
        $model= new CodesModel();
        $rows = $model->getRowByKey($id);
//        var_dump($rows);exit;
        $this->assign('row',$rows);
        $this->display('edit');
    }

    public function insertAction(){
        //生产随机代码
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123546789";
        $str= str_shuffle($str);
        $str=  substr($str , 0 , 8);

        $post=$_POST;
        $post['code']=$str;


//        var_dump($post);exit;
        $model = new CodesModel();
        //调用insert方法
        if($model->insert($post)){
            static::jump("index.php?p=Admin&c=Codes&a=show");
        }
    }

    //创建update 方法 修改信息
    public function updateAction(){
        //获取数据
        $post = $_POST;
//        var_dump($post);exit;
        //调用model
        $model = new CodesModel();
        if($model->modify($post)){
            static::jump("index.php?p=Admin&c=Codes&a=show");
        }
    }

}