<?php

class MembersModel extends Model{
    //????list????
    public function getOne($post){
//???????
        $username = $post["username"];
        $password = md5($post["password"]);
        $sql = "SELECT * FROM Members WHERE username='$username' AND password='$password'";
        return $this->db->fetchRow($sql);
    }
//
//    // ?????????????????
    public function getLists(){
        $sql = "select * from `Members`";
        return $rows = $this->db->fetchAll($sql);
}
        //  按照id删除用户
        public function delete($id){
            // 构建sql
            $sql = "delete from `Members` where member_id = '$id'";
            //发送执行，返回
//            var_dump($this->db->query($sql));exit;
            return $this->db->query($sql);
        }
    public function edit($id){
            //  调用getList显示一条数据
            return $rows = $this->getRowByKey($id);
        }
    public function update($post){
        $id = $post['id'];
        $username = $post['username'];
        $password = $post['password'];
        $group_id = $post['group_id'];
        $telephone = $post['telephone'];
//        var_dump($post);exit;
            $sql = "update `Members` set `username`='$username',`password`='$password',`group_id`='$group_id',`telephone`='$telephone' where member_id ='$id'";
//        echo $sql;exit;
            return $this->db->query($sql);
        }
        //创建insert 方法  执行新建用户的方法
        public function insert($post){
//            var_dump($post);exit;
            return $this->insertValue($post);
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