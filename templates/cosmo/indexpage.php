<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

if($cid)
	$top_hint = $cat['name'] . '(' . $total . ')';
elseif($page > 1)
	$top_hint = '第' . $page . '页 / 共' . $totalpage . '页';
else
	$top_hint = '<li class="active">最近更新<span class="divider">/</span></li><li><a href="/feed">Atom Feed</a></li>';

if($cid && $cur_user_is_admin)
	$top_hint .= '<li><a href="/admin-node-' . $cat['id'] . '#edit">编辑</a></li>';

$newpost_cid = $cid ? $cid : 1;

?>
<!-- INSIDE TEMPLATE -->


<ul class="breadcrumb title clearfix">
	<li><a href="/"><?=$options['name']?></a><span class="divider">/</span></li>
	<?=$top_hint?>

<?php if($cur_user && $cur_user['flag'] > 4):?>
		<li class="pull-right"><a href="/newpost/<?=$newpost_cid?>" rel="nofollow" class="btn btn-primary btn-small">发新帖</a></li>
<?php endif;?>
</ul>


<?php if($cid && $cat['about']): ?>
<div class="well cat_about">
	<p><?=$cat['about']?></p>
</div>
<?php endif; ?>


<?php foreach($articledb as $article):
	$gotopage = ceil($article['comments']/$options['commentlist_num']);
	$c_page = $gotopage > 1 ? '-'.$gotopage : '';

?>
<div class="media post-list">
	<a class="pull-left hidden-480" href="/member/<?=$article['uid']?>">
<?php if(!$is_spider): ?>
		<img src="/avatar/normal/<?=$article['uavatar']?>.png" alt="<?=$article['author']?>" />
<?php else: ?>
		<img src="/static/grey.gif" data-original="/avatar/normal/<?=$article['uavatar']?>.png" alt="<?=$article['author']?>" />
<?php endif; ?>
	</a>
	<div class="media-body item-content">
		<a class="badge pull-right hidden-480 comment-count comment-<?=$gotopage?>" href="/t-<?=$article['id']?><?=$c_page?>#reply<?=$article['comments']?>"><?=$article['comments']?></a>
		<h4 class="media-heading"><a href="/t-<?=$article['id']?>"><?=$article['title']?></a></h4>
		<a class="mylabel" href="/n-<?=$article['cid']?>"><?=$article['cname']?></a>
		<a class="mylabel" href="/member/<?=$article['uid']?>"><?=$article['author']?></a>
<?php if($article['comments']): ?>
		<span class="mylabel"><?=$article['edittime']?></span>
		<span class="mylabel"><span class="hidden-480">最后回复来自 </span><a href="/member/<?=$article['ruid']?>"><?=$article['rauthor']?></a></span>
<?php else: ?>
		<span class="mylabel"><span><?=$article['addtime']?></span></span>
<?php endif; ?>
	</div>
</div>

<?php endforeach; ?>
<?php 
if($totalpage > 1)
{
echo '<div class="post-list"><ul class="pager">
';
$pageprefix = $cid ? '/n-' . $cid . '-' : '/page/';

if($page > 1)
	echo '	<li class="previous"><a href="',$pageprefix,$page-1,'">&laquo; 上一页</a></li>';

if($page < $totalpage)
	echo '	<li class="next"><a href="',$pageprefix,$page+1,'">下一页 &raquo;</a></li>';

echo '
</ul></div>';
}


if(isset($bot_nodes)){
echo '
<div class="title">热门分类</div>
<div class="main-box main-box-node">
<span class="btn">';
foreach( $bot_nodes as $k=>$v ){
	echo '<a href="/',$k,'">',$v,'</a>';
}
echo '
</span>
<div class="c"></div>

</div>';
}

?>