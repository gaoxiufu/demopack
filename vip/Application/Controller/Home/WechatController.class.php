<?php

  //  加载微信sdk

require APP_PATH.'Wechat/autoload.php';

use Overtrue\Wechat\Server;

use Overtrue\Wechat\Message;

use Overtrue\Wechat\Menu;

use Overtrue\Wechat\MenuItem;

use Overtrue\Wechat\Auth;

//定义appid

define('APPID','wx837f8eff98a19b38');

// 定义token

define('TOKEN','luo');

// 定义appsecret

define('SECRET','7ece98a88189e0893e0d1e0941c25434');

//   创建一个微信端处理的控制器

class WechatController extends Controller{

    public function loginAction(){

        $server = new Server(APPID, TOKEN);

        // 监听text消息

        $server->on('message','text',function($message){

            if($message['Content'] == '帮助'){

                return Message::make('text')->content("了解最新活动信息请发送“最新活动”，\r\n登录请发送“登录”，\r\n解除绑定请发送“解除绑定”");

            }

            if($message['Content'] == '最新活动'){

                return Message::make('text')->content('点击链接查看最新活动');

            }

            if($message['Content'] == '解除绑定'){

                return Message::make('text')->content('点击链接解除绑定');

            }

            if($message['Content'] == '登录'){

                return Message::make('text')->content('登陆');

            }

        });

        //监听click事件

        $server->on('event', 'click', function($event) {

            if($event['EventKey'] == 'article'){//如果点击的是 “最新活动”菜单

                //从数据表里面获取最新活动（最多10条）

                $model = new WechatModel();

                $articles = $model->activity();

                $items = array();

                foreach($articles as $article){

                    $item = Message::make('news_item')->title($article['title'])->url('http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Wechat&a=articles&id='.$article['article_id']);

                    $items[] = $item;

                }

                $news = Message::make('news')->items($items);

                return $news;

            }

        });

        echo $server->serve();

    }

    //   设置菜单

    public function setMenuAction(){

        $menuService = new Menu(APPID, SECRET);

        //设置一个一级菜单

        $button0 = new MenuItem("最新活动", 'click', 'article');

        //个人信息，设置一个带二级菜单的一级菜单

        $button1 = new MenuItem("个人信息");

        // 绑定账号

        $button1_1 = new MenuItem('绑定账号','view','http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Wechat&a=band');

        //预约美发

        $button1_2 = new MenuItem('预约美发','view','http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Wechat&a=bespoke');

        //消费记录

        $button1_3 = new MenuItem('消费记录','view','http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Wechat&a=consumes');

        // 排行榜  二级菜单的一级菜单

        $button2 = new MenuItem("排行榜");

        // 充值排行

        $button2_1 = new MenuItem('充值排行','view','http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Wechat&a=band');

        // 消费排行

        $button2_2 = new MenuItem('消费排行','view','http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Wechat&a=band');

        // 服务之星

        $button2_3 = new MenuItem('服务之星','view','http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Wechat&a=band');

        $button1->buttons(array($button1_1,$button1_2,$button1_3));

        $button2->buttons(array($button2_1,$button2_2,$button2_3));

        $menus=array($button0,$button1,$button2);

        try {

            $menuService->set($menus);// 请求微信服务器

            echo'设置成功！';

        } catch (\Exception$e) {

            echo'设置失败：'.$e->getMessage();

        }

    }

    //  创建绑定账号的方法

    public function bandAction(){

        //获取用户openid

        session_start();

        $auth = new Auth(APPID, SECRET);

        if (empty($_SESSION['Wechat_user'])){

            $user = $auth->authorize(); // 返回用户 Bag

            $_SESSION['Wechat_user'] = $user->all();

        } else { // 跳转到其它授权才能访问的页面

            $user = $_SESSION['Wechat_user'];

        }

            $open_id = $user['openid'];//用户的openid

//        echo $open_id;exit;

        //判断用户的openid是否已绑定

        //去数据表里面查该openid是否存在

        $model = new WechatModel();

        $rows = $model->binding($open_id);

//        var_dump($rows);exit;

        //如果存在，显示解绑按钮

        if(!$rows == null){

            require "./Application/View/Home/jiebang.html";

        }else{//如果不存在，跳入绑定页面

            require "./Application/View/Home/band.html";

        }

    }

    public function bangsAction(){

        session_start();

        $auth = new Auth(APPID, SECRET);

        if (empty($_SESSION['Wechat_user'])) {

            $user = $auth->authorize(); // 返回用户 Bag

            $_SESSION['Wechat_user'] = $user->all();

            // 跳转到其它授权才能访问的页面

        } else {

            $user = $_SESSION['Wechat_user'];

        }

        $open_id = $user['openid'];//用户的openid

        $username = $_POST['username'];//用户提交的账号

        $password = $_POST['password'];//用户提交的密码

        $model = new WechatModel();

        $user =$model->select($username,$password);

//        $user_id = $user['user_id'];

        //登录验证，去数据表里面查出该账号密码对应的用户$user

        if($user){ //用户存在

            //绑定（update），将openid放入对应用户的记录里面

            $model->update($open_id,$username);

            echo "绑定成功";

        }else{//用户不存在

            //说明用户名或密码不正确

            echo "用户名或者密码不正确";

        }

    }

    //  清空openid  解除绑定

    public function emptyAction(){

        session_start();

        $auth = new Auth(APPID, SECRET);

        if (empty($_SESSION['Wechat_user'])) {

            $user = $auth->authorize(); // 返回用户 Bag

            $_SESSION['Wechat_user'] = $user->all();

            // 跳转到其它授权才能访问的页面

        } else {

            $user = $_SESSION['Wechat_user'];

        }

        //用户的openid

        $open_id = $user['openid'];

//        echo $open_id;exit;

        $model = new WechatModel();

        $user =$model->remove($open_id);

        if($user){

            echo "已解除绑定";

        }

    }

    //  显示所有活动

    public function articlesAction(){

        $id = $_GET['id'];

        $model = new WechatModel();

        $rows = $model->getOne($id);

//        var_dump($rows);exit;

        require "./Application/View/Home/activity.html";

    }

    // 消费记录

    public function consumesAction(){

        //获取用户openid

        session_start();

        $auth = new Auth(APPID, SECRET);

        if (empty($_SESSION['Wechat_user'])){

            $user = $auth->authorize(); // 返回用户 Bag

            $_SESSION['Wechat_user'] = $user->all();

        } else { // 跳转到其它授权才能访问的页面

            $user = $_SESSION['Wechat_user'];

        }

        //用户的openid

        $open_id = $user['openid'];

        //判断用户的openid是否已绑定

        //去数据表里面查该openid是否存在

        $model = new WechatModel();

        $rows = $model->getRow($open_id);

        $username = $rows['username'];

//        var_dump($username);exit;

        $res = $model->record($username);

//        var_dump($res);exit;

        //如果存在，显示解绑按钮

        if($res){

            require "./Application/View/Home/xiaofei.html";

        }else{//如果不存在，跳入绑定页面

            echo "请先绑定";

            require "./Application/View/Home/band.html";

        }



    }

    //  预约美发

    public function bespokeAction(){

        //获取用户openid

        session_start();

        $auth = new Auth(APPID, SECRET);

        if (empty($_SESSION['Wechat_user'])){

            $user = $auth->authorize(); // 返回用户 Bag

            $_SESSION['Wechat_user'] = $user->all();

        } else { // 跳转到其它授权才能访问的页面

            $user = $_SESSION['Wechat_user'];

        }

        //用户的openid

        $open_id = $user['openid'];

        //判断用户的openid是否已绑定

        //去数据表里面查该openid是否存在

        $model = new WechatModel();

        $res = $model->getRow($open_id);

        $rows = $model->bespeak();

        require "./Application/View/Home/bespoke.html";

    }

    // 创建add控制器

    public function addAction(){

        //  获取表单数据

        $post = $_POST;

        $model = new WechatModel();

        if($model->join($post)){

            echo "预约成功，请返回";

        }

    }



  //创建方法 显示充值排行榜
    public function chongzhiAction(){
        //调用消费表 model
        $model = new HistoriesModel();
        $rows = $model->chongzhi();
//        var_dump($rows);exit;
        require CURRENT_VIEW_PATH.'chongzhi.html';
    }

    //创建方法 显示消费排行榜
    public function xiaofeiAction(){
        //调用消费表  model
        $model = new HistoriesModel();
        $rows = $model->xiaofei();
//        var_dump($rows);exit;

        require CURRENT_VIEW_PATH.'xiaofei.html';
    }

    //创建方法 显示服务排行榜
    public function fuwuAction(){
        //调用消费表 model
        $model = new HistoriesModel();
        $rows = $model->fuwu();
//        var_dump($rows);exit;
        require CURRENT_VIEW_PATH.'fuwu.html';
    }




    //获取菜单

    public function getMenuAction()

    {

        $menuService = new Menu(APPID, SECRET);

        $menus = $menuService->get();

        echo '<pre>';

        var_dump($menus);

    }

}