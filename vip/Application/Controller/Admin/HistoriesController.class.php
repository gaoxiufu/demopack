<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/11
 * Time: 14:59
 */
class HistoriesController extends Controller{
    //创建方法 增加消费记录
    public function insertAction(){
        //实例化usersModel
        $model = new UsersModel();

    }

    //创建方法  显示消费记录分页
    public function showAction(){
        //读取会员表信息
//        $model1=new UsersModel();
//        $rows1=$model1->getAll();
//        foreach($rows1 as $row1){
//            echo $row1['user_id'];
//        }
//
        $pageSize = 3;
        //获取当前所在的页码 当前的页面
        $pageIndex = isset($_GET["pageIndex"]) ? $_GET["pageIndex"] : 1;
        //判定当前页面不能小于等于0
        if ($pageIndex <= 0) $pageIndex = 1;
        //寻找数据的总条数
        //从model中读取所有数据
        $model = new HistoriesModel();
        //获取数据的总条数
        $num = $model->getRecordsCount();
        //计算总页数
        $pageTotal = ceil($num / $pageSize);
        //验证临界点最大页码
        if ($pageIndex >= $pageTotal) $pageIndex = $pageTotal;
        //调用getList方法
        $rows = $model->getList("*", $pageIndex, $pageSize);

        $this->assign('rows', $rows);
        $this->assign('pageSize', $pageSize);
        $this->assign('pageIndex', $pageIndex);
        $this->assign('pageTotal', $pageTotal);
        $this->assign('num', $num);
        $this->display("list");

//        require CURRENT_VIEW_PATH . "Histories/list.html";
    }

    //  会员消费榜
    public function consumeAction(){
        $model = new HistoriesModel();
        $rows = $model->getlistgroup('`user_id`,sum(amount)', "`type`='消费'", 'user_id', 'sum(amount)');
        $model2 = new UsersModel();
        $arrs = array();
        $i=1;
        foreach ($rows as $row) {
            $row['username'] = $model2->getone('username', "user_id={$row['user_id']}");
            $row['id']=$i;
            $arrs[] = $row;
            $i++;
        }
        $rows=$arrs;
//        echo "<pre>";
//        var_dump($rows);exit;
        require CURRENT_VIEW_PATH . "Histories/reveal.html";

    }
    // 会员充值排行
    public function rechargeAction(){
        $model = new HistoriesModel();
        $rows = $model->recharge('`user_id`,sum(amount)', "`type`='充值'", 'user_id', 'sum(amount)');
        $users = new UsersModel();
        $array = array();
        $i=1;
        foreach ($rows as $row) {
            $row['username'] = $users->getone('username', "user_id={$row['user_id']}");
            $row['id']=$i;
            $array[] = $row;
            $i++;
        }
        $rows=$array;
        require CURRENT_VIEW_PATH . "Histories/recharge.html";

    }

    //创建方法 显示消费排行帮
    public function xiaofeiAction(){
        $model = new HistoriesModel();
        $rows = $model->xiaofei();
//var_dump($rows);exit;
        $this->assign('rows',$rows);
        $this->display('xiaofei');

    }

    //创建方法 显示充值排行帮
    public function chongzhiAction(){
        $model = new HistoriesModel();
        $rows = $model->chongzhi();

        $this->assign('rows',$rows);
        $this->display('chongzhi');

    }


    //创建方法 显示服务排行帮
    public function fuwuAction(){
        $model = new HistoriesModel();
        $rows = $model->fuwu();

        $this->assign('rows',$rows);
        $this->display('fuwu');

    }

}