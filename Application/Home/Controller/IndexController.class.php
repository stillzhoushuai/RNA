<?php
//命名空间
namespace Home\controller;
use Think\controller;
class IndexController extends Controller{
    function index(){
        $this->display();
    }
    
    public function top(){
        $this->display();
    }
    
   
}