<?php
//命名空间
namespace Home\controller;
use Think\controller;
vendor("Jpgraph.jpgraph");
vendor("Jpgraph.jpgraph_line");
vendor("Jpgraph.jpgraph_bar");
vendor("Jpgraph.jpgraph_error");
class PancreasController extends Controller{
       
        function index(){
            $this->assign(array(
                '_page_title'=>'Pancreas编辑位点分析',
                '_page_btn_name1' => 'Pancreas_variance_GO',
                '_page_btn_name2' => 'Pancreas_scatter_GO',
            ));
           $this->display();
        }
        
       function search(){
            $where =array(); //空的where条件
            $where1=array();
            //文章号
            $paper_id= I('get.paper_id');
            if($paper_id)
                $where['paper_id'] = array('eq',$paper_id);  //WHERE goods_name LIKE '%$gn%'
                $where1['paper_id'] = array('eq',$paper_id);  //WHERE goods_name LIKE '%$gn%'
            
            //染色体号
            $chr= I('get.chr');
            //dump($chr);die;
            if($chr <= 22){
                $where['chr'] = array('like',"%$chr%");  //WHERE goods_name LIKE '%$gn%'
            }elseif($chr < 24){
                $where['chr'] = array('like',"%X%");
            }else{
                $where['chr'] = array('like',"%Y%");
            }
            //RNA编辑位点坐标
            $gn = I('get.rna_editing_location');
            if($gn)
                $where['rna_editing_location'] = array('like',"%$gn%");  //WHERE goods_name LIKE '%$gn%'
             
            
            //RNA编辑位点坐标范围
            $fl= I('get.fl');
            $tl= I('get.tl');
            if($fl && $tl){
                $where['rna_editing_location'] =array('between', array($fl, $tl)); //WHERE shop_price BETWEEN $fp AND $tp
            }elseif($fl){
                $where['rna_editing_location'] =array('egt',$fl); //WHERE shop_price >= $fp
            }elseif($tl){
                $where['rna_editing_location'] =array('elt',$fl); //WHERE shop_price <= $tp
            }
             
            
            //编辑效率
            $fr= I('get.fr');
            $tr= I('get.tr');
            if($fr && $tr){
                $where['reads_editing_rate'] =array('between', array($fr, $tr)); //WHERE shop_price BETWEEN $fp AND $tp
            }elseif($fr){
                $where['reads_editing_rate'] =array('egt',$fr); //WHERE shop_price >= $fp
            }elseif($tr){
                $where['reads_editing_rate'] =array('elt',$fr); //WHERE shop_price <= $tp
            }
            $testModel = M('colon');
            $paper_name=array();
            //连表查询查询取出文章名称
            $data =$testModel->field('b.paper_name')
            ->alias('a')
            ->join('LEFT JOIN __PAPER__ b ON a.paper_id=b.id')
            ->where($where1)
            ->select();
            $paper_name=$data[0];
            //取出所有的组织分类信息
            $testData = $testModel ->where($where)-> select();
            foreach($testData as $k=>$v) {
                $result[$v["rna_editing_location"]][] = $v; // 将二维数组按照自己想要的关键字平成$k然后组成新的三维数组。
            }
            $datax=array();
            $rate=array();
            $variance1=array();
            $variance=array();
             foreach ($result as $k => $v){
                    array_push($datax, $k);
                     $count=count($v);
                     $array=array();
                     foreach($v as $kk =>$vv){
                         array_push($array, $vv['reads_editing_rate']);     
                     } 
                     //求不同位点的平均值
                    $sum=array_sum($array);
                    $avg=$sum/$count;
                    //求不同位点的方差 
                    $total_var=0;
                    foreach($v as $kk1 =>$vv1){
                        $total_val += pow(($vv1['reads_editing_rate']-$avg),2);
                        $variance1=$total_val/$count;
                    }
                   array_push($rate, $avg);
                   array_push($variance, $variance1);
              
             }
            
             $datay1=array();
             $datay2=array();
            /**************处理数据并传送值页面画图**************************/
            // $datay1 =array_slice($rate, 0,100);
            $datay1 =$rate;
            // $datay2 =array_slice($variance, 0,100);
            $datay2 =$variance;
            // $tissue_name =array_slice($tissue_name, 0,100);
            //$sample_name =array_slice($sample_name, 0,100);
            $datay1= implode(",",$datay1);
            $datay2= implode(",",$datay2);
            $datax= implode(",",$datax);
            $paper_name= implode(",",$paper_name);

            $this->assign(array(
                'datay1' => $datay1,
                'datay2' => $datay2,
                'datax' => $datax,
                'paper_name' => $paper_name,
                '_page_title'=>'Brain编辑位点分析',
                '_page_btn_name' => 'Brain_GO',
            ));
            $this->display();
        }
        
        public function draw(){
            $datay1=$_GET['datay1'];
            $datay2=$_GET['datay2'];
            $datax=$_GET['datax'];
            $paper_name=$_GET['paper_name'];
            $datay1=explode(",",$datay1);
            $datay2=explode(",",$datay2);
            $datax=explode(",",$datax);
            // $tissue_name=explode(",",$tissue_name);  //不需要分割
            /***********************将平均值和方差合并起来*****************************/
            $error=array();
            $array=array();
            $i=0;
            $x=1;
            foreach($datay1 as $v){
                $error[$i]=$v;
                $i=$i+2;
            }
            foreach($datay2 as $v){
                $error[$x]=$v;
                $x=$x+2;
            }
            ksort($error);   //按照键的大小对给误差数组排序
         /*    $error=implode(",", $error);*/
            //dump($error);die; 
            $graph = new \Graph(1000,800,"auto");
            $graph->SetScale('textlin');
            $graph->SetMargin(50,30,30,60);
            //$graph->graph_theme = null;
            $graph->title->Set('RNA editing location rate');
            $graph->title->SetFont(FF_SIMSUN,FS_BOLD);
            $graph->xaxis->SetTickLabels($datax);
            $graph->xaxis->title->Set('RNA location(Paper_Name:'.$paper_name.')');
            $graph->xaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
            $graph->yaxis->title->Set('RNA editing_rate');
            $graph->yaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
            $graph->yaxis->SetTitleMargin(30);
        
            $errplot=new \ErrorPlot($error);
            $errplot->SetLegend("Brain's average and variance");
            $errplot->SetColor("red");
            $errplot->SetWeight(2);
            $errplot->SetCenter();
            
            $graph->Add($errplot);
            $graph->stroke();
        }
        
 
        public function draw1(){
            $datay1=$_GET['datay1'];
            $datay2=$_GET['datay2'];
            $datax=$_GET['datax'];
            $paper_name=$_GET['paper_name'];
            $datay1=explode(",",$datay1);
            $datay2=explode(",",$datay2);
            $datax=explode(",",$datax);
 
          // $tissue_name=explode(",",$tissue_name);  //不需要分割
          /***********************将平均值和方差合并起来*****************************/
           $error=array();
           $array=array();
           $i=0;
           $x=1;
           foreach($datay1 as $v){
               $error[$i]=$v;
                $i=$i+2;
           }
           foreach($datay2 as $v){
               $error[$x]=$v;
               $x=$x+2;
           }
           ksort($error);   //按照键的大小对给误差数组排序

            $graph = new \Graph(800,600);
            $graph->SetScale('textlin');
            $graph->SetMargin(50,30,30,60);
            //$graph->graph_theme = null;
            $graph->title->Set('RNA editing location rate');
            $graph->title->SetFont(FF_SIMSUN,FS_BOLD);
            $graph->xaxis->SetTickLabels($datax);
            $graph->xaxis->title->Set('RNA location(Paper_Name:'.$paper_name.')');
            $graph->xaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
            $graph->yaxis->title->Set('RNA editing_rate');
            $graph->yaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
            $graph->yaxis->SetTitleMargin(30);
    
            $bar1 = new \BarPlot($datay1);
            $bar2 = new \BarPlot($datay2);
            $bar1->SetLegend("Colon's average");
            $bar2->SetLegend("Colon's variance");
            $accbar = new \GroupBarPlot(array($bar1,$bar2));
            $graph->Add($accbar);
            $graph->stroke();    
        }
        
        
}