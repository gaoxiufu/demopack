<?php



/**

 * Created by PhpStorm.

 * User: Administrator

 * Date: 2016/5/9

 * Time: 23:03

 */

class UsersModel extends Model{

    //创建getlist方法

    public function getList($fields="*",$pageIndex=1,$pageSize=3){

        //获取所有数据

        return $this->getPage($fields,$pageIndex,$pageSize);

    }

//书写方法获取总的条数

    public function getRecordsCount(){

        return $this->getCount();

    }





    //创建insert 插入数据方法

    public function insert($post){

        return $this->insertValue($post);

    }



    //创建remove方法  删除一条数据

    public function remove($id){

        return $this->delete($id);

    }

    //会员表 模糊查询

    public function seek($val,$pageIndex,$pageSize){

                $start=($pageIndex-1)*$pageSize;

                //书写模糊查询语句

                $sql = "SELECT * FROM Users WHERE CONCAT(username,realname,sex,telephone,remark,money) LIKE '%$val%' LIMIT $start,$pageSize";

                    return $this->db->fetchAll($sql);



    }



    //获取搜索的总 条数

    public function num($val){

        $sql = "SELECT * FROM Users WHERE CONCAT(username,realname,sex,telephone,remark,money) LIKE '%$val%'";
	
        return $this->db->nums($sql);

    }





    public function getone($field,$condition){

        return $this->getonevalue($field,$condition);

    }



    //创建 plus 方法 获取会员信息 绑定到充值/消费

    public function plus($id){

        return $this->getRowByKey($id);

    }





    //创建 方法 更新数据会员余额

    public function plusModify($post){

        return $this->modify($post);

    }



    //创建方法获取会员表的微信 openid 是否存在

    public function selects($openid){

        $condetion = "openid='{$openid}'";

        return $this->getAll('*',$condetion);

    }



    //创建方法查询user表的 账户和密码

    public function selectOne($post){

        $username = $_POST['username'];//用户提交的账号

        $password = $_POST['password'];//用户提交的密码

        $sql = "SELECT * FROM Users WHERE username='{$username}' AND password='{$password}'";

        return $this->db->fetchRow($sql);

    }



    //创建 方法 按照openid删除更新 openid

    public function modifyOpenid($openid){

        //属性sql 语句

        $sql = "UPDATE `Users` SET  `openid`=null WHERE `openid`='{$openid}'";

//        echo $sql;exit;

        return $this->db->query($sql);

    }





}