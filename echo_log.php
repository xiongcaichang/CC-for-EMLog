<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
	<div id="container">
		<div id="left">
			 <div class="breadcrumb"><a href="<?php echo BLOG_URL; ?>"><i class="fa fa-home"></i>&nbsp;返回首页</a>&nbsp;&gt;&nbsp;<?php sortbread($sortid); ?>&nbsp;&gt;&nbsp;<a href="#"><?php topflg($top); ?><?php echo $log_title; ?></a></div>
			<div class="wp-content">
				<div class="post-header">
    <h3 class="post-title"><?php topflg($top); ?><?php echo $log_title; ?></h3>
        <div class="post-info">
        <span class="publish" title="发布时间"><?php echo gmdate('Y-n-j', $date); ?></span>		
        <span class="tags" title="标签"><?php blog_tag($logid); ?></span>		
		<span class="category" title="分类"><?php blog_sort2($logid); ?></span>
        <span class="views" title="访问数量"><?php echo $views; ?>&nbsp;&nbsp;&nbsp;<?php editflg($logid,$author); ?></span>
					</div>
				</div>
<div class="post-content">
<?php echo $log_content; ?>
<?php doAction('log_related', $logData); ?>
</div>
					<div class="post-sns" id="post-sns">
					<a href="<?php echo BLOG_URL; ?>"><i class="fa fa-bullhorn"></i>&nbsp;版权声明：转载请出示来自<?php echo $blogname;?>的文章！</a>
					<div class="clr"></div>
				    </div>
			</div>
<div class="related-posts">
<h2 class="related-title">相关文章</h2>
<div class="posts">
<?php
$Log_Model = new Log_Model();
$randlogs = $Log_Model->getLogsForHome("AND sortid = {$sortid} ORDER BY rand() DESC,date DESC", 1,4);
foreach($randlogs as $value):
if(pic_thumb($value['content'])){
$imgsrc = pic_thumb($value['content']);
}else
$imgsrc = TEMPLATE_URL.'images/random/tb'.rand(1,12).'.jpg';
?>
<div class="r-post ">
	<a title="<?php echo $value['log_title']; ?><?php echo gmdate('Y/n/j', $value['date']); ?>" href="<?php echo $value['log_url']; ?>" rel="bookmark">
		<h3><?php echo $value['log_title']; ?><?php echo gmdate('Y/n/j', $value['date']); ?></h3>
		<div class="clr"></div>
	</a>
</div>
<?php endforeach; ?>
<div class="clr"></div>
</div>
<div class="related-pn-posts">
<?php neighbor_log($neighborLog);?>

<div class="clr"></div>
</div>
</div>

<?php echo duoshuo_comments($logData);?>


</div>



<?php
 include View::getView('side');
 include View::getView('footer');
?>