<?php
get_header();
?>

<form class="form-post" action="" method="get">
    <select name="cat" id="category-filter">
        <option value="">Все категории</option>
        <?php
        $categories = get_categories();
        foreach ($categories as $category) {
            echo '<option value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="Фильтровать">
</form>
<section class="news-block">
    <?php
    if (have_posts()):
        while (have_posts()):
            the_post();
            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $categories = get_the_category();
            ?>

            <div class="news-item">
                <?php if ($image_url): ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" class="news-image">
                <?php endif; ?>
                <h2 class="news-title"><a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a></h2>
                <p class="news-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                </p>
                <p class="news-categories">
                    <?php
                    if (!empty ($categories)) {
                        echo 'Категории: ';
                        foreach ($categories as $category) {
                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>, ';
                        }
                    }
                    ?>
                </p>
            </div>

            <?php
        endwhile;
    endif;
    ?>
</section>