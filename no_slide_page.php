<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
	<div id="container">

			 <div class="breadcrumb"><a href="<?php echo BLOG_URL; ?>"><i class="fa fa-home"></i>&nbsp;返回首页</a>&nbsp;&gt;&nbsp;<a href="#"><?php topflg($top); ?><?php echo $log_title; ?></a></div>
			<div class="wp-content">


								<div class="post-content">
						<?php echo $log_content; ?>
</div>
			</div>

<?php
 include View::getView('footer');
?>