<?php
class OrderModel extends Model{
    //  �������� չʾ���е�ԤԼ
    public function getLists(){
        return $rows = $this->getAll();
    }
    //����id�޸��û�
    public function edit($id){
//        var_dump($id);exit;
        //  ����getList��ʾһ������
        return $rows = $this->getRowByKey($id);
    }
    //  ִ���޸�
    public function update($post){
        $post  = $_POST;
//        var_dump($post);exit;
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

    //�������� ����ԤԼ
    public function insert($post){
        return $this->insertValue($post);
    }

//��������  ��ѯ�����������ǰ��λԱ��
    public function fuwu(){
        $sql = "SELECT barber,COUNT(barber)AS ci FROM `Order` GROUP BY barber ORDER BY ci DESC LIMIT 3";
//        echo $sql;exit;
        return $this->db->fetchAll($sql);
    }

}