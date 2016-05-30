<?php

if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="" <?php echo $site_title; ?>/>
<meta name="description" content=" <?php echo $site_title; ?>-<?php echo $site_description; ?>-<?php echo $site_key; ?>" />

<?php doAction('index_head'); ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo TEMPLATE_URL; ?>style.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo TEMPLATE_URL; ?>css/jquery.fancybox-1.3.4.css">

<script src="<?php echo TEMPLATE_URL; ?>js/js.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/ajax_comment.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/pjax.js" type="text/javascript"></script>


<style type="text/css">
body { background-image: url('<?php echo TEMPLATE_URL; ?>images/fixedBg.jpeg');  background-repeat: no-repeat; background-size:100% 100%;  background-attachment: fixed; }
.header-image { height: 200px; max-width: 100%;  background: transparent; }
.header-image span { display: block; color: #ffffff; }
</style>


</head>
<body>

<div id="wrap">

<div id="header">
	<div class="header-image">
		<a title="<?php echo BLOG_URL; ?>"><span class="site-name"><?php echo $blogname; ?></span><span class="sub-title"><?php echo $site_key; ?></span></a>
	</div>
	
	<div id="header-nav" class="header-nav" style="z-index:999;">

		<ul id="menu-navigation" class="nav-menu">
            <?php blog_navi();?>
            <?php if (_g('sssq_xz') == "x"): ?>	
			<?php shouqi_logs();?>
            <?php endif;?>
            <li>



		<li Style="float:right;"> <a rel="nofollow" title="github" href="https://github.com/xiongcaichang" target="_blank"><i class="fa fa-github" aria-hidden="true" style="font-size:18px; line-height:40px"></i></a></li>

		<li Style="float:right;"> <a rel="nofollow" title="QQ：15223245 [点击临时会话]" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo _g('qq');?>&amp;site=qq&amp;menu=yes" target="_blank"><i class="fa fa-qq" aria-hidden="true"></i></a></li>
      

            </li>
            </ul>			
            <ul class="mobile-nav nav-menu">
            <li><a href="javascript:;" id="mobile_nav">菜单</a>
			<ul class="sub-menu" id="mobile_nav_list">
			<?php xblog_navi();?>
			</ul>
		    </li>
	       </ul>


        </div>
	</div>
<div class="sns-list"></div>
<div class="clr"></div>

