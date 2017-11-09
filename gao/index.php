<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/15
 * Time: 15:59
 */
//获取微信post 发来的数据、
$postStr = file_get_contents('php://input');
//保存信息  应用调试
file_put_contents('post.xml',$postStr);

//收到的位置信息数据
/*
 *<xml><ToUserName><![CDATA[gh_7066fa2bed4a]]></ToUserName>
<FromUserName><![CDATA[oenrgvlNw5vw6J5AoihsjtKYTzMg]]></FromUserName>
<CreateTime>1463299650</CreateTime>
<MsgType><![CDATA[location]]></MsgType>
<Location_X>30.532675</Location_X>
<Location_Y>104.086922</Location_Y>
<Scale>16</Scale>
<Label><![CDATA[双流县新怡花园A区内(红星路南延线东400米)]]></Label>
<MsgId>6284824141401703655</MsgId>
</xml>
 *
 */

define('AK','bWSMeIjp4gzrPpT6tuHimvD2ZfYqnvGV');
//解析用户发送的位置信息
$xml = simplexml_load_string($postStr);

//链接数据库
mysql_connect('localhost','team16','67114322');
mysql_select_db('team16');
mysql_set_charset('utf8');
//消息类型
$MsgType = (string)$xml->MsgType;

$FromUserName = (string)$xml->FromUserName;//用户名
$open_id = $FromUserName;
$ToUserName = (string)$xml->ToUserName;//开发者

if($MsgType=="location"){
    $x = (string)$xml->Location_X;
    $y = (string)$xml->Location_Y;
    $label = (string)$xml->Label;
    $time = time();
//书写SQL 语句
    $sql = "INSERT INTO `gao_weixin` VALUES (null,'{$open_id}',{$x},{$y},'{$label}',{$time})";
    file_put_contents('sql.xml',$sql);
//发送sql 语句
    if(mysql_query($sql)){

        $Content = "已经保存您的位置！";
    }else{
        $Content = "位置获取失败！";
    }
    require 'text.xml';
}elseif($MsgType=="text"){
    $Content = (string)$xml->Content;
    //书写sql语句
    $sql = "SELECT * FROM `gao_weixin` WHERE `open_id`='{$open_id}' ORDER BY `time` DESC LIMIT 1";
    file_put_contents('sql.xml',$sql);
    $re = mysql_query($sql);
    $rows = mysql_fetch_assoc($re);
           if($rows){
            $x = $rows['x'];
            $y = $rows['y'];
            //使用百度api
            $url = "http://api.map.baidu.com/place/v2/search?query={$Content}&page_size=10&page_num=0&scope=1&location={$x},{$y}&radius=2000&output=xml&ak=" . AK;
             //解析地图信息
               $api_xml = simplexml_load_file($url);
               $results = $api_xml->results;
               $news = array();
               foreach($results->result as $result){
                   $news[]=array(
                       'Title'=>(string)$result->name,
                       'uid'=>(string)$result->uid,
                       'lat'=>(string)$result->lat,
                       'lng'=>(string)$result->lng,
                   );
               }
               ob_start();
               require "news.xml";
               $od = ob_get_contents();
               file_put_contents('respost.xml',$od);
             }else{
               $Content = '请先发送位置信息';
               require 'text.xml';
             }

}



