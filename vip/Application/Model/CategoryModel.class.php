<?php

/**
 * Description of CategoryModel
 *
 * @author Administrator
 */
class CategoryModel extends Model {
//    public $tree=array();
    //获取所有数据
    public function getList(){
        //执行返回结果
        $rows=$this->getAll();    
        //返回树形菜单
        return $this->getTree($rows);       
    }
    
    //书写方法 排除包含自身的所有子类
    public function getParents($id){  
         $rows=$this->getAll();    
        //返回树形菜单
        $shengxia=$this->getTree($rows,0,0,$id); 
       return $shengxia;
        
    }
//     public function getTree1($arr,$pid=0,$deep=0){
//        static $data=array();
//        //遍历 数组 取出每行 当这行的parent_id=0
//        foreach ($arr as $row){
//            //寻找顶级分类
//            if($row["parent_id"]==$pid){
//                $row["deep"]=$deep;
//                //记录缩进和分类名
//                $row["txt"]=  str_repeat("&nbsp;", $deep*3).$row["cateName"];
//                //利用Data保存每行数据
//                $data[]= $row;  
//       
//                //递归调用
//                 $this->getTree1($arr,$row["id"],$deep+1);
//            }
//        }
//        //返回保存的$data数据
//        return $data;
// }

    //声明方法取得树形菜单
    //寻找顶层元素
    public function getTree($arr,$pid=0,$deep=0,$id=-1){
        static $data=array();
        //遍历 数组 取出每行 当这行的parent_id=0
        foreach ($arr as $row){
            //寻找顶级分类
            if($row["parent_id"]==$pid &&$row["parent_id"]!=$id&&$row["id"]!=$id){
                $row["deep"]=$deep;
                //记录缩进和分类名
                $row["txt"]=  str_repeat("&nbsp;", $deep*3).$row["cateName"];
                //利用Data保存每行数据
                $data[]= $row;  
       
                //递归调用
                    $this->getTree($arr,$row["id"],$deep+1,$id);
            }
        }
        //返回保存的$data数据
        return $data;
    }
    //添加删除方法
    public function remove($id){
        //寻找是否有一行数据的父类编号 等于当前编号
        //获取所有数据
        $rows=$this->getList();
        //遍历数据
        foreach($rows as $row){
//            寻找是否有一行数据的父类编号 等于当前编号
            if($row["parent_id"]==$id){
                return false;
            }
        }
        //没有找到有子类的现象 直接删除该分类
        //定义sql语句
//          $sql="delete from category where id=$id";
          return $this->delete($id);        
    }
//    修改model 添加insert 方法
    public function insert($post){
         return $this->insertValue($post);         
         
    }
    //添加获取一条数据
    public function getRow($id){

        return $this->getRowByKey($id);
    }
    //增加update方法
    public function update($post){
        //在 同类下有没有除自己外相同名字  
        $cateName=$post["cateName"];
        //取得父亲编号
        $parent_id=$post["parent_id"];   
        //取得自身id
        $id=$post["id"];
        //获取intro
        $intro=$post["intro"];
        //遍历树形菜单
        $rows=$this->getList();
        foreach($rows as $row){
            //还需要排除自身 存在同类下的相同名字
            if($row["parent_id"]==$parent_id&&$row["cateName"]==$cateName&&$row["id"]!=$id){
                return false;
            }
        }
//        制作修改语句
//        $sql="update Category set cateName='$cateName',parent_id=$parent_id,intro='$intro' where id=$id";
        //返回执行结果
        return $this->modify($post);
        
    }
}
