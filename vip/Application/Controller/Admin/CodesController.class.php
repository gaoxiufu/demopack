<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/10
 * Time: 19:26
 */
class CodesController extends Controller{
    //����show ����
    public function showAction(){

        $pageSize=3;
        //��ȡ��ǰ���ڵ�ҳ�� ��ǰ��ҳ��
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //�ж���ǰҳ�治��С�ڵ���0
        if($pageIndex<=0) $pageIndex=1;
        //Ѱ�����ݵ�������
        //��model�ж�ȡ��������
        $model=new CodesModel();
        //��ȡ���ݵ�������
        $num = $model->getRecordsCount();
        //������ҳ��
        $pageTotal=  ceil($num/$pageSize);
        //��֤�ٽ�����ҳ��
        if($pageIndex>=$pageTotal) $pageIndex=$pageTotal;
        //����getList����
        $rows=$model->getList("*",$pageIndex,$pageSize);

        $this->assign('rows',$rows);
        $this->assign('pageSize',$pageSize);
        $this->assign('pageIndex',$pageIndex);
        $this->assign('pageTotal',$pageTotal);
        $this->assign('num',$num);
//������ͼģ��
        $this->display("list");
    }


    //���� remove ����ɾ������
    public function removeAction(){
        $id=$_GET['id'];

        //ʵ����model
        $model= new CodesModel();
        $rows = $model->getRowByKey($id);

        if($rows['status']=="δʹ��"){
            false;
            static::jump("index.php?p=Admin&c=Codes&a=show",2,"�˴���ȯδʹ�ò���ɾ����");
        }elseif($model->remove($id)){
            static::jump("index.php?p=Admin&c=Codes&a=show");
        }

    }

    //����add ����
    public function addAction(){
        require CURRENT_VIEW_PATH ."Codes/add.html";
    }



    //����edit ���� �󶨲鿴����ȯ��Ϣ
    public function editAction(){
        $id = $_GET['id'];
        $model= new CodesModel();
        $rows = $model->getRowByKey($id);
//        var_dump($rows);exit;
        $this->assign('row',$rows);
        $this->display('edit');
    }

    public function insertAction(){
        //�����������
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123546789";
        $str= str_shuffle($str);
        $str=  substr($str , 0 , 8);

        $post=$_POST;
        $post['code']=$str;


//        var_dump($post);exit;
        $model = new CodesModel();
        //����insert����
        if($model->insert($post)){
            static::jump("index.php?p=Admin&c=Codes&a=show");
        }
    }

    //����update ���� �޸���Ϣ
    public function updateAction(){
        //��ȡ����
        $post = $_POST;
//        var_dump($post);exit;
        //����model
        $model = new CodesModel();
        if($model->modify($post)){
            static::jump("index.php?p=Admin&c=Codes&a=show");
        }
    }

}