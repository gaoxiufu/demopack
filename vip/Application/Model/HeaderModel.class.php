<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/11 0011
 * Time: 10:04
 */
class HeaderModel extends Model{
        //  �������� չʾ���е���ʦ
    public function getList(){
        return $rows = $this->getAll();
    }
}