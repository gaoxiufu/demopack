<?php
/**
 * Description of CaptchaController
 *
 * @author Administrator
 */
class CaptchaController {
    //建立方法 显示图片
    public function showCodeAction(){
        CaptchaTool::generate();
    }
}
