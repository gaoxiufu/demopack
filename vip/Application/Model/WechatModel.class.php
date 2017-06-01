<?php
class WechatModel extends Model{
    //声明方法获取表名
    protected function getTable(){
        //取得的类名
//        $className=  get_class($this);
        //获取表名
//         截取字符串
        return "Users";
    }
    //  查询用户是否有openid
    public function binding($open_id){
        $fields="*";
        $condetion="openid = '$open_id'";
        $rows = $this->getAll($fields,$condetion);
        return $rows;
    }
    //  没有获取到iopenid跳转到此方法进行登录验证
    public function select($username,$password){
        $sql = "select * from `Users` where username = '$username' and password = '$password'";
        return $rows = $this->db->fetchRow($sql);
    }
    // 查询到数据，把openid更新到数据库
    public function update($open_id,$username){
        $sql = "update `Users` set openid = '$open_id' where username = '$username'";
        return $this->db->query($sql);
    }
    //  注销openid 解除绑定
    public function remove($open_id){
        $sql = "update `Users` set openid = null where openid = '$open_id'";
        return $this->db->query($sql);
    }
    //  展示活动
    public function activity(){
        //  构建sql  查询十条
        $sql = "SELECT * FROM `Article` ORDER  BY article_id DESC LIMIT 10; ";
        return $articles = $this->db->fetchAll($sql);
    }
    public function getOne($id){
        //  构建sql
        $sql = "select * from `Article` where article_id = '$id'";
        // 发送执行
        return $row = $this->db->fetchAll($sql);
    }
    public function getRow($open_id){
        $sql = "select * from `Users` where openid = '$open_id'";
        $row = $this->db->fetchRow($sql);
        return $row;
    }
    //查询消费记录
    public function record($username){
        //  构建sql
       $sql = "SELECT * FROM Histories WHERE `type` = '消费' AND user_id = '$username'";
        //  发送执行
        $res = $this->db->fetchAll($sql);
        return $res;
    }
    public function bespeak(){
        //  构建sql
        $sql = "select * from `members` ";
        return $rows = $this->db->fetchAll($sql);
    }
    //  添加一个增加预约的model
    public function join($post){
        $username = $post['realname'];
        $phone = $post['phone'];
        $barber = $post['barber'];
        //  构建sql
        $sql = "insert into `Order`(`realname`,`phone`,`barber`) VALUES ('$username','$phone','$barber')";
        return $this->db->query($sql);
    }
    //  会员充值榜
    public function recharge(){

    }
}