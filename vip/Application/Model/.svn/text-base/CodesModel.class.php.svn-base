<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/10
 * Time: 22:23
 */
class CodesModel extends Model{
    //创建getlist方法
    public function getList($fields="*",$pageIndex=1,$pageSize=3){
        //获取所有数据
        return $this->getPage($fields,$pageIndex,$pageSize);
    }
    //书写方法获取总的条数
    public function getRecordsCount(){
        return $this->getCount();
    }

    //创建remove方法  删除一条数据
    public function remove($id){
        return $this->delete($id);
    }

    //创建insert 插入数据方法
    public function insert($post){

        return $this->insertValue($post);
    }

}