<?php
//声明db类
class DB{
    //主要目的 执行sql  
    //链接数据库 设置编码  选定数据库
//    声明属性
     private $host;//服务器
     private $user;//用户名
     private $password;//密码
     private $port;//端口
     private $charset;//通信编码
     private $dbName;//操作的库名
     
     private $link; //保存链接资源
     
     //建立一个静态属性
     private static $instance=null;
     

//     ①设计，具有的属性 host user  pwd  port
//②在得到该对象时，可以对属性进行初始化！构造函数  host  root  password
      private function __construct($config=array()) {
         //为属性赋值
         $this->host=isset($config['host'])?$config['host']:'127.0.0.1';
         $this->user=isset($config['user'])?$config['user']:'root';
         $this->port=isset($config['port'])?$config['port']:'3306';
         $this->password=isset($config['password'])?$config['password']:'12345';
         $this->charset=isset($config['charset'])?$config['charset']:'utf8';
         $this->dbName=isset($config['dbName'])?$config['dbName']:'ydm';
         //执行调用链接方法
         $this->connect();
         //调用设置通信编码
         $this->setCharset();
         //调用选择数据库
         $this->selectDB();
      }
      //使用静态方法创建对象
      public static  function getInstance($config=array()){
          
          if(self::$instance==null){
              self::$instance=new DB($config);
          }
          //返回对象
          return self::$instance;
      }

    //③设置好属性后，自动连接数据库 链接数据库方法
    private function connect(){
        if(!$this->link=mysql_connect("$this->host:$this->port","$this->user", "$this->password")){
            echo mysql_error();
            exit;
        }
        
    }
    //④自动设置字符集 
    private function setCharset(){
        mysql_set_charset($this->charset,  $this->link);
    }
    //⑤自动设置默认数据库！
    private function selectDB(){
        if(!mysql_select_db($this->dbName,  $this->link)){
            echo mysql_error();
            exit;
        }
    }
//    ⑥增加一个执行sql的方法！  执行返回bool的sql语句
    // insert  update  delete drop  create alter...
    public function query($sql){
        //执行语句
       $result =  mysql_query($sql);
       return $result;
    }

    //创建方法   获取总条数
    public function nums($sql){
        $re = mysql_query($sql);
        $num = mysql_num_rows($re);

        return $num;
    }
    
//    增加fetchAll()方法功能是，得到执行一条查询类的sql语句，返回符合条件的所有记录,返回是一个二维数组！
    public function fetchAll($sql){
        //发送执行sql语句
        $re =  mysql_query($sql);
        //判定执行是否成功
        if(!$re){
            //执行不成功
           @mysql_error();
        }else{
            //声明空数组 放置 所有读出的数据
            $rows=array();
            //分离资源
            while($row =  mysql_fetch_assoc($re)){
                $rows[]=$row;
            }
           if($rows)
               return $rows;
           else
               return null;
        }
    }
//    增加fetchRow(),要求执行一条查询类的语句，得到符合条件的第一条记录！返回一维数组
    public function fetchRow($sql){
        //调用获取所有数据的方法
        $rows =  $this->fetchAll($sql);
//        return $rows[0];
        if($rows)
           return array_shift($rows);
        else
            return null;
    }
    
//    增加一个fetchColumn()方法，要求执行一条sql语句，返回符合条件的第一条记录的第一条字段的值！返回字符串标量数据！
    public function fetchColumn($sql){
        //调用对象方法
        $row = $this->fetchRow($sql);
        //返回第一个单元格的值
        if($row)
            return array_shift($row);
        else
            return null;
    }
    //私有化克隆函数
    private function __clone() {
        
    }
    //⑦可选的，增加析构方法，在对象被销毁时，释放连接！
    public function __destruct() {
//        mysql_close($this->link);
    }

}




