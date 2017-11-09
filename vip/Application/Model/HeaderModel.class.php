<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/11 0011
 * Time: 10:04
 */
class HeaderModel extends Model{
        //  创建方法 展示所有的理发师
    public function getList(){
        return $rows = $this->getAll();
    }
}