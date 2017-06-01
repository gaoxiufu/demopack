<?php

class ArticleModel extends Model{
    //  创建方法 展示所有的活动
    public function getLists(){
        return $rows = $this->getAll();
    }
    //  添加活动
    public function addList($post){
        return $this->insertValue($post);
    }
    public function delete($id){
        // 构建sql
        $sql = "delete from `article` where `article_id` = '$id'";
        // 发送执行
        return $this->db->query($sql);
    }
    //按照id修改活动
    public function edit($id){
//        var_dump($id);exit;
        //  按照id查询一条数据
        return $rows = $this->getRowByKey($id);
    }
    //  执行修改
    public function update($post){
//        $post  = $_POST;
        return $rows = $this->modify($post);
    }
    //创建getlist方法
    public function getList($fields="*",$pageIndex=1,$pageSize=3){
        //获取所有数据
        return $this->getPage($fields,$pageIndex,$pageSize);
    }
//书写方法获取总的条数
    public function getRecordsCount(){
        return $this->getCount();
    }

//书写方法获取总的条数
    public function selectBY(){
        return $this->selectBYs();
    }

}