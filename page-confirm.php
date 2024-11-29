<?php get_header(); ?>
<section class="contact__mv mv">
        <div class="mv__title-wrap">
            <p class="mv__title">Contact</p>
        </div>
        <picture class="mv__photo">
            <source
            srcset="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/contact_mv-sp.jpg"
            media="(max-width:768px)"
            />
            <img
            src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/contact_mv.jpg"
            alt="2匹の黄色の熱帯魚が海で泳いでいる"/>
        </picture>
    </section>
    <?php get_template_part('breadcrumb'); ?>
	<?php echo do_shortcode('[contact-form-7 id="e419dde" title="お問い合わせ確認"]'); ?>
<?php get_footer(); ?>