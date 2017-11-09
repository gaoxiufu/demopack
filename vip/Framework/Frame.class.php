<?php

/**
 * Description of Frame
 *
 * @author Administrator
 */
class Frame {
    //添加方法执行内部所有方法
    public  static function run(){

        //执行定义路径常量
        self::initPath();
        //定义配置文件
        self::initConfig();
        //获取平台参数
        self::initParam();
        //定义特殊路径的方法
        self::classMapping();
        //定义自动加载方法
        self::initAutoload();
        //执行控制器
        self::dispacher();
    }
    //定义常量的方法
    public static function initPath(){
        //定义分隔符常量
        defined("DS") or define("DS", DIRECTORY_SEPARATOR);
        //定义站点所在根目录
        defined("ROOT_PATH") or define("ROOT_PATH", dirname($_SERVER["SCRIPT_FILENAME"]).DS);
        //定义应用程序的路径
        defined("APP_PATH") or define("APP_PATH", ROOT_PATH."Application".DS);
        //定义框架的路径
        defined("FRAME_PATH") or define("FRAME_PATH", ROOT_PATH."Framework".DS);
        //控制器路径
        defined("CONTROLLER_PATH") or define("CONTROLLER_PATH", APP_PATH."Controller".DS);
        //model路径
        defined("MODEL_PATH") or define("MODEL_PATH", APP_PATH."Model".DS);
        //视图路径
        defined("VIEW_PATH") or define("VIEW_PATH", APP_PATH."View".DS);
        //配置文件路径
        defined("CONFIG_PATH") or define("CONFIG_PATH", APP_PATH."Config".DS);
        //工具路径
        defined("TOOL_PATH") or define("TOOL_PATH", FRAME_PATH."Tool".DS);
    }
    //定义配置文件
    public static function initConfig(){
        //引入配置文件
       $GLOBALS["config"] =  require CONFIG_PATH.'Myshop.config.php';
    }
    //定义平台参数  当前平台
    public static function initParam(){
        $platFrom =  isset($_GET["p"])?$_GET["p"]:$GLOBALS["config"]["app"]["platFrom"];
         defined("PLAT_FORM") or define("PLAT_FORM",$platFrom);
        //平台路径  Controller平台  view 的平台路径
        defined("CURRENT_CONTROLLER_PATH") or define("CURRENT_CONTROLLER_PATH", CONTROLLER_PATH.$platFrom.DS);
        defined("CURRENT_VIEW_PATH") or define("CURRENT_VIEW_PATH", VIEW_PATH.$platFrom.DS);
        //引入控制器
        $c=isset($_GET["c"])?$_GET["c"]:$GLOBALS["config"]["app"]["controllerName"];
        defined("CONTROLLER_NAME") or define("CONTROLLER_NAME",$c);
        //获取方法名称
        $a=isset($_GET["a"])?$_GET["a"]:$GLOBALS["config"]["app"]["method"];
        defined("ACTION") or define("ACTION",$a);
        //拼接控制器名
        $GLOBALS["controllerName"]=$c."Controller";
        //目的为了其他方法可以使用
//         defined("CONTROLLER_NAME") or define("CONTROLLER_NAME",$controllerName);
        //拼接方法名
        $GLOBALS["actionName"]=$a."Action";
//        defined("ACTION_NAME") or define("ACTION_NAME",$actionName);
    }
    //引入文件的特殊路径
    public static function classMapping(){
        //定义 引入文件的的特殊路径
         $GLOBALS["mapping"]=array(        
            "DB"=>TOOL_PATH."DB.class.php",
            "Model"=>FRAME_PATH.'Model.class.php',
            "Controller"=>FRAME_PATH.'Controller.class.php'
         );  
    }
    //自动加载
    public static function initAutoload(){
        //注册自动加载 注册自己的方法为自动加载方法
        spl_autoload_register("self::userAutoLoad");
    }
    
    //自动加载的方法
    public static function userAutoLoad($class){
        //判定特殊路径  判定数据的键这个值是否存在 如果存在则引入文件
        if(isset($GLOBALS["mapping"][$class])){
            require $GLOBALS["mapping"][$class];
        }elseif(substr($class,-10)=="Controller"){//判定引入文件是否是控制器
             //引入控制器文件

             require CURRENT_CONTROLLER_PATH.$class.".class.php";
         }elseif(substr($class,-5)=="Model"){//判定类是否是Model  
             // 引入model
             require MODEL_PATH.$class.".class.php";       
         }elseif(substr($class,-4)=="Tool"){//判定类是否是Tool
             // 引入model
             require TOOL_PATH.$class.".class.php";       
         }
    }
    //控制器的调用
     public static function dispacher(){

         //使用变量 保存 CONTROLLER_NAME
        $controller=new $GLOBALS["controllerName"]();
        //控制器调用方法
         $controller->$GLOBALS["actionName"]();
    }
}
