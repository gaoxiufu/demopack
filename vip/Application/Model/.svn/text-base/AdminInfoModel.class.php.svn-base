<?php
//引入db类
class AdminInfoModel extends Model{
    //书写方法获取所有数据
    public function getList(){
        //构建sql语句
//        $sql="select * from users";
        //调用方法执行 sql
        return $this->getAll();
    }
    //书写删除方法
    public function remove($id){
//        构建sql语句
//         $sql="delete from users where id=$id";
         //执行
         return $this->delete($id);
         
    }
    
    //添加model方法
    public function check($post){
        $adminName=$post["adminName"];
        $adminPwd=md5($post["adminPwd"]);
        //构建sql
//        $sql="select * from users where adminName='$adminName' and adminPwd='$adminPwd'";
        //返回一条数据
        return $this->getAll("*"," adminName='$adminName' and adminPwd='$adminPwd'");
    }
    
    //书写按id获取一行数据的方法
    public function getRowById($id){
//        $sql="select * from users where id=$id";
        //返回一条数据
        return $this->getRowByKey($id);
    }
}
