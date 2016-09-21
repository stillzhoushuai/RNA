<!-- 
这是我的一个小测试 怎么提交了没有反应呢   这是第三次测试
-->
<?php
$testArr = array(1, 1, 2, 7, 3, 3, 4, 5, 6, 10, 2, 3, 1);
sort($testArr);

print_r(array_count_values($testArr));
$resultArr = array();
$array=array();
foreach($testArr as $key=>$value)
{
	if(!isset($resultArr[$value]))
	{
		$resultArr[$value] = 1;
	}
	else
	{
		$resultArr[$value]++;
	}
}
foreach($testArr as $key=>$value)
{
	if($resultArr[$value] > 1)
	{
		//echo '数组下标'.$key.'数组元素'.$value;
		array_push($array, $value.'_'.$key);
		
	}else{
	    echo '数组下标'.$key.'数组元素'.$value;
	    echo "</br>";
	}
}
sort($array);
print_r($array);echo "</br>";
$x=array();
foreach($array as $k=>$v){
    array_push($x, explode("_", $v));
    
}
print_r($x);echo "</br>";

?> 