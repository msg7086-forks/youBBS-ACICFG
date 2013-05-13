<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 
ob_start();

?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<link href="/static/cosmo/css/bootstrap.css" rel="stylesheet" />
	<link href="/static/cosmo/css/bootstrap-responsive.css" rel="stylesheet" />
	<link href="/static/cosmo/css/cosmo.css" rel="stylesheet" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link href="/feed" rel="alternate" title="<?=htmlspecialchars($options['name'])?> - ATOM Feed" type="application/atom+xml"/>
<?php
if($options['head_meta']){
	echo $options['head_meta'];
}

if(isset($meta_des) && $meta_des){
	echo '    <meta name="description" content="',$meta_des,'" />';
}
if(isset($canonical)){
	echo '    <link rel="canonical" href="http://',$_SERVER['HTTP_HOST'],$canonical,'" />';
}
?>
</head>
<body>

<div class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="/" id="top"><?=htmlspecialchars($options['name'])?></a>

			<div class="nav-collapse collapse" id="main-menu">
				<form class="navbar-search pull-left" onsubmit="return dispatch()">
					<input type="text" class="search-query" name="q" placeholder="站内搜索" maxlength="30">
				</form>
				<ul class="nav pull-right" id="main-menu-right">

<?php if ($cur_user):
	$notic_n = count(array_unique(explode(',', $cur_user['notic'])))-1;
	/*
	if($cur_user['flag'] == 0){
		echo '<span style="color:yellow;">已被禁用</span>&nbsp;&nbsp;&nbsp;';
	}else if($cur_user['flag'] == 1){
		echo '<span style="color:yellow;">在等待审核</span>&nbsp;&nbsp;&nbsp;';
	}
	*/
?>
					<li><a class="thin"><img src="/avatar/mini/<?=$cur_user['avatar']?>.png" alt="<?=htmlspecialchars($cur_user['name'])?>" /></a></li>
					<li class="notice-<?=$notic_n?>"><a href="/notifications" style="color:yellow;"><?=$notic_n?>条提醒</a></li>
					<li><a href="/favorites" title="收藏的帖子">★</a></li>
					<li><a href="/member/<?=$cur_user['id']?>"><?=$cur_user['name']?></a></li>
					<li><a href="/setting">设置</a></li>
					<li><a href="/logout">退出</a></li>
<?php else: 
	if($options['wb_key'] && $options['wb_secret'])
		echo '<li><a href="/wblogin" rel="nofollow"><img src="/static/weibo_login.png" alt="微博登录" title="用微博帐号登录"/></a></li>';
	if($options['qq_appid'] && $options['qq_appkey'])
		echo '<li><a href="/qqlogin" rel="nofollow"><img src="/static/connect_logo_7.png" alt="QQ登录" title="用QQ登录"/></a></li>';
	if(!$options['close_register'])
		echo '<li><a href="/sigin">注册</a></li>';
?>
					<li><a href="/login" rel="nofollow">登录</a></li>
<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</div>


<div class="container main-wrap">
	<div class="row main">
		<div class="span9 main-content">
		
<?php
include($pagefile);
?>
		</div>
		<!-- main-content end -->
		<div class="span3 main-sider">

<?php
include(dirname(__FILE__) . '/sider.php');
?>
		</div>
	</div>
</div>
	<footer id="footer">
		<div class="container">
<?php
echo '
	<p>&copy; Copyright <a href="/">',$options['name'],'</a> • <a href="/feed">Atom Feed</a>';
if($options['icp']){
	echo ' • <a href="http://www.miibeian.gov.cn/" target="_blank" rel="nofollow">',$options['icp'],'</a>';
}
if($is_mobie){
	echo ' • <a href="/viewat-mobile">手机模式</a>';
}

echo '    </p>
	<p>Powered by <a href="http://youbbs.sinaapp.com/" target="_blank">YouBBS-ACI v',SAESPOT_VER,'</a></p>';
if($options['show_debug']){
	$mtime = explode(' ', microtime());
	$totaltime = number_format(($mtime[1] + $mtime[0] - $starttime), 6);
	echo '<p>Processed in ',$totaltime,' second(s), ',$DBS->querycount,' queries</p>';
}
?>
		</div>
	</footer>
	<!-- footer end -->


<script src="/static/js/jquery.lazyload.min.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
$(function() {
	$(".main-box img").lazyload({
		//placeholder : "/static/grey.gif",
		//effect : "fadeIn"
	});
});
</script>

<?php
if($options['analytics_code']){
	echo $options['analytics_code'];
}
?>
<script src="/static/cosmo/js/jquery-1.9.1.min.js"></script>
<script src="/static/cosmo/js/bootstrap.js"></script>

</body>
</html>

<?php
/*
$_output = ob_get_contents();
ob_end_clean();

// 304
// WHY we need this?
// MD5 will take long time to run, and this page has token a long time to run.
// Unless you are heavily stricted on bandwidth, or this code is meaningless.

if(!$options['show_debug']){
	$etag = md5($_output);
	if($_SERVER['HTTP_IF_NONE_MATCH'] == $etag){
		header("HTTP/1.1 304 Not Modified");
		header("Status: 304 Not Modified");
		header("Etag: ".$etag);
		exit;    
	}else{
		header("Etag: ".$etag);
	}
}

echo $_output;
*/

?>
