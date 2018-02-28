<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml1" dir="ltr" lang="zh-cn" xml:lang="zh-cn">
<head>
	<title>多用户留言系统</title>
	<link rel="stylesheet" type="text/css" href="/Public/css/moodle.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/moodle2.css">
	<script type="text/javascript" src="/Public/script.js"></script>
</head>
<body class="login course-1 notloggedin dir-ltr lang-zh_cn_utf8" id="login-index">
	<div id="page">
		<div id="header" class="clearfix">
			<h1 class="headermain">多用户留言系统</h1>
			<div class="headermenu">
				<div class="logininfo">
					<?php if(isset($_SESSION['logineduser'])): ?>欢迎您，<?php echo (session('logineduser')); ?>！ | <a href="/home/user/logout">注销</a>
					<?php else: ?>
						您还没有登录(<a href="/home/user/login/">登录</a>)&nbsp;
						还没有用户名(<a href="/home/user/register/">注册</a>)<?php endif; ?>
				</div>
			</div>
		</div>

		<!-- 面包屑 -->
		<div class="navbar clearfix">
			<div class="breadcrumb">
				<ul>
					<li class="first"><a href="/">多用户留言系统</a></li>
					<li><span class="arrow sep">&#x25BA;</span><?php echo ($view_title); ?></li>
				</ul>
			</div>
		</div>

		<!-- 显示留言板主题 -->
		<!-- start PF CONTENT -->
		<div id="content"><!-- 
			<div id="intro" class="generalbox box">
				<font size="+0" face="courier new">
					欢迎大家来到我的留言板。<br/>
					您有什么问题或想法，请书写下您的笔墨。<br/>
					如果您有其他的想法......<br/>
					您可以在这里和大家一起交流和讨论。<br/>
					如果您还没有用户名，请<a href=""></a>
				</font>
			</div> -->
			<div class="loginbox clearfix twocolumns">
  <div class="loginpanel">
      <h2>
          请详细填写您的注册信息！
      </h2>
      <div class="subcontent loginsub">
          <form action="" id="login" method="post">
              <div class="loginform">
                  <div class="form-label">
                      <label for="username">用户名</label>
                  </div>
                  <div class="form-input">
                      <input id="username" name="username" size="15" type="text" value="" />
                      <br/>
                      <span class="errorTip" id="userTip"></span>
                  </div>
                  <div class="clearer"></div>
                  <div class="form-label">
                      <label for="password">密码</label>
                  </div>
                  <div class="form-input">
                      <input id="password" name="password" size="15" type="password" value="" />
                      <br>
                      <span class="errorTip" id="pswdTip"></span>
                  </div>
                  <div class="clearer"></div>
                  <div class="form-label">
                      <label for="password">确认密码</label>
                  </div>
                  <div class="form-input">
                      <input id="password2" name="password2" size="15" type="password" value="" />
                      <br>
                      <span class="errorTip" id="pswd2Tip"></span>
                  </div>
                  <div class="clearer">
                  </div>
                  <div class="form-label">
                      <label for="password">选择头像</label>
                  </div>
                    <div style="margin-left: 235px">
                    <img height="30px" src="/Public/images/0.gif" width="30px">
                    <input id="image" name="image" type="radio" value="/Public/images/0.gif">
                    <img height="30px" src="/Public/images/1.gif" width="30px">
                    <input id="image" name="image" type="radio" value="/Public/images/1.gif">
                    <img height="30px" src="/Public/images/2.gif" width="30px">
                    <input id="image" name="image" type="radio" value="/Public/images/2.gif">
                    <img height="30px" src="/Public/images/3.gif" width="30px">
                    <input id="image" name="image" type="radio" value="/Public/images/3.gif">
                    <img height="30px" src="/Public/images/4.gif" width="30px">
                    <input id="image" name="image" type="radio" value="/Public/images/4.gif">
                    <img height="30px" src="/Public/images/5.gif" width="30px">
                    <input id="image" name="image" type="radio" value="/Public/images/5.gif">
                    <img height="30px" src="/Public/images/6.gif" width="30px">
                    <input id="image" name="image" type="radio" value="/Public/images/6.gif">
                    <img height="30px" src="/Public/images/7.gif" width="30px">
                    <input id="image" name="image" type="radio" value="/Public/images/7.gif">
                    <img height="30px" src="/Public/images/8.gif" width="30px">
                    <input id="image" name="image" type="radio" value="/Public/images/8.gif">
                    <img height="30px" src="/Public/images/9.gif" width="30px">
                    <input id="image" name="image" type="radio" value="/Public/images/9.gif">
                  </div>
                  <div class="clearer">
                  </div>
                  <div class="form-label">
                      <label for="captcha">验证码</label>
                  </div>
                  <div class="form-input">
                      <input id="captcha" name="captcha" size="15" type="text" value="" />
                      <img id="captchaImg" src="/home/user/captcha/atype/register/" style="cursor: pointer; width: 100px; height: 40px;">
                      <br>
                      <span class="errorTip" id="captchaTip"></span>
                      </input>
                  </div>
                  <div class="clearer">
                  </div>
                  <div class="form-input">
                      <input id="submit" name="register" type="submit" value="注册" />
                  </div>
                  <div class="clearer"></div>
              </div>
          </form>
      </div>
  </div>
  <div class="subcontent">
    <h2>注册帮助</h2>
    <div class="subcontent">
      <p>
        <b>1 用户名</b><br>
        用户名必须是字母、数字或下划线，且必须以字母开头（至少六位）<br>
        <b>2 密码和确认密码</b><br>
        密码和确认密码必须相同，至少八位 <br>
        <b>3 验证码</b><br>
        验证码不区分大小写 <br>
      </p>
    </div>
  </div>
</div>
		</div>
		<div id="footer">
			&copy;2018 <a href="http://www.coeji.xyz">首页</a>
		</div>
	</div>
</body>
</html>