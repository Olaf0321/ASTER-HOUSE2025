<?php get_header(); ?>

    <div class="ttl fadeIn">
        <h2 class="fadeUp">Reserve<span>ご来場予約</span></h2>
    </div>

    <article class="wrapper relative">
        <div class="imgbox__form__reserve">
            <object data="<?php echo get_template_directory_uri(); ?>/images/reserve.svg" type="image/svg+xml" class="svg__company01"></object>
        </div>
        <div class="textbox__form">
            <?php echo do_shortcode('[custom_reserve_form]'); ?>
        </div>
    </article>

<?php get_footer(); ?>