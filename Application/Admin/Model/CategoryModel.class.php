<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model 
{
	protected $insertFields = array('cat_name','parent_id');
	protected $updateFields = array('id','cat_name','parent_id');
	protected $_validate = array(
		array('cat_name', 'require', '分类名称不能为空！', 1, 'regex', 3),
	);
	//找一个分类所有子分类的ID
	public function getChildren($catId)
	{
		//取出所有的分类
		$data = $this->select();
		//递归从所有的分类中挑出子分类的ID
		return $this->_getChildren($data,$catId,TRUE);	
	}
	/**
	 * 递归从数据中找子分类
	 */
	private function _getChildren($data, $catId, $isClear = FALSE)
	{
		static $_ret = array(); //保存找到的子分类的ID
		if($isClear)
			$_ret = array();   //第一次调用的时候清空数组，防止子分类累加造成错误。
		//循环所有的分类找子分类
		foreach ($data as $k => $v)
		{
			if($v['parent_id'] == $catId)
			{
				$_ret[] = $v['id'];
				//再找这个$v的子分类
				$this->_getChildren($data,$v['id']);
			}	
		}
		return $_ret;	
	}
	
	//获取树形结构
	public function getTree()
	{
		$data = $this -> select();
		return $this->_getTree($data);
		//return $data;	
	}
	private function _getTree($data, $parent_id=0, $level=0)
	{
		static $_ret = array();
		foreach ($data as $k => $v)
		{
			if($v['parent_id'] == $parent_id)
			{
				$v['level'] = $level ; //用来标记这个分类是第几级的
				$_ret[] = $v;
				//找子分类
				$this->_getTree($data,$v['id'],$level+1);
			}
		}
		return $_ret;	
	}
	
	protected function _before_delete($option)
	{
		//先找出所有子分类的ID
		$children = $this->getChildren($option['where']['id']);
		if($children)
		{
			$children = implode(',',$children);
			//删除这些子分类
			//说明这里必须生成父类模型然后调用delete，因为如果使用$this调用delete那么在delete之前又会调用
			//$this->_before_delete这样就死循环了、用了父类的delete就不在delete之前调用父类的_before_delete和
			//这个_before_delete没有冲突。
			$model = new \Think\Model();
			$model ->table('__CATEGORY__')-> delete($children);
		}	
	}
	
	/**
	 * 获取导航条上的数据
	 */
	public function getNavData()
	{
		$catData =S('catData');
		if(!$catData){
		//取出所有的分类
		$all =$this->select();
		$ret =array();
		//循环所有的分类找出顶级分类
		foreach ($all as $k => $v)
		{
			if($v['parent_id'] == 0)
			{
				//循环所有的分类找出这个顶级分类的子分类
				foreach ($all as $k1 => $v1)
				{
					if($v1['parent_id'] == $v['id'])
					{
						//循环所有的分类找出这个二级分类的子分类
						foreach ($all as $k2 => $v2)
						{
							if($v2['parent_id'] == $v1['id'])
							{
								$v1['children'][] =$v2;
							}
							
						}
						$v['children'][] = $v1;
					}
				}
				$ret[] =$v;
			}	
		}
		S('catData', $ret, 86400);
		return $ret;	
	}
	else 	
		return $catData;
	}
}