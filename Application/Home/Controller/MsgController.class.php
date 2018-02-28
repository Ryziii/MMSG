<?php
namespace Home\Controller;
use Think\Controller;

class MsgController extends Controller{
	public function addmsg(){
		$msgsTable=D('msgs');
		if(IS_POST){
			$userTable=D('users');
			$data['title']=I('post.title');
			$data['body']=I('post.content');
			$data['userid']=$userTable->getUidByUname(session('logineduser'));
			$r= $msgsTable->addMsg($data['title'],$data['body'],$data['userid']);
			if(false!==$r){
				$this->success('添加留言成功！','/home/msg/index');
			}else{
				$this->error('添加留言失败！');
			}
		}else{
			if(session('?logineduser')){
				$this->assign('view_title','发表留言');
				$this->display();
			}else{
				$this->error('请先登录');
			}
		}
	}
	public function editmsg(){

		$msgsTable=D('msgs');
		if(IS_POST){
			$userTable=D('users');
			$data['title']=I('post.title');
			$data['body']=I('post.content');
			// $data['userid']=$userTable->getUidByUname(session('logineduser'));
			$msgid=I('get.msgid');
			$r= $msgsTable->updateMsg('id='.$msgid,$data);
			if(false!==$r){
				$this->success('修改留言成功！','/home/msg/index');
			}else{
				$this->error('修改留言失败！');
			}
		}else{
			$msgId=I('get.msgid');
			$msgObj=$msgsTable->getMsgById($msgId);
			if(session('?logineduser')){
				$this->assign('msg',$msgObj);
				$this->assign('view_title','修改留言');
				$this->display();
			}else{
				$this->error('请先登录');
			}
		}
	}
	public function deletemsg(){
		$msgsTable=D('msgs');
		$userTable=D('users');
		$id=I('get.msgid');
		if(!$id|| session('logineduser')!=$userTable->getUsername($msgsTable->getUidByMid($id))){
			$this->error('留言删除失败！');
		}
		$r=$msgsTable->deleteMsg('id='.$id);
		if($r!==false){
			$this->success('留言删除成功！','home/msg/idnex');
		}else{
			$this->error('留言删除失败！');
		}
		
	}
	public function index(){

		//实例化数据库操作类
		$msgsTable=D('msgs');
		//获取分页记录
		$r=$msgsTable->getMsgsByPage();
		$userTable=D('users');
		foreach ($r['lists'] as $key => &$value) {
			$value['image']= $userTable->getImage($value['userid']);
			$value['flag']=$userTable->getFlag($value['userid']);
			$value['username']=$userTable->getUsername($value['userid']);
		}
		//分页记录和分页信息指派给视图文件
		$flag=$r['lists']['username']===session('logineduser')?1:0;
		$this->assign('lists',$r['lists']);
		$this->assign('pages',$r['pages']);
		//指定视图标题
		$this->assign('view_title','首页');
		//显示视图
		$this->display();
	}
	public function viewmsg(){
		$msgTable=D('msgs');
		$userTable=D('users');
		$msgid=I('get.msgid');
		if(!$msgid||empty($msgid)){
			$msgid=1;
		}
		$msg=$msgTable->getMsgById($msgid);
		$msg['image']=$userTable->getImage($msg['userid']);
		$msg['username']=$userTable->getUsername($msg['userid']);
		foreach ($msg['rmsgs'] as $key => &$value) {
			$value['image']= $userTable->getImage($value['userid']);
			$value['username']=$userTable->getUsername($value['userid']);
		}
		$this->assign('msg',$msg);
		$this->assign('view_title',$msg['title']);
		$this->display();
	}
}