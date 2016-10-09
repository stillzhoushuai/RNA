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



<div class="form-div">
    <form action="/RNA/index.php/Admin/Muscle/lst" method="GET" name="searchForm">
    	<p>
    		RNA编辑位点坐标：
    		<input value="<?php echo I('get.location');?>" type="text" name="location" vaule="80"/>
    	</p>
		<p>
			编辑效率：
			从<input value="<?php echo I('get.fr');?>" type="text" name="fr" size="8"/>
			到<input value="<?php echo I('get.tr');?>" type="text" name="tr" size="8"/>
		</p>
		<p>
			添加时间：
			从<input type="text" id="fa" name="fa" value="<?php echo I('get.fa'); ?>" size="20"/>
			到<input type="text" id="ta" name="ta" value="<?php echo I('get.ta'); ?>" size="20"/>
		</p>
	    <p>
			<input type="submit" value="搜索"/>
		</p>
		
    </form>
</div>


<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>染色体号</th>
                <th>RNA编辑位点坐标</th>
                <th>RNA编辑类型</th>
                <th>原碱基类型</th>
                <th>突变碱基类型</th>
                <th>碱基数总和</th>
                <th>RNA位点编辑效率</th>
                <th>样本号</th>
                <th>组织类型</th>
                <th>操作</th>
            </tr>
      <?php foreach ($data as $k => $v): ?>
            <tr class="tron">
                <td align="center"><?php echo $v['id']; ?></td>
                <td align="center"><?php echo $v['chr']; ?></td>
                <td align="center"><?php echo $v['rna_editing_location']; ?></td>
                <td align="center"><span><?php echo $v['rna_editing_type']; ?></span></td>        
                <td align="center"><span><?php echo $v['pre_base']; ?></span></td>
                <td align="center"><span><?php echo $v['now_base']; ?></span></td>
                <td align="center"><span><?php echo $v['sum_bases']; ?></span></td>
                <td align="center"><span><?php echo $v['reads_editing_rate']; ?></span></td>
                <td align="center"><span><?php echo $v['sample']; ?></span></td>
                <td align="center"><span><?php echo $v['tissue_name']; ?></span></td>
                <td align="center">
                <a href="<?php echo U('edit?id='.$v['id']); ?>">修改</a>
                <a onclick="return confirm('确定要删除吗？');" href="<?php echo U('delete?id='.$v['id']);?>">删除</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

    <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <?php echo $page; ?>
                </td>
            </tr>
        </table>
    <!-- 分页结束 -->
    </div>
</form>



<!-- 时间插件 -->
<link href="/RNA/Public/datetimepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/RNA/Public/umeditor1_2_2-utf8-php/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/RNA/Public/datetimepicker/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/RNA/Public/datetimepicker/datepicker-zh_cn.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="/RNA/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.css" />
<script type="text/javascript" src="/RNA/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.js"></script>
<script type="text/javascript" src="/RNA/Public/datetimepicker/time/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script>
$.timepicker.setDefaults($.timepicker.regional['zh-CN']);  //设置使用中文

$("#fa").datetimepicker();
$("#ta").datetimepicker();
</script>
<!--引入行高亮显示-->
<script type="text/javascript" src="/RNA/Public/Admin/Js/tron.js"></script>

<div id="footer">
共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>