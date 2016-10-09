<?php
//命名空间
namespace Admin\Controller;
import("ORG.Util.Page");
class LiverController extends BaseController{

	
	//显示和处理表单
	public function add(){
		//判断用户是否提交了表单
		if(IS_POST){
			//dump($_POST);die;
			$model= D('liver');
			//2.CREATE方法：a.接收数据并保存到模型中  b.根据模型中定义的规则验证表单
			/**
			 * 第一个参数：要接手的数据默认是$_POST
			 * 第二个参数：表单的类型。当前是添加还是修改的表单,1：添加 2：修改
			 * $_POST: 表单中原始的数据，I('post.'):过滤之后的$_POST的数据，过滤XSS攻击，这是TP框架自带的
			 */
			if($model -> create(I('post.'),1)){
				if($model->add()){   //在add()里先调用了_before_insert方法
					//显示成功信息并等待1秒之后跳转
					$this->success('操作成功！',U('lst'));
					exit;
				}
			}
			//如果走到这里说明上面失败了在这里处理失败的请求
			//从模型中取得失败的原因
			$error= $model->getError();
			//从控制器显示错误信息,并在3秒调回上一个页面
			$this->error($error);
		}
		
		//取出所有的组织类型
		$tissueModel = D('tissue');
		$tissueData = $tissueModel -> select();
		
		//设置页面信息
		$this->assign(array(
			'tissueData' => $tissueData,
			'_page_title'  => '添加新组织信息',
			'_page_btn_name' => 'RNA编辑位点列表',
			'_page_btn_link'  => U('lst'),
		
		));
		//1.显示表单
		$this->display();
	}
	
	//修改表单
	public function edit(){
		$id = I('get.id');   //要修改的商品的ID
		$model= D('liver');
		if(IS_POST){
			if($model -> create(I('post.'),2)){
				if(FALSE !== $model->save()){  //save()的返回值是：如果失败返回受影响的条数【如果修改后和修改前相同就会返回0】
					$this->success('操作成功！',U('lst'));
					exit;
				}
			}
			$error= $model->getError();
			$this->error($error);
		}
		//根据ID取出要修改IDE商品的原信息
		$data=$model->find($id);
		$this->assign('data',$data);
		
		//取出所有的组织分类信息
		$tissueModel = D('tissue');
		$tissueData = $tissueModel -> select();
		
		//设置页面信息
		$this->assign(array(
			'tissueData' => $tissueData,
			'_page_title'  => '修改RNA脂肪组织信息',
			'_page_btn_name' => '心脏组织列表',
			'_page_btn_link'  => U('lst'),
		
		));
		$this->display();
	}
	
	public function delete(){
		$mode =D('adipose');
		if(FALSE !==$mode->delete(I('get.id')))
			$this->success('删除成功！',U('lst'));
		else 
			$this->error('删除成功！原因：'.$model->getError());	
	}
	//商品列表页
	public function lst(){
		      //数据查询操作
               $adipose=D('liver');
               $data=$adipose->search();
             
               $this->assign($data);
                //把获得的信息传递给模板使用
                $this->assign(array(
                    '_page_btn_name' => '添加数据',
                    '_page_title' => '心脏RNA编辑位点信息',
                    '_page_btn_link' => U('add'),
           
                ));
                $this->display();
	}
	
}