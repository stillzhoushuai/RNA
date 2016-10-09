<?php
//命名空间
namespace Admin\Model;
use Think\Model;
import("ORG.Util.Page");
class LiverModel extends Model{
	//添加时调用create方法允许接收的字段
	protected $insertFields = 'chr,rna_editing_location,rna_editing_type,pre_base,now_base,sum_bases,reads_editing_rate,sample,add_time,adipose_desc,tissue_id';
	//修改时调用create方法允许接受的字段
	protected $updateFields = 'id,chr,rna_editing_location,rna_editing_type,pre_base,now_base,sum_bases,reads_editing_rate,sample,add_time,adipose_desc,tissue_id';
	//定义验证规则
	protected  $_validate = array(
	    array('tissue_id','require','必须选择组织分类！',1),
	    array('chr','require','染色体号不能为空！',1),
	    array('rna_editing_location','require','RNA编辑位点坐标不能为空！',1),
	    array('rna_editing_type','require','RNA编辑类型不能为空！',1),
	    array('pre_base','require','原碱基类型不能为空！',1),
	    array('now_base','require','突变碱基类型不能为空！',1),
	    array('sum_bases','require','碱基总数不能为空！',1),
	    array('sample','require','样本号不能为空！',1),
	    array('reads_editing_rate','require','RNA编辑位点编辑效率不能为空！',1)
	);
	
	//这个方法在添加之前会自动被调用--->钩子方法
	//第一个参数，表单中即将要插入到数据库中的数据->数组
	//&按引用传递，函数内部要修改函数外部传进来的变量必须按照引用传递，除非传递的是一个对象。因为对象默认是按引用传递的。
	protected function _before_insert(&$data,$option){
	
	    //获取系统当前时间并添加到表单中这样就会插入到数据库中
	    $data['add_time']=date('Y-m-d H:i:s', time());
	    //我们自己来过滤这个字段
	    $data['liver_desc']=removeXSS($_POST['liver_desc']);
	}
	
	
	/**
	 * 实现翻页、搜索、排序
	 * 
	 */

	//RNA信息搜索
	public function  search($perPage = 20){
    	    /***************搜索***********************/
    	    $where =array(); //空的where条件
    	    //RNA编辑位点坐标
    	    $gn = I('get.location');
    	    if($gn)
    	        $where['rna_editing_location'] = array('like',"%$gn%");  //WHERE goods_name LIKE '%$gn%'
    	    //编辑效率
    	    $fr= I('get.fr');
    	    $tr= I('get.tr');
    	    if($fr && $tr)
    	        $where['reads_editing_rate'] =array('between', array($fr, $tr)); //WHERE shop_price BETWEEN $fp AND $tp
    	    elseif($fr)
    	    $where['reads_editing_rate'] =array('egt',$fr); //WHERE shop_price >= $fp
    	    elseif($tr)
    	    $where['reads_editing_rate'] =array('elt',$fr); //WHERE shop_price <= $tp
    	    //添加时间
    	    $fp= I('get.fa');
    	    $tp= I('get.ta');
    	    if($fa && $ta)
    	        $where['add_time'] =array('between', array($fa, $ta)); //WHERE addtime BETWEEN $fa AND $ta
    	    elseif($fa)
    	    $where['add_time'] =array('egt',$fa); //WHERE addtime >= $fa
    	    elseif($ta)
    	    $where['add_time'] =array('elt',$fa); //WHERE addtime <= $ta
   
    	    
    	    /***************翻页******************/
    	    //取出总的记录数
    	    $count =$this->where($where)->count();
    	    //生成翻页类的对象
    	    $pageObj = new \Think\Page($count, $perPage);
    	   // dump($pageObj);die;
    	    //设置样式
    	   $pageObj->setConfig('next','下一页');
    	   $pageObj->setConfig('prev','上一页');
    	    //生成页面下面显示的上一页/下一页的字符串
    	   $pageString = $pageObj->show();
    	    
    	    
    	/************取某一页的数据****************/
		$data =$this->field('a.*,b.tissue_name')
		->alias('a')
		->join('LEFT JOIN __TISSUE__ b ON a.tissue_id=b.id')
		->where($where)
		->limit($pageObj->firstRow.','.$pageObj->listRows)
		->select();
		
		/************返回数据****************************/
		return array(
			'data' => $data,  //数据
			'page' => $pageString,   //翻页字符串
		
		);
	    
	    
	}
}