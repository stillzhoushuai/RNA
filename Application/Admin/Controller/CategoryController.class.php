<?php
//命名空间
namespace Admin\Controller;
class CategoryController extends BaseController{
	//添加
	 public function add()
    {
    	$model = D('Category');
    	if(IS_POST)
    	{
    		if($model->create(I('post.'), 1))
    		{
    			if($id = $model->add())
    			{
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
		//取出所有的分类做下拉框
		$catData = $model->getTree();
		// 设置页面中的信息
		$this->assign(array(
			'catData' => $catData,
			'_page_title' => '添加分类',
			'_page_btn_name' => '分类列表',
			'_page_btn_link' => U('lst'),
		));
		$this->display();
    }
    //修改
    public function edit()
    {
    		// M:生成的是父类模型\Think\Model
    	$model = D('Category');
    	$id = I('get.id');
    	if(IS_POST)
    	{
    		if($model->create(I('post.'), 2))
    		{
    			if($model->save() !== FALSE)
    			{
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}

    	$data = $model->find($id);
    	//取出所有的分类做下拉框
    	$catData = $model ->getTree();
    	//取出当前分类的子分类
    	$children =$model -> getChildren($id);
    	$this->assign(array(
    		'children' => $children,
    		'data' => $data,
    		'catData' => $catData,
    	));

		// 设置页面中的信息
		$this->assign(array(
			'_page_title' => '修改分类',
			'_page_btn_name' => '分类列表',
			'_page_btn_link' => U('lst'),
		));
		$this->display();
    }
	//分类列表页
	public function lst(){
		$model =D('Category');
		$data = $model ->getTree();
		//设置页面信息
		$this->assign(array(
			'data' => $data,
			'_page_title'  => '商品分类列表',
			'_page_btn_name' => '添加新商品分类',
			'_page_btn_link'  => U('add'),
		
		));
		$this->display();
	}
	
	//删除
		public function delete(){
		$mode =D('category');
		if(FALSE !==$mode->delete(I('get.id')))
			$this->success('删除成功！',U('lst'));
		else 
			$this->error('删除成功！原因：'.$model->getError());	
	}
}