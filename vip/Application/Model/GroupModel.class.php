<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/11
 * Time: 12:28
 */
class GroupModel extends Model{
    //����getlist����
    public function getList($fields="*",$pageIndex=1,$pageSize=3){
        //��ȡ��������
        return $this->getPage($fields,$pageIndex,$pageSize);
    }
    //��д������ȡ�ܵ�����
    public function getRecordsCount(){
        return $this->getCount();
    }
}