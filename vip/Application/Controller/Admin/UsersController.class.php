<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/9
 * Time: 22:34
 */
header("content-type:text/html;charset=utf-8");

//创建会员管理类
class UsersController extends Controller{

    //创建list方法
    public function listAction(){
        $pageSize=3;
        //获取当前所在的页码 当前的页面
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //判定当前页面不能小于等于0
        if($pageIndex<=0) $pageIndex=1;
        //寻找数据的总条数
        //从model中读取所有数据
        $model=new UsersModel();
        //获取数据的总条数
        $num = $model->getRecordsCount();
        //计算总页数
        $pageTotal=  ceil($num/$pageSize);
        //验证临界点最大页码
        if($pageIndex>=$pageTotal) $pageIndex=$pageTotal;
        //调用getList方法
        $rows=$model->getList("*",$pageIndex,$pageSize);

        $this->assign('rows',$rows);
        $this->assign('pageSize',$pageSize);
        $this->assign('pageIndex',$pageIndex);
        $this->assign('pageTotal',$pageTotal);
        $this->assign('num',$num);

        $this->display("list");
    }

    //创建add 方法
    public function addAction(){
        require CURRENT_VIEW_PATH . "Users/add.html";
    }

    //创建insert 方法 新增会员
    public function insertAction(){
        //说起所有数据
        $post = $_POST;
        if ($post['remember'] == 1) {
            //实例化model
            $model = new UsersModel();
            //调用insert方法
            if (!$model->insert($post) || $post['password'] == '' || $post['password'] != $post['passwordnew']) {
                static::jump("index.php?p=Admin&c=Users&a=add", 2, "输入错误！请重新输入！ 两秒后返回！");
            } else {
                static::jump("index.php?p=Admin&c=Users&a=list");
            }
        } else {
            //获取上传文件名
            $file = $_FILES['photo'];
            //使用工具类
            $upload = new FileUpLoadTool();
            //调用上传方法
            $name = $upload->upload($file);
            if (!$name) {
                //跳转到表单页面
                static::jump("index.php?p=Admin&c=Users&a=add", 2, $upload->msg);
                exit;
            }
            //将名字设置到$post中
            $post["photo"] = $name;
            //实例化model
            $model = new UsersModel();
            //调用insert方法
            if (!$model->insert($post) || $post['password'] == '' || $post['password'] != $post['passwordnew']) {
                static::jump("index.php?p=Admin&c=Users&a=add", 2, "输入错误！请重新输入！ 两秒后返回！");
            } else {
                static::jump("index.php?p=Admin&c=Users&a=list");
            }
        }
    }


    //创建 remove 方法删除数据
    public function removeAction(){
        $id=$_GET['id'];
        //实例化model
        $model= new UsersModel();
         $rows = $model->getRowByKey($id);
        if($rows['money']>0){
            static::jump("index.php?p=Admin&c=Users&a=list",2,"不能删除此会员！");
        }elseif($model->remove($id)){
            static::jump("index.php?p=Admin&c=Users&a=list");
        }

    }

    //创建edit 方法 绑定查看会员信息
    public function editAction(){
        $id = $_GET['id'];
        $model= new UsersModel();
        $rows = $model->getRowByKey($id);
//        var_dump($rows);exit;
        $this->assign('row',$rows);
        $this->display('edit');
    }

    //创建update 方法 修改会员信息
    public function updateAction(){
        //获取数据
        $post = $_POST;
        $file=$_FILES['photo'];
        if (!empty($file['tmp_name'])) {
            //使用工具类
            $upload=new FileUpLoadTool();
            //调用上传方法
            $name=$upload->upload($file);
            if(!$name){//没有上传成功
                //跳转到表单页面
                static::jump("index.php?p=Admin&c=Goods&a=add",3,$upload->msg);
                exit;
            }
            //将名字设置到$post中
            $post["photo"]=$name;
        }
        //调用model
        $model = new UsersModel();
        if($model->modify($post)){
            static::jump("index.php?p=Admin&c=Users&a=list");
        }
    }

    //创建show 方法  搜索数据
    public function showAction(){
        $get = $_GET;
        $val=$get['val'];
        //判断 搜索框 内容情况
        if($val==""){
            static::jump("index.php?p=Admin&c=Users&a=list",2,"搜索条件不能为空！");
        }else{
            //开始分页
            $pageSize=3;//
            //当前页
            $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
            //判定当前页面不能小于等于0
            if($pageIndex<=0) $pageIndex=1;
            //寻找数据的总条数
            //从model中读取所有数据
            $model=new UsersModel();
            //获取数据的总条数
            $num = $model->num($val);
            //计算总页数
            $pageTotal= ceil($num/$pageSize);
            //验证临界点最大页码
            if($pageIndex>=$pageTotal) $pageIndex=$pageTotal;
            $rows=$model->seek($val,$pageIndex,$pageSize);
            if($rows==null){
                echo "<script>alert('搜索无结果！');location.href='index.php?p=Admin&c=Users&a=list';</script>";
            }else{
                //传值
                $this->assign('rows', $rows);
                $this->assign('num', $num);
                $this->assign('pageTotal', $pageTotal);
                $this->assign('pageSize', $pageSize);
                $this->assign('pageIndex', $pageIndex);
                $this->assign('val', $val);
                //定义模板
                $this->display('seek');
            }
        }
//
    }

    //创建方法  载入视图 数据
    public function showPlusAction(){
        $id = $_GET['id'];
        $model= new UsersModel();
         $rows = $model->getRowByKey($id);
//        var_dump($rows);exit;
        $this->assign('row',$rows);
        $this->display('plus');

//        require CURRENT_VIEW_PATH . "Users/plus.html";
    }



    //创建方法 充值金额
    public function plusAction(){
        //获取数据显示
        $post = $_POST;
//        var_dump($post);exit;
        $id = $post['user_id'];
        //获取原有的金额
        $model = new UsersModel();
        $row = $model->getRowByKey($id);
//        var_dump($row);exit;
        //判断充值金额是否为空 和充值优惠
        if ($post['money'] <= 0) {
            static::jump("index.php?p=Admin&c=Users&a=list", 2, "充值失败，请输入有效金额！");
        } elseif ($post['money'] >= 500 && $post['money'] < 1000) {
            //获得充值后的金额
            $post['money'] = $row['money'] + $post['money'] + 100;//充值后余额
            $model = new UsersModel();
            $model->modify($post);
            //插入充值记录
            $post['amount']=$post['money']-$row['money'];//本次充值金额（优惠后）
            $post['remainder']=$post['money'];//充值后余额
            $post['user_id']=$post['realname'];//充值会员的名字
            $model1 = new HistoriesModel();
            $model1->insertValue($post);

            static::jump("index.php?p=Admin&c=Users&a=list", 2, "恭喜充值成功！");
        } elseif ($post['money'] >= 1000 && $post['money'] < 5000) {
            $post['money'] = $row['money'] + $post['money'] + 300;
            $model = new UsersModel();
            $model->modify($post);
            //插入充值记录
            $post['amount']=$post['money']-$row['money'];//本次充值金额（优惠后）
            $post['remainder']=$post['money'];//充值后余额
            $post['user_id']=$post['realname'];//充值会员的名字
            $model1 = new HistoriesModel();
            $model1->insertValue($post);

            static::jump("index.php?p=Admin&c=Users&a=list", 2, "恭喜充值成功！");
        } elseif ($post['money'] >= 5000) {
            $post['money'] = $row['money'] + $post['money'] + 2000;
            $model = new UsersModel();
            $model->modify($post);
            //插入充值记录
            $post['amount']=$post['money']-$row['money'];//本次充值金额（优惠后）
            $post['remainder']=$post['money'];//充值后余额
            $post['user_id']=$post['realname'];//充值会员的名字
            $model1 = new HistoriesModel();
            $model1->insertValue($post);
            static::jump("index.php?p=Admin&c=Users&a=list", 2, "恭喜充值成功！");
        } else {
            $post['money'] = $row['money'] + $post['money'];
            $model = new UsersModel();
            $model->modify($post);
            //插入充值记录
            $post['amount']=$post['money']-$row['money'];//本次充值金额（优惠后）
            $post['remainder']=$post['money'];//充值后余额
            $post['user_id']=$post['realname'];//充值会员的名字
            $model1 = new HistoriesModel();
            $model1->insertValue($post);
            static::jump("index.php?p=Admin&c=Users&a=list", 2, "恭喜充值成功！");
        }
    }


        //创建 showConsume 方法 显示消费页面 绑定数据
    public function showConsumeAction(){
        //获取Users表会员账号和名字
        $id = $_GET['id'];
        $model= new UsersModel();
        $row = $model->getRowByKey($id);

        //获取plans套餐表的 套餐信息 并且绑定数据到页面
        $model1 = new PlansModel();
        $rows1 = $model1->getList();

        //获取 员工表数据  绑定页面
        $model2 = new MembersModel();
        $rows2 = $model2->getList();

        $this->assign('row',$row);
        $this->assign('rows1',$rows1);
        $this->assign('rows2',$rows2);
        $this->display('consume');
//        require CURRENT_VIEW_PATH . "Users/consume.html";
    }


    //创建方法 计算消费
    public function consumeAction(){
            //获取表单数据
            $post=$_POST;
//        var_dump($post);exit;
            $id=$post['user_id'];
            //获取会员原有金额
            $model= new UsersModel();
            $row = $model->getRowByKey($id);
            $str=$post['xiaofei'];
            //本次服务员工
            $waiter =$post['name'];
            //获取本次消费套餐
            $plans = strstr ($str,'-',true);

            //获取本次消费金额
            $money = ltrim(strstr($str, '-'), '-');

            //判断余额不足
            if ($row['money'] < $money) {
                static::jump("index.php?p=Admin&c=Users&a=list", 2, "余额不足，请充值后消费！");
            } elseif($row['is_vip']=="是"){
                //计算消费后的金额
                $post['money'] = $row['money']-$money/2;
                $model->modify($post);
                //插入消费记录
                $post['member_id']=$waiter;//本次服务员
                $post['amount']=$money/2;//本次消费金额(优惠后)
                $post['user_id']=$post['realname'];//本次消费会员
                $post['remainder']=$post['money'];//消费后余额
                $post['content']=$plans;//消费内容

                $model1 = new HistoriesModel();
                $model1->insertValue($post);

                static::jump("index.php?p=Admin&c=Users&a=list");
            }else{
                //计算消费后的金额
                $post['money'] = $row['money']-$money;
                $model->modify($post);
                //插入消费记录
                $post['member_id']=$waiter;//本次服务员
                $post['amount']=$money;//本次消费金额
                $post['user_id']=$post['realname'];//本次消费会员
                $post['remainder']=$post['money'];//消费后余额
                $post['content']=$plans;//消费内容

                $model1 = new HistoriesModel();
                $model1->insertValue($post);

                static::jump("index.php?p=Admin&c=Users&a=list");
            }


    }

    //创建控制器  载入个人消费记录页面
    public function showRecordAction(){
        //获取id
        $realname = $_GET['realname'];
        //调用model
        $model = new HistoriesModel();
        $rows = $model->showRecord($realname);

        $this->assign('rows',$rows);
        $this->display('record');

    }

    //创建方法 显示会员是否有预约
    public function orderAction(){


        require CURRENT_VIEW_PATH . "Order/show.html";
    }



}