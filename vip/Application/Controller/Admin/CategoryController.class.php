<?php

/**
 * Description of CategoryController
 *
 * @author Administrator
 */
class CategoryController extends PlatFormController {
    //显示分类列表
    public function listAction(){
        //读取所有数据 显示视图
        $model=new CategoryModel();
        //调用 获取所有数据的方法 getList
        $rows = $model->getList();
        //引入视图
        require CURRENT_VIEW_PATH.'Category/li.html';
    }
    //添加删除方法
    public function removeAction(){
        //通过地址获取id
        $id=$_GET["id"];
        //new model
         $model=new CategoryModel();
         //调用model的方法
         if(!$model->remove($id)){
             //有子类不允许删除
             static::jump("index.php?p=Admin&c=Category&a=list",3,"老板，请先删除子类！");
         }else{
             //跳转到列表
             static::jump("index.php?p=Admin&c=Category&a=list");
         }
    }
    //添加add方法
    public function addAction(){
        //绑定分类
        //从model的getList中取得数据
         $model=new CategoryModel();
         //取得树形结构
         $rows=$model->getList(); 
        //载入视图
        require CURRENT_VIEW_PATH."Category/cccccc.html";
    }
    
    //添加insert方法
    public function insertAction(){
        //获取整个表单数据
        $post=$_POST;
        //传递给model插入数据
        $model=new CategoryModel();
        //调用model的insert方法
        //添加成功 跳转到list
        if($model->insert($post)){
             static::jump("index.php?p=Admin&c=Category&a=list");
        }else{
            static::jump("index.php?p=Admin&c=Category&a=add",3,"数据不合法");
        }
    }
    
    //添加编辑控制器
    public function editAction(){
        //获取传递的id
         $id=$_GET["id"];
        //从model的getList中取得数据
         $model=new CategoryModel();
         //取得树形结构
         $rows=$model->getParents($id); 
         //从model中读取一条数据
         $row1=$model->getRow($id);
        //引入视图绑定
        require CURRENT_VIEW_PATH."Category/edit.html";
    }
    //添加修改方法
    public function updateAction(){
        //获取数据
        $post=$_POST;
        //调用修改方法修改数据
        $model=new CategoryModel();
        //调用修改
        if($model->update($post)){
            static::jump("index.php?p=Admin&c=Category&a=list");
        }else{
             static::jump("index.php?p=Admin&c=Category&a=edit&id={$post['id']}",3,"已经存在该分类名称");
        }
        
    }
}
