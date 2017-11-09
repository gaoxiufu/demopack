<?php
//设置数据库的连接参数
//设置 站点默认访问位置�?
return  array(
    "db"=>array(
        'host'=>"localhost",
        'port'=>'3306',
        'user'=>'team16',
        'password'=>'67114322',
        'charset'=>'utf8',
        'dbName'=>'team16'
        ),
    "app"=>array(
        'platFrom'=>'Admin',
        //默认控制�?
        'controllerName'=>'Members',
        'method'=>'login'
    ),
    "upload"=>array(                       //  图片上传
        "maxSize"=>50000,                  //   最大大�?
        "path"=>"./Public/Upload/",        //路径
        "pre"=>"my_"                   //  前缀
    ),
    "thumb"=>array(                     //  略缩�?
        "width"=>100,                   //略缩图宽�?
        "height"=>150,                  //  高度
        "savePath"=>"./Public/Thumb/",   //  保存路径
        "pre"=>"thumb_"                 // 前缀
    )
);

