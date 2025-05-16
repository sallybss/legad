<?php
get_header();
?>

<div class="custom-cart-page">
  <h2 class="cart-heading">Cart</h2>

  <div class="cart-grid">
    <div class="cart-items">
      <?php echo do_shortcode('[woocommerce_cart]'); ?>
    </div>

    <div class="cart-summary">
      <h3>ORDER SUMMARY</h3>

      <div class="summary-row">
        <span>Subtotal</span>
        <span><?php wc_cart_totals_subtotal_html(); ?></span>
      </div>

      <hr>

      <div class="summary-row">
        <?php wc_cart_totals_shipping_html(); ?>
      </div>

      <hr>

      <div class="summary-row total">
        <span>Total</span>
        <span><?php wc_cart_totals_order_total_html(); ?></span>
      </div>

      <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button">PROCEED TO CHECKOUT</a>
    </div>
  </div>
</div>

<?php get_footer(); ?>