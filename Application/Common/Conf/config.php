<?php
return array(
	//'配置项'=>'配置值'
    //页面底部追踪信息显示
    'SHOW_PAGE_TRACE' =>  TRUE,
    
	//数据库配置信息
	'DB_TYPE'   => 'mysqli', // 数据库类型 mysql,mysqli,pdo
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'rna_editing', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'rna_', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
	
	'DEFAULT_FILTER' =>  'trim,htmlspecialchars', // 默认参数过滤方法 用于I函数...,trim过滤字符左右的空格，htmlspecialchars可以转义字符防止攻击

	/*****************图片相关的配置********************/	
	'IMAGE_CONFIG'  =>  array(
		'maxSize'  => 1024*1024,
		'exts'     => array('jpg', 'gif', 'png', 'jpeg'),// 设置附件上传类型
    	'rootPath' => './Public/Uploads/', // 上传图片的保存路径 ->PHP要使用的路径，硬盘上的路径
    	'viewPath' => '/Public/Uploads/', // 显示图片的路径  ->浏览器用的路径，相对网站的根目录
	
	
	
	),
);