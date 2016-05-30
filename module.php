<?php
//widget：最新文章
function widget_newlog2($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<?php foreach($newLogs_cache as $value):$li = idby_img($value['gid']); ?>
    <a href="<?php echo Url::log($value['gid']); ?>" class="_ajx ease sb-border">
	<img width="160" height="120" src="<?php echo $li[0]; ?>" class="attachment-post-thumbnail wp-post-image" alt="<?php echo $value['title']; ?>" />
	<span class="publish"><?php echo $li[1]; ?></span>
	<span><?php echo $value['title']; ?></span>
	</a>

	<?php endforeach; ?>
<?php }?>
<?php
//widget：随机文章
function widget_random_log2($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>

	<?php foreach($randLogs as $value):$li = idby_img($value['gid']); ?>
	    <a href="<?php echo Url::log($value['gid']); ?>" class="_ajx ease sb-border">
	<img width="160" height="120" src="<?php echo $li[0]; ?>" class="attachment-post-thumbnail wp-post-image" alt="<?php echo $value['title']; ?>" />
	<span class="publish"><?php echo $li[1]; ?></span>
	<span><?php echo $value['title']; ?></span>
	</a>
	<?php endforeach; ?>

<?php }?>
<?php //文章缩略图获取 返回地址
function is_img($str){
  preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $str, $match);
  if(!empty($match[1])){
    return $match[1][0];
  }else{
    return TEMPLATE_URL . 'images/random/'.rand(1,12).'.jpg';
  }
}
?>
<?php
//通过id在文章中获取图片
function idby_img($logid){
$db = MySql::getInstance();
$sql = 	"SELECT content,date,views,comnum FROM ".DB_PREFIX."blog WHERE gid=".$logid."";
$list = $db->query($sql);
while($row = $db->fetch_array($list)){ 
	$li=array(is_img($row['content']),date('20y年m月d日',$row['date']),$row['views'],$row['comnum']);
	return $li;
 }} ?>
<?php 
if (!isset($_SERVER['REQUEST_TIME_FLOAT'])) {
	$_SERVER['REQUEST_TIME_FLOAT'] = microtime(TRUE);
}
function runtime_display() {
	echo sprintf('%.2fms', (microtime(TRUE) - $_SERVER["REQUEST_TIME_FLOAT"]) * 1000);
}
?>
<?php
//统计文章总数
function count_log_all(){
$db = MySql::getInstance();
$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog WHERE type = 'blog'");
return $data['total'];
}
//统计评论总数
function count_com_all(){
$db = MySql::getInstance();
$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "comment");
return $data['total'];
}
//统计分类总数
function count_sort_all(){
$db = MySql::getInstance();
$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sort");
return $data['total'];
}
//最后发表文章时间 
function last_post_log(){
$db = MySql::getInstance();
$sql = "SELECT * FROM " . DB_PREFIX . "blog WHERE type='blog' ORDER BY date DESC LIMIT 0,1";
$res = $db->query($sql);
$row = $db->fetch_array($res);
$date = date('Y-n-j',$row['date']);
return $date;       
}
//统计管理员总数
function count_user_admin(){
$db = MySql::getInstance();
$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user WHERE role = 'admin'");
return $data['total'];
};?>

<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
function rcolor() {   
    $rand = rand(0,255);//随机获取0--255的数字
     return sprintf("%02X","$rand");//输出十六进制的两个大写字母   
}   
function rand_color(){   
    return '#'.rcolor().rcolor().rcolor();//六个字母   
}
?>
<?php
//widget：blogger
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
	<div class="slide-box new-comment">
    <h2 class="sb-comment-title"><?php echo $title; ?></h2>
<a class="author _ajx ease sb-border" target="_blank">
	<?php if (!empty($user_cache[1]['photo']['src'])): ?>
	<img alt="" src="<?php echo BLOG_URL.$user_cache[1]['photo']['src']; ?>" class="avatar avatar-30 photo" height="30" width="30">
	<?php endif;?>
	<p><?php echo $user_cache[1]['des']; ?></p>
</a>
	</div>
<?php }?>

<?php
//widget：日历
function widget_calendar($title){ ?>
	<div class="slide-box new-comment">
    <h2 class="sb-comment-title"><?php echo $title; ?></h2>
<a class="author _ajx ease sb-border" target="_blank">
<script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script>

</a>
	</div>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<div class="slide-box">
	<h2><?php echo $title; ?></h2>
	<div class="sb-tags-wrap sb-border" id="sb-tags">
		<?php 
		$tag_cache = array_slice($tag_cache,0,43);
		foreach($tag_cache as $value): ?>
		<a href="<?php echo Url::tag($value['tagurl']); ?>" class="tag-link" title="<?php echo $value['usenum']; ?> 篇文章" ><?php echo $value['tagname']; ?></a>
		<?php endforeach; ?>
    </div>
    </div>
<?php }?>
<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
	<div class="slide-box sb-category">
	<h2><?php echo $title; ?></h2>
	<?php
	foreach($sort_cache as $value):
		if ($value['pid'] != 0) continue;
	?>
	<a title="<?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)" href="<?php echo Url::sort($value['sid']); ?>" class="_ajx ease sb-border"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
	<?php endforeach; ?>
	<?php if (!empty($value['children'])): ?>
		<?php
		$children = $value['children'];
		foreach ($children as $key):
			$value = $sort_cache[$key];
		?>
	<a title="<?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)" href="<?php echo Url::sort($value['sid']); ?>" class="_ajx ease sb-border"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a><?php endforeach; ?>
	<?php endif; ?>
	<div class="clr"></div>
	</div>
<?php }?>
<?php
//widget：最新微语
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
	<div class="slide-box new-comment">
<h2 class="sb-comment-title"><?php echo $title; ?></h2>
			<?php foreach($newtws_cache as $value): ?>
             <a class="author _ajx ease sb-border" target="_blank"><i class="fa fa-chevron-right"></i>&nbsp;<?php echo $value['t']; ?></a>
			<?php endforeach; ?>
</div>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
	?>
	<div class="slide-box new-comment">

<h2 class="sb-comment-title"><?php echo $title; ?></h2>
		<div class="newcomment">
<!-- 多说最新评论 start -->
	<div class="ds-recent-comments" data-num-items="5" data-show-avatars="0" data-show-time="1" data-show-title="1" data-show-admin="1" data-excerpt-length="70"></div>
<!-- 多说最新评论 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
<script type="text/javascript">
var duoshuoQuery = {short_name:"beardecode"};
	(function() {
		var ds = document.createElement('script');
		ds.type = 'text/javascript';ds.async = true;
		ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
		ds.charset = 'UTF-8';
		(document.getElementsByTagName('head')[0] 
		 || document.getElementsByTagName('body')[0]).appendChild(ds);
	})();
	</script>
<!-- 多说公共JS代码 end -->
</div>

</div>
<?php }?>
<?php
//widget：最新文章
function widget_newlog($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<div class="slide-box new-comment">
<h2 class="sb-comment-title"><?php echo $title; ?></h2>
		<?php foreach($newLogs_cache as $value): ?>
			<a class="author _ajx ease sb-border" href="<?php echo Url::log($value['gid']); ?>" target="_blank">&nbsp;<?php echo $value['title']; ?></a>
		<?php endforeach; ?>
	</div>
<?php }?>
<?php
//widget：热门文章
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<div class="slide-box new-comment">
<h2 class="sb-comment-title"><?php echo $title; ?></h2>
		<?php foreach($randLogs as $value): ?>
			<a class="author _ajx ease sb-border" href="<?php echo Url::log($value['gid']); ?>" target="_blank">&nbsp;<?php echo $value['title']; ?></a>
		<?php endforeach; ?>
	</div>
<?php }?>
<?php
//widget：随机文章
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<div class="slide-box new-comment">
<h2 class="sb-comment-title"><?php echo $title; ?></h2>
		<?php foreach($randLogs as $value): ?>
			<a class="author _ajx ease sb-border" href="<?php echo Url::log($value['gid']); ?>" target="_blank">&nbsp;<?php echo $value['title']; ?></a>
		<?php endforeach; ?>
	</div>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
		<div id="scroll_box">
		<div class="slide-box-scroll">
		<div class="slide-box">
		<h2><?php echo $title; ?></h2>
		<div class="sb-custom sb-search">
		<form action="<?php echo BLOG_URL; ?>index.php?keyword=" id="sch_form">
	    <input type="text"  name="keyword" id="sch_val" class="key" required="">
	    <input type="submit" value="" id="sch_btn" class="sub" title="搜索">
        </form>
		</div>
		</div>
		</div>
	    </div>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	?>
    <div class="slide-box sb-archives">
	<h2><?php echo $title; ?></h2>
		<?php foreach($record_cache as $value): ?>
		<a href="<?php echo Url::record($value['date']); ?>" class="as-year sb-border"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a>
		<?php endforeach; ?>
	</div>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
	<div class="widget widget_text">
        <div class="slide-box-scroll"><div class="slide-box"><h2><?php echo $title; ?></h2>
        <div class="textwidget"><?php echo $content; ?></div>
			 </div>		</div>
	</div>
<?php } ?>
<?php
//widget：自建链接模板
function zjwidget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
	    <?php foreach($link_cache as $value): ?>
		<li><a href="<?php echo $value['url']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
		<?php endforeach; ?>
<?php }?>
<?php
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
	<div class="slide-box sb-archives">
	<h2><?php echo $title; ?></h2>
	    <?php foreach($link_cache as $value): ?>
		<a href="<?php echo $value['url']; ?>" class="as-year sb-border" target="_blank"><?php echo $value['link']; ?></a>
		<?php endforeach; ?>
	</div>
<?php }?> 
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li id="menu-item-104"><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li id="menu-item-104"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-103' : '';
		?>
        <li id="menu-item" class="<?php echo $current_tab;?>">
        <a href="<?php echo $value['url']; ?>"><?php echo $value['naviname']; ?></a>
			<?php if (!empty($value['children'])) :?>
            <ul class="sub-menu">
                <?php foreach ($value['children'] as $row){
                        echo '<li id="menu-item" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item"><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>
            <?php if (!empty($value['childnavi'])) :?>
            <ul class="sub-menu">
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                        echo '<li id="menu-item" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item"><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>
		</li>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：导航
function xblog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-103' : '';
		?>
        <li><a href="<?php echo $value['url']; ?>"><?php echo $value['naviname']; ?></a></li>
			<?php if (!empty($value['children'])) :?>

                <?php foreach ($value['children'] as $row){
                        echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
                }?>
            <?php endif;?>
            <?php if (!empty($value['childnavi'])) :?>
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                        echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                }?>
            <?php endif;?>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<img src=\"".TEMPLATE_URL."/images/top.png\" title=\"首页置顶文章\" /> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<img src=\"".TEMPLATE_URL."/images/sortop.png\" title=\"分类置顶文章\" /> " : '';
    }
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" class="category ease _ajx" ><?php echo $log_cache_sort[$blogid]['name']; ?><i class="ease"></i></a>
	<?php endif;?>
<?php }?>
<?php
//blog：分类
function blog_sort2($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?><i class="ease"></i></a>
	<?php endif;?>
<?php }?>
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "<i class=\"icon-tag\"></i><a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}
}
?>
<?php
//blog：文章标签
function blog_tags($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '标签：';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}
}
?>
<?php
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<span><i class="icon-user"></i><a href="'.Url::author($uid)."\" $title>$author</a></span>";
}
?>
<?php
//blog：文章作者
function blog_authorout($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	echo '<li class="archive"><a target="_blank" href="'.Url::author($uid)."\" title=\"阅读 $author 的其他文章\">阅读 $author 的其他文章</a></li>";
}
?>
<?php
//blog：文章作者
function blog_authorurl($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	echo ''.Url::author($uid).'';
}
?>
<?php
//blog：文章作者
function blog_authors($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	echo $author;
}
?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
<a title="<?php echo $prevLog['title'];?>" href="<?php echo Url::log($prevLog['gid']) ?>" class="prev ease"><span>上一篇 </span><?php echo $prevLog['title'];?></a>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>
	<?php endif;?>
	<?php if($nextLog):?>
<a title="<?php echo $nextLog['title'];?>" href="<?php echo Url::log($nextLog['gid']) ?>" class="next ease"><?php echo $nextLog['title'];?><span> 下一篇</span></a>					
	<?php endif;?>
<?php }?>
<?php 
//blog:多说获取Gravatar头像
function mygetGravatar($email, $s = 80, $d = 'mm', $g = 'g') {
	$hash = md5($email);
	$avatar = "http://gravatar.duoshuo.com/avatar/$hash?s=$s&d=$d&r=$g";
	return $avatar;
}
?>
<?php
function echo_levels($comment_author_email,$comment_author_url){
  $DB = MySql::getInstance();
global $CACHE;
	$user_cache = $CACHE->readCache('user'); 
	$adminEmail = '"'.$user_cache[1]['mail'].'"';
  if($comment_author_email==$adminEmail)
  {
    echo '<span style="color:#E53333;"><strong>我不是管理员</strong></span>';
  }
  $sql = "SELECT cid as author_count,mail FROM ".DB_PREFIX."comment WHERE mail != '' and mail in ($comment_author_email) and hide ='n'";
  $res = $DB->query($sql);
  $author_count = mysql_num_rows($res);
   if($author_count>=2 && $author_count<10 && $comment_author_email!=$adminEmail)
    echo '<span style="color:#000000;"><strong>我只是路过的</strong></span>';
  else if($author_count>=10 && $author_count<20 && $comment_author_email!=$adminEmail)
    echo '<span style="color:#4C33E5;"><strong>偶尔会来光临</strong></span>';
  else if($author_count>=20 && $author_count<40 && $comment_author_email!=$adminEmail)
    echo '<span style="color:#003399;"><strong>我是常驻人口</strong></span>';
  else if($author_count>=40 && $author_count<80 && $comment_author_email!=$adminEmail)
    echo '<span style="color:#337FE5;"><strong>以本博客为家</strong></span>';
  else if($author_count>=80 &&$author_count<160 && $comment_author_email!=$adminEmail)
    echo '<span style="color:#009900;"><strong>情牵本博客了</strong></span>';
  else if($author_count>=160 && $author_coun<320 && $comment_author_email!=$adminEmail)
    echo '<span style="color:#FF9900;"><strong>陪伴本博终老</strong></span>';
  else if($author_count>=50 && $author_coun<60 && $comment_author_email!=$adminEmail)
    echo '<span style="color:#E53333;"><strong>博人合一超神</strong></span>';
}
?>
<?php
//blog：评论列表
function blog_comments($comments){extract($comments);if($commentStacks):?>
	<div class="cmttitle" Style="margin:30px auto">
		<h3><i class="fa fa-comments"></i>&nbsp;评论列表</h3>
	</div>
	<?php endif;?>
  <div class="comm_charu"></div>
  <div class="comment-list"  Style="margin:30px auto">
	<?php	$isGravatar = Option::get('isgravatar');$comnum = count($comments);foreach($comments as $value){if($value['pid'] != 0){$comnum--;}}$page = isset($params[5])?intval($params[5]):1;$i= $comnum - ($page - 1)*Option::get('comment_pnum');foreach($commentStacks as $cid):$comment = $comments[$cid];$comm_name = $comment['url'] ? '<a title="点击访问：'.$comment['url'].'" href="'.$comment['url'].'" target="_blank" rel="external nofollow">'.$comment['poster'].'</a>' : $comment['poster'];$comment['content'] = preg_replace("/\[S(([1-4]?[0-9])|50)\]/",'<img src="'.TEMPLATE_URL.'images/face/$1.gif" alt="蓝叶博客" />',$comment['content']);$comment['content'] = preg_replace("/\{smile:(([1-4]?[0-9])|50)\}/",'<img src="'.TEMPLATE_URL.'images/face/$1.gif" alt="蓝叶博客" />',$comment['content']);$comment['content'] = preg_replace("/\[img=?\]*(.*?)(\[\/img)?\]/e", '"<a href=\"$1\" target=\"_blank\" rel=\"nofollow\" title=\"新窗口查看图片\"><img style=\"width:20px;height:20px;margin:0 5px\" src=\"'.TEMPLATE_URL.'imagess/img.gif\" alt=\"" . basename("$1") . "\" /></a>"', $comment['content']);$comment['content'] = preg_replace("/\[code=?\]*(.*?)(\[\/code)?\]/e", '"<pre>$1</pre>"', $comment['content']);$comment['content'] = preg_replace("/\[link=?\]*(.*?)(\[\/link)?\]/e", '"<a href=\"$1\" target=\"_blank\" rel=\"external nofollow\">$1</a>"', $comment['content']);?>
	<div class="comment" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo mygetGravatar($comment['mail']); ?>" width="48" height="48" alt="<?php echo $comment['poster'];?>" title="<?php echo $comment['poster'];?>" /></div><?php endif; ?>
		<div class="comment-info"><span class="poster"><i class="fa fa-user mar-r-4 green"></i><?php $mail_str="\"".strip_tags($comment['mail'])."\"";echo_levels($mail_str,"\"".$comment['url']."\"");?> <?php echo $comm_name;?></span><span class="comment-time"><i class="fa fa-clock-o mar-r-4"></i><?php echo $comment['date']; ?></span><span class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)"><i class="fa fa-share mar-r-4"></i>回复</a></span><div class="louceng">#<?php echo $i;?></div>
			<div class="comment-content"><?php echo $comment['content']; ?></div>			
		</div>
		<?php blog_comments_children($comments, $comment['children']); ?>
	</div>
	<?php $i--;endforeach;?></div><div class="clear"></div>
	<div id="pagenavi" style="border-top:1px solid rgba(0,0,0,0.13);border-bottom:1px solid rgba(0,0,0,0.13);">
	<div id="page-navigation" class="page-navigation">
	<?php echo $commentPageUrl;?>
	</div>
    </div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){$isGravatar = Option::get('isgravatar');foreach($children as $child):$comment = $comments[$child];$comm_name = $comment['url'] ? '<a title="点击访问：'.$comment['url'].'" href="'.$comment['url'].'" target="_blank" rel="external nofollow">'.$comment['poster'].'</a>' : $comment['poster'];$comment['content'] = preg_replace("/\{smile:(([1-4]?[0-9])|50)\}/",'<img src="'.TEMPLATE_URL.'images/face/$1.gif" alt="蓝叶博客" />',$comment['content']);$comment['content'] = preg_replace("/\[S(([1-4]?[0-9])|50)\]/",'<img src="'.TEMPLATE_URL.'images/face/$1.gif" alt="蓝叶博客" />',$comment['content']);$comment['content'] = preg_replace("/\[img=?\]*(.*?)(\[\/img)?\]/e", '"<a href=\"$1\" target=\"_blank\" rel=\"nofollow\" title=\"新窗口查看图片\"><img style=\"width:20px;height:20px;margin:0 5px\" src=\"'.TEMPLATE_URL.'imagess/img.gif\" alt=\"" . basename("$1") . "\" /></a>"', $comment['content']);$comment['content'] = preg_replace("/\[code=?\]*(.*?)(\[\/code)?\]/e", '"<pre>$1</pre>"', $comment['content']);$comment['content'] = preg_replace("/\[link=?\]*(.*?)(\[\/link)?\]/e", '"<a href=\"$1\" target=\"_blank\" rel=\"external nofollow\">$1</a>"', $comment['content']);?>
	<div class="comment-children" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo mygetGravatar($comment['mail']); ?>" width="36" height="36" alt="<?php echo $comment['poster'];?>" title="<?php echo $comment['poster'];?>" /></div><?php endif;?>
		<div class="comment-info"><span class="poster"><i class="fa fa-user mar-r-4 green"></i><?php $mail_str="\"".strip_tags($comment['mail'])."\"";echo_levels($mail_str,"\"".$comment['url']."\"");?> <?php echo $comm_name;?></span><span class="comment-time"><i class="fa fa-clock-o mar-r-4"></i><?php echo $comment['date']; ?></span><?php if($comment['level'] < 4):?><span class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)"><i class="fa fa-share mar-r-4"></i>回复</a></span><?php endif;?>
			<div class="comment-content"><?php echo $comment['content']; ?></div>			
		</div>
		<?php blog_comments_children($comments, $comment['children']);?>
	</div>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'):?>
	<div id="comment-place" style="margin: 20px auto">
	<div class="comment-post" id="comment-post">
	<div class="cmttitle">
		<h3><i class="fa fa-comments"></i>&nbsp;发表评论</h3>
	</div>
<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">

		   <div class="cutline"><span>快啦吧唧吧唧</span></div><br />
    <?php if(ROLE == 'visitor'): ?>
    <div style="width:700px; margin:20px auto">
<label for="author"><i class="icon-user"></i>*名&nbsp;&nbsp;字：</label><input type="text" name="comname" id="comname" maxlength="49" value="<?php echo $ckname; ?>" size="10" tabindex="1">
    <label for="email"><i class="icon-envelope-alt"></i>*邮&nbsp;&nbsp;箱：</label><input type="text" name="commail" id="commail" maxlength="128"  value="<?php echo $ckmail; ?>" size="20" tabindex="2">
   <label for="url"><i class="icon-desktop"></i>网&nbsp;&nbsp;址：</label><input type="text" name="comurl" id="comurl" maxlength="128"  value="<?php echo $ckurl; ?>" size="20" tabindex="3">
  

    </div>

    <?php else:?>
    <?php endif; ?>
<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
<div class="textarea"><textarea name="comment" id="comment" rows="10" tabindex="4" placeholder="既然来了说点什么吧"></textarea></div>
<div class="comm_toolbar">
  <div class="comm_tool">
  <div title="插入图片" onclick="tool_img()" class="tool_img">图</div>
  <div title="插入链接" onclick="tool_link()" class="tool_link">链</div>
  <div title="插入代码" onclick="tool_code()" class="tool_code">码</div>
  <div title="签到" onclick="tool_qiand()" class="tool_qiand">签</div>
  <div title="赞一个" onclick="tool_zyg()" class="tool_code">赞</div>
  <div title="踩一个" onclick="tool_syg()" class="tool_code">踩</div>
  <div id="cmt-loading" style="float:left;padding-left:15px;height:32px;font-size:14px;color:red;line-height:30px;"></div>
<div class="comm_tijiao"><input type="submit" id="comment_submit" value="发表评论" tabindex="6" /></div>
<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
</div>
</div>
<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
</form>
</div>
</div>
<?php endif; ?>
<?php }?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
?>

<?php
//图片链接
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
	if($imgsrc):
		return $imgsrc;
	endif;
}
?>
<?php
//格式化内容工具
function blog_tool_purecontent($content, $strlen = null){
        $content = str_replace('继续阅读&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString($content, 0, $strlen);
        }
        return $content;
}
?>
<?php
//widget：随机文章
function shouqi_logs(){
	$index_randlognum = 1;
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<?php foreach($randLogs as $value): ?>
	<li id="menu-item" class="">
	<a href="<?php echo Url::log($value['gid']); ?>">试试手气</a>
	</li>
	<?php endforeach; ?>
<?php }?>
<?php
//首页置顶日志一
function Home_Top_Logs() {
	$a="";
	$b=1;
    $db = MySql::getInstance();
    $sql = 	"SELECT gid,title,content,date FROM ".DB_PREFIX."blog WHERE type='blog' and top='y' ORDER BY `top` DESC ,`date` DESC LIMIT 0,1";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){ ?>
	<li class="<?php if($a-1+$b++=='0'){echo " first-pic";}?>">
<a href="<?php echo Url::log($row['gid']);?>" class="post-thumbnail" title="<?php echo $row['title'];?>" rel="<?php if($a-1+$b++=='0'){echo " bookmark";}?>">
<img class="lazy" src="<?php get_thum($row['gid']);?>" alt="" style="width:100%;height:260px;"/></a>
<h3>
<a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" rel="<?php if($a-1+$b++=='0'){echo " bookmark";}?>"><?php echo $row['title'];?></a>
</h3>
</li>
   <?php } ?>
<?php } ?>
<?php
//首页置顶日志二
function Home_Top_Logsz() {
	$a="";
	$b=1;
    $db = MySql::getInstance();
    $sql = 	"SELECT gid,title,content,date FROM ".DB_PREFIX."blog WHERE type='blog' and top='y' ORDER BY `top` DESC ,`date` DESC LIMIT 0,4";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){ ?>
<li><a href="<?php echo Url::log($row['gid']);?>" class="post-thumbnail" title="<?php echo $row['title'];?>">
<img class="lazy" src="<?php get_thum($row['gid']);?>" style="width:100%;height:118px;"/></a></li>
    <?php } ?>
<?php } ?>
<?php
//首页图/标题
function getdatelogs($log_num){
	$db = MySql::getInstance();
	$sql = "SELECT `A`.`blogid` as `g`, `A`.`filepath`, `B`.`title` as `t`, `B`.`date` as `d`, `B`.`content` as `c` FROM ".DB_PREFIX."attachment `A` LEFT JOIN ".DB_PREFIX."blog `B` ON `A`.`blogid`=`B`.`gid` WHERE `B`.`hide`='n' AND (`A`.`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') GROUP BY `A`.`blogid` ORDER BY `A`.`addtime` DESC LIMIT 0,5";
	$imgs = $db->query($sql);
	while($row = $db->fetch_array($imgs)){
	$slide .= '
	<li><a href="'.Url::log($row['g']).'" target="_blank"><img src="'.BLOG_URL.substr($row['filepath'],3,strlen($row['filepath'])).'" alt="'.$row['t'].'" style="width:100%;height:330px" /></a><div class="bx-caption"><span>'.$row['t'].'</span></div></li>
	
	'; }
	echo $slide;		
	}
?>
<?php
//30天按点击率排行文章
function getdatelogs2($log_num){
    $db = MySql::getInstance();
    $time = time();
    $sql = "SELECT gid,title FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - 30*24*60*60 ORDER BY `views` DESC LIMIT 0,$log_num";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){ ?>
	<li>
	<a href="<?php echo Url::log($row['gid']); ?>"><img style="width:100%;height:330px;" title="<?php echo $row['title']; ?>"alt="" src="<?php get_thum($row['gid']);?>" width="631" height="260" /></a>
	</li>
    <?php } ?>
<?php } ?>
<?php
//blog-tool:获取Gravatar头像
function myGravatar($email, $s = 40, $d = 'mm', $g = 'g') {
$hash = md5($email);
$avatar = "http://cn.gravatar.com/avatar/$hash?s=$s&d=$d&r=$g";
return $avatar;
}?>
<?php //判断内容页是否百度收录
function baidu($url){
$url='http://www.baidu.com/s?wd='.$url;
$curl=curl_init();curl_setopt($curl,CURLOPT_URL,$url);curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);$rs=curl_exec($curl);curl_close($curl);if(!strpos($rs,'没有找到')){return 1;}else{return 0;}}
function logurl($id){$url=Url::log($id);
if(baidu($url)==1){echo "百度已收录";
}else{echo "<a style=\"color:red;\" rel=\"external nofollow\" title=\"点击提交收录！\" target=\"_blank\" href=\"http://zhanzhang.baidu.com/sitesubmit/index?sitename=$url\">百度未收录</a>";}}
?>
<?php
//判断分类输出子分类ID号
function lanye_getsortids($sortid){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); 
 $sort = $sort_cache[$sortid];
 if ($sort['pid'] != 0 || empty($sort['children'])) {
			$fenlei_ids = $sortid;
		} else {
			$sortids = array_merge(array($sortid), $sort['children']);
			$fenlei_ids = implode(',', $sortids);
		}
  return $fenlei_ids;
}?>
<?php
//获取文章缩略图
function get_thum($logid){
 $db = MySql::getInstance();
$thum_pic = EMLOG_ROOT.'/thumpic/'.$logid.'.jpg';
if (is_file($thum_pic)) {
    $thum_url = BLOG_URL.'thumpic/'.$logid.'.jpg'; 
}else{
	$sqlimg = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$logid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
	$img = $db->query($sqlimg);
    while($roww = $db->fetch_array($img)){
	 $thum_url=BLOG_URL.substr($roww['filepath'],3,strlen($roww['filepath']));
    }
    if (empty($thum_url)) {
	
srand((double)microtime()*1000000); 
$randval   =rand(1,7); 

            $thum_url = TEMPLATE_URL.'images/random/'.$randval.'.jpg';
        }
    }
echo $thum_url;
}
?>
<?php
//获取文章缩略图
function get_thums($logid){
 $db = MySql::getInstance();
$thum_pic = EMLOG_ROOT.'/thumpic/'.$logid.'.jpg';
if (is_file($thum_pic)) {
    $thum_url = BLOG_URL.'thumpic/'.$logid.'.jpg'; 
}else{
	$sqlimg = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$logid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
	$img = $db->query($sqlimg);
    while($roww = $db->fetch_array($img)){
	 $thum_url=BLOG_URL.substr($roww['filepath'],3,strlen($roww['filepath']));
    }
    if (empty($thum_url)) {
	
srand((double)microtime()*1000000); 
$randval   =rand(1,5); 

            $thum_url = TEMPLATE_URL.'images/random/tb'.$randval.'.jpg';
        }
    }
echo $thum_url;
}
?>
<?php function convertip($ip) { $dat_path = EMLOG_ROOT.'/content/templates/dux/ip.dat'; //*数据库路径*//
if(!$fd = @fopen($dat_path, 'rb')){ return 'IP数据库文件不存在或者禁止访问或者已经被删除！';   
    } $ip = explode('.', $ip); $ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3]; $DataBegin = fread($fd, 4); $DataEnd = fread($fd, 4); $ipbegin = implode('', unpack('L', $DataBegin)); if($ipbegin < 0) $ipbegin += pow(2, 32); $ipend = implode('', unpack('L', $DataEnd)); if($ipend < 0) $ipend += pow(2, 32); $ipAllNum = ($ipend - $ipbegin) / 7 + 1; $BeginNum = 0; $EndNum = $ipAllNum; while($ip1num>$ipNum || $ip2num<$ipNum) { $Middle= intval(($EndNum + $BeginNum) / 2); fseek($fd, $ipbegin + 7 * $Middle); $ipData1 = fread($fd, 4); if(strlen($ipData1) < 4) { fclose($fd); return '系统出错！';   
        } $ip1num = implode('', unpack('L', $ipData1)); if($ip1num < 0) $ip1num += pow(2, 32); if($ip1num > $ipNum) { $EndNum = $Middle; continue;   
        } $DataSeek = fread($fd, 3); if(strlen($DataSeek) < 3) { fclose($fd); return '系统出错！';   
        } $DataSeek = implode('', unpack('L', $DataSeek.chr(0))); fseek($fd, $DataSeek); $ipData2 = fread($fd, 4); if(strlen($ipData2) < 4) { fclose($fd); return '系统出错！';   
        } $ip2num = implode('', unpack('L', $ipData2)); if($ip2num < 0) $ip2num += pow(2, 32); if($ip2num < $ipNum) { if($Middle == $BeginNum) { fclose($fd); return '未知';   
            } $BeginNum = $Middle;   
        }   
    } $ipFlag = fread($fd, 1); if($ipFlag == chr(1)) { $ipSeek = fread($fd, 3); if(strlen($ipSeek) < 3) { fclose($fd); return '系统出错！';   
        } $ipSeek = implode('', unpack('L', $ipSeek.chr(0))); fseek($fd, $ipSeek); $ipFlag = fread($fd, 1);   
    } if($ipFlag == chr(2)) { $AddrSeek = fread($fd, 3); if(strlen($AddrSeek) < 3) { fclose($fd); return '系统出错！';   
        } $ipFlag = fread($fd, 1); if($ipFlag == chr(2)) { $AddrSeek2 = fread($fd, 3); if(strlen($AddrSeek2) < 3) { fclose($fd); return '系统出错！';   
            } $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0))); fseek($fd, $AddrSeek2);   
        } else { fseek($fd, -1, SEEK_CUR);   
        } while(($char = fread($fd, 1)) != chr(0)) $ipAddr2 .= $char; $AddrSeek = implode('', unpack('L', $AddrSeek.chr(0))); fseek($fd, $AddrSeek); while(($char = fread($fd, 1)) != chr(0)) $ipAddr1 .= $char;   
    } else { fseek($fd, -1, SEEK_CUR); while(($char = fread($fd, 1)) != chr(0)) $ipAddr1 .= $char; $ipFlag = fread($fd, 1); if($ipFlag == chr(2)) { $AddrSeek2 = fread($fd, 3); if(strlen($AddrSeek2) < 3) { fclose($fd); return '系统出错！';   
            } $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0))); fseek($fd, $AddrSeek2);   
        } else { fseek($fd, -1, SEEK_CUR);   
        } while(($char = fread($fd, 1)) != chr(0)){ $ipAddr2 .= $char;   
        }   
    } fclose($fd); if(preg_match('/http/i', $ipAddr2)) { $ipAddr2 = '';   
    } $ipaddr = "$ipAddr1 $ipAddr2"; $ipaddr = preg_replace('/CZ88.Net/is', '', $ipaddr); $ipaddr = preg_replace('/^s*/is', '', $ipaddr); $ipaddr = preg_replace('/s*$/is', '', $ipaddr); if(preg_match('/http/i', $ipaddr) || $ipaddr == '') { $ipaddr = '未知';   
    } $ipaddr = iconv('gbk', 'utf-8//IGNORE', $ipaddr); if( $ipaddr != '  ' ) return $ipaddr; else $ipaddr = '评论者来自火星，无法或者其所在地!'; return $ipaddr;   
} ?>
<?php
//文章页路径获取分类
function sortbread($sortid){
	global $CACHE; 
	$sort_cache = $CACHE->readCache('sort');
	?>
	<?php if (isset($sort_cache[$sortid])): ?>
	<?php if (isset($sort_cache[$sort_cache[$sortid]['pid']])): ?>
	<i class="icon-angle-right"></i><a href="<?php echo Url::sort($sort_cache[$sortid]['pid']); ?>"><?php echo $sort_cache[$sort_cache[$sortid]['pid']]['sortname']; ?></a>
	<?php endif; ?>
	<i class="icon-angle-right"></i><a href="<?php echo Url::sort($sortid); ?>"><?php echo $sort_cache[$sortid]['sortname'];?></a>
	<?php endif;?>
<?php }?>

<?php
//home：近期访问
function home_datelog(){
    $db = MySql::getInstance();
    $time = time();
    $sql = "SELECT gid,date,title FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - 30*24*60*60 ORDER BY `views` DESC LIMIT 0,9";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){ ?>
<li><span><?php echo gmdate('n-j', $row['date']); ?></span><a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title']; ?>" rel="bookmark"><i class="icon-angle-right"></i><?php echo $row['title']; ?></a></li>
    <?php } ?>
<?php } ?>
<?php
//side：近期访问
function side_datelog(){
    $db = MySql::getInstance();
    $time = time();
    $sql = "SELECT gid,title FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - 30*24*60*60 ORDER BY `views` DESC LIMIT 0,9";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){ ?>
<li><a href='<?php echo Url::log($row['gid']); ?>'><?php echo $row['title']; ?></a></li>
    <?php } ?>
<?php } ?>
<?php
//home：最新文章
function home_newlog(){
    $db = MySql::getInstance();
    $time = time();
    $sql = "SELECT gid,title,date FROM " . DB_PREFIX . "blog WHERE hide='n' and checked='y' and type='blog' LIMIT 0, 8";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){ ?>
<li><span><?php echo gmdate('n-j', $row['date']); ?></span><a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title']; ?>" rel="bookmark"><i class="icon-angle-right"></i><?php echo $row['title']; ?></a></li>
    <?php } ?>
<?php }?>
<?php
//home：热门文章
function home_hotlog(){
    $db = MySql::getInstance();
    $time = time();
    $sql = "SELECT gid,title,views FROM " . DB_PREFIX . "blog WHERE hide='n' and checked='y' and type='blog' ORDER BY views DESC, comnum DESC LIMIT 0, 8";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){ ?>
<li class="most-view"><span><?php echo $row['views']; ?> ℃</span><a href="<?php echo Url::log($row['gid']); ?>"><i class="icon-angle-right"></i><?php echo $row['title']; ?></a></li>
    <?php } ?>
<?php }?>
<?php
//home：随机文章
function home_random_log(){
    $db = MySql::getInstance();
    $time = time();
    $sql = "SELECT gid,title,date FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - 30*24*60*60 ORDER BY `comnum` DESC LIMIT 0,8";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){ ?>
<li><span><?php echo gmdate('n-j', $row['date']); ?></span><a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title']; ?>" rel="bookmark"><i class="icon-angle-right"></i><?php echo $row['title']; ?></a></li>
    <?php } ?>
<?php } ?>

<?php //分页函数
function sheli_fy($count,$perlogs,$page,$url,$anchor=''){
$pnums = @ceil($count / $perlogs);
$page = @min($pnums,$page);
$prepg=$page-1;                 //shuyong.net上一页
$nextpg=($page==$pnums ? 0 : $page+1); //shuyong.net下一页
$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
//开始分页导航内容
$re = "";
if($pnums<=1) return false;	//如果只有一页则跳出	
if($page!=1) $re .=" <a href=\"$urlHome$anchor\" class='c-nav ease' >首页</a> "; 
if($prepg) $re .=" <a href=\"$url$prepg$anchor\" class='c-nav ease' >前页</a> ";
for ($i = $page-2;$i <= $page+2 && $i <= $pnums; $i++){
if ($i > 0){if ($i == $page){$re .= "<a class='on'>$i</a> ";
}elseif($i == 1){$re .= " <a href=\"$urlHome$anchor\"class='ease'>$i</a> ";
}else{$re .= " <a href=\"$url$i$anchor\"class='ease'>$i</a> ";}
}}
if($nextpg) $re .=" <a href=\"$url$nextpg$anchor\"class='c-nav ease'>后页</a> "; 
if($page!=$pnums) $re.=" <a href=\"$url$pnums$anchor\"class='c-nav ease' title=\"尾页\">尾页</a>";
return $re;}
?>
<?php
//blog：分类
function blog_sorts($i){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort');
	?>
	<div class="widget-title"><h2><i class="icon-list"></i>&nbsp;<?php echo $sort_cache[$i]['sortname']; ?></h2></div>
<?php }?>
<?php
function sortlogs($sortid){
	$db = MySql::getInstance();
	$sql = 'SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='".$sortid."' AND type='blog' AND hide='n' order by date DESC limit 0,1";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){
?>
<li class="first-pic"><a href="<?php echo Url::log($row['gid']);?>" class="post-thumbnail" title="链接到 <?php echo $row['title'];?>" rel="bookmark"><img class="lazy" src="<?php get_thum($row['gid']);?>" alt="" style="width:100%;height:260px;"/></a><h3><a href="<?php echo Url::log($row['gid']);?>" title="链接到 <?php echo $row['title'];?>" rel="bookmark"><?php echo $row['title'];?></a></h3></li>
<?php
	}
}
?>
<?php
function first_sortlogs($sortid){
	$db = MySql::getInstance();
	$sql = 'SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='".$sortid."' AND type='blog' AND hide='n' order by date DESC limit 0,1";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){
?>
<li class="first-posts"><a class="post-thumbnail" href="<?php echo Url::log($row['gid']);?>" title="链接到 <?php echo $row['title'];?>" rel="bookmark"><img class="lazy" src="<?php get_thums($row['gid']);?>" alt="" style="width:100%;height:120px;"/></a><h3><a href="<?php echo Url::log($row['gid']);?>" title="链接到 <?php echo $row['title'];?>" rel="bookmark"><?php echo $row['title'];?></a></h3><p class="summary"><?php echo blog_tool_purecontent($row['content'],80); ?></p></li>
<?php
	}
}
?>
<?php
function home_sortlogst($sortid){
	$db = MySql::getInstance();
	$sql = 'SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='".$sortid."' AND type='blog' AND hide='n' order by date DESC limit 1,4";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){
?>
<li><a href="<?php echo Url::log($row['gid']);?>" class="post-thumbnail" title="<?php echo $row['title'];?>"><img class="lazy" src="<?php get_thums($row['gid']);?>" style="width:100%;height:118px;"/></a></li>
<?php
	}
}
?>
<?php
function firsthomesortlogst($sortid){
	$db = MySql::getInstance();
	$sql = 'SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='".$sortid."' AND type='blog' AND hide='n' order by date DESC limit 1,6";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){
?>
<li class="other-news"><span><?php echo gmdate('n-j', $row['date']); ?></span><a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" rel="bookmark"><i class="icon-angle-right"></i><?php echo $row['title'];?></a></li>
<?php
	}
}
?>