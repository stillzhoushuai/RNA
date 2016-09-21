<?php
//命名空间
namespace Admin\controller;
use Think\controller;
vendor("Jpgraph.jpgraph");
vendor("Jpgraph.jpgraph_line");
vendor("Jpgraph.jpgraph_bar");
class TestController extends Controller{
       
        function test(){
            $where1 =array(); //空的where条件
            $where2 =array(); //空的where条件
            $where3 =array(); //空的where条件
            //组织分类号
           $tissue_id1= I('get.tissue_id1');
           if($tissue_id1 < 3){
               $table_name1="rna_brain";
           }elseif($tissue_id1 < 6){
               $table_name1="rna_adipose";
           }elseif($tissue_id1 < 8){
               $table_name1="rna_colon";
           }
           $tissue_id2= I('get.tissue_id2');
           if($tissue_id2 < 3){
               $table_name2="rna_brain";
           }elseif($tissue_id2 < 6){
               $table_name2="rna_adipose";
           }elseif($tissue_id2 < 8){
               $table_name2="rna_colon";
           }
           $tissue_id3= I('get.tissue_id3');
           if($tissue_id3 < 3){
               $table_name3="rna_brain";
           }elseif($tissue_id3 < 6){
               $table_name3="rna_adipose";
           }elseif($tissue_id3 < 8){
               $table_name3="rna_colon";
           }
          
           if($tissue_id1)
               $where1['tissue_id'] = array('eq',$tissue_id1);  //WHERE goods_name LIKE '%$gn%'
           if($tissue_id2)
               $where2['tissue_id'] = array('eq',$tissue_id2);  //WHERE goods_name LIKE '%$gn%'
           if($tissue_id3)
               $where3['tissue_id'] = array('eq',$tissue_id3);  //WHERE goods_name LIKE '%$gn%'
           //染色体号
           $chr= I('get.chr');
           //dump($chr);die;
           if($chr <= 22){
              $where1['chr'] = array('like',"%$chr%");  //WHERE goods_name LIKE '%$gn%'
              $where2['chr'] = array('like',"%$chr%");  //WHERE goods_name LIKE '%$gn%'
              $where3['chr'] = array('like',"%$chr%");  //WHERE goods_name LIKE '%$gn%'
           }elseif($chr < 24){
               $where1['chr'] = array('like',"%X%");
               $where2['chr'] = array('like',"%X%");
               $where3['chr'] = array('like',"%X%");
           }else{
               $where1['chr'] = array('like',"%Y%");
               $where2['chr'] = array('like',"%Y%");
               $where3['chr'] = array('like',"%Y%");
           }
           //RNA编辑位点坐标
           $gn = I('get.rna_editing_location');
           if($gn)
               $where1['rna_editing_location'] = array('like',"%$gn%");  //WHERE goods_name LIKE '%$gn%'
               $where2['rna_editing_location'] = array('like',"%$gn%");  //WHERE goods_name LIKE '%$gn%'
               $where3['rna_editing_location'] = array('like',"%$gn%");  //WHERE goods_name LIKE '%$gn%'
           //编辑效率
           $fr= I('get.fr');
           $tr= I('get.tr');
           if($fr && $tr){
               $where1['reads_editing_rate'] =array('between', array($fr, $tr)); //WHERE shop_price BETWEEN $fp AND $tp
               $where2['reads_editing_rate'] =array('between', array($fr, $tr)); //WHERE shop_price BETWEEN $fp AND $tp
               $where3['reads_editing_rate'] =array('between', array($fr, $tr)); //WHERE shop_price BETWEEN $fp AND $tp
           }elseif($fr){
                $where1['reads_editing_rate'] =array('egt',$fr); //WHERE shop_price >= $fp
                $where2['reads_editing_rate'] =array('egt',$fr); //WHERE shop_price >= $fp
                $where3['reads_editing_rate'] =array('egt',$fr); //WHERE shop_price >= $fp
           }elseif($tr){
                $where1['reads_editing_rate'] =array('elt',$fr); //WHERE shop_price <= $tp
                $where2['reads_editing_rate'] =array('elt',$fr); //WHERE shop_price <= $tp
                $where3['reads_editing_rate'] =array('elt',$fr); //WHERE shop_price <= $tp
           }
         
           //取出所有的组织分类信息
           $testModel = M('test');
           $testData1 = $testModel ->table($table_name1)->where($where1)-> select();
           $testData2 = $testModel ->table($table_name2)->where($where2)-> select();
           $testData3 = $testModel ->table($table_name3)->where($where3)-> select();
          // dump($testData1);
           //dump($testData2);
           //dump($testData3);die;
           // dump($testData);die;
           $datay1=array();
           $datay2=array();
           $datay3=array();
           $datax=array();
           $tissue_name1=array();
           $tissue_name2=array();
           $tissue_name3=array();
           foreach ($testData1 as $v){
               // echo $v['rna_editing_location']."----".$v['reads_editing_rate']."<br>";
               array_push($datay1, $v['reads_editing_rate']) ;
               array_push($datax, $v['rna_editing_location']) ;
               array_push($tissue_name1, $v['tissue_id']) ;
           }
           foreach ($testData2 as $v){
               // echo $v['rna_editing_location']."----".$v['reads_editing_rate']."<br>";
               array_push($datay2, $v['reads_editing_rate']) ;
               array_push($datax, $v['rna_editing_location']) ;
               array_push($tissue_name2, $v['tissue_id']) ;
           }
           foreach ($testData3 as $v){
               // echo $v['rna_editing_location']."----".$v['reads_editing_rate']."<br>";
               array_push($datay3, $v['reads_editing_rate']) ;
               array_push($datax, $v['rna_editing_location']) ;
               array_push($tissue_name3, $v['tissue_id']) ;
           }
           //die;
           $datay1 =array_slice($datay1, 0,100);
           $datay2 =array_slice($datay2, 0,100);
           $datay3 =array_slice($datay3, 0,100);
           $datax =array_slice($datax, 0,100);
           $tissue_name1 =array_slice($tissue_name1, 0,100);
           $tissue_name2 =array_slice($tissue_name2, 0,100);
           $tissue_name3 =array_slice($tissue_name3, 0,100);
           $datay1= implode(",",$datay1);
           $datay2= implode(",",$datay2);
           $datay3= implode(",",$datay3);
           $datax= implode(",",$datax);
           $tissue_name1= implode(",",$tissue_name1);
           $tissue_name2= implode(",",$tissue_name2);
           $tissue_name3= implode(",",$tissue_name3);
          
           // $datay=explode(",",$datay);
           //  $datay="2,3,5,8,12,6,3,3,5,8,12,6,3,3,5,8,12,6,3,3,5,8,12,6,3";
           $this->assign(array(
               'datay1' => $datay1,
               'datay2' => $datay2,
               'datay3' => $datay3,
               'datax' => $datax,
               'tissue_name1' => $tissue_name1,
               'tissue_name2' => $tissue_name2,
               'tissue_name3' => $tissue_name3,
           ));
           $this->display();
        }
        
        public function test4(){
            $datay1=$_GET['datay1'];
            $datay2=$_GET['datay2'];
            $datay3=$_GET['datay3'];
            $datax=$_GET['datax'];
            $tissue_name1=$_GET['tissue_name1'];
            $tissue_name2=$_GET['tissue_name2'];
            $tissue_name3=$_GET['tissue_name3'];
            $datay1=explode(",",$datay1);
            $datay2=explode(",",$datay2);
            $datay3=explode(",",$datay3);
            $datax=explode(",",$datax);
          // $tissue_name=explode(",",$tissue_name);  //不需要分割
            $graph = new \Graph(800,600);
            $graph->SetScale('textlin');
            $graph->SetMargin(50,30,30,60);
            $graph->title->Set('RNA editing location rate');
            $graph->title->SetFont(FF_SIMSUN,FS_BOLD);
            $graph->xaxis->SetTickLabels($datax);
            $graph->xaxis->title->Set('RNA location');
            $graph->xaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
            $graph->yaxis->title->Set('RNA editing_rate');
            $graph->yaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
            $graph->yaxis->SetTitleMargin(30);
           // $data1 = array(18.3); //C
           $data2 = array(17.5); //java
            $data3 = array(9.1); //C++
            
            $bar1 = new \BarPlot($datay1);
            $bar2 = new \BarPlot($datay2);
            $bar3 = new \BarPlot($datay3);
            if($tissue_name1 == 1){
                $bar1->SetLegend('Brain_Normal');
            }elseif($tissue_name1 == 2){
                $bar1->SetLegend('Brain_Tumor');
            }elseif($tissue_name1 == 3){
                $bar1->SetLegend('Adipose_Normal');
            }elseif($tissue_name1 == 4){
                $bar1->SetLegend('Adipose_Tumor');
            }elseif($tissue_name1 == 5){
                $bar1->SetLegend('Adipose_lean');
            }elseif($tissue_name1 == 6){
                $bar1->SetLegend('colon_Normal');
            }elseif($tissue_name1 == 7){
                $bar1->SetLegend('colon_Tumor');
            }
            $bar2 = new \BarPlot($datay2);
            if($tissue_name2 == 1){
                $bar2->SetLegend('Brain_Normal');
            }elseif($tissue_name2 == 2){
                $bar2->SetLegend('Brain_Tumor');
            }elseif($tissue_name2 == 3){
                $bar2->SetLegend('Adipose_Normal');
            }elseif($tissue_name2 == 4){
                $bar2->SetLegend('Adipose_Tumor');
            }elseif($tissue_name2 == 5){
                $bar2->SetLegend('Adipose_lean');
            }elseif($tissue_name2 == 6){
                $bar2->SetLegend('colon_Normal');
            }elseif($tissue_name2 == 7){
                $bar2->SetLegend('colon_Tumor');
            }
            $bar3 = new \BarPlot($datay3);
            if($tissue_name3 == 1){
                $bar3->SetLegend('Brain_Normal');
            }elseif($tissue_name3 == 2){
                $bar3->SetLegend('Brain_Tumor');
            }elseif($tissue_name3 == 3){
                $bar3->SetLegend('Adipose_Normal');
            }elseif($tissue_name3 == 4){
                $bar3->SetLegend('Adipose_Tumor');
            }elseif($tissue_name3 == 5){
                $bar3->SetLegend('Adipose_lean');
            }elseif($tissue_name3 == 6){
                $bar3->SetLegend('colon_Normal');
            }elseif($tissue_name3 == 7){
                $bar3->SetLegend('colon_Tumor');
            }
            $accbar = new \GroupBarPlot(array($bar1,$bar2,$bar3));

            $graph->Add($accbar);
            $graph->stroke();    
        }
        
        
}