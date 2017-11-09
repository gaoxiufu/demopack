<?php
class ArticleController extends Controller{
    //  ��ʾ��������
    public function showAction(){
        $pageSize=3;
        //��ȡ��ǰ���ڵ�ҳ�� ��ǰ��ҳ��
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //�ж���ǰҳ�治��С�ڵ���0
        if($pageIndex<=0) $pageIndex=1;
        //Ѱ�����ݵ�������
        //��model�ж�ȡ��������
        $model = new ArticleModel();
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
        require CURRENT_VIEW_PATH."Article/show.html";
    }
    //  ��ӻ����
    public function addAction(){
        //��ȡ���ύ������
        $post = $_POST;
        $model = new ArticleModel;
        if(!$model->addList($post) && $post != ''){
            static::jump("index.php?p=Admin&c=Article&a=add","���ݲ��Ϸ�");
        }
        require CURRENT_VIEW_PATH."Article/add.html";
    }
    // ���ɾ������
    public function deleteAction(){
        // ��ȡҪɾ����id
        $id = $_GET['id'];
        // ��model�л��л�ȡ����
        $model = new ArticleModel;
        if($model->delete($id)){
            static::jump("index.php?p=Admin&c=Article&a=show");
        }
    }
    //  �޸��û���Ϣ������id�޸�
    public function editAction(){
        $id = $_GET['id'];
        $model = new ArticleModel;
        $rows = $model->edit($id);
        require CURRENT_VIEW_PATH.'Article/update.html';
    }
    //    //  ִ���޸�
    public function updateAction(){
        $post = $_POST;
        $model = new ArticleModel;
        if($model->update($post)){
            static::jump("index.php?p=Admin&c=Article&a=show");
        }else{
            static::jump("index.php?p=Admin&c=Article&a=update",3,"�޸Ĳ��ɹ�");
        }
    }

}