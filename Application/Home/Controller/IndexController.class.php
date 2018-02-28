<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller
{
    public function index($id=1)
    {
        
        $this->assign('person', $p);
        $this->assign('time', time());
        $this->assign('persons',array(
            array('name'=>'zs','age'=>22),
            array('name'=>'ls','age'=>20),
        ));
        $this->display();
    }
    public function add(){
        $this->display();
    }
}
class Person{
    public $name;
    public $age;
}
