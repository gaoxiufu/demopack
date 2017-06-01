<?php
class Controller{
    private $smarty;
    public function __construct(){
        //  实例化对象
        $this->smarty = new smartyTool();
        // 设置编译目录
        $this->smarty->setCompileDir(APP_PATH."View_c".DS.PLAT_FORM.CONTROLLER_NAME.DS);
        //  设置模板目录
//        $this->smarty->setTemplateDir(CURRENT_VIEW_PATH);
    }
    function assign($name,$value=null){
        $this->smarty->assign($name,$value);
    }
    function display($template_name){
        $this->smarty->display(CURRENT_VIEW_PATH.CONTROLLER_NAME.DS.$template_name.'.html');
    }
    //书写跳转方法
    protected static function jump($url,$time=0,$msg=""){
        //是否用服务器端跳转 判定header 头是否有发送
        if(!headers_sent()){
            //判定是否有延迟时间
            if($time==0){
                //跳转
                header("location:$url");
            }  else {
                //输出提示信息
              echo $msg;
              //延迟跳转
              header("Refresh:$time;url=$url");
            }
        }else{//使用客户端跳转
           //判定是否有延迟时间
            if($time==0){
                echo "<script>location.href='$url'</script>";
            }else{
                echo $msg;
                echo "<meta http-equiv='refresh' content='$time;url=$url'>";
            }
        }
        
    }
}
