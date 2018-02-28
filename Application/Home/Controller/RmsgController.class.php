<?php 
namespace Home\Controller;
use Think\Controller;
class RmsgController extends Controller{
	public function recipemsg(){
		$rmsgsTable=D('rmsgs');
		$msgid=I('get.msgid');
		if(IS_POST){
			$userTable=D('users');
			$content=I('post.content');
			$userid=$userTable->getUidByUname(session('logineduser'));
			$r= $rmsgsTable->recipeMsg($msgid,$userid,$content);
			if(false!==$r){
				$this->success('添加回复成功！','/home/msg/viewmsg/msgid/'.$msgid);
			}else{
				$this->error('添加回复失败！');
			}
		}else{
			if(session('?logineduser')){
				$msgsTable=D('msgs');
				$msgObj=$msgsTable->getMsgById($msgid);
				$this->assign('msg',$msgObj);
				$this->assign('view_title','发表留言');
				$this->display();
			}else{
				$this->error('请先登录','/home/user/login/');
			}
		}
	}
	public function editrmsg(){
		$rmsgsTable=D('rmsgs');
		$rmsgid=I('get.rmsgid');
		$msgsTable=D('msgs');
		$msgid=$rmsgsTable->getMsgidByRmsgid($rmsgid);		
		if(IS_POST){
			$userTable=D('users');
			$content=I('post.content');
			$userid=$userTable->getUidByUname(session('logineduser'));
			$data['body']=$content;
			$data['id']=$rmsgid;

			$data['userid']=$userid;
			$data['msgid']=$msgid;
			$r= $rmsgsTable->editRmsg('id='.$rmsgid,$data);
			if(false!==$r){
				$this->success('修改回复成功！','/home/msg/viewmsg/'.$msgid);
			}else{
				$this->error('修改回复失败！');
			}
		}else{
			if(session('?logineduser')){
				$msgObj=$msgsTable->getMsgById($msgid);
				$rmsgObj=$rmsgsTable->getRmsgsByRmsgId($rmsgid);
				$this->assign('msg',$msgObj);
				$this->assign('rmsg',$rmsgObj);
				$this->assign('view_title','发表留言');
				$this->display();
			}else{
				$this->error('请先登录','/home/user/login/');
			}
		}

	}
	public function deletermsg(){
		$rmsgsTable=D('rmsgs');
		$rmsgid=I('get.rmsgid');
		$msgid=$rmsgsTable->getMsgidByRmsgid($rmsgid);		
		$r=$rmsgsTable->deleteRmsg('id='.$rmsgid);
		if($r!==false){
			$this->success('删除回复成功','/home/msg/viewmsg/'.$msgid);
		}else {
			$this->error('删除回复失败');
		}
	}
}