<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/11
 * Time: 14:59
 */
class HistoriesModel extends Model{



    //����getlist����
    public function getList($fields="*",$pageIndex=1,$pageSize=3){
        //��ȡ��������
        return $this->getPage($fields,$pageIndex,$pageSize);
    }
//��д������ȡ�ܵ�����
    public function getRecordsCount(){
        return $this->getCount();
    }



    //  ��Ա����
    public function getlistgroup($field,$condition,$group,$field1){
        return $this->getdatabygroup($field, $condition, $group, $field1);
    }
    //  ��Ա��ֵ
    public function recharge($field,$condition,$group,$field1){
        $rows = $this->getdatabygroup($field, $condition, $group, $field1);
//        var_dump($rows);exit;
        return $this->getdatabygroup($field, $condition, $group, $field1);
    }

    //�������� �������� ������Ա��¼
    public function showRecord($realname){
//       $condition=$realname;
       return $this->condition($realname);

    }

    //��������  ��ѯ���ѱ� ������
    public function selects($name){
        $condetion =$name;
        return $this->condition($condetion);

    }

    //�������� ��ѯ��ֵ����ǰ3 λ
    public function chongzhi(){
        $sql = "SELECT user_id,SUM(amount) AS sum FROM `Histories` WHERE `type`='充值' GROUP BY user_id ORDER BY SUM(amount) DESC LIMIT 3";
//        echo $sql;exit;
       return $this->db->fetchAll($sql);
    }

    //�������� ��ѯ��������ǰ3 λ
    public function xiaofei(){
        $sql = "SELECT user_id,SUM(amount) AS sum FROM `Histories` WHERE `type`='消费' GROUP BY user_id ORDER BY SUM(amount) DESC LIMIT 3";
//        echo $sql;exit;
       return $this->db->fetchAll($sql);

    }

    //创建方法  查询服务次数最多的前三位员工
    public function fuwu(){
        $sql = "SELECT member_id,COUNT(member_id) AS sum FROM `Histories` GROUP BY member_id ORDER BY sum DESC LIMIT 3;";
//        echo $sql;exit;
        return $this->db->fetchAll($sql);
    }


}