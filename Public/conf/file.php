<?php
vendor('Jpgraph.jpgraph');
vendor('Jpgraph.jpgraph_bar');
       // include ("../jpgraph/jpgraph.php");
        //include ("../jpgraph/jpgraph_bar.php");
        $data=$_GET['data'];
        $datas=explode("|",$data);
        $group=array('一月','二月','三月','四月','五月');
        $graph = new \Graph(400,300);                                //创建新的Graph对象
        $graph->SetScale("textlin");
        $graph->SetShadow();                                       //设置阴影
        $graph->img->SetMargin(40,50,40,50);
        $graph->legend->SetFont(FF_SIMSUN,FS_BOLD);                //此处设置防止中文注释乱码
        $barplot=new BarPlot($datas);                             //创建新的BarPlot对象
        $barplot->SetFillColor('orange');
        $barplot->SetShadow('black@0.4');                       //设置阴影
        $barplot->value->Show();                         //填充颜色
        $barplot->SetLegend("人数");                             //设置注释
        $barplot->SetWidth(0.8);                                //设置柱状图宽度
        $graph->Add($barplot);                                     //将柱形图添加到图像中
        $graph->title->Set("统计分析");                      //设置标题和X-Y轴标题
        $graph->title->SetColor("red");
        $graph->title->SetMargin(10);
        $graph->xaxis->title->Set("分组");
        $graph->xaxis->title->SetMargin(5);
        $graph->xaxis->SetTickLabels($group);
        $graph->yaxis->title->Set("数值");
        $graph->title->SetFont(FF_SIMSUN,FS_BOLD);           //设置标题字体
        $graph->yaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
        $graph->xaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
        $graph->xaxis->SetFont(FF_SIMSUN,FS_BOLD);
        $graph->Stroke();