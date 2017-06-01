<?php
class MembersController extends Controller {

    private $ca = '0c786af0cae579777bab9b7ff69ccb51';
    private $k = 'cb9c583bbf22bbe3e2cddc160ce72256';
//����loginAction����
    public function loginAction(){
        require CURRENT_VIEW_PATH."Members/login.html";
    }
    //���创建�list�控制器��
    public function listAction(){
        //获取数据���
        $post = $_POST;
        $username = $post['username'];
        $password = md5($post['password']);
        //实例化 model
        $model = new MembersModel();
        $rows = $model->getOne($post);
        if($rows['username']==$username){
            //开启session;
            session_start();
            $_SESSION["isLogin"]=true;
            if($rows) {
                if (isset($post["remember"])) {
                    //记录cookie的值
                    setcookie("id", $rows["member_id"], time() + 5);
                    setcookie("adminPwd", $rows["password"], time() + 5);
                } else {
                    //设置cookie过期
                    setcookie("id", $rows["member_id"], time() - 1);
                    setcookie("adminPwd", $rows["password"], time() - 1);
                }
                static::jump("index.php?p=Admin&c=Users&a=list");
            }else{
                static::jump("index.php?p=Admin&c=Members&a=login", 2, "登陆失败两秒后返回！");
            }

        }else{
            static::jump("index.php?p=Admin&c=Members&a=login", 2, "登陆失败两秒后返回！");
        }



    }

    //创建add 控制器
    public function addAction(){
        require CURRENT_VIEW_PATH."Members/add.html";
    }
    //  显示所有数据
    public function showAction(){
        //  从model中取得所有数据
//        $model = new MembersModel();
//          调用list方法
//        $rows = $model->getLists();
        $pageSize=3;
        //获取当前所在的页码 当前的页面
        $pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
        //判定当前页面不能小于等于0
        if($pageIndex<=0) $pageIndex=1;
        //寻找数据的总条数
        //从model中读取所有数据
        $model = new MembersModel();
        $rows = $model->getLists();
        //获取数据的总条数
        $num = $model->getRecordsCount();
        //计算总页数
        $pageTotal=  ceil($num/$pageSize);
        //验证临界点最大页码
        if($pageIndex>=$pageTotal) $pageIndex=$pageTotal;
        //调用getList方法
        $rows=$model->getList("*",$pageIndex,$pageSize);
        //载入视图
        require CURRENT_VIEW_PATH.'Members/list.html';
    }
    // 删除用户的方法  按照id删除
    public function deleteAction(){
        //  从model中取得所有数据
        $id = $_GET['id'];
        $model = new MembersModel();
        if($model->delete($id)){
            static::jump("index.php?p=Admin&c=Members&a=show");
        }else{
            static::jump("index.php?p=Admin&c=Members&a=show");
        }
    }
    //  修改用户信息，按照id修改
    public function editAction(){
        $id = $_GET['id'];
        $post = $_POST;
        $model = new MembersModel();
        $rows = $model->edit($id);
        require CURRENT_VIEW_PATH.'Members/edit.html';
    }
//    //  执行修改
    public function updateAction(){
            $post = $_POST;
            $model = new MembersModel();
        if($model->update($post)){
            static::jump("index.php?p=Admin&c=Members&a=show");
        }else{
            static::jump("index.php?p=Admin&c=Members&a=show",2,"操作失败");
        }
    }
    //创建insert 方法 新增用户
    public function appendAction(){
        //获取表单提交的数据
        $post = $_POST;
//        var_dump($post);exit;
        if ($post['remember'] == 1) {
            //实例化model
            $model = new MembersModel();
            if (!$model->insert($post) || $post['password'] == '' || $post['password'] != $post['passwordnew']){
                static::jump("index.php?p=Admin&c=Members&a=show", 2, "1！ 两秒后返回！");
            } else {
                static::jump("index.php?p=Admin&c=Members&a=show");
//                echo '注册成功';
            }
        } else {
            //获取上传文件名
            $file = $_FILES['photo'];
//            var_dump($file);exit;
            //使用工具类s
            $upload = new FileUpLoadTool();
            //调用上传方法
            $name = $upload->upload($file);
            if (!$name) {
                //跳转到表单页面
                static::jump("index.php?p=Admin&c=Members&a=add", 2, $upload->msg);
                exit;
            }
            //将名字设置到$post中
            $post["photo"] = $name;
            //实例化model
            $model = new MembersModel();
            //调用insert方法
            if (!$model->insert($post) || $post['password'] == '' || $post['password'] != $post['passwordnew']) {
                static::jump("index.php?p=Admin&c=Members&a=add", 2, "2！ 两秒后返回！");
            } else {
                static::jump("index.php?p=Admin&c=Members&a=list");
            }
        }
    }

    public function checkLoginAction()
    {
        session_start();

        $GtSdk = new GeetestlibTool($this->ca, $this->k);
        $user_id = $_SESSION['user_id'];
        if ($_SESSION['gtserver'] == 1) {
            $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $user_id);
            if ($result) {
                echo 'Yes';
            } else{
                echo 'No';
            }
        }else{
            if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
                echo "yes";
            }else{
                echo "no";
            }
        }
    }

    public function startCaptchaAction()
    {
        $GtSdk = new GeetestLibTool($this->ca, $this->k);
        session_start();
        $user_id = "test";
        $status = $GtSdk->pre_process($user_id);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $user_id;
        echo $GtSdk->get_response_str();
    }

}
