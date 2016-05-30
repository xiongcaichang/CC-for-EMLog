<?php
/*
Template Name:WPGo-SK
Sidebar Amount:1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html>
<!-- <?php echo $site_title; ?>欢迎您！-->
<!-- ------感觉自己萌萌哒------ -->
<!-- saved from url=(0018)<?php echo BLOG_URL; ?> -->
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" <?php echo $site_title; ?>/>
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="generator" content="cc" />
<script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
<link href="http://cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo TEMPLATE_URL; ?>style.css">

<link rel="stylesheet" type="text/css" media="all" href="<?php echo TEMPLATE_URL; ?>css/jquery.fancybox-1.3.4.css">
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>css/hover.css">
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>css/shCore.css">
<script src="<?php echo TEMPLATE_URL; ?>js/lighterCode.js" type="text/javascript"></script>


<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<script src="<?php echo TEMPLATE_URL; ?>js/js.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/ajax_comment.js" type="text/javascript"></script>


<style type="text/css">
/**/
body { background-image: url('<?php echo TEMPLATE_URL; ?>images/wpgo_background.jpg');  background-color: #f1f1f1; background-repeat: repeat; background-position: top left; background-attachment: scroll; }
.header-image { height: 170px; max-width: 100%;  background: url('<?php echo _g('header') ; ?>') no-repeat; background-size:100% 100%; }
.header-image span { display: block; color: #ffffff; }
</style>
<?php doAction('index_head'); ?>
<?php doAction('index_yw_yl');?>


</head>
<body>
<img src="<?php echo TEMPLATE_URL; ?>images/wpgo_background.jpg" style="width:100%; height:100% ; margin:0; padding:0; position:fixed; top:0; z-index:-999">

<div id="header">
	<div class="header-image">
		<a title="<?php echo BLOG_URL; ?>"><span class="site-name"><?php echo $blogname; ?></span><span class="sub-title"><?php echo $site_key; ?></span></a>
	</div>
	
	<div id="header-nav" class="header-nav" style="z-index:999;">
				<div id="wrap" style=" pading: 0 auto; margin:0 auto">
		<ul id="menu-navigation" class="nav-menu">
            <?php blog_navi();?>
            <?php if (_g('sssq_xz') == "x"): ?>	
			<?php shouqi_logs();?>
            <?php endif;?>
            <li>



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
	</div>
<div class="sns-list"></div>
<div class="clr"></div>
<div id="wrap">
