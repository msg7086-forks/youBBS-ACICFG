<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

if($cid)
    $top_hint = $cat['name'] . '(' . $total . ')';
elseif($page > 1)
    $top_hint = '第' . $page . '页 / 共' . $totalpage . '页';
else
    $top_hint = '最近更新 • <a href="/feed">Atom Feed</a>';

if($cid && $cur_user_is_admin)
    $top_hint .= ' • <a href="/admin-node-' . $cat['id'] . '#edit">编辑</a>';

$newpost_cid = $cid ? $cid : 1;

echo '
<div class="title">
    <div class="float-left fs14">
        <a href="/">',$options['name'],'</a> &raquo; ', $top_hint, '
    </div>';

if($cur_user && $cur_user['flag']>4){
    echo '<div class="float-right"><a href="/newpost/',$newpost_cid,'" rel="nofollow" class="newpostbtn">+发新帖</a></div>';
}
echo '    <div class="c"></div>
</div>

<div class="main-box home-box-list">';

if($cid && $cat['about']){
    echo '<div class="post-list grey"><p>',$cat['about'],'</p></div>';
}

foreach($articledb as $article){
echo '
<div class="post-list">
    <div class="item-avatar"><a href="/member/',$article['uid'],'">';
if(!$is_spider){
    echo '<img src="/avatar/normal/',$article['uavatar'],'.png" alt="',$article['author'],'" />';
}else{
    echo '<img src="/static/grey.gif" data-original="/avatar/normal/',$article['uavatar'],'.png" alt="',$article['author'],'" />';
}
echo '    </a></div>
    <div class="item-content">
        <h1><a href="/t-',$article['id'],'">',$article['title'],'</a></h1>
        <span class="item-date"><a href="/n-',$article['cid'],'">',$article['cname'],'</a>  •  <a href="/member/',$article['uid'],'">',$article['author'],'</a>';
if($article['comments']){
    echo ' •  ',$article['edittime'],' •  最后回复来自 <a href="/member/',$article['ruid'],'">',$article['rauthor'],'</a>';
}else{
    echo ' •  ',$article['addtime'];
}
echo '        </span>
    </div>';
if($article['comments']){
    $gotopage = ceil($article['comments']/$options['commentlist_num']);
    if($gotopage == 1){
        $c_page = '';
    }else{
        $c_page = '-'.$gotopage;
    }
    echo '<div class="item-count"><a href="/t-',$article['id'],$c_page,'#reply',$article['comments'],'">',$article['comments'],'</a></div>';
}
echo '    <div class="c"></div>
</div>';

}

if($totalpage > 1)
{
echo '<div class="pagination">
';
$pageprefix = $cid ? '/n-' . $cid . '-' : '/page/';

if($page>1){
echo '<a href="',$pageprefix,$page-1,'" class="float-left">&laquo; 上一页</a>';
}
if($page<$totalpage){
echo '<a href="',$pageprefix,$page+1,'" class="float-right">下一页 &raquo;</a>';
}
echo '<div class="c"></div>
</div>';
}

echo '</div>';

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