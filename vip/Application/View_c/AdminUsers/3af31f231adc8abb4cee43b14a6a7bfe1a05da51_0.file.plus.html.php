<?php
/* Smarty version 3.1.29, created on 2016-05-18 00:55:40
  from "/mnt/data/www/web/team16/vip/Application/View/Admin/Users/plus.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_573b4d0caa6a55_66839287',
  'file_dependency' => 
  array (
    '3af31f231adc8abb4cee43b14a6a7bfe1a05da51' => 
    array (
      0 => '/mnt/data/www/web/team16/vip/Application/View/Admin/Users/plus.html',
      1 => 1463496933,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_573b4d0caa6a55_66839287 ($_smarty_tpl) {
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

                    <dd class="m2 "><a href="index.php?p=Admin&c=Users&a=list" ><span class="d2">会员管理</span></a></dd>

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

        <div id="right">
            <div id="position">
                <div class="position">
                    <a href="#" title="后台首页">首页</a>
                    <span>会员管理</span>
                    <span>充值</span>
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







                    <div class="tags" style="margin-bottom:20px;">
                        <div id="tagstitle">
                            <a id="one1" onclick="setTab('one',1,6)" class="hover">充值</a>
                            <a id="one2" onclick="setTab('one',2,6)"></a>
                        </div>

                        </thead>
                        <!--<tbody>-->
                        <div id="tagscontent" class="right_box">
                            <form method="post" name="form1" action="index.php?p=Admin&c=Users&a=plus"  enctype="multipart/form-data"  onsubmit="return checkform();">


                                <div id="con_one_1">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">

                                        <tbody>

                                        <tr>
                                            <td width="19%" align="right">充值账号</td>
                                            <td width="1%">&nbsp;</td>
                                            <td width="70%">
                                                <!--<input type="text" name="username" id="username" value="" class="input"  />&nbsp;</td>-->
                                                <?php echo $_smarty_tpl->tpl_vars['row']->value['username'];?>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td width="19%" align="right">会员名字</td>
                                            <td width="1%">&nbsp;</td>
                                            <td width="70%">
                                                <?php echo $_smarty_tpl->tpl_vars['row']->value['realname'];?>

                                                <input type="hidden" name="realname" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['realname'];?>
"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="19%" align="right">联系电话</td>
                                            <td width="1%">&nbsp;</td>
                                            <td width="70%">
                                                <?php echo $_smarty_tpl->tpl_vars['row']->value['telephone'];?>


                                            </td>
                                        </tr>


                                        <tr>
                                            <td width="19%" align="right">充值金额</td>
                                            <td width="1%">&nbsp;</td>
                                            <td width="70%">
                                                <input type="text" name="money" id="nickname" value="" class="input"  />
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width="19%" align="right">充值优惠</td>
                                            <td width="1%">&nbsp;</td>
                                            <td width="70%">
                                                充500元送100元, 充1000元送300元, 充5000元送2000元
                                            </td>
                                        </tr>

                                        <!--</tbody>-->
                                    </table>

                                </div>


                                </tbody>
                                </table>


                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;              &nbsp;&nbsp;&nbsp;    <input type="submit" name="" value="提交" class="btn_a" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['user_id'];?>
"/>
                                <input type="hidden" name="type" value="充值"/>
                                <input type="reset" name="submit" value="重填" class="btn_a" />
                            </form>
                        </div>
                        <?php echo '<script'; ?>
>
                            $(function(){
                                $('#btn_add').click(function(e) {
                                    $('#listform').attr('action','/index.php?case=invite&act=add&admin_dir=admin&site=default');
                                    $('#listform').submit();
                                });
                            });
                        <?php echo '</script'; ?>
>



                        <div class="blank30"></div>
                        <div class="blank30"></div>
                        <div class="copy">
                            Powered by <a href="http://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a>
                        </div>
                        <div class="blank30"></div>
                    </div>
                    <div class="clear"></div>
                </div>



                <?php echo '<script'; ?>
 type="text/javascript" language="javascript" src="/template/admin/skin/js/script.js"><?php echo '</script'; ?>
>
                <?php echo '<script'; ?>
 language="javascript" type="text/javascript" src="/template/admin/skin/js/admin.js"><?php echo '</script'; ?>
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
</html><?php }
}
