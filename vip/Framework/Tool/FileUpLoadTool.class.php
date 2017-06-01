<?php
class FileUpLoadTool{
      //  �����ϴ�ͼƬ�����ֵ
    public $maxSize = 52000;
    // ������ʾ��Ϣ,Ĭ��Ϊ��
    public $msg = "";
    //  ���������ϴ���ͼƬ��ʽ
    public $type = array(
        "image/jpeg",
        "image/png",
        "image/gif",
    );
    //  �����ļ������·��
    public $path= "./Public/Upload/";
    //�����ļ�����ǰ׺
    public $pre = "my_";
    //  ���캯����ʼ������
    public function __construct($maxSize = 52000, $path = "./Public/Upload/", $pre = "my_"){
        // �������ļ���ȡ���ϴ�����
//        $this -> maxSize = $GLOBALS['config']['upload']['maxSize'];  //  ��ʼ���ļ���С
//        $this -> pre = $GLOBALS['config']['upload']['pre'];   //   ǰ׺
//        $this -> path = $GLOBALS['config']['upload']['path'];   // ·��
            $this-> maxSize = $maxSize;
            $this-> path = $path;
            $this-> pre = $pre;
    }
    public function upload($file)
    {
         // �ж��ļ��Ƿ��Ѿ�������ʱ�ļ���
        if($file['error'] != 0){
            //  �����ʾ��Ϣ
            $this-> msg = "�ļ��ϴ�����";
            // ��֤�ļ���С
        }elseif($file['size'] > $this->maxSize){
            $this->msg = "�ļ������ϴ���С";
        }elseif(!in_array($file['type'],$this -> type)){
            $this->msg="�ļ���ʽ����";
        }


        //  �����֤ͨ��
        if($this->msg == ""){
            // �������ݣ������ļ���Ψһ���� �����ļ�ǰ׺
            $fileName = uniqid($this->pre);
            $str = $file['name'];
            //��ȡ�ļ�����չ��
            $sexName = substr($str,strrpos($str,'.'));
            // �ϴ��ļ���������
            $uploadFileName = $fileName.$sexName;
            // ����ʱ�ļ����浽�ļ�����   move_uploaded_file(��ԭʼ�ļ��ĵ�ַ���֡�����Ŀ¼�����֡�);
            move_uploaded_file($file['tmp_name'],$this->path.$uploadFileName);
            return $uploadFileName;
        }else{
            return false;
        }
    }
    //   ���ļ��ϴ�
    public function multiUpload($files){
        //�������鱣���ϴ��ļ�������
        $nameArr = array();
        for ($i=0;$i<count($files["name"]);$i++){
            $file["name"]=$files["name"][$i];
            $file["type"]=$files["type"][$i];
            $file["tmp_name"]=$files["tmp_name"][$i];
            $file["error"]=$files["error"][$i];
            $file["size"]=$files["size"][$i];
            $nameArr[]=$this->upload($file);
        }
        //���ض���ļ�������
        return $nameArr;
    }
}
