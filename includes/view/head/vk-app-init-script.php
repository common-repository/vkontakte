<?php
/**
 * @var int $app_id
 */
?>
<script type="text/javascript" id="vkontakte-init-script">
	VK?.init({
		apiId: <?php echo esc_html( $app_id ); ?>,
		onlyWidgets: true
	});
</script>
