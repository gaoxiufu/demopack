<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/11 0011
 * Time: 10:03
 */
class OrderController extends Controller{
        //  ��ʾ��������
    public function showAction(){
        //  ��ȡ��������
//        $model = new OrderModel();
//        $rows = $model->getLists();
        $pageSize=3;
        //��ȡ��ǰ���ڵ�ҳ�� ��ǰ��ҳ��
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //�ж���ǰҳ�治��С�ڵ���0
        if($pageIndex<=0) $pageIndex=1;
        //Ѱ�����ݵ�������
        //��model�ж�ȡ��������
        $model = new OrderModel();
        $rows = $model->getLists();
        //��ȡ���ݵ�������
        $num = $model->getRecordsCount();
        //������ҳ��
        $pageTotal=  ceil($num/$pageSize);
        //��֤�ٽ�����ҳ��
        if($pageIndex>=$pageTotal) $pageIndex=$pageTotal;
        //����getList����;
        $rows=$model->getList("*",$pageIndex,$pageSize);
        // ������ͼ
        require CURRENT_VIEW_PATH."Order/show.html";
    }
    //  �޸��û���Ϣ������id�޸�
    public function editAction(){
        $id = $_GET['id'];
//        var_dump($id);exit;
        $model = new OrderModel();
        $rows = $model->edit($id);
        require CURRENT_VIEW_PATH.'Order/update.html';
    }
//    //  ִ���޸�
    public function updateAction(){
        $post = $_POST;
//        var_dump($post);exit;
        $model = new OrderModel();
        if($model->update($post)){
            static::jump("index.php?p=Admin&c=Order&a=show");
        }else{
            static::jump("index.php?p=Admin&c=Order&a=show",2,"����ʧ��");
        }
    }
}