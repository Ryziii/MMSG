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
			<div id="content">
            <br>
            <!-- 主贴 -->
            <table cellspacing="0" class="forumpost">
                <tbody><tr class="header">
                    <td class="picture left">
                        <img src="<?php echo ($msg["image"]); ?>" height="35" width="35">
                    </td>
                    <td class="topic starter">
                        <div class="subject"><?php echo ($msg["title"]); ?></div>
                        <div class="author">
                            由 <?php echo ($msg["username"]); ?>                          发表于 <?php echo ($msg["time"]); ?>                     </div>
                    </td>                   
                </tr>
                <tr>
                    <td class="left side"></td>
                    <td class="content"> 
                        <div class="posting">                           
                            <?php echo ($msg["body"]); ?>                                                                   <div class="commands">
        <a href="/home/rmsg/recipemsg/msgid/<?php echo ($msg["id"]); ?>/">回复</a>
    </div>                      </div>
                        
                    </td>
                </tr>

            </tbody></table> 
            <!-- 回帖列表 -->
            <?php if(is_array($msg["rmsgs"])): foreach($msg["rmsgs"] as $key=>$vo): ?><table cellspacing="0" class="forumpost" style="margin-left: 50px;">
    <tbody><tr class="header">
        <td class="picture left">
            <img src="<?php echo ($vo["image"]); ?>" height="35" width="35">
        </td>
        <td class="topic">
            <div class="subject">回复: </div>
            <div class="author">由 <?php echo ($vo["username"]); ?> 发表于 <?php echo ($vo["time"]); ?></div>
        </td>
    </tr>
    
    <tr>
        <td class="left side">&nbsp;</td>
        <td class="content"> 
            <div class="posting"> 
                <?php echo ($vo["body"]); ?>                                <br><br>                        
            </div>
                            
            <div class="commands">
                <?php if($vo["username"] == session('logineduser')): ?><a href="/home/rmsg/editrmsg/rmsgid/<?php echo ($vo["id"]); ?>">编辑</a> | 
                <a href="/home/rmsg/deletermsg/rmsgid/<?php echo ($vo["id"]); ?>">删除</a><?php endif; ?>
            </div>      </td>
    </tr>
</tbody></table><?php endforeach; endif; ?>
            <!-- 回帖列表 -->
        </div>
		</div>
		<div id="footer">
			&copy;2018 <a href="http://www.coeji.xyz">首页</a>
		</div>
	</div>
</body>
</html>