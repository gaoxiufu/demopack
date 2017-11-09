<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/11
 * Time: 11:06
 */
class GroupController extends Controller{
    //����show ���� ��ʾ ����
    public function showAction(){
        $pageSize=3;
        //��ȡ��ǰ���ڵ�ҳ�� ��ǰ��ҳ��
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //�ж���ǰҳ�治��С�ڵ���0
        if($pageIndex<=0) $pageIndex=1;
        //Ѱ�����ݵ�������
        //��model�ж�ȡ��������
        $model=new GroupModel();
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
//        require CURRENT_VIEW_PATH ."Group/list.html";
    }

    //����add ����
    public function addAction(){
        require CURRENT_VIEW_PATH ."Group/add.html";
    }

    //����insert ���� ������Ա
    public function insertAction(){
        $post = $_POST;
        $model = new GroupModel();
        //�ж�
        if(!$model->insertValue($post)||$post['name']==''){
            static::jump("index.php?p=Admin&c=Group&a=show",2,"�û�������Ϊ �� ���û����Ѵ��ڣ�");
        }else{
            $model->insertValue($post);
            static::jump("index.php?p=Admin&c=Group&a=show");
        }

    }

    //���� remove ����ɾ������
    public function removeAction(){
        $id=$_GET['id'];
        //ʵ����model
        $model= new GroupModel();
        if($model->delete($id))
            static::jump("index.php?p=Admin&c=Group&a=show");
    }

    //����edit ���� �󶨲鿴��Ա��Ϣ
    public function editAction(){
        $id = $_GET['id'];
        $model= new GroupModel();
        $rows = $model->getRowByKey($id);
//        var_dump($rows);exit;
        $this->assign('row',$rows);
        $this->display('edit');
    }

}