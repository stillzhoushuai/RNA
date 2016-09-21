<?php
//命名空间
namespace Home\Model;
use Think\Model;
import("ORG.Util.Page");
class IndexModel extends Model{
	//添加时调用create方法允许接收的字段
	protected $insertFields = 'chr,rna_editing_location,rna_editing_type,pre_base,now_base,sum_bases,reads_editing_rate,sample,add_time,adipose_desc,tissue_id';
	//修改时调用create方法允许接受的字段
	protected $updateFields = 'id,chr,rna_editing_location,rna_editing_type,pre_base,now_base,sum_bases,reads_editing_rate,sample,add_time,adipose_desc,tissue_id';
	//定义验证规则
	protected  $_validate = array(
	    
	);
	
	//这个方法在添加之前会自动被调用--->钩子方法
	//第一个参数，表单中即将要插入到数据库中的数据->数组
	//&按引用传递，函数内部要修改函数外部传进来的变量必须按照引用传递，除非传递的是一个对象。因为对象默认是按引用传递的。
	protected function _before_insert(&$data,$option){
	
	    //获取系统当前时间并添加到表单中这样就会插入到数据库中
	    $data['add_time']=date('Y-m-d H:i:s', time());
	    //我们自己来过滤这个字段
	    $data['adipose_desc']=removeXSS($_POST['adipose_desc']);
	}
	
	
	/**
	 * 实现翻页、搜索、排序
	 * 
	 */

	//RNA信息搜索
	public function  search(){
    	   
	}
}