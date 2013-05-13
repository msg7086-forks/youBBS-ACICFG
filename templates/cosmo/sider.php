<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 
?>
<!-- SIDEBAR -->
<?php

if($cur_user_is_admin) {
?>
<div class="sider-box">
	<div class="sider-box-title">管理员面板 （<a href="http://youbbs.sinaapp.com/" target="_blank">YouBBS官方支持</a>）</div>
	<div class="sider-box-content">
	<a class="btn" href="/admin-node">分类管理</a>
	<a class="btn" href="/admin-setting">网站设置</a>
	<a class="btn" href="/admin-user-list">用户管理</a>
	<a class="btn" href="/admin-link-list">链接管理</a>
	<div class="c"></div>
	</div>
</div>
<?php
}


if($options['ad_sider_top']) {
?>
<div class="sider-box">
	<div class="sider-box-title">广而告之</div>
	<div class="sider-box-content">',$options['ad_sider_top'],'
	<div class="c"></div>
	</div>
</div>
<?php
}


if($options['close']){
	$note = $options['close_note'] ? $options['close_note'] : '系统维护中';
?>
<div class="sider-box">
	<div class="sider-box-title">公告</div>
	<div class="sider-box-content">
	<h2><?=$note?></h2>
	<div class="c"></div>
	</div>
</div>
<?php
}


if(isset($newpost_page)){
?>
<div class="sider-box">
	<div class="sider-box-title">发帖指南</div>
	<ul class="sider-box-content">
	<ul>
	<li>• 不欢迎灌水</li>
	<li>• 字数限制： 标题 &lt; <?=$options['article_title_max_len']?>，内容 &lt; <?=$options['article_content_max_len']?></li>
	<li>• 纯文本格式，不支持html 或 ubb 代码</li>
	<li>• 贴图： 可直接粘贴图片地址，<br/>如 http://www.baidu.com/xxx.gif <br/>支持jpg/gif/png后缀名，<br/> 也可利用“围脖是个好图床”提供的通道，<br/>上传后直接粘贴地址</li>
	<li>• 贴视频： 可直接视频地址栏里的网址，<br/>如 http://www.tudou.com/programs/view/PAH86KJNoiQ/ <br/>仅支持土豆/优酷/QQ</li>
	<div class="c"></div>
	</ul>
	</div>
</div>
<?php
}

if(isset($bot_nodes)){
?>
<div class="sider-box">
	<div class="sider-box-title">最热主题</div>
	<div class="sider-box-content">
<?php
foreach(array_slice($bot_nodes, 0, intval($options['hot_node_num']), true) as $k=>$v ){
	echo '<a class="btn" href="/',$k,'">',$v,'</a>';
}
?>
	<div class="c"></div>
	</div>
</div>
<?php
}

if(isset($newest_nodes) && $newest_nodes){
?>
<div class="sider-box">
	<div class="sider-box-title">最近添加的分类</div>
	<div class="sider-box-content">
<?php
foreach( $newest_nodes as $k=>$v ){
	echo '<a class="btn" href="/',$k,'">',$v,'</a> ';
}
?>
	<div class="c"></div>
	</div>
</div>
<?php
}

if(isset($links) && $links){
?>
<div class="sider-box">
	<div class="sider-box-title">链接</div>
	<div class="sider-box-content">
<?php
foreach( $links as $k=>$v ){
	echo '<a class="btn" href="',$v,'" target="_blank">',$k,'</a> ';
}
?>
	<div class="c"></div>
	</div>
</div>
<?php
}

if(isset($site_infos)){
?>
<div class="sider-box">
	<div class="sider-box-title">站点运行信息（<?=round(($timestamp - $options['site_create'])/86400)+1?>天）</div>
	<div class="sider-box-content">
	<ul>
<?php
foreach($site_infos as $k=>$v){
	echo '<li>',$k,': ',$v,'</li>';
}
?>
	</ul>
	<div class="c"></div>
	</div>
</div>
<?php
}
