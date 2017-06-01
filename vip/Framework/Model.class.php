<?php

/**
 * Description of Model
 *
 * @author Administrator
 */
//取得db类的实例
class Model {
     //建立属性 保存DB类的实例
     protected $db;
     //声明属性 保存所有字段
     protected $fields=array();
     //在构造函数中初始化  $db
     public function __construct() {
         //引入配置文件
         $config=  require CONFIG_PATH.'Myshop.config.php';
         $this->db=DB::getInstance($config["db"]);
         //调用获取字段名的方法
         $this->getFields();
     }
     
     //声明方法获取表名
     protected function getTable(){
       //取得的类名
         $className=  get_class($this);
         //获取表名
//         截取字符串
         return substr($className, 0,-5);          
     } 
     
     //查找所有数据
     public function getAll($fields="*",$condetion=""){
         //构建sql语句
         if(empty($condetion))
             $sql="select $fields from `{$this->getTable()}`";
         else
              $sql="select $fields from `{$this->getTable()}` where $condetion";
//         echo $sql;exit;
         //执行语句返回所有数据
         return $this->db->fetchAll($sql);
     }
     
     // 分页查询数据的方法
     public function getPage($fields="*",$pageIndex=1,$pageSize=3){
         //计算其实位置
         $start=($pageIndex-1)*$pageSize;
         //构建sql语句
           $sql="select $fields from `{$this->getTable()}` limit $start,$pageSize";
//         echo $sql;exit;
                    //执行返回所有数据
           return $this->db->fetchAll($sql);
     }
     
     //封装获取数据总条数的方法
     public function getCount(){
         //构建sql
         $sql="select count(*) from `{$this->getTable()}`";
         //执行返回结果
         return $this->db->fetchColumn($sql);
     }
     
     //寻找所有的字段名
     public function getFields(){
         //构建sql语句
          $sql="desc `{$this->getTable()}`";
          //取出所有字段
          $rows=$this->db->fetchAll($sql);
          //遍历数组找出所有的字段名
          foreach ($rows as $row){
              if($row["Key"]=="PRI"){
                  $this->fields["pk"]=$row["Field"];
              }else{
                $this->fields[]=$row["Field"];
              }
          }
     }
     //删除数据的方法
     public function delete($id){
         //构建sql语句
         $sql="delete from `{$this->getTable()}` where `{$this->fields['pk']}`='$id'";//寻找表中主键
//         echo $sql;exit;
         //执行返回数据
         return $this->db->query($sql);                 
      }
      //按照主键查询数据
      public function getRowByKey($id){
          //构建sql语句
//          echo $this->fields['pk'];exit;
           $sql="select * from `{$this->getTable()}` where `{$this->fields['pk']}`='$id'";
//          echo $sql;exit;
//           获取一条数据
            return $this->db->fetchRow($sql);
      }
      
      //建立方法 找出有效的字段名
      public function fiterFields($post){
          foreach($post as $key=>$val){
              //判定$key在不在  $this->fields中
              if(!in_array($key, $this->fields)){
                  unset($post[$key]);
              }
          }
         return $post;     
      }
      //取得字段名 字符串
      public function getFieldsString($data){
          //字段名,字段名, ...
         
//           var_dump(array_keys($data));   
           //找字段
           $arr =  array_keys($data);
           //给数组每个值加上反引号
           $arr=array_map(function($val){return "`$val`";}, $arr);
//           var_dump($arr);
           return implode(",", $arr);         
      }
//             取值的字符串
      public function getValueString($data){
          $arr=  array_values($data);
//          var_dump($arr);
//          拼接单引号
           $arr=  array_map(function($val){return "'$val'";}, $arr);
          //转为字符处
          return implode(",", $arr);
          
      }
      
           //声明方法 拼接 插入语句
      public function insertValue($post){
          //表单项的所有名字 全部命名为 字段名
          // 寻找字段名
          $data=$this->fiterFields($post);
          //构建字段形式
          $fields=$this->getFieldsString($data); 
          //获取值得字符串
          $values=$this->getValueString($data);
          //拼接语句
           $sql="insert into `{$this->getTable()}`($fields) values($values)";
//          echo $sql;exit;
//           执行语句
           $res = $this->db->query($sql);
          return $res;
      }
      
      //修改方法
      public function modify($post,$condition=""){
//          var_dump($post);exit;
          //调用过滤方法
           $data=$this->fiterFields($post);

           //变量保存拼接的结果
             $str="";
           //遍历$data
           foreach($data as $key=>$val){
               $str.="`$key`='$val',";
           }
           //去掉右端的逗号
           $str=rtrim($str,",");
//           echo $str;exit;
          //构建sql语句
          $sql="update `{$this->getTable()}` set $str ";

          if(!empty($condition)){
              $sql.=" where $condition";
          }else{
              $pkName=$this->fields["pk"];
              $sql.=" where `{$pkName}`='$data[$pkName]'";
          }
//          echo $sql; exit;
//          执行修改语句
          return $this->db->query($sql);
      }
    public function getdatabygroup($field,$condition="",$group,$field1){
        if($condition) {
            $sql = "select $field from `{$this->getTable()}` WHERE $condition GROUP BY `$group` ORDER BY $field1 DESC ";
//            echo $sql; exit;
        }else{
            $sql = "select $field from `{$this->getTable()}`  GROUP BY `$group` ORDER BY $field1 DESC ";
//            echo $sql;exit;
        }
        return $this->db->fetchAll($sql);
    }

    public function getonevalue($field,$condition){
        //构建sql
        $sql="select $field from `{$this->getTable()}` WHERE $condition";

        //执行返回结果
        return $this->db->fetchColumn($sql);
    }

    //创建方法 按照条件搜索
    public function condition($condition){
        //构建sql
        $sql = "SELECT * FROM `{$this->getTable()}` WHERE  user_id='{$condition}'";
//        echo $sql;exit;
        return $this->db->fetchAll($sql);
    }

    //创建方法 查询 前10条活动 展示在微信端
    public function selectBYs(){
        //书写  sql 语句
        $sql = "SELECT * FROM `{$this->getTable()}` ORDER BY `article_id` DESC LIMIT 10";
//        echo $sql;exit;
        return $this->db->fetchAll($sql);
    }


}
