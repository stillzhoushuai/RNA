<?php
//命名空间
namespace Admin\Controller;
class IndexController extends BaseController{
	public function test(){
		$this->assign(array(
			'_page_title'  => '测试页面',
			'_page_btn_name' => '商品列表页',
			'_page_btn_link'  => U('Goods/lst'),
		
		));
		$this->display();
		
	}
	public function index(){
		$this->display();
	}
	public function top(){
		$this->display();
	}
	public function menu(){
		$this->display();
	}
	public function main(){
		$this->display();
	}
	
	
	
	
	
}