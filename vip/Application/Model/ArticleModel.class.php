<?php

class ArticleModel extends Model{
    //  �������� չʾ���еĻ
    public function getLists(){
        return $rows = $this->getAll();
    }
    //  ��ӻ
    public function addList($post){
        return $this->insertValue($post);
    }
    public function delete($id){
        // ����sql
        $sql = "delete from `article` where `article_id` = '$id'";
        // ����ִ��
        return $this->db->query($sql);
    }
    //����id�޸Ļ
    public function edit($id){
//        var_dump($id);exit;
        //  ����id��ѯһ������
        return $rows = $this->getRowByKey($id);
    }
    //  ִ���޸�
    public function update($post){
//        $post  = $_POST;
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

//��д������ȡ�ܵ�����
    public function selectBY(){
        return $this->selectBYs();
    }

}