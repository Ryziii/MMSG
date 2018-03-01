<?php 
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{
	public function register(){
		if(IS_POST){
			$userTable=D('users');
			$userName=I('post.username');
			$userPswd=I('post.password');
			$userConfpswd=I('post.password2');
			$userImage=I('post.image');
			$captcha=I('post.captcha');
			$verify=new \Home\Model\Captcha();
			if($verify->checkCaptcha($captcha,$verify->REGISTER_CAPTCHA)){
				if($userPswd!==$userConfpswd){
					$this->error('两次输入密码不一致！');
				}
				$r=$userTable->doUserRegister($userName,$userPswd,$userImage);
				if($r>0){
					$this->success('用户注册成功', __ROOT__.'/home/user/login');
				}elseif($r==-3){
					$this->error('用户已存在');
				}
			}else{
				$this->error('验证码不正确，请重新填写');
			}
		}else{
			$this->assign('view_title','用户注册');
			$this->display();
		}
	}
	public function login(){
		if(IS_POST){
			$userTable=D('users');
			$userName=I('post.username');
			$userPswd=I('post.password');
			if($userTable->isValidUser($userName,$userPswd)){
				session('logineduser',$userName);
				$this->success('登录成功',__ROOT__.'/home/msg/index');
			}else{
				$this->error('用户名或者密码错误,请重新输入');
			}
		}else{
			$this->assign('view_title', '用户登录');
			$this->display();
		}
	}
	public function logout(){
		session('logineduser',null);
		$this->redirect('/home/msg/index');
	}
	public function changepswd(){
		$this->error('改功能暂未开发....');
	}

	/**
	 * 创建验证码图片
	 * @Author   Ryziii
	 * @DateTime 2018-02-27
	 * @param    string     $atype 创建的是哪一个操作的验证码 默认‘register’
	 * @return   [type]            [description]
	 */
	public function captcha($atype='register'){
		$verify=new \Home\Model\Captcha();
		switch ($atype) {
			case 'register':
				$verify->createCaptcha($verify->REGISTER_CAPTCHA);
				break;
			case 'login':
				$verify->createCaptcha($verify->LOGIN_CAPTCHA);
				break;
			default:
				$verify->createCaptcha($verify->REGISTER_CAPTCHA);
				break;
			
		}
	}
}