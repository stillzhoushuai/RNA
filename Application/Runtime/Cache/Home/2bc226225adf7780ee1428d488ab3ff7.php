<?php if (!defined('THINK_PATH')) exit();?><div class="form-div">
    <form action="/RNA/index.php/Home/Index/colon" method="GET" name="searchForm">
    <p>
			文章名称：
			<?php buildSelect('Paper','paper_id','id','paper_name'); ?>
			
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
			从<input value="<?php echo I('get.fl');?>" type="text" name="fl" size="8"/>
			到<input value="<?php echo I('get.tl');?>" type="text" name="tl" size="8"/>
	</p>
    <p>
			编辑效率：
			从<input value="<?php echo I('get.fr');?>" type="text" name="fr" size="8"/>
			到<input value="<?php echo I('get.tr');?>" type="text" name="tr" size="8"/>
	</p>
	<p>
			<input type="submit" value="搜索"/>
	</p>
    </form>
</div>
<div class="btn">
<a target="_blank"  href="<?php echo U('draw?'.'datay1='.$datay1.'&'.'datay2='.$datay2.'&'.'datax='.$datax.'&'.'tissue_name='.$tissue_name); ?>"><b>GO</b></a> 
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