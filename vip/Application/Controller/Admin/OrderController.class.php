<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/11 0011
 * Time: 10:03
 */
class OrderController extends Controller{
        //  显示所有数据
    public function showAction(){
        //  获取所有数据
//        $model = new OrderModel();
//        $rows = $model->getLists();
        $pageSize=3;
        //获取当前所在的页码 当前的页面
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //判定当前页面不能小于等于0
        if($pageIndex<=0) $pageIndex=1;
        //寻找数据的总条数
        //从model中读取所有数据
        $model = new OrderModel();
        $rows = $model->getLists();
        //获取数据的总条数
        $num = $model->getRecordsCount();
        //计算总页数
        $pageTotal=  ceil($num/$pageSize);
        //验证临界点最大页码
        if($pageIndex>=$pageTotal) $pageIndex=$pageTotal;
        //调用getList方法;
        $rows=$model->getList("*",$pageIndex,$pageSize);
        // 引入视图
        require CURRENT_VIEW_PATH."Order/show.html";
    }
    //  修改用户信息，按照id修改
    public function editAction(){
        $id = $_GET['id'];
//        var_dump($id);exit;
        $model = new OrderModel();
        $rows = $model->edit($id);
        require CURRENT_VIEW_PATH.'Order/update.html';
    }
//    //  执行修改
    public function updateAction(){
        $post = $_POST;
//        var_dump($post);exit;
        $model = new OrderModel();
        if($model->update($post)){
            static::jump("index.php?p=Admin&c=Order&a=show");
        }else{
            static::jump("index.php?p=Admin&c=Order&a=show",2,"操作失败");
        }
    }
}