<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="container">
<div id="left">
<div class="post-warp">
<!--日志循环输出开始-->
<?php 
if (!empty($logs)):
foreach($logs as $value): 
?>
<div class="home-post" stye="margin-top:40px">
<div class="post-header">
		<?php
	    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $img);
        $imgsrc = !empty($img[1]) ? $img[1][0] : TEMPLATE_URL.'images/random/'.rand(1,12).'.jpg';?>
	    <?php blog_sort($value['logid']); ?>
	<h3 class="post-title"><a href="<?php echo $value['log_url']; ?>" class="ease"><?php echo $value['log_title']; ?></a></h3>
</div>
<div class="post-thumb"><a href="<?php echo $value['log_url']; ?>"><img src="<?php echo $imgsrc; ?>" title="<?php echo $value['log_title']; ?>"></a></div>
	<div class="post-content">
		<div class="post-info">
			<span class="publish" title="发布时间"><?php echo gmdate('Y-n-j', $value['date']); ?></span>
			<span class="views" title="访问人数"><?php echo $value['views']; ?></span>
			<span class="comments" title="评论数"><?php echo $value['comnum']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php editflg($value['logid'],$value['author']); ?></span>
		</div>
<?php echo subString(strip_tags($value['log_description']),0,128,"..."); ?>

<a href="<?php echo $value['log_url']; ?>" class="read-more _ajx ease">继续阅读></a>

</div>
<div class="clr"></div>	
</div>
<?php 
endforeach;
else:
?>
<div class="home-post">
<div class="post-header">
<a class="category ease _ajx">未找到<i class="ease"></i></a><h3 class="post-title"><a class="ease">抱歉，没有符合您查询条件的结果。</a></h3>
</div></div>
<?php endif;?>
</div>
<div id="page-navigation" class="page-navigation">
<?php echo sheli_fy($lognum,$index_lognum,$page,$pageurl);?>
</div>		
</div>
<!-- end #contentleft-->
<?php
 include View::getView('side');
 include View::getView('footer');
?>