<?php

/**
 * Description of SessionDBTool
 *
 * @author Administrator
 */
class SessionDBTool {
    private  $db;
//   定义构造函数 重写session
    public function __construct() {
        session_set_save_handler(
                array($this,"open"),
                array($this,"close"),
                array($this,"read"),
                array($this,"write"),
                array($this,"destroy"),
                array($this,"gc")
                );
        //开启session
        session_start();
    }
    //书写方法
    public function open($path,$name){
//        require './DB.class.php';
        //初始链接数据库
        $this->db=DB::getInstance($GLOBALS["config"]["db"]);
    }
    //书写方法
    public function close(){
        return true;
    }
    //书写方法
    public function read($sessId){
        $sql="select sess_data from `session` where sess_id='$sessId'";
        $data=$this->db->fetchColumn($sql);
        if($data)
            return $data;
        else
            return "";     
    }
    //书写方法
    public function write($sessId,$sessData){
        $sql="insert into `session` values('$sessId','$sessData',UNIX_TIMESTAMP()) on duplicate key update sess_data='$sessData',last_time=unix_timestamp()";
        return $this->db->query($sql);        
    }
    //书写方法
    public function destroy($sessId){
        $sql="delete from `session` where sess_id='$sessId'";
        return $this->db->query($sql);  
    }
    public function gc($lifeTime){
        $sql="delete from `session` where last_time+$lifeTime<unix_timestamp()";
        return $this->db->query($sql);  
    }
}
