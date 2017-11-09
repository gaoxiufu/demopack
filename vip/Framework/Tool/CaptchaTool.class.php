<?php

/**
 * Description of captchaTool
 *
 * @author Administrator
 */
class CaptchaTool {
    //1)	制作得到验证码的方法 取得一个随机字符串
    public static function getCode($max=4){
        //声明字符串；
        $str="1234567890QWERTYIOPASDFGHJKLZXCVBNM";
        //打乱字符串
         $str=  str_shuffle($str);
         //取出$max个字符
         return substr($str, 0,$max);
    }
    //制作验证码
    public static function generate(){
        //建立画布
        $img =  imagecreatefromjpeg("./Public/images/Captcha/captcha_bg".  mt_rand(1, 5).".jpg");
        //设定文字的颜色 将两种颜色装在数组中
//        $color =  imagecolorallocate($imge, 0, 0, 0);
        $colArr=array(
            imagecolorallocate($img, 0, 0, 0),
            imagecolorallocate($img, 255, 255, 255)
        );
        //设置画布的文字
         $str=self::getCode();
         //记录验证码
         //开启session
         session_start();
         $_SESSION["code"]=$str;
         imagestring($img, 5, 50, 2, $str, $colArr[mt_rand(0, 1)]);
         //绘制干扰线
//         for($i=0;$i<5;$i++){
//             imageline($img, mt_rand(0, 145), mt_rand(0, 20), mt_rand(0, 145), mt_rand(0, 20), $colArr[mt_rand(0, 1)]);
//         }
         //绘制干扰点
//         for($i=0;$i<100;$i++){
//             imagesetpixel($img, mt_rand(0, 145), mt_rand(0, 20), $colArr[mt_rand(0, 1)]);
//         }
        //绘制边框
        imagerectangle($img, 0, 0, 144, 19, $colArr[1]);
        //绘制画布
        //设定文件格式
        header("Content-type:image/jpeg;charset=utf-8");
        imagejpeg($img);
        //释放资源
        imagedestroy($img);
    }
    //检查验证码
    public static function checkCode($code){
         //开启session
//         session_start();
        return strtoupper($code)==$_SESSION["code"];
    }
}

