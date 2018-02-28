<?php 
namespace Home\Model;
use Think\Verify;
class Captcha{
	//定义常量
	const REGISTER_CAPTCHA=1;
	const LOGIN_CAPTCHA=2;

	//定义方法
	public static function createCaptcha($identify=self::REGISTER_CAPTCHA){
		$verify=new Verify();
		//配置参数
		$verify->length=C('captcha_length');
		//生成验证码
		$verify->entry($identify);
	}
	public static function checkCaptcha($captcha,$identify=self::REGISTER_CAPTCHA){
		$verify=new Verify();
		return $verify->check($captcha,$identify);
	}
}