<?php
  class ThumbPicTool{
      //属性
      private $width;
      private $height;
      private $savePath;
      private $pre;
      //声明图片来源画布建立的属性
      private  $fromImg=array(
          "image/jpeg"=>"imagecreatefromjpeg",
          "image/png"=>"imagecreatefrompng",
          "image/gif"=>"imagecreatefromgif"        
      ) ;
      //声明绘制画布的数组
       private  $createImg=array(
          "image/jpeg"=>"imagejpeg",
          "image/png"=>"imagepng",
          "image/gif"=>"imagegif"          
      );
       private $extName=array(
          "image/jpeg"=>".jpg",
          "image/png"=>".png",
          "image/gif"=>".gif"    
       );
      //声明构造函数初始化属性
      public function __construct() {
          //初始化
          $this->width=$GLOBALS["config"]["thumb"]["width"];
          $this->height=$GLOBALS["config"]["thumb"]["height"];
          $this->savePath=$GLOBALS["config"]["thumb"]["savePath"];
          $this->pre=$GLOBALS["config"]["thumb"]["pre"];
      }
      //制作缩略图
      public function makeThumb($path){
          //建立新的画布
          $img=  imagecreatetruecolor($this->width, $this->height);
          //设置画布的背景颜色
//          建立颜色
           $white=  imagecolorallocate($img, 255, 255, 255);
           imagefill($img, 0, 0, $white);
           //取得原图的属性
           $imgType=  getimagesize($path);//类型 type=image/jpeg  image/png  image/gif
           $type=$imgType["mime"];
           //建立原图画布
           $old=$this->fromImg[$type]($path);
           //计算产生图片的大小
           $bili=$imgType[0]/$this->width>$imgType[1]/$this->height?$imgType[0]/$this->width:$imgType[1]/$this->height;
           //目标图片大小
           $width=$imgType[0]/$bili;
           $height=$imgType[1]/$bili;
           $posX=($this->width- $width)/2;
            $posY=($this->height- $height)/2;
           //将原图copy到新的画布中
           imagecopyresampled($img, $old,$posX,$posY, 0, 0, $width, $height, $imgType[0], $imgType[1]);
             //产生唯一的名
            $name=  uniqid($this->pre);
            $fileName=$name.$this->extName[$type];
           //绘制图片
           $this->createImg[$type]($img,$this->savePath.$fileName);
           //返回文件名
            return $fileName;
      }
  }

