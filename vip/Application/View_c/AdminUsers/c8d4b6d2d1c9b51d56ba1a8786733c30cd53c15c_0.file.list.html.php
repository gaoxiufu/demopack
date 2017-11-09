<?php
/* Smarty version 3.1.29, created on 2016-05-18 09:41:05
  from "/mnt/data/www/web/team16/vip/Application/View/Admin/Users/list.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_573bc8310c2e03_83754553',
  'file_dependency' => 
  array (
    'c8d4b6d2d1c9b51d56ba1a8786733c30cd53c15c' => 
    array (
      0 => '/mnt/data/www/web/team16/vip/Application/View/Admin/Users/list.html',
      1 => 1463535401,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_573bc8310c2e03_83754553 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="Generator" content="CmsEasy 5_6_0_20160128_UTF8" />
    <meta name="renderer" content="webkit">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!--<title>CmsEasy 企业营销型管理系统 - 后台管理中心 - Powered by CmsEasy</title>-->
    <!-- 调用样式表 -->
    <?php echo '<script'; ?>
 type="text/javascript" src="./Public/login/js/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
    <link href="./Public/login/css/admin.css" rel="stylesheet" type="text/css" />

    <?php echo '<script'; ?>
 language="javascript" type="text/javascript">
        function killerrors()
        {
            return true;
        }
        window.onerror = killerrors;
    <?php echo '</script'; ?>
>
</head>
<body>


<div class="box">
    <div id="header">
        <div class="top_right">
            <ul>
                <li><span> <strong></strong> [<a href="index.php?p=Admin&c=Members&a=login">退出</a>]</span></li>
            </ul>
        </div>
    </div>

    <div id="nav">
        <div class="nav_bg">
            <div class="nav">
                <!--<ul>-->
                    <!--<li class="no nav1"><a href="/index.php?case=index&act=index&mod=config&system=set&site=default&admin_dir=admin">设置</a></li>-->
                    <!--<li class="no nav2"><a href="/index.php?case=index&act=index&mod=content&admin_dir=admin&site=default">内容</a></li>-->
                    <!--<li class="on nav3"><a href="/index.php?case=index&act=index&mod=user&admin_dir=admin&site=default">用户</a></li>-->
                    <!--<li class="no nav4"><a href="/index.php?case=index&act=index&mod=order&admin_dir=admin&site=default">订单</a></li>-->
                    <!--<li class="no nav5"><a href="/index.php?case=index&act=index&mod=func&admin_dir=admin&site=default">功能</a></li>-->
                    <!--<li class="no nav6"><a href="/index.php?case=index&act=index&mod=help&admin_dir=admin&site=default">模板</a></li>-->
                    <!--&lt;!&ndash;<li class="no nav7"><a href="/index.php?case=index&act=index&mod=seo&admin_dir=admin&site=default">营销</a></li>&ndash;&gt;-->
                    <!--<li class="nav7"><a href="index.php?p=Admin&c=Histories&a=consume">排行榜</a></li>-->
                    <!--<li class="no nav8"><a href="/index.php?case=index&act=index&mod=defined&admin_dir=admin&site=default">自定义</a></li>-->
                    <!--<li class="no nav9"><a href="/index.php?case=index&act=index&mod=celive&admin_dir=admin&site=default">在线客服</a></li>-->
                    <!--<li class="no nav10"><a href="/index.php?case=index&act=index&mod=bbs&admin_dir=admin&site=default">论坛</a></li>-->
                <!--</ul>-->

                <!---->
            </div>
        </div>
    </div>

    <div id="c">
        <div id="left">
            <div id="menu">
                <h5 class="h5_1">用户管理</h5>
                <dl class="l_1">

                    <dd class="m0 "><a href="index.php?p=Admin&c=Members&a=show" ><span class="d0">员工管理</span></a></dd>

                    <dd class="m1 "><a href="index.php?p=Admin&c=Members&a=add" ><span class="d1">添加员工</span></a></dd>

                    <dd class="m2 on"><a href="index.php?p=Admin&c=Users&a=list" ><span class="d2">会员管理</span></a></dd>

                    <dd class="m3 "><a href="index.php?p=Admin&c=Users&a=add" ><span class="d3">新增会员</span></a></dd>

                </dl>
                <h5 class="h5_2">门店管理</h5>
                <dl class="l_6">

                    <dd class="m5 "><a href="index.php?p=Admin&c=Group&a=show" ><span class="d5">分组管理</span></a></dd>

                    <dd class="m6 "><a href="index.php?p=Admin&c=Article&a=show" ><span class="d6">活动管理</span></a></dd>
                </dl>
                <h5 class="h5_3">经营管理</h5>
                <dl class="l_9">
                    <dd class="m9 "><a href="index.php?p=Admin&c=Order&a=show" ><span class="d9">预约美发</span></a></dd>
                    <dd class="m8 "><a href="index.php?p=Admin&c=Plans&a=show" ><span class="d8">美发套餐</span></a></dd>
                    <dd class="m9 "><a href="index.php?p=Admin&c=Codes&a=show" ><span class="d9">代金券</span></a></dd>
                    <dd class="m11 ">
                        <a href="index.php?p=Admin&c=Histories&a=show" ><span class="d11">消费统计</span></a></dd>
                </dl>
            </div>
        </div>


        <!--2016-->
        <div id="right">
            <div id="position">
                <div class="position">
                    <a href="#" title="后台首页">首页</a>
                    <span>用户</span>
                    <span>会员管理</span>
                </div>

            </div>


            <div id="right_box">
                <div class="right">
                    <?php echo '<script'; ?>
 type="text/javascript">
                        <!--
                        function table(o,a,b,c,d){
                            if(!document.getElementById(o)){ return; }
                            var t=document.getElementById(o).getElementsByTagName("tr");
                            for(var i=0;i<t.length;i++){
                                t[i].style.backgroundColor=(t[i].sectionRowIndex%2==0)?a:b;
                                t[i].onclick=function(){
                                    if(this.x!="1"){
                                        this.x="1";
                                        this.style.backgroundColor=d;
                                    }else{
                                        this.x="0";
                                        this.style.backgroundColor=(this.sectionRowIndex%2==0)?a:b;
                                    }
                                }
                                t[i].onmouseover=function(){
                                    if(this.x!="1")this.style.backgroundColor=c;
                                }
                                t[i].onmouseout=function(){
                                    if(this.x!="1")this.style.backgroundColor=(this.sectionRowIndex%2==0)?a:b;
                                }
                            }
                        }
                        // -->
                    <?php echo '</script'; ?>
>




                    <!--<1111form name="listform" id="listform"  action="#" method="post">-->
                        <div class="blank20"></div>

                        <form method="get" action="index.php">
                            <tr>

                                <td width="70%">
                                    <input type="text"  name="val" value="" class="input"  />
                                    <input type="hidden" name="p"  value="Admin" class="input"  />
                                    <input type="hidden" name="c"  value="Users" class="input"  />
                                    <input type="hidden" name="a"  value="show" class="input"  />
                                    <input type="submit" name="" value="搜索" class="btn_a" />
                                </td>
                            </tr>
                        </form>

                        <div id="tagscontent" class="right_box">

                            <table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
                                <thead>
                        <tr class="th">
                            <!--<th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>-->
                            <th align="center"><!--userid-->会员编号</th>
                            <th align="center"><!--username-->会员昵称</th>
                            <th align="center"><!--username-->会员头像</th>
                            <th align="center"><!--nickname-->会员姓名</th>
                            <th align="center"><!--groupid-->性别</th>
                            <th align="center"><!--groupid-->联系电话</th>
                            <th align="center"><!--groupid-->备注</th>
                            <th align="center"><!--groupid-->余额</th>
                            <th align="center"><!--groupid-->是否是VIP</th>
                            <th align="center">操作</th>
                        </tr>
                        </thead>
                            <tbody>

                            <?php
$_from = $_smarty_tpl->tpl_vars['rows']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_0_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_0_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
                            <tr class="s_out">
                                <!--<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="1" name="select[]" class="checkbox" /> </td>-->

                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['user_id'];?>
</td>
                                <td align="center" style="padding-left:10px;"><?php echo $_smarty_tpl->tpl_vars['row']->value['username'];?>
</td>
                                <td align="center" style="padding-left:10px;">
                                    <?php if ($_smarty_tpl->tpl_vars['row']->value['photo']) {?>
                                    <img src="./Public/Upload/<?php echo $_smarty_tpl->tpl_vars['row']->value['photo'];?>
"/>
                                    <?php } else { ?>

                                    <img src="./Public/Upload/110.png"/>
                                    <?php }?>

                                </td>
                                <td align="center" style="padding-left:10px;"><?php echo $_smarty_tpl->tpl_vars['row']->value['realname'];?>
</td>
                                <td align="center" style="padding-left:10px;"><?php echo $_smarty_tpl->tpl_vars['row']->value['sex'];?>
</td>
                                <td align="center" style="padding-left:10px;"><?php echo $_smarty_tpl->tpl_vars['row']->value['telephone'];?>
</td>
                                <td align="center" style="padding-left:10px;"><?php echo $_smarty_tpl->tpl_vars['row']->value['remark'];?>
</td>
                                <td align="center" style="padding-left:10px;"><?php echo $_smarty_tpl->tpl_vars['row']->value['money'];?>
</td>
                                <td align="center" style="padding-left:10px;"><?php echo $_smarty_tpl->tpl_vars['row']->value['is_vip'];?>
</td>

                                <td align="left" width="20%">


                                    <a href="index.php?p=Admin&c=Users&a=showPlus&id=<?php echo $_smarty_tpl->tpl_vars['row']->value['user_id'];?>
" class="btn_a">充值</a>

                                    <a href="index.php?p=Admin&c=Users&a=showConsume&id=<?php echo $_smarty_tpl->tpl_vars['row']->value['user_id'];?>
" class="btn_a">消费</a>

                                    <a href="index.php?p=Admin&c=Order&a=show" class="btn_a">预约</a>

                                    <a href="index.php?p=Admin&c=Users&a=showRecord&realname=<?php echo $_smarty_tpl->tpl_vars['row']->value['realname'];?>
" class="btn_a">记录</a>

                                    <a  onclick="javascript: return confirm('确实要删除吗?');" href="index.php?p=Admin&c=Users&a=remove&id=<?php echo $_smarty_tpl->tpl_vars['row']->value['user_id'];?>
" class="btn_a">删除</a>
                                    <a href="index.php?p=Admin&c=Users&a=edit&id=<?php echo $_smarty_tpl->tpl_vars['row']->value['user_id'];?>
" class="btn_a">修改</a>
                                    <!--<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="/index.php?case=table&act=delete&table=user&id=1&admin_dir=admin&site=default" class="a_del"></a></span>-->
                                </td>
                            </tr>
                            <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
?>

                            </tbody>
                            </table>

                            <div class="page"><span>&nbsp;&nbsp;共<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
条记录 &nbsp;&nbsp;总共<?php echo $_smarty_tpl->tpl_vars['pageTotal']->value;?>
页&nbsp;&nbsp;当前第<?php echo $_smarty_tpl->tpl_vars['pageIndex']->value;?>
页
                                 <a href="index.php?p=Admin&c=Users&a=list&$pageIndex=1">第一页</a>
                                <a href="index.php?p=Admin&c=Users&a=list&pageIndex=<?php echo $_smarty_tpl->tpl_vars['pageIndex']->value-1;?>
">上一页</a>
                                <a href="index.php?p=Admin&c=Users&a=list&pageIndex=<?php echo $_smarty_tpl->tpl_vars['pageIndex']->value+1;?>
">下一页</a>
                                <a href="index.php?p=Admin&c=Users&a=list&pageIndex=<?php echo $_smarty_tpl->tpl_vars['pageTotal']->value;?>
">最后页</a>
                            </span>

                            </div>
                            <div class="blank20"></div>
                        </div>
                        <div class="blank20"></div>



                    <!--</form>-->


                    <div class="blank30"></div>
                    <div class="blank30"></div>
                    <!--<div class="copy">-->
                        <!--Powered by <a href="http://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a>-->
                    <!--</div>-->
                    <div class="blank30"></div>
                </div>
                <div class="clear"></div>
            </div>

                    </form>

                    <div class="blank30"></div>
                    <div class="blank30"></div>
                    <!--<div class="copy">-->
                        <!--Powered by <a href="http://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a>-->
                    <!--</div>-->
                    <!--<div class="blank30"></div>-->
                <!--</div>-->
                <div class="clear"></div>
            </div>
<!--2-->


            <?php echo '<script'; ?>
 type="text/javascript" language="javascript" src="./Public/login/js/script.js"><?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 language="javascript" type="text/javascript" src="./Public/login/js/admin.js"><?php echo '</script'; ?>
>


            <?php echo '<script'; ?>
 type="text/javascript">
                <!--
                //table("表格名称","奇数行背景","偶数行背景","鼠标经过背景","点击后背景");
                table("table1","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
                table("table2","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
                table("table3","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
                table("table4","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
                table("table5","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
                table("table6","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
                table("table7","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
                table("table8","#F5F5F5","#F9F9F9","#FFFFF0","#F5F5F5");
                table("table9","#FFFFFF","#FFFFFF","#FFFFF0","#FFFFFF");
                // -->

                //去掉虚线框
                function bluring(){
                    if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
                }
                document.onfocusin=bluring;
            <?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 type="text/javascript">
                $("#right").css("width",($("#c").width() - 210));
                $(".right").css("width",($("#c").width() - 210));
                $(window).resize(function() {
                    $("#right").css("width",($("#c").width() - 210));
                    $(".right").css("width",($("#c").width() - 210));
                });
                //点击关闭提示信息层
                function turnoff(obj){
                    document.getElementById(obj).style.display="none";
                }
                //省市区
                $(document).ready(function() {
                    $('#search_province_id').change(function(){
                        $.ajax({
                            url: '/index.php?case=area&act=city_option_search',
                            data:'province_id='+$(this).val(),
                            type: 'POST',
                            dataType: 'html',
                            timeout: 10000,
                            success: function(data){
                                $('#search_city_id').html(data);
                            }
                        });
                    });
                    $('#search_city_id').change(function(){
                        $.ajax({
                            url: '/index.php?case=area&act=section_option_search',
                            data:'city_id='+$(this).val(),
                            type: 'POST',
                            dataType: 'html',
                            timeout: 10000,
                            success: function(data){
                                $('#search_section_id').html(data);
                            }
                        });
                    });
                    $(document).ready(function() {
                        $('#province_id').change(function(){
                            $.ajax({
                                url: '/index.php?case=area&act=city_option',
                                data:'province_id='+$(this).val(),
                                type: 'POST',
                                dataType: 'html',
                                timeout: 10000,
                                success: function(data){
                                    $('#city_id').html(data);
                                }
                            });
                        });
                        $('#city_id').change(function(){
                            $.ajax({
                                url: '/index.php?case=area&act=section_option',
                                data:'city_id='+$(this).val(),
                                type: 'POST',
                                dataType: 'html',
                                timeout: 10000,
                                success: function(data){
                                    $('#section_id').html(data);
                                }
                            });
                        });
                    });
                });
            <?php echo '</script'; ?>
>

            <style>
                html,body { background:#f4f4f4 url(/template/admin/skin/images/c_bg.gif) left top repeat-y;}
            </style>

</body>
</html>
<?php }
}
