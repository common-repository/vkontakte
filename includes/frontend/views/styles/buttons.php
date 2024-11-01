<?php
/**
 * @var int $like_button_width
 * @var string $buttons_css
 */
?>
<style id="vkontakte-buttons-styles">
    .vk-like-div .vk-like-btn iframe {
        width: <?php echo $like_button_width; ?>px !important;
    }

    <?php if ($buttons_css): ?>
    <?php echo $buttons_css; ?>
    <?php endif; ?>
</style>
