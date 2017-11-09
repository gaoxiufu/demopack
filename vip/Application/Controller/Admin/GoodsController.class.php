<?php

/**
 * Description of GoodsController
 *
 * @author Administrator
 */
class GoodsController extends PlatFormController{
    //定义基础数据
    //当前页面  每页显示的条数
    //书写列表方法
    public function listAction(){
        $pageSize=2;
        //获取当前所在的页码 当前的页面
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //判定当前页面不能小于等于0        
        if($pageIndex<=0) $pageIndex=1;
        //寻找数据的总条数    
        //从model中读取所有数据
        $model=new GoodsModel();
        //获取数据的总条数
       $num = $model->getRecordsCount();
       //计算总页数
       $pageTotal=  ceil($num/$pageSize);
       //验证临界点最大页码
       if($pageIndex>=$pageTotal) $pageIndex=$pageTotal;
        //调用getList方法
        $rows=$model->getList("*",$pageIndex,$pageSize);
        //载入视图
//        require CURRENT_VIEW_PATH.'Goods/li.html';
        $this->assign('rows',$rows);//$'rows'=$rows
        $this->assign('num',$num);
        $this->assign('pageIndex',$pageIndex);
        $this->assign('pageTotal',$pageTotal);
        $this->display('list');
    }
    public function addAction(){
        //        绑定分类
        $cateModel=new CategoryModel();
        $rows=$cateModel->getList();
        require CURRENT_VIEW_PATH."Goods/cccccc.html";
    }
    //添加insert方法
    public function insertAction(){
        //获取传值
        $post=$_POST;
        $num1=isset($post["is_new"])?$post["is_new"]:0;
        $num2=isset($post["is_best"])?$post["is_best"]:0;
        $num3=isset($post["is_hot"])?$post["is_hot"]:0;
        //商品状态
        $post["goods_status"]=$num1+$num2+$num3;
        //取文件
        $file=$_FILES["goods_img"];
        //使用工具类
        $upload=new FileUploadTool();
        //调用上传方法
        $name=$upload->upload($file);
        //没有上传成功
        if(!$name){
            //跳转到表单页面
            static::jump("index.php?p=Admin&c=Goods&a=add",3,$upload->msg);
            exit;
        }
        //将名字设置到$post中
        $post["image_ori"]=$name;

        //制作缩略图
        //判定勾选
        if(isset($post["auto_thumb"])){
            //new缩略图工具类
            $thumb=new ThumbPicTool();
            //制作缩略图
            $thName=$thumb->makeThumb("./Public/Upload/$name");
            //缩略图名字入库
            $post["goods_thumb"]=$thName;
        }


        //调用model插入数据
        $model=new GoodsModel();
        if($model->insert($post)){
            static::jump("index.php?p=Admin&c=Goods&a=list");
        }

    }
}
