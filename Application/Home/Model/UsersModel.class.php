<?php 
namespace Home\Model;
use Think\Model;

class UsersModel extends Model{
	protected $trueTableName='users';

	//字段限制信息
	protected $_validate=array(
		array('username','require','账号不能为空！',1,'',3),
		array('password','require','密码不能为空！',1,'',3),
		array('username','','账号名称已存在！',1,'unique',2),
	);
	
	/////////////////////////////////////
	/**
	 * 实现用户注册
	 * @Author   Ryziii
	 * @DateTime 2018-02-27
	 * @param    string     $userName  用户名
	 * @param    string     $userPswd  用户密码
	 * @param    string     $userImage 用户头像
	 * @return   mix                若用户注册成功返回主键id 否则返回false
	 */
	public function doUserRegister($userName,$userPswd,$userImage){
		if($this->where('username='."'$userName'")->count()){
			return -3;
		}
		if(empty($userImage)){
			$userImage='1.jpg';
		}
		$data['username']=$userName;
		$data['password']=md5(md5($userPswd));
		$data['image']=$userImage;
		if($this->create($data)){
			return $this->add();
		}
		echo $this->getError();
		return false;
	}

	/**
	 * 修改密码操作
	 * @Author   Ryziii
	 * @DateTime 2018-02-27
	 * @param    string     $userName 用户名
	 * @param    string     $oldPswd  元素密码
	 * @param    string     $newPswd  新密码
	 * @return   bool               成功true 失败false
	 */
	public function doChangePswd($userName,$oldPswd,$newPswd){
		if($oldPswd===$newPswd){
			return false;
		}
		if(!$newPswd){
			echo '新密码不能为空';
			return false;
		}
		if(!$this->isValidUser($userName,$oldPswd)){
			return false;
		}

		$data['username']=$userName;
		$data['password']=md5(md5($newPswd));
		if($this->create($data)){
			return $this->where(array('username'=>$userName))->save();
		}
		echo $this->getError();
		return false;
	}

	/**
	 * 判断指定用户名用户是否存在
	 * @Author   Ryziii
	 * @DateTime 2018-02-27
	 * @param    string userName     $userName 指定用户名
	 * @return   boolean              存在true 不存在false
	 */
	public function isUserExists($userName){
		if(empty($userName)){
			return false;
		}
		$count=	$this->where(array(
			'username'=>$username
		))->count();

		return $count==1;
	}
	/**
	 * 判断是否为有效用户
	 * @Author   Ryziii
	 * @DateTime 2018-02-27
	 * @param    string     $userName 用户名
	 * @param    string     $userPswd 用户密码
	 * @return   boolean              用户名密码有效返回true 否则false
	 */
	public function isValidUser($userName,$userPswd){
		// die($userName.'  '.md5(md5(11)));
		$count= $this->where(array(
			'username'=>$userName,
			'password'=>md5(md5($userPswd)),
		))->count();
		
		return $count;
	}
	public function getImage($userid){
		$ima=$this->where('id='.$userid)->getField('image');
		return $ima;
	}
	public function getFlag($userid){
		$userName=$this->where('id='.$userid)->getField('username');
		return $userName===session('logineduser');
	}
	public function getUsername($userid){
		return $this->where('id='.$userid)->getField('username');
	}
	public function getUidByUname($username){
		if(!$username){
			return false;
		}
		$cond['username']=$username;
		return $this->where($cond)->getField('id');
	}
}