<?php
//引入微信sdk的自动加载文件
require APP_PATH.'wechat/autoload.php';
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;
use Overtrue\Wechat\Auth;

define('APPID','wx73fa1807dcd1e55a');
define('TOKEN','xie');
define('SECRET','1bc405c476b8cedcd3c7441f1a63321d');
class xieruiController extends Controller{
    public function indexAction(){
        $appId = 'wx73fa1807dcd1e55a';
        $token = "xie";
        $server = new Server($appId, $token);
        //监听text消息
        $server->on('message', 'text', function ($message) {
            if ($message['Content'] == '帮助') {
                return Message::make('text')->content("发送:【最新活动】获取最新活动信息！\r\n发送:【解除绑定】解除账号绑定！");
            }
            if ($message['Content'] == '最新活动') {

            }
        });
        //监听click事件
        $server->on('event', 'CLICK', function($event){
            if($event['EventKey']=="article"){
                //从数据表里面获取最新活动（最多10条）
                $articles = array(//演示数据
                    array('id'=>1,'title'=>'第一条活动标题'),
                    array('id'=>2,'title'=>'第二条活动标题')
                );

                $items=array();
                foreach($articles as $article){
                    $item=Message::make('news_item')->title($article['title'])->description('好不好说句话？')->url('http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Gao&a=articleView&id='.$article['id']);
                    $items[]=$item;
                }
                $news=Message::make('news')->items($items);
                return $news;
            }

//            return Message::make('text')->content($event['EventKey']);//点击菜单调试使用
        });



        echo $server->serve();
    }

    //设置菜单
    public function setMenAction(){
        $menuService = new Menu(APPID, SECRET);
        $button0=new MenuItem("最新活动", 'click', 'article');//一级菜单

        $button1 = new MenuItem("个人信息");//二级菜单1
        $button1_1 = new MenuItem('绑定账号', 'view', 'http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Gao&a=binding');
        $button1_2 = new MenuItem('预约美发', 'view', 'http://phpweixin.itsource.cn');
        $button1_3 = new MenuItem('消费记录', 'view','http://phpweixin.itsource.cn');

        $button2 = new MenuItem("排行榜");//二级菜单2
        $button2_1 = new MenuItem('充值排行榜', 'view', 'http://phpweixin.itsource.cn');
        $button2_2 = new MenuItem('消费排行榜', 'view', 'http://phpweixin.itsource.cn');
        $button2_3 = new MenuItem('服务之星', 'view', 'http://phpweixin.itsource.cn');

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

    //创建方法  获取openid
    public function openIdAction(){
        //获取用户openid
        session_start();
        $auth = new Auth(APPID, SECRET);
        if (empty($_SESSION['weixin_user'])) {
            $user = $auth->authorize(); // 返回用户 Bag
            $_SESSION['weixin_user'] = $user->all();
            // 跳转到其它授权才能访问的页面
        } else {
            $user = $_SESSION['weixin_user'];
        }
        return $user;
    }

    //创建绑定账号页面
    public function bindingAction(){
        //调用方法 获取openid
        $user= $this->openIdAction();
        $openid=$user['openid'];

        //判断用户的openid是否已绑定
        //去数据表里面查该openid是否存在
        //调用UsersModel
        $model = new UsersModel();
        $result=$model->selects($openid);
        if($result==null){//如果不存在，显示绑定表单
            echo '请先绑定账号!';
            require CURRENT_VIEW_PATH.'binding.html';
        }else{
            require CURRENT_VIEW_PATH.'delete.html';
        }
    }

    public function bangAction(){
        //调用方法 获取openid
        $user= $this->openIdAction();
        $post = $_POST;
        $post['openid'] = $user['openid'];//用户的openid
        //登录验证，去数据表里面查出该账号密码对应的用户$user
        //实例化usermodel
        $model = new UsersModel();
        $user= $model->selectOne($post);
        $post['user_id']=$user['user_id'];
        if($user){ //用户存在
            //绑定更新openid
            $model->modify($post);
            echo "恭喜绑定成功！";

        }else{//用户不存在
            echo "用户名或者密码输错误";
        }
    }

    //创建方法 解除绑定
    public function deleteAction(){
        //调用方法 获取openid
        $user= $this->openIdAction();
        $openid = $user['openid'];
        //实例化usermodel
        $model = new UsersModel();
        $result=$model->modifyOpenid($openid);
        if($result){
            echo "已解除绑定！";
        }
    }

    //活动页面
    public function articleViewAction(){

        echo $id = $_GET['id'];
        //1 从数据表获取该活动的记录
        //2 调用模板显示活动内容

    }



}