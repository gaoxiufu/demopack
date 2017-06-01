<?php
class OrderModel extends Model{
    //  创建方法 展示所有的预约
    public function getLists(){
        return $rows = $this->getAll();
    }
    //按照id修改用户
    public function edit($id){
//        var_dump($id);exit;
        //  调用getList显示一条数据
        return $rows = $this->getRowByKey($id);
    }
    //  执行修改
    public function update($post){
        $post  = $_POST;
//        var_dump($post);exit;
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

    //创建方法 新增预约
    public function insert($post){
        return $this->insertValue($post);
    }

//创建方法  查询服务次数最多的前三位员工
    public function fuwu(){
        $sql = "SELECT barber,COUNT(barber)AS ci FROM `Order` GROUP BY barber ORDER BY ci DESC LIMIT 3";
//        echo $sql;exit;
        return $this->db->fetchAll($sql);
    }

}