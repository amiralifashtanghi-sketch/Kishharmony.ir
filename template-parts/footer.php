<?php
// template-parts/footer.php
?>
<footer class="site-footer">
    <div class="footer-widgets">
        <?php if(is_active_sidebar('footer-1')) dynamic_sidebar('footer-1'); ?>
    </div>
    <div class="site-info">&copy; <?php echo date('Y'); ?> Kishharmony</div>
</footer>
