<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/16
 * Time: 14:17
 */
//引入sdk
require APP_PATH."Wechat/autoload.php";
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;
use Overtrue\Wechat\Auth;


define('APPID','wxb641183b73b548ca');
define('TOKEN','gao');
define('SECRET','f588103359522a876e91874a4c02076a');

class GaoController extends Controller{

    public function indexAction(){
        $appId = 'wxb641183b73b548ca';
        $token = "gao";
        $server = new Server($appId, $token);

        //自动回复
        $server->on('event', 'subscribe', function($event){
            return Message::make('text')->content('您好！欢迎关注!');
});

        //监听text消息
        $server->on('message', 'text', function ($message) {
            if ($message['Content'] == '帮助') {
                return Message::make('text')->content("发送:【最新活动】获取最新活动信息！\r\n发送:【解除绑定】解除账号绑定！");
            }elseif ($message['Content'] == '最新活动') {
                $model  = new ArticleModel();
                $articles=$model->selectBY();
                $items=array();
                foreach($articles as $article){
                    $item=Message::make('news_item')->title($article['title'])->url('http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Gao&a=articleView&id='.$article['article_id']);
                    $items[]=$item;
                }
                $news=Message::make('news')->items($items);
                return $news;
            }elseif($message['Content'] == '解除绑定'){
                $openid=$message['FromUserName'];
                //调用UsersModel
                $model = new UsersModel();
                $result=$model->selects($openid);
                if($result){
                    $model->modifyOpenid($openid);
                    return Message::make('text')->content("账号已解绑！");
                }else{
                    return Message::make('text')->content("账号未绑定！");
                }
            }else{
                return Message::make('text')->content("您可以输入【帮助】！");
            }

        });


        //监听click事件
        $server->on('event', 'CLICK', function($event){
            if($event['EventKey']=="article"){
                //从数据表里面获取最新活动（最多10条）
                //实例化活动表方法
                $model  = new ArticleModel();
                $articles=$model->selectBY();
                $items=array();

                foreach($articles as $article){
                    $item=Message::make('news_item')->title($article['title'])->url('http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Gao&a=articleView&id='.$article['article_id']);
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
        $button1_2 = new MenuItem('预约美发', 'view', 'http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Gao&a=order');
        $button1_3 = new MenuItem('消费记录', 'view','http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Gao&a=histories');

        $button2 = new MenuItem("排行榜");//二级菜单2
        $button2_1 = new MenuItem('充值排行榜', 'view', 'http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Gao&a=chongzhi');
        $button2_2 = new MenuItem('消费排行榜', 'view', 'http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Gao&a=xiaofei');
        $button2_3 = new MenuItem('服务之星', 'view', 'http://phpweixin.itsource.cn/team16/vip/index.php?p=Home&c=Gao&a=fuwu');

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
            echo "您已绑定账号，需要解绑吗？";
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
        //获取活动id 通过id获取该活动的记录
        $id = $_GET['id'];
        //调用article model
        $model = new ArticleModel();
        $rows = $model->getRowByKey($id);
//        var_dump($rows);exit;
        //2 调用模板显示活动内容
        require CURRENT_VIEW_PATH.'article.html';

    }


    //创建方法 展示消费记录
    public function historiesAction(){
        //调用方法 获取openid
        $user= $this->openIdAction();
        $openid = $user['openid'];
        //查询users表 openid 对应的会员
        $model =new UsersModel();
        $result = $model->selects($openid);
        if($result==null){
            echo '请先绑定账号!';
            require CURRENT_VIEW_PATH.'binding.html';
        }else{
            foreach($result as $row){

            }
            $name = $row['realname'];
            //查询histories消费记录表 对比用户
            $model1 =new HistoriesModel();
            $rows = $model1->selects($name);
            require CURRENT_VIEW_PATH.'histories.html';
        }
    }

    //创建方法 显示客户预约
    public function orderAction(){
        //调用方法 获取openid
        $user= $this->openIdAction();
        $openid=$user['openid'];
        //查询users表 openid 对应的会员 获取名字
        $model =new UsersModel();
        $result = $model->selects($openid);
        if($result==null){
            echo '请先绑定账号!';
            require CURRENT_VIEW_PATH.'binding.html';
        }else{
            foreach($result as$row){
            }
            $phone = $row['telephone'];
            $name = $row['realname'];
            //获取员工名字
            $model1 =new MembersModel();
            $rows = $model1->getLists();
            //引入页面 绑定数据
            require CURRENT_VIEW_PATH.'order.html';
        }
    }

    //创建方法 新增预约信息
    public function insertAction(){
        $post=$_POST;
        //调用 order model
        $model = new OrderModel();
        $model->insert($post);
        echo "恭喜您预约成功！";
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