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
    <span class="action-span"><a target="_blank"  href="<?php echo U('draw_variance?'.'datay1='.$datay1.'&'.'datay2='.$datay2.'&'.'datay_scatter='.$datay_scatter.'&'.'datax='.$datax.'&'.'datax_scatter='.$datax_scatter.'&'.'paper_name='.$paper_name.'&'.'tissue_name='.$tissue_name); ?>"><?php  echo $_page_btn_name1; ?></a></span>
    <span class="action-span"><a target="_blank"  href="<?php echo U('draw_scatter?'.'datay1='.$datay1.'&'.'datay2='.$datay2.'&'.'datay_scatter='.$datay_scatter.'&'.'datax='.$datax.'&'.'datax_scatter='.$datax_scatter.'&'.'paper_name='.$paper_name.'&'.'tissue_name='.$tissue_name); ?>"><?php  echo $_page_btn_name2; ?></a></span>
    <span class="action-span1"><a href="#">RNA编辑效率作图分析中心</a></span>
    <span id="search_id" class="action-span1"> - <?php  echo $_page_title; ?> </span>
    <div style="clear:both"></div>
</h1>

<!-- 内容 -->

<div class="form-div">
    <form action="/RNA/index.php/Home/Colon/search?tissue_id=1&paper_id=&chr=17&rna_editing_location=&fl=4931018&tl=4932000&fr=&tr=" method="POST" name="searchForm">
    <p>
			组织类型：
			<select name="tissue_id">
                    	<option value="">请选择:</option>
                    	<option value="1">colon_Normal</option>
                    	<option value="2">colon_Tumor</option>
            </select>
	</p>
    <p>
			文章名称：
			<?php buildSelect('Colonpaper','paper_id','id','paper_name'); ?>
			
	</p>
	<p>
			染色体号：
			<?php buildSelect('Chr','chr','id','chr_name'); ?>
	</p>
	<p>
			RNA编辑位点坐标：<input value="<?php echo I('get.rna_editing_location');?>" type="text" name="rna_editing_location" size="20"/>	
	</p>
	<p>
			RNA编辑位点坐标范围：
			从<input value="<?php echo I('get.fl');?>" type="text" name="fl" size="15"/>
			到<input value="<?php echo I('get.tl');?>" type="text" name="tl" size="15"/>
	</p>
    <p>
			编辑效率：
			从<input value="<?php echo I('get.fr');?>" type="text" name="fr" size="15"/>
			到<input value="<?php echo I('get.tr');?>" type="text" name="tr" size="15"/>
	</p>
	<p>
			<input type="submit" value="搜索"/>
	</p>
    </form>
</div>

<style>
div  a {
  color: #666;
  font-size: 30px;
  font-weight: 400;
  text-decoration: none;
  //display:block;
  padding:2px 5px 2px 23px;
  *padding:4px 5px 2px 23px;
  border:1px solid #278296;
  border-right:2px solid #278296;
  border-bottom:2px solid #278296;
 *background:#DDEEF2 url(../images/icon_add.gif) no-repeat 3px center;
 *background:#DDEEF2 url(../images/icon_add.gif) no-repeat 3px 3px;
}

div  a:hover {
  border:1px solid #5FA6B6;
  border-right:2px solid #5FA6B6;
  border-bottom:2px solid #5FA6B6;
  background:#FFF url(../images/icon_add.gif) no-repeat 3px center;
  *background:#FFF url(../images/icon_add.gif) no-repeat 3px 3px;
  color:#666;
  text-decoration:none;
}
</style>



<div id="footer">
共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>