<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="container">
<div id="left">
<div class="wp-content">
<div class="post-content">
<ul>
    <?php 
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    ?> 
		<li>
		<?php echo $author; ?>：<?php echo $val['t'].'<br/>'.$img;?>
	</li>
<?php endforeach;?>
</ul>
<div id="page-navigation" class="page-navigation">
<?php echo $page_url;?>
</div>		
</div></div></div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>