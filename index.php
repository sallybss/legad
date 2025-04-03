<?php get_header(); ?>

<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>

        <?php 
            $herovideo = get_field("video");
            $herovideoFileUrl = is_array($herovideo) ? $herovideo['url'] : $herovideo;

            $top_text = get_field('top_products_text');
            $editorial_left = get_field('editorial_image_left'); // now array
            $editorial_right = get_field('editorial_image_right'); // now array
        ?>

        <!-- Hero Video Section -->
        <div class="hero">
            <?php if ($herovideoFileUrl): ?>
                <div class="videooverlay">
                    <video autoplay loop muted playsinline>
                        <source src="<?php echo esc_url($herovideoFileUrl); ?>" type="video/mp4">
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
                $terms = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                    'parent' => 0
                ));

                foreach ($terms as $term):
                    $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
                    $image = wp_get_attachment_url($thumbnail_id);
                    $link = get_term_link($term);
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
                $products = wc_get_products(array(
                    'limit' => 6,
                    'status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));

                foreach ($products as $product):
                    $product_id = $product->get_id();
                    $permalink = get_permalink($product_id);
                    $thumbnail = get_the_post_thumbnail_url($product_id, 'medium');
                ?>
                    <a href="<?php echo esc_url($permalink); ?>" class="product-box">
                        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Dynamic paragraph -->
            <?php if ($top_text): ?>
                <p class="product-description"><?php echo esc_html($top_text); ?></p>
            <?php endif; ?>

            <!-- Editorial images using full array -->
            <div class="editorial-images">
  <?php if ($editorial_left): ?>
    <img 
      src="<?php echo esc_url($editorial_left['url']); ?>" 
      alt="<?php echo esc_attr($editorial_left['alt']); ?>" 
      class="left-img"
    >
  <?php endif; ?>

  <?php if ($editorial_right): ?>
    <img 
      src="<?php echo esc_url($editorial_right['url']); ?>" 
      alt="<?php echo esc_attr($editorial_right['alt']); ?>" 
      class="right-img"
    >
  <?php endif; ?>
</div>
        </section>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>