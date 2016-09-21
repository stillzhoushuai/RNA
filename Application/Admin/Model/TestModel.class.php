<?php
namespace Admin\Model;
use Think\Model;
class TestModel extends Model 
{
	protected $insertFields = array('type_name');
	protected $updateFields = array('id','type_name');
	protected $_validate = array(
		array('type_name', 'require', '类型名称不能为空！', 1, 'regex', 3),
		array('type_name', '1,30', '类型名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('type_name', '', '类型名称已经存在！', 1, 'unique', 3)
	);
	public function search($pageSize = 20)
	{
		
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
	}
	// 删除前
	protected function _before_delete($option)
	{
		
	}
	/************************************ 其他方法 ********************************************/
}