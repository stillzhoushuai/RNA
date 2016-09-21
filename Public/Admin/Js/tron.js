$(".tron").mouseover(function(){
	//这个TR里面每个TD的背景色
	$(this).find("td").css('backgroundColor','#DEE7F5');
});
$(".tron").mouseout(function(){
	//这个TR里面每个TD的背景色
	$(this).find("td").css('backgroundColor','#FFF');
});