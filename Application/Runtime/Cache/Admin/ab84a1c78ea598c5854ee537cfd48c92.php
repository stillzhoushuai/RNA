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

<div class="main-div">
    <form name="main_form" method="POST" action="/RNA/index.php/Admin/Role/add.html" enctype="multipart/form-data">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">角色名称：</td>
                <td>
                    <input  type="text" name="role_name" value="" />
                </td>
            </tr>
            <tr>
                <td class="label">权限列表：</td>
                <td>	
                	<?php foreach ($priData as $k => $v): ?>
                		<?php echo str_repeat('-', 8*$v['level']); ?>
                    	<input level_id="<?php echo $v['level']; ?>" type="checkbox" name="pri_id[]" value="<?php echo $v['id']; ?>" />
                    	<?php echo $v['pri_name']; ?><br />
                    <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
// 为所有的复选框绑定一个点击事件
$(":checkbox").click(function(){
	//先获取点击的这个level_id
	var temp_level_id=level_id = $(this).attr("level_id");
	//判断是选中还是取消
	if($(this).prop("checked"))
	{
		//所有的子权限也被选中
		$(this).nextAll(":checkbox").each(function(k,v){
			if($(v).attr("level_id") > level_id)
				$(v).attr("checked", "checked");	
			else
				return false;
		});
		
		//所有的上级权限也被选中
		$(this).prevAll(":checkbox").each(function(k,v){
			if($(v).attr("level_id") < temp_level_id){
				$(v).attr("checked", "checked");
			    temp_level_id--;   //再找更上一级的
			}
			
		});
	}else{
		//所有的子权限也取消
		$(this).nextAll(":checkbox").each(function(k,v){
			if($(v).attr("level_id") > level_id)
				$(v).removeAttr("checked");	
			else
				return false;
		});
	}
});
</script>
















<div id="footer">
共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>