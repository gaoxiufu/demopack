<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/11
 * Time: 12:28
 */
class GroupModel extends Model{
    //创建getlist方法
    public function getList($fields="*",$pageIndex=1,$pageSize=3){
        //获取所有数据
        return $this->getPage($fields,$pageIndex,$pageSize);
    }
    //书写方法获取总的条数
    public function getRecordsCount(){
        return $this->getCount();
    }
}