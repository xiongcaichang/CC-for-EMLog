<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
</div>

<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>


<div class="clr"></div>	</div>
</div>

<script type="text/javascript">function warning(){ if(navigator.userAgent.indexOf("MSIE")>0) { art.dialog.alert('复制成功！若要转载请务必保留原文链接，申明来源，谢谢合作！'); } else { alert("复制成功！若要转载请务必保留原文链接，申明来源，谢谢合作！"); }}document.body.oncopy=function(){warning();}</script>
<script type="text/javascript">eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('g(0).h(e(){e d(){0.9=0[b]?"╰(￣▽￣)╭ ☞ 大爷常来玩啊 ☜":a}f b,c,a=0.9;"2"!=4 0.8?(b="8",c="k"):"2"!=4 0.5?(b="5",c="j"):"2"!=4 0.6&&(b="6",c="l"),("2"!=4 0.7||"2"!=4 0[b])&&0.7(c,d,!1)});',22,22,'document||undefined||typeof|mozHidden|webkitHidden|addEventListener|hidden|title|||||function|var|jQuery|ready|Hi|mozvisibilitychange|visibilitychange|webkitvisibilitychange'.split('|'),0,{}))</script>



<script type="text/javascript" id="wpgo_global_js" src="<?php echo TEMPLATE_URL; ?>js/wpgo_global.js"></script>
<div id="fancybox-tmp"></div><div id="fancybox-loading"><div></div></div><div id="fancybox-overlay"></div><div id="fancybox-wrap"><div id="fancybox-outer"><div class="fancybox-bg" id="fancybox-bg-n"></div><div class="fancybox-bg" id="fancybox-bg-ne"></div><div class="fancybox-bg" id="fancybox-bg-e"></div><div class="fancybox-bg" id="fancybox-bg-se"></div><div class="fancybox-bg" id="fancybox-bg-s"></div><div class="fancybox-bg" id="fancybox-bg-sw"></div><div class="fancybox-bg" id="fancybox-bg-w"></div><div class="fancybox-bg" id="fancybox-bg-nw"></div><div id="fancybox-content"></div><a id="fancybox-close"></a><div id="fancybox-title"></div><a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a><a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a></div></div>
<?php doAction('index_footer'); ?>
<?php doAction('myhk_player'); ?>

	<div id="footer">   
		<div class="footer-info"> 

			<div class="copyright"> 
				<a href="http://www.xiongcaichang.com/sitemap.xml">网站地图</a><br> 
				 Copyright ©<?php echo date('Y',time())?>-<?php echo $blogname; ?> | <a href="http://www.xiongcaichang.com"  target="_blank">版权所有 CC's Blog</a> <br>
			  <?php echo $icp; ?> 
			 已经运行：<?php echo floor((time()-strtotime("2014-01-08"))/86400); ?>天 | 请求耗时: <?php echo strtoupper(runtime_display()); ?>

		

			  <?php echo $footer_info; ?>
			</div>
		</div>
	</div>
<?php doAction('index_bodys'); ?>

<!--异步刷新-->
<script>
    $(document).pjax('a[target!=_blank]', '#left', {fragment:'#left', timeout:8000});

</script>

<div class="pjax_loading"></div>
<script>
$(document).on('pjax:send', function() { //pjax链接点击后显示加载动画；
    $(".pjax_loading").css("display", "block");
});
$(document).on('pjax:complete', function() { //pjax链接加载完成后隐藏加载动画；
    $(".pjax_loading").css("display", "none");
});
</script>

<script>
$(document).on('pjax:complete', function() {
    pajx_loadDuodsuo();//pjax加载完成之后调用重载多说函数
});
function pajx_loadDuodsuo(){
    var dus=$(".ds-thread");
    if($(dus).length==1){
        var el = document.createElement('div');
        el.setAttribute('data-thread-key',$(dus).attr("data-thread-key"));//必选参数
        el.setAttribute('data-url',$(dus).attr("data-url"));
        DUOSHUO.EmbedThread(el);
        $(dus).html(el);
    }
}
</script>


<!--异步刷新-->  

</body>
</html>