<?php 
namespace Home\Model;
use Think\Model;
use Think\Page;
class MsgsModel extends Model{
	protected $trueTableName='msgs';

	/**
	 * 通过用户id获取用户
	 * @Author   Ryziii
	 * @DateTime 2018-02-27
	 * @param    [type]     $userid [description]
	 * @return   array             按指定条件返回数据记录
	 */
	public function getMsgsByUserId($userid){
		return $this->where('userid='.$userid)->select();
	}
	public function isUserExists($userName){
		if(empty($userName)){
			return false;
		}
		$count= $this->where(array(
			'title'=>$userName
		))->count();
	
		return $count==1;
	}
	public function addMsg($msgTitle,$msgBody="",$msgUserId=null){
		$data=array();
		if(is_array($msgTitle)){
			$data['title']=$msgTitle['title'];
			$data['body']=$msgTitle['body'];
			$data['userid']=$msgTitle['userid'];
		}else if(is_string($msgTitle)){
			$data['title']=$msgTitle;
			// die(dump($msgBody).' '.dump($msgUserId));
			if(empty($msgBody)||!$msgUserId){
				return false;
			}
			$data['body']=$msgBody;
			$data['userid']=$msgUserId;
		}
		date_default_timezone_set('PRC');
		$data['time']=date('Y-m-d H:i:s',time());
		return $this->add($data);
	}

	/**
	 * 修改留言
	 * @Author   Ryziii
	 * @DateTime 2018-02-27
	 * @param    [type]     $where 查询条件
	 * @param    array      $data  
	 * @return   [type]            修改后的记录
	 */
	public function updateMsg($where,$data=array()){
		if(empty($where)){
			return false;
		}
		date_default_timezone_set('PRC');
		$data['time']=date('Y-m-d H:i:s',time());
		return $this->where($where)->save($data);
	}

	public function deleteMsg($where){
		if(!$where||empty($where)){
			return false;
		}
		$id=$this->where($where)->getField('id');
		$rmsgsTable=D('rmsgs');
		if($rmsgsTable->deleteRmsgsByMsgId($id)){
			return $this->where($where)->delete();
		}
		return false;
	}

	public function getMsgById($id){
		$msg=$this->getById($id);
		$rmsgsTable=D('rmsgs');
		$msg['rmsgs']=$rmsgsTable->getRmsgsByMsgId($msg['id']);
		return $msg;
	}
	public function getMsgsByPage(){
		$count=$this->count();
		$page=new Page($count,C('page_rows'));
		$page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$show=$page->show();
		$show= str_replace("Msg","Home/msg",$show);
		$msgs=$this->limit($page->firstRow.','.$page->listRows)->select();
		$result=array();
		$result['lists']=$msgs;
		$result['pages']=$show;
		$result['pageCount']=$page->totalPages;
		return $result;
	}
	public function getUidByMid($msgid){
		return $this->where('id='.$msgid)->getField('userid');
	}
}