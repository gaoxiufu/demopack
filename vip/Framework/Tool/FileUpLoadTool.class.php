<?php
class FileUpLoadTool{
      //  设置上传图片的最大值
    public $maxSize = 52000;
    // 定义提示信息,默认为空
    public $msg = "";
    //  设置允许上传的图片格式
    public $type = array(
        "image/jpeg",
        "image/png",
        "image/gif",
    );
    //  定义文件保存的路径
    public $path= "./Public/Upload/";
    //设置文件名的前缀
    public $pre = "my_";
    //  构造函数初始化属性
    public function __construct($maxSize = 52000, $path = "./Public/Upload/", $pre = "my_"){
        // 从配置文件中取出上传限制
//        $this -> maxSize = $GLOBALS['config']['upload']['maxSize'];  //  初始化文件大小
//        $this -> pre = $GLOBALS['config']['upload']['pre'];   //   前缀
//        $this -> path = $GLOBALS['config']['upload']['path'];   // 路径
            $this-> maxSize = $maxSize;
            $this-> path = $path;
            $this-> pre = $pre;
    }
    public function upload($file)
    {
         // 判断文件是否已经传入临时文件夹
        if($file['error'] != 0){
            //  输出提示信息
            $this-> msg = "文件上传错误";
            // 验证文件大小
        }elseif($file['size'] > $this->maxSize){
            $this->msg = "文件超过上传大小";
        }elseif(!in_array($file['type'],$this -> type)){
            $this->msg="文件格式错误";
        }


        //  如果验证通过
        if($this->msg == ""){
            // 保存数据，设置文件的唯一名字 设置文件前缀
            $fileName = uniqid($this->pre);
            $str = $file['name'];
            //获取文件的扩展名
            $sexName = substr($str,strrpos($str,'.'));
            // 上传文件保存名字
            $uploadFileName = $fileName.$sexName;
            // 将临时文件保存到文件夹中   move_uploaded_file(“原始文件的地址名字”，“目录和名字”);
            move_uploaded_file($file['tmp_name'],$this->path.$uploadFileName);
            return $uploadFileName;
        }else{
            return false;
        }
    }
    //   多文件上传
    public function multiUpload($files){
        //声明数组保存上传文件的名字
        $nameArr = array();
        for ($i=0;$i<count($files["name"]);$i++){
            $file["name"]=$files["name"][$i];
            $file["type"]=$files["type"][$i];
            $file["tmp_name"]=$files["tmp_name"][$i];
            $file["error"]=$files["error"][$i];
            $file["size"]=$files["size"][$i];
            $nameArr[]=$this->upload($file);
        }
        //返回多个文件的名字
        return $nameArr;
    }
}
