<?php
get_header();

$category_slug = get_field('category_slug');

$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'product_cat' => $category_slug
);

$products = new WP_Query($args);
?>

<div class="custom-category-page">
  <h1><?php echo esc_html(get_the_title()); ?></h1>

  <div class="products-grid">
    <?php if ($products->have_posts()) : ?>
      <?php while ($products->have_posts()) : $products->the_post(); 
        $price = get_post_meta(get_the_ID(), '_price', true);
        $thumbnail = get_the_post_thumbnail(get_the_ID(), 'medium');
      ?>
        <a href="<?php echo esc_url(get_permalink()); ?>" class="product-box">
          <?php 
            echo $thumbnail ?: '<div class="no-thumb">No image</div>'; 
          ?>
          <h3><?php echo esc_html(get_the_title());?></h3>
          <span><?php echo wc_price($price); ?></span>
        </a>
      <?php endwhile; wp_reset_postdata(); ?>
    <?php else : ?>
      <p>No products found in this category.</p>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>