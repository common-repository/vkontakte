<div class="wrap">
	<h2><?php _e( 'VKontakte Comments', 'vkontakte' ); ?></h2>

	<div id="vk-comments-browse"></div>
</div>
<script type="text/javascript" id="vkontakte-comments-browse-script">
	window.onload = function () {
		VK.Widgets.CommentsBrowse('vk-comments-browse');
	}
</script>
