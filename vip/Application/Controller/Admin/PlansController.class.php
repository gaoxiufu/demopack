<?php
class PlansController extends Controller{
        //展示所有套餐
    public function showAction(){
        //  c从model中获取所有数据
//        $model = new PlansModel();
        //   调用方法 获取数据
//        $rows = $model->getList();
        $pageSize=3;
        //获取当前所在的页码 当前的页面
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //判定当前页面不能小于等于0
        if($pageIndex<=0) $pageIndex=1;
        //寻找数据的总条数
        //从model中读取所有数据
        $model = new PlansModel();
        $rows = $model->getLists();
        //获取数据的总条数
        $num = $model->getRecordsCount();
        //计算总页数
        $pageTotal=  ceil($num/$pageSize);
        //验证临界点最大页码
        if($pageIndex>=$pageTotal) $pageIndex=$pageTotal;
        //调用getList方法;
        $rows=$model->getList("*",$pageIndex,$pageSize);
        //引入视图
        require CURRENT_VIEW_PATH."Plans/show.html";
    }
    // 添加套餐方法
    public function addAction(){
            //获取表单提交的数据
            $post = $_POST;
        $model = new PlansModel();
        $rows = $model->addList($post);
//        if($rows){
//            static::jump("index.php?p=Admin&c=Plans&a=show");
//        }else{
//            static::jump("index.php?p=Admin&c=Plans&a=show",2,"添加失败");
//        }
        require CURRENT_VIEW_PATH."Plans/add.html";
    }
    //  删除套餐的方法
    public function deleteAction(){
        // 获取要删除的id
        $id = $_GET['id'];
        // 从model中回中获取数据
        $model = new PlansModel();
        if($model->delete($id)){
            static::jump("index.php?p=Admin&c=Plans&a=show");
        }else{
            static::jump("index.php?p=Admin&c=Plans&a=show",2,"操作失败");
        }
    }
    //  修改用户信息，按照id修改
    public function editAction(){
        $id = $_GET['id'];
//        var_dump($id);exit;
        $model = new PlansModel();
        $rows = $model->edit($id);
        require CURRENT_VIEW_PATH.'Plans/update.html';
    }
//    //  执行修改
    public function updateAction(){
        $post = $_POST;
//        var_dump($post);exit;
        $model = new PlansModel();
        if($model->update($post))
            static::jump("index.php?p=Admin&c=Plans&a=show");

    }

}