<?php
get_header();

$hero_image       = get_field('category_hero_image'); 
$category_title   = get_field('category_title');
$current_cat_slug = basename(get_permalink());
$selected_sort    = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : '';
?>

<div class="category-template-page">

  <?php if ($hero_image): ?>
    <div class="category-hero">
      <img src="<?php echo esc_url($hero_image['url']); ?>" alt="Category Hero">
    </div>
  <?php endif; ?>

  <?php if ($category_title): ?>
    <h1 class="category-h1"><?php echo esc_html($category_title); ?></h1>
  <?php endif; ?>

  <!-- Filters -->
  <div class="shop-controls">
    <div class="shop-filter-left">
      <label for="product_cat">Categories:</label>
      <?php wp_dropdown_categories([
        'taxonomy'         => 'product_cat',
        'name'             => 'product_cat',
        'orderby'          => 'name',
        'hierarchical'     => true,
        'show_option_all'  => 'All',
        'value_field'      => 'slug',
        'selected'         => $current_cat_slug
      ]); ?>
    </div>

    <div class="shop-filter-right">
      <label for="orderby">Sort by:</label>
      <select name="orderby" id="orderby">
        <option value="">Default</option>
        <option value="price_asc" <?php selected($selected_sort, 'price_asc'); ?>>Price: Low to High</option>
        <option value="price_desc" <?php selected($selected_sort, 'price_desc'); ?>>Price: High to Low</option>
        <option value="date_desc" <?php selected($selected_sort, 'date_desc'); ?>>Newest</option>
      </select>
    </div>
  </div>

  <!-- Products Grid -->
  <div class="custom-category-products">
    <div class="product-grid">
      <?php
        $order_by = 'date';
        $order    = 'DESC';

        if ($selected_sort === 'price_asc') {
          $order_by = 'meta_value_num';
          $order    = 'ASC';
        } elseif ($selected_sort === 'price_desc') {
          $order_by = 'meta_value_num';
          $order    = 'DESC';
        }

        $args = [
          'post_type'      => 'product',
          'posts_per_page' => -1,
          'post_status'    => 'publish',
          'meta_key'       => '_price',
          'orderby'        => $order_by,
          'order'          => $order,
          'tax_query'      => [[
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $current_cat_slug
          ]]
        ];

        $loop = new WP_Query($args);

        if ($loop->have_posts()):
          while ($loop->have_posts()): $loop->the_post();
            global $product;
            $product_id = $product->get_id();
            $thumbnail  = get_the_post_thumbnail_url($product_id, 'woocommerce_thumbnail');
            $title      = $product->get_name();
            $price      = $product->get_price_html();
            $permalink  = get_permalink($product_id);
      ?>
        <div class="custom-product">
          <div class="product-image">
            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>">
            <div class="hover-overlay">
              <h3><?php echo esc_html($title); ?></h3>
              <p class="price"><?php echo $price; ?></p>
              <div class="hover-buttons">
                <a href="<?php echo esc_url($permalink); ?>" class="view-product-link">View Product</a>
                <form method="post" action="<?php echo esc_url(wc_get_cart_url()); ?>">
                  <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>">
                  <button type="submit" class="buy-button">Buy</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
  </div>

</div>

<!-- JS for Category and Sort -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  const catDropdown = document.querySelector('select[name="product_cat"]');
  const sortDropdown = document.getElementById('orderby');

  if (catDropdown) {
    catDropdown.addEventListener('change', function () {
      if (this.value) {
        window.location.href = '<?php echo esc_url(site_url()); ?>/' + this.value;
      }
    });
  }

  if (sortDropdown) {
    sortDropdown.addEventListener('change', function () {
      const url = new URL(window.location.href);
      if (this.value) {
        url.searchParams.set('orderby', this.value);
      } else {
        url.searchParams.delete('orderby');
      }
      window.location.href = url.toString();
    });
  }
});
</script>

<?php get_footer(); ?>