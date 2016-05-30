<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
	<div id="container">
		<div id="left">
			 <div class="breadcrumb"><span class="home-icon"><a href="<?php echo BLOG_URL; ?>"><i class="fa fa-home"></i>&nbsp;返回首页</a>&nbsp;&gt;&nbsp;<a href="#"><?php topflg($top); ?><?php echo $log_title; ?></a></span></div>
			<div class="wp-content">
				<div class="post-header">
    <h3 class="post-title"><?php topflg($top); ?><?php echo $log_title; ?></h3>

				</div>
								<div class="post-content">
<?php echo $log_content; ?>
</div>
			</div>
<div class="sc_act">
<input type="hidden" id="post_id" value="469">
<div id="contentleft">
<?php blog_comments($comments); ?>
<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>			
</div>
</div>
</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>