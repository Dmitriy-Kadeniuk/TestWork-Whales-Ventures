<?php
get_header();
?>
<section class="about-us">
    <h1>
        <?php the_title(); ?>
    </h1>
    <img src="<?php the_field('image-about'); ?>" alt="">
    <p>
        <?php the_field('text-about'); ?>
    </p>
</section>

<?php
get_footer();
?>