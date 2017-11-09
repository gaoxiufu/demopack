<?php
//获取微信post 过来的xml数据
$postStr=file_get_contents('php://input');
//保持收到的xml文件
file_put_contents('1post.xml',$postStr);
/*
 * <xml>
    <ToUserName><![CDATA[gh_7066fa2bed4a]]></ToUserName>
    <FromUserName><![CDATA[oenrgvlNw5vw6J5AoihsjtKYTzMg]]></FromUserName>
    <CreateTime>1463201686</CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
    <Content><![CDATA[你好]]></Content>
    <MsgId>6284403389225473871</MsgId>
</xml>
 */
//使用simplexml_load_string解析数据
$xml = simplexml_load_string($postStr);
$FromUserName = (string)$xml->FromUserName;
$ToUserName = (string)$xml->ToUserName;
$Content = (string)$xml->Content;

//$resposeXml="<xml>
//<ToUserName><![CDATA[{$FromUserName}]]></ToUserName>
//<FromUserName><![CDATA[{$ToUserName}]]></FromUserName>
//<CreateTime>12345678</CreateTime>
//<MsgType><![CDATA[text]]></MsgType>
//<Content><![CDATA[{$Content}]]></Content>
//</xml>";

//echo $resposeXml;
//php  输出缓存  ob缓存
//打开ob缓存
ob_start();
require "text.xml";
$ob = ob_get_contents();//获取ob缓存内容
file_put_contents('respost.xml',$ob);