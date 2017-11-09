<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/11
 * Time: 11:06
 */
class GroupController extends Controller{
    //创建show 方法 显示 分组
    public function showAction(){
        $pageSize=3;
        //获取当前所在的页码 当前的页面
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //判定当前页面不能小于等于0
        if($pageIndex<=0) $pageIndex=1;
        //寻找数据的总条数
        //从model中读取所有数据
        $model=new GroupModel();
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
//        require CURRENT_VIEW_PATH ."Group/list.html";
    }

    //创建add 方法
    public function addAction(){
        require CURRENT_VIEW_PATH ."Group/add.html";
    }

    //创建insert 方法 新增会员
    public function insertAction(){
        $post = $_POST;
        $model = new GroupModel();
        //判断
        if(!$model->insertValue($post)||$post['name']==''){
            static::jump("index.php?p=Admin&c=Group&a=show",2,"用户名不能为 或 空用户名已存在！");
        }else{
            $model->insertValue($post);
            static::jump("index.php?p=Admin&c=Group&a=show");
        }

    }

    //创建 remove 方法删除数据
    public function removeAction(){
        $id=$_GET['id'];
        //实例化model
        $model= new GroupModel();
        if($model->delete($id))
            static::jump("index.php?p=Admin&c=Group&a=show");
    }

    //创建edit 方法 绑定查看会员信息
    public function editAction(){
        $id = $_GET['id'];
        $model= new GroupModel();
        $rows = $model->getRowByKey($id);
//        var_dump($rows);exit;
        $this->assign('row',$rows);
        $this->display('edit');
    }

}