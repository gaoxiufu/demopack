<?php
class PlansModel extends Model{

    public function getLists(){
        //չʾ�����ײ�
        $sql = "select * from `plans`";
//        echo $sql;exit;
        return $rows = $this->db->fetchAll($sql);
    }
        //1.����ײ�
    public function addList($post){
        return $this->insertValue($post);
    }
        //2.ɾ���ײ�
    public function delete($id){
        // ����sql
        $sql = "delete from `plans` where plan_id = '$id'";
        // ����ִ��
        return $this->db->query($sql);
    }
    //����id�޸��û�
    public function edit($id){
        //  ����getList��ʾһ������
        return $rows = $this->getRowByKey($id);
    }
    //  ִ���޸�
    public function update($post){
        $post  = $_POST;
        return $rows = $this->modify($post);
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