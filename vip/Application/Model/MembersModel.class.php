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
        //  ����idɾ���û�
        public function delete($id){
            // ����sql
            $sql = "delete from `Members` where member_id = '$id'";
            //����ִ�У�����
//            var_dump($this->db->query($sql));exit;
            return $this->db->query($sql);
        }
    public function edit($id){
            //  ����getList��ʾһ������
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
        //����insert ����  ִ���½��û��ķ���
        public function insert($post){
//            var_dump($post);exit;
            return $this->insertValue($post);
        }
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