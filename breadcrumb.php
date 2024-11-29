<div class="breadcrumb layout-breadcrumb">
    <div class="breadcrumb__inner inner">
        <div class="breadcrumb__list <?php echo is_404() ? 'breadcrumb__list--404' : ''; ?>">
            <?php
            if ( function_exists( 'bcn_display' ) ) {
                bcn_display();
            }
            ?>
        </div>
    </div>
</div>

