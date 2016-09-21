<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 商品列表 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/RNA/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/RNA/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php  echo $_page_btn_link; ?>"><?php  echo $_page_btn_name; ?></a></span>
    <span class="action-span1"><a href="__GROUP__">RNA编辑管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php  echo $_page_title; ?> </span>
    <div style="clear:both"></div>
</h1>

<!-- 内容 -->

<style>
#ul_pic_list li{margin:5px; list-style-type:none;}
#cat_list {background:#EEE;margin:0;}
#cat_list li{margin:5px;}
</style>
<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front">通用信息</span>
            <span class="tab-back" >组织信息描述</span>
            <span class="tab-back" >组织类别</span>
            <span class="tab-back" >组织相册</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="/RNA/index.php/Admin/Colon/edit/id/1.html" method="post">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        	<!-- 基本信息 -->
            <table width="90%" class="tab_table" align="center">
            	<tr><td class="label">组织类型：</td>
            		<td><?php buildSelect('Tissue','tissue_id','id','tissue_name',$data['tissue_id']); ?>
            		<span class="require-field">*</span></td>
            	</tr>
            	<tr>
                    <td class="label">样本号：</td>
                    <td><input type="text" name="sample" value="<?php echo $data['sample']; ?>" size="20" />
                    <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">染色体号：</td>
                    <td><input type="text" name="chr" value="<?php echo $data['chr']; ?>" size="20" />
                    <span class="require-field">*</span></td>
                </tr>
                 <tr>
                    <td class="label">RNA编辑位点坐标：</td>
                    <td>
                        <input type="text" name="rna_editing_location" value="<?php echo $data['rna_editing_location']; ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">RNA编辑类型：</td>
                    <td>
                        <input type="text" name="rna_editing_type" value="<?php echo $data['rna_editing_type']; ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">原碱基类型：</td>
                    <td>
                        <input type="text" name="pre_base" value="<?php echo $data['pre_base']; ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">突变碱基类型：</td>
                    <td>
                        <input type="text" name="now_base" value="<?php echo $data['now_base']; ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">碱基总数：</td>
                    <td>
                        <input type="text" name="sum_bases" value="<?php echo $data['sum_bases']; ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">RNA编辑位点编辑效率：</td>
                    <td>
                        <input type="text" name="reads_editing_rate" value="<?php echo $data['reads_editing_rate']; ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                  
            </table>
            <!-- RNA编辑信息描述-->
            <table style="display:none;" width="100%" class="tab_table" align="center">
             	<tr>
                    <td>
                        <textarea id="editing_desc" name="editing_desc"></textarea>
                    </td>
                </tr>
            </table>
            
            <!-- 组织属性-->
            <table style="display:none;" width="90%" class="tab_table" align="center">
             	
             	<tr><td>
             		<ul id="attr_list"></ul>
             	</td></tr>
            </table>
            <!-- 组织相册-->
            <table style="display:none;" width="90%" class="tab_table" align="center">
             	<tr><td>
             		<input id="btn_add_pic" type="button" value="添加一张" />
             		<hr/>
             		<ul id="ul_pic_list"></ul>
             	</td></tr>
            </table>
            <div class="button-div">
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>

<!--导入在线编辑器-->
<link href="/RNA/Public/umeditor1_2_2-utf8-php/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/RNA/Public/umeditor1_2_2-utf8-php/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/RNA/Public/umeditor1_2_2-utf8-php/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/RNA/Public/umeditor1_2_2-utf8-php/umeditor.min.js"></script>
<script type="text/javascript" src="/RNA/Public/umeditor1_2_2-utf8-php/lang/zh-cn/zh-cn.js"></script>
<script>
UM.getEditor('editing_desc', {
	initialFrameWidth:"100%",
	initialFrameHeight:350	
});

/*************切换的代码**************/
$("#tabbar-div p span").click(function(){
	
	// 点击的第几个按钮
	var i = $(this).index();
	// 先隐藏所有的table
	$(".tab_table").hide();
	// 显示第i个table
	$(".tab_table").eq(i).show();
	// 先取消原按钮的选中状态
	$(".tab-front").removeClass("tab-front").addClass("tab-back");
	// 设置当前按钮选中
	$(this).removeClass("tab-back").addClass("tab-front");
	
});

//添加一张
$("#btn_add_pic").click(function(){
	var file = '<li><input type="file" name="pic[]" /></li>';
	$("#ul_pic_list").append(file);
});

</script>

<div id="footer">
共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>