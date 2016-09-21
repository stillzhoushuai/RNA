<?php
//命名空间
namespace Admin\Controller;
use Think\controller;
class LoginController extends Controller{
    public function chkcode(){
        $Verify = new \Think\Verify(array(
            'fontSize'    =>    30,    // 验证码字体大小
            'length'      =>    2,     // 验证码位数
            'useNoise'    =>    TRUE, // 关闭验证码杂点   
        ));
        $Verify->entry();
        
        
    }
	public function login(){
	    if(IS_POST){
	        $model =D('Admin');
	        //接受表单并且验证表单
	        if($model->validate($model->_login_vilidate)->create()){
	            if($model->login()){
	                $this->success('登陆成功',U('Index/index'));
	                exit;
	            }
	        }
	        $this->error($model->getError());
	    }
	    $this->display();
	}
	
	
	public function logout(){
	    $model = D('Admin');
	    $model ->logout();
	    redirect('login');
	}
	
	
}