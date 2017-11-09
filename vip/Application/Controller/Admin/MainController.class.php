<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MainController
 *
 * @author Administrator
 */
class MainController extends PlatFormController {
    //添加show方法
    public function showAction(){
       require CURRENT_VIEW_PATH."Main/main.html";
    }
    public function loadTopAction(){
       require CURRENT_VIEW_PATH."Main/top.html";
    }
    public function loadLeftAction(){
       require CURRENT_VIEW_PATH."Main/left.html";
    }
    public function loadMiddleAction(){
       require CURRENT_VIEW_PATH."Main/middle.html";
    }
    public function loadRightAction(){
       require CURRENT_VIEW_PATH."Main/right.html";
    }
}
