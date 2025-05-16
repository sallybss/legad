<div class="custom-single-product">
  <div class="product-images">
    <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
  </div>

  <div class="product-summary">
    <?php do_action( 'woocommerce_single_product_summary' ); ?>
  </div>
</div>

<div class="product-tabs">
  <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
</div>