<?php

function mergePics($pics) {
    $height_max = 0;
    $pics_new = array();
    foreach ($pics as $k => $v) {
        $img_info = getimagesize($v);
        $widths[] = $img_info[0];
        $height_max += $img_info[1];
        $pics_new[$k]['pic'] = $v;
        $pics_new[$k]['width'] = $img_info[0];
        $pics_new[$k]['height'] = $img_info[1];
    }

    $width_max = max($widths);
    $merge_img = imagecreatetruecolor($width_max, $height_max);
    $trans_colour = imagecolorallocatealpha($merge_img, 255, 255, 255, 127);
    imagefill($merge_img, 0, 0, $trans_colour);
    $height = 0;
    foreach ($pics_new as $k => $v) {
        if ($k == 0) {
            imagecopyresized($merge_img, imagecreatefromjpeg($v['pic']), 0, 0, 0, 0, $v['width'], $v['height'], $v['width'], $v['height']);
        } else {
            imagecopyresized($merge_img, imagecreatefromjpeg($v['pic']), 0, $height, 0, 0, $v['width'], $height, $v['width'], $height);
        }

        $height += $v['height'];
    }
    $pic_heti = 'heti.jpg';
    imagejpeg($merge_img, $pic_heti);
    return $pic_heti;
}

$pics = array("1.jpg", "2.jpg", "3.jpg");
$heti = mergePics($pics);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>演示：PHP合成多图片</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <link rel="stylesheet" type="text/css" href="http://www.erdangjiade.com/jquery/css/common.css" />
    </head>
    <body>
        <div class="head">
            <div class="head_inner clearfix">
                <ul id="nav">
                    <li><a href="http://www.erdangjiade.com">首 页</a></li>
                    <li><a href="http://www.erdangjiade.com/templates">网站模板</a></li>
                    <li><a href="http://www.erdangjiade.com/js">网页特效</a></li>
                    <li><a href="http://www.erdangjiade.com/php">PHP</a></li>
                    <li><a href="http://www.erdangjiade.com/site">精选网址</a></li>
                </ul>
                <a class="logo" href="http://www.erdangjiade.com"><img src="http://www.erdangjiade.com/Public/images/logo.jpg" alt="二当家的logo" /></a>
            </div>
        </div>
        <div class="container">
            <div class="demo">
                <h2 class="title"><a href="http://www.erdangjiade.com/js/942.html">教程：PHP合成多图片</a></h2>
                <p class="notice red">三图片：</p>
                <img  src="1.jpg"/><img  src="2.jpg" style="margin:0 10px"/><img  src="3.jpg"/>
                <p class="notice red" style="margin:10px 0">合体后：</p>
                <a href="<?php echo $heti; ?>" target="_blank"><img src="<?php echo $heti; ?>"> </a>
            </div>
        </div>
        <div class="foot">
            Powered by erdangjiade.com  本站皆为作者原创，转载请注明原文链接：<a href="http://www.erdangjiade.com" target="_blank">www.erdangjiade.com</a>
        </div>

    </body>
</html>


