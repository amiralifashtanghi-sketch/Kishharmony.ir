<?php
/*
Template Name: Rentals Listing
*/
get_header();
?>
<main class="rentals-listing">
    <h1>لیست خودروهای رنت</h1>
    <?php
    $args = array('post_type'=>'rental_car','posts_per_page'=>12);
    $q = new WP_Query($args);
    if($q->have_posts()):
        echo '<ul class="rental-items">';
        while($q->have_posts()): $q->the_post();
            echo '<li>';
            if(has_post_thumbnail()) the_post_thumbnail('medium');
            echo '<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
            the_excerpt();
            echo '</li>';
        endwhile;
        echo '</ul>';
        wp_reset_postdata();
    else:
        echo '<p>هیچ خودرویی یافت نشد.</p>';
    endif;
    ?>
</main>
<?php get_footer(); ?>
