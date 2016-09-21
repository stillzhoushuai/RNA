<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model 
{
	protected $insertFields = array('username','password','cpassword','chkcode');
	protected $updateFields = array('id','username','password','cpassword');
	//添加和修改管理员是时使用表单验证规则
	protected $_validate = array(
		array('username', 'require', '用户名不能为空！', 1, 'regex', 3),
		array('username', '1,30', '用户名的值最长不能超过 30 个字符！', 1, 'length', 3),
	    //第6个参数。规则什么时候生效：1:：添加时生效， 2：修改时生效，3：所有情况都生效
		array('password', 'require', '密码不能为空！', 1, 'regex', 1),
        array('cpassword', 'password', '两次密码输入不一致！', 1, 'confirm', 3),
        array('username', '', '用户名已经存在！', 1, 'unique', 3),
	);
	//为登陆的表单定义一个验证规则
	public $_login_vilidate = array(
	    array('username', 'require', '用户名不能为空！', 1),
	    array('password', 'require', '密码不能为空！', 1),
	    array('chkcode', 'require', '验证码不能为空！', 1),
	    array('chkcode', 'check_verify', '验证码不正确！', 1,'callback'),
	    
	);
	public function login(){
	    //从模型中获取用户名和密码
	    $username = $this->username;
	    $password = $this->password;
	    //先查询这个用户名是否存在
	    $user=$this->where(array(
	        'username' => array('eq',$username),
	    ))->find();
	    if($user){
	        if($user['password'] == md5($password)){
	            //登陆成功存session
	            session('id',$user['id']);
	            session('username',$user['username']);
	            return TRUE;
	        }else{
	            $this->error = '密码不正确！';
	            return FALSE;
	        }
	    }else{
	        $this->error = '用户名不存在';
	        return FALSE;
	    }
	}
	//退出清除session值
	public function logout(){
	    session(null);
	}
	//判断验证码是否正确
	function check_verify($code, $id = ''){
	    $verify = new \Think\Verify();
	    return $verify->check($code, $id);
	}
	
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($username = I('get.username'))
			$where['username'] = array('like', "%$username%");
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		// 配置翻页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->alias('a')->where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{
	    //添加密码前给密码md5加密
	    $data['password'] = md5($data['password']);  
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
	    //如何修改用户的名字而密码不修改，则默认不修改  
	    if($data['password'])
	        $data['password'] = md5($data['password']);
	    else 
	        unset($data['password']);  //从表单中删除这个字段就不会修改这个字段了！！！！   
	}
	// 删除前
	protected function _before_delete($option)
	{
	    //超级管理员不能被删除
	    if($option['where']['id']==1){
	        $this->error = '超级管理员的ID不允许删除！';
	        return FALSE;
	    }
		if(is_array($option['where']['id']))
		{
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
	/************************************ 其他方法 ********************************************/
}