<?php
class PlansModel extends Model{

    public function getLists(){
        //展示所有套餐
        $sql = "select * from `plans`";
//        echo $sql;exit;
        return $rows = $this->db->fetchAll($sql);
    }
        //1.添加套餐
    public function addList($post){
        return $this->insertValue($post);
    }
        //2.删除套餐
    public function delete($id){
        // 构建sql
        $sql = "delete from `plans` where plan_id = '$id'";
        // 发送执行
        return $this->db->query($sql);
    }
    //按照id修改用户
    public function edit($id){
        //  调用getList显示一条数据
        return $rows = $this->getRowByKey($id);
    }
    //  执行修改
    public function update($post){
        $post  = $_POST;
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

}