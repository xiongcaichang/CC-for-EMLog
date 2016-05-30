<?php 
/**
 *   自建链接模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
	<div id="container">
		<div id="left">
			<div class="wp-content">
				<div class="wpgo-links">
				<h3 class="sc_h"><span><?php topflg($top); ?><?php echo $log_title; ?></span></h3><ul><?php zjwidget_link();?></ul>
                <div class="clr"></div>
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