<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()): the_post(); ?>

<?php
$herovideo      = get_field("video");
$video_url      = is_array($herovideo) ? $herovideo['url'] : $herovideo;
$top_text       = get_field('top_products_text');
$editorial_left = get_field('editorial_image_left');
$editorial_right = get_field('editorial_image_right');
?>

<!-- Hero Video -->
<div class="hero">
  <?php if ($video_url): ?>
    <div class="videooverlay">
      <video autoplay loop muted playsinline>
        <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
      </video>
    </div>
  <?php else: ?>
    <p>No video available.</p>
  <?php endif; ?>
</div>

<!-- Categories Grid -->
<section class="category-grid">
  <h2 class="category-title">CATEGORIES</h2>
  <div class="grid-container">
    <?php
    $terms = get_terms([
      'taxonomy' => 'product_cat',
      'hide_empty' => false,
      'parent' => 0
    ]);

    foreach ($terms as $term):
      $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
      $image = wp_get_attachment_url($thumbnail_id);
      $custom_page = get_page_by_path($term->slug);
      $link = $custom_page ? get_permalink($custom_page) : '#';
    ?>
      <a href="<?php echo esc_url($link); ?>" class="grid-item">
        <?php if ($image): ?>
          <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($term->name); ?>">
        <?php endif; ?>
        <div class="overlay"><span><?php echo esc_html($term->name); ?></span></div>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<!-- Top Products Grid -->
<section class="top-products">
  <h2 class="section-title">TOP PRODUCTS</h2>
  <div class="product-grid">
    <?php
    $products = wc_get_products([
      'limit' => 6,
      'status' => 'publish',
      'orderby' => 'date',
      'order' => 'DESC'
    ]);

    foreach ($products as $product):
      $product_id = $product->get_id();
      $thumbnail = get_the_post_thumbnail_url($product_id, 'woocommerce_thumbnail');
      $title     = $product->get_name();
      $price     = $product->get_price_html();
      $link      = get_permalink($product_id);
    ?>
      <div class="custom-product">
        <div class="product-image">
          <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>">
          <div class="hover-overlay">
            <h3><?php echo esc_html($title); ?></h3>
            <p class="price"><?php echo $price; ?></p>
            <div class="button-group">
              <a href="<?php echo esc_url($link); ?>">View Product</a>

              <?php if ($product->is_type('variable')): ?>
                <form class="add-to-cart-form" method="post" action="<?php echo esc_url(wc_get_cart_url()); ?>">
                  <?php
                  $attributes = $product->get_variation_attributes();
                  $attribute_keys = array_keys($attributes);
                  ?>
                  <select name="attribute_<?php echo esc_attr($attribute_keys[0]); ?>" required>
                    <option value="">Size</option>
                    <?php foreach ($attributes[$attribute_keys[0]] as $option): ?>
                      <option value="<?php echo esc_attr($option); ?>"><?php echo esc_html($option); ?></option>
                    <?php endforeach; ?>
                  </select>
                  <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>">
                  <button type="submit" class="buy-btn">Buy</button>
                </form>
              <?php else: ?>
                <form method="post" action="<?php echo esc_url(wc_get_cart_url()); ?>">
                  <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>">
                  <button type="submit" class="buy-btn">Buy</button>
                </form>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Editorial Section -->
<section class="editorial-section">
  <?php if ($top_text): ?>
    <p class="product-description"><?php echo esc_html($top_text); ?></p>
  <?php endif; ?>

  <div class="editorial-images">
    <?php if (!empty($editorial_left)): ?>
      <img src="<?php echo esc_url($editorial_left['url']); ?>" alt="<?php echo esc_attr($editorial_left['alt']); ?>" class="left-img">
    <?php endif; ?>
    <?php if (!empty($editorial_right)): ?>
      <img src="<?php echo esc_url($editorial_right['url']); ?>" alt="<?php echo esc_attr($editorial_right['alt']); ?>" class="right-img">
    <?php endif; ?>
  </div>
</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>