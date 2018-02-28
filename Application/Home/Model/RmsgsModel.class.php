<?php 
namespace Home\Model;
use Think\Model;

class RmsgsModel extends Model{
	protected $trueTableName='rmsgs';

	/////////////////////
	/**
	 * 添加回复留言
	 * @Author   Ryziii
	 * @DateTime 2018-02-27
	 * @param    [type]     $msgid  留言id
	 * @param    [type]     $userid 用户id
	 * @param    [type]     $body   留言信息
	 * @return   boolean             留言成功为true否则为false
	 */
	public function recipeMsg($msgid,$userid,$body){
		if(empty($msgid)||empty($userid)||empty($body)){
			return false;
		}

		$data=array();
		$data['msgid']=$msgid;
		$data['userid']=$userid;
		$data['body']=$body;
		return $this->add($data);
	}

	/**
	 * 修改回复留言
	 * @Author   Ryziii
	 * @DateTime 2018-02-27
	 * @param    [type]     $where 判断条件
	 * @param    array      $data  数据
	 * @return   Boolean            修改成功true失败false
	 */
	public function editRmsg($where,$data=array()){
		if(empty($where)){
			return false;
		}
		date_default_timezone_set('PRC');
		$data['time']=date("Y-m-d H:i:s");
		return $this->where($where)->save($data);
	}

	/**
	 * 删除回复信息
	 * @Author   Ryziii
	 * @DateTime 2018-02-27
	 * @param    [type]     $where 判断条件
	 * @return   bool            删除成功true 失败false
	 */
	public function deleteRmsg($where){
		if(!$where||empty($where)){
			return false;
		}
		return $this->where($where)->delete();
	}

	/**
	 * 根据msgid删除该留言回复留言信息
	 * @Author   Ryziii
	 * @DateTime 2018-02-27
	 * @param    int     $msgid 主留言id
	 * @return   mix            删除成功返回个数 失败false
	 */
	public function deleteRmsgsByMsgId($msgid){
		$where=array();
		if(!$msgid||empty($msgid)){
			return false;
		}
		if(is_array($msgid)){
			$where['msgid']=array('in',implode(',', $msgid));
		}elseif(is_string($msgid)){
			if(strpos($msgid, ',')){
				$where['msgid']=array('in',$msgid);
			}else{
				$where['msgid']=$msgid;
			}
		}elseif(is_int($msgid)){
			$where['msgid']=$msgid;
		}
		return $this->where($where)->delete()!==false;
	}

	public function getRmsgsByMsgId($msgid){
		if(!$msgid||empty($msgid)){
			return false;
		}
		$where=array();
		if(is_array($msgid)){
			$where['msgid']=array('in',implode(',', $msgid));
		}elseif(is_string($msgid)){
			if(strpos($msgid, ',')){
				$where['msgid']=array('in',$msgid);
			}else{
				$where['msgid']=$msgid;
			}
		}elseif(is_int($msgid)){
			$where['msgid']=$msgid;
		}
		return $this->where($where)->select();	
	}
	public function getRmsgsByRmsgId($msgid){
		if(!$msgid||empty($msgid)){
			return false;
		}
		$where=array();
		if(is_array($msgid)){
			$where['id']=array('in',implode(',', $msgid));
		}elseif(is_string($msgid)){
			if(strpos($msgid, ',')){
				$where['id']=array('in',$msgid);
			}else{
				$where['id']=$msgid;
			}
		}elseif(is_int($msgid)){
			$where['id']=$msgid;
		}
		return $this->where($where)->select();	
	}
	public function getMsgidByRmsgid($id){

		return $this->where('id='.$id)->getField('msgid');
	}
}