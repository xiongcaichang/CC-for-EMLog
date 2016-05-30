<?php 
/**
 * 侧边栏
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery-1.8.3.min.js"></script>
<div id="right">
<?php if (_g('bkgg_xz') == "x"): ?>	
<div class="slide-box sb-notice">
	<h2>博客公告</h2>
	<div class="sb-notice-wrap sb-border">
	<ul id="wpgo_notice">
	<li style="display:block;"><?php echo _g('bkgg_lr');?></li>			
	</ul>
	<div class="clr"></div>
	<div class="sb-notice-nav">
	<span class="on"></span>
	</div>
	</div>
</div>
<?php endif;?>
<?php if (_g('tgsbl_xz') == "x"): ?>	
<div class="slide-box sb-tab" id="sb_panel">
<ul class="tab-title">
<li class="on">随机文章</li>
<li>最新文章</li>
<li>博客统计</li>
<li>博客公告</li>
</ul>
<div class="clr"></div>
<div class="panel post-items current">
<?php widget_random_log2($title);?><!--随机文章-->
</div>
<div class="panel post-items">
<?php widget_newlog2($title);?><!--最新文章-->
</div>
<div class="panel post-items">
<div class="sb-notice-wrap sb-border">
<ul id="wpgo_notice">
<li style="display:block;">
<p>分类数量：<?php echo count_sort_all();?>个</p>
<p>日志数量：<?php echo count_log_all();?>篇</p>
<p>评论数量：<?php echo count_com_all();?>个</p>
<p>博主从<?php echo last_post_log();?>以后就没有更新文章了！</p>
</li></ul>
<div class="clr"></div>
<div class="sb-notice-nav">
<span class="on"></span></div>
</div>
</div>
<div class="panel post-items">
	<div class="sb-notice-wrap sb-border">
	<ul id="wpgo_notice">
	<li style="display:block;"><?php echo _g('bkgg_lr');?></li>			
	</ul>
	<div class="clr"></div>
	<div class="sb-notice-nav">
	<span class="on"></span>
	</div>
	</div>
</div>
</div>
<?php endif;?>
<?php 
$widgets = !empty($options_cache['widgets1']) ? unserialize($options_cache['widgets1']) : array();
doAction('diff_side');
foreach ($widgets as $val)
{
	$widget_title = @unserialize($options_cache['widget_title']);
	$custom_widget = @unserialize($options_cache['custom_widget']);
	if(strpos($val, 'custom_wg_') === 0)
	{
		$callback = 'widget_custom_text';
		if(function_exists($callback))
		{
			call_user_func($callback, htmlspecialchars($custom_widget[$val]['title']), $custom_widget[$val]['content']);
		}
	}else{
		$callback = 'widget_'.$val;
		if(function_exists($callback))
		{
			preg_match("/^.*\s\((.*)\)/", $widget_title[$val], $matchs);
			$wgTitle = isset($matchs[1]) ? $matchs[1] : $widget_title[$val];
			call_user_func($callback, htmlspecialchars($wgTitle));
		}
	}
}
?>
<?php if (Option::get('rss_output_num')):?>
</div>
<?php endif;?>

