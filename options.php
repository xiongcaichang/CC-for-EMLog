<?php

/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');
$options = array(
	'logo' =>array(
		'type' => 'image',
		'name' => 'LOGO设置',
		'values' => array(
			TEMPLATE_URL . 'images/auth.jpg',
		),
		'description' => 'LOGO最好是正方形的.亲',
	),
	'header' =>array(
		'type' => 'image',
		'name' => 'LOGO背景',
		'values' => array(
			TEMPLATE_URL . 'images/header_img.jpg',
		),
	),
	'header2' =>array(
		'type' => 'image',
		'name' => 'LOGO2背景',
		'values' => array(
			TEMPLATE_URL . 'images/author.png',
		),
	),
	'LOGO_xz' => array(
		'type' => 'radio',
		'name' => 'LOGO样式',
		'values' => array(
			'x' => '样式1',
			'bx' => '样式2',
		),
		'default' => 'x',
	),
	'sssq_xz' => array(
		'type' => 'radio',
		'name' => '试试手气显示',
		'values' => array(
			'x' => '显示',
			'bx' => '不显示',
		),
		'default' => 'bx',
	),
	'bkgg_xz' => array(
		'type' => 'radio',
		'name' => '博客公告显示',
		'values' => array(
			'x' => '显示',
			'bx' => '不显示',
		),
		'default' => 'bx',
	),
	'bkgg_lr' => array(
		'type' => 'text',
		'name' => '博客公告内容',
		'multi' => 'true',
		'values' => array(
			'刚刚我找一位大师算命，大师说我有血光之灾，我一想完了，问大师怎么办，大师给了我一包卫生巾！！！',
		),
	), 
	'tgsbl_xz' => array(
		'type' => 'radio',
		'name' => '多个侧边栏显示',
		'values' => array(
			'x' => '显示',
			'bx' => '不显示',
		),
		'default' => 'x',
	),
);
