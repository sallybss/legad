<?php

// TEMP FIX: Force product visibility for guests
if (!is_user_logged_in()) {
  add_filter('woocommerce_is_purchasable', '__return_true');
  add_filter('woocommerce_product_is_visible', '__return_true');
  add_filter('woocommerce_product_is_public', '__return_true');
  add_filter('woocommerce_variation_is_visible', '__return_true');
  add_filter('woocommerce_variation_is_active', '__return_true');
}

add_filter('woocommerce_is_shop', '__return_true');
get_header();

// Load custom fields
$shop_banner = get_field('shop_banner');
$shop_intro = get_field('shop_intro');

// Handle filters
$selected_cat = isset($_GET['product_cat']) ? sanitize_text_field($_GET['product_cat']) : '';
$selected_sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : '';
?>

<div class="custom-shop-page">

  <?php if ($shop_banner): ?>
    <div class="shop-hero">
      <img src="<?php echo esc_url($shop_banner['url']); ?>" alt="Shop Hero">
    </div>
  <?php endif; ?>

  <?php if ($shop_intro): ?>
    <div class="shop-description">
      <p><?php echo esc_html($shop_intro); ?></p>
    </div>
  <?php endif; ?>

  <!-- Filters -->
  <div class="shop-controls">
    <div class="shop-filter-left">
      <label for="product_cat">Categories:</label>
      <?php wp_dropdown_categories([
        'taxonomy' => 'product_cat',
        'name' => 'product_cat',
        'orderby' => 'name',
        'hierarchical' => true,
        'show_option_all' => 'All',
        'value_field' => 'slug',
        'selected' => $selected_cat,
      ]); ?>
    </div>

    <div class="shop-filter-right">
      <label for="sort">Sort by:</label>
      <select name="sort" id="sort">
        <option value="">Default</option>
        <option value="price_asc" <?php selected($selected_sort, 'price_asc'); ?>>Price: Low to High</option>
        <option value="price_desc" <?php selected($selected_sort, 'price_desc'); ?>>Price: High to Low</option>
        <option value="newest" <?php selected($selected_sort, 'newest'); ?>>Newest</option>
        <option value="oldest" <?php selected($selected_sort, 'oldest'); ?>>Oldest</option>
      </select>
    </div>
  </div>

  <!-- Product Grid -->
  <div class="product-loop">
    <?php
    $args = [
      'limit' => -1,
      'status' => 'publish',
    ];

    if ($selected_cat) {
      $args['category'] = [$selected_cat];
    }

    if ($selected_sort === 'price_asc') {
      $args['orderby'] = 'meta_value_num';
      $args['meta_key'] = '_price';
      $args['order'] = 'ASC';
    } elseif ($selected_sort === 'price_desc') {
      $args['orderby'] = 'meta_value_num';
      $args['meta_key'] = '_price';
      $args['order'] = 'DESC';
    } elseif ($selected_sort === 'newest') {
      $args['orderby'] = 'date';
      $args['order'] = 'DESC';
    } elseif ($selected_sort === 'oldest') {
      $args['orderby'] = 'date';
      $args['order'] = 'ASC';
    }

    $products = wc_get_products($args);

    foreach ($products as $product):
      $product_id = $product->get_id();
      $thumbnail = get_the_post_thumbnail_url($product_id, 'woocommerce_thumbnail');
      $title = $product->get_name();
      $price = $product->get_price_html();
      $permalink = get_permalink($product_id);
    ?>
      <div class="custom-product">
        <div class="product-image">
          <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>">
          <div class="hover-overlay">
            <h3><?php echo esc_html($title); ?></h3>
            <p class="price"><?php echo wp_kses_post($price); ?></p>

            <div class="hover-buttons">
              <a href="<?php echo esc_url($permalink); ?>" class="view-product-link">View Product</a>

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
                  <button type="submit" class="buy-button">Buy</button>
                </form>
              <?php else: ?>
                <form method="post" action="<?php echo esc_url(wc_get_cart_url()); ?>">
                  <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>">
                  <button type="submit" class="buy-button">Buy</button>
                </form>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>

<!-- JS for Filters -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  const categoryDropdown = document.querySelector('select[name="product_cat"]');
  const sortDropdown = document.querySelector('select[name="sort"]');

  function updateShopURL() {
    const url = new URL(window.location.href);
    const selectedCategory = categoryDropdown?.value || '';
    const selectedSort = sortDropdown?.value || '';

    if (selectedCategory) {
      url.searchParams.set('product_cat', selectedCategory);
    } else {
      url.searchParams.delete('product_cat');
    }

    if (selectedSort) {
      url.searchParams.set('sort', selectedSort);
    } else {
      url.searchParams.delete('sort');
    }

    window.location.href = url.toString();
  }

  categoryDropdown?.addEventListener('change', updateShopURL);
  sortDropdown?.addEventListener('change', updateShopURL);
});
</script>

<?php get_footer(); ?>