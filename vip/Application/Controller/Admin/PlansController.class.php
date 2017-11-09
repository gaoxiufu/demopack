<?php
class PlansController extends Controller{
        //չʾ�����ײ�
    public function showAction(){
        //  c��model�л�ȡ��������
//        $model = new PlansModel();
        //   ���÷��� ��ȡ����
//        $rows = $model->getList();
        $pageSize=3;
        //��ȡ��ǰ���ڵ�ҳ�� ��ǰ��ҳ��
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //�ж���ǰҳ�治��С�ڵ���0
        if($pageIndex<=0) $pageIndex=1;
        //Ѱ�����ݵ�������
        //��model�ж�ȡ��������
        $model = new PlansModel();
        $rows = $model->getLists();
        //��ȡ���ݵ�������
        $num = $model->getRecordsCount();
        //������ҳ��
        $pageTotal=  ceil($num/$pageSize);
        //��֤�ٽ�����ҳ��
        if($pageIndex>=$pageTotal) $pageIndex=$pageTotal;
        //����getList����;
        $rows=$model->getList("*",$pageIndex,$pageSize);
        //������ͼ
        require CURRENT_VIEW_PATH."Plans/show.html";
    }
    // ����ײͷ���
    public function addAction(){
            //��ȡ���ύ������
            $post = $_POST;
        $model = new PlansModel();
        $rows = $model->addList($post);
//        if($rows){
//            static::jump("index.php?p=Admin&c=Plans&a=show");
//        }else{
//            static::jump("index.php?p=Admin&c=Plans&a=show",2,"���ʧ��");
//        }
        require CURRENT_VIEW_PATH."Plans/add.html";
    }
    //  ɾ���ײ͵ķ���
    public function deleteAction(){
        // ��ȡҪɾ����id
        $id = $_GET['id'];
        // ��model�л��л�ȡ����
        $model = new PlansModel();
        if($model->delete($id)){
            static::jump("index.php?p=Admin&c=Plans&a=show");
        }else{
            static::jump("index.php?p=Admin&c=Plans&a=show",2,"����ʧ��");
        }
    }
    //  �޸��û���Ϣ������id�޸�
    public function editAction(){
        $id = $_GET['id'];
//        var_dump($id);exit;
        $model = new PlansModel();
        $rows = $model->edit($id);
        require CURRENT_VIEW_PATH.'Plans/update.html';
    }
//    //  ִ���޸�
    public function updateAction(){
        $post = $_POST;
//        var_dump($post);exit;
        $model = new PlansModel();
        if($model->update($post))
            static::jump("index.php?p=Admin&c=Plans&a=show");

    }

}