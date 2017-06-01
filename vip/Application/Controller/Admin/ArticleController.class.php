<?php
class ArticleController extends Controller{
    //  显示所有数据
    public function showAction(){
        $pageSize=3;
        //获取当前所在的页码 当前的页面
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //判定当前页面不能小于等于0
        if($pageIndex<=0) $pageIndex=1;
        //寻找数据的总条数
        //从model中读取所有数据
        $model = new ArticleModel();
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
        require CURRENT_VIEW_PATH."Article/show.html";
    }
    //  添加活动方法
    public function addAction(){
        //获取表单提交的数据
        $post = $_POST;
        $model = new ArticleModel;
        if(!$model->addList($post) && $post != ''){
            static::jump("index.php?p=Admin&c=Article&a=add","数据不合法");
        }
        require CURRENT_VIEW_PATH."Article/add.html";
    }
    // 添加删除方法
    public function deleteAction(){
        // 获取要删除的id
        $id = $_GET['id'];
        // 从model中回中获取数据
        $model = new ArticleModel;
        if($model->delete($id)){
            static::jump("index.php?p=Admin&c=Article&a=show");
        }
    }
    //  修改用户信息，按照id修改
    public function editAction(){
        $id = $_GET['id'];
        $model = new ArticleModel;
        $rows = $model->edit($id);
        require CURRENT_VIEW_PATH.'Article/update.html';
    }
    //    //  执行修改
    public function updateAction(){
        $post = $_POST;
        $model = new ArticleModel;
        if($model->update($post)){
            static::jump("index.php?p=Admin&c=Article&a=show");
        }else{
            static::jump("index.php?p=Admin&c=Article&a=update",3,"修改不成功");
        }
    }

}