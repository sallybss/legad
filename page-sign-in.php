<?php
/* Template Name: Sign In */
get_header();

if ( is_user_logged_in() ) {
  wp_redirect( wc_get_page_permalink('myaccount') );
  exit;
}
?>

<div class="auth-page">
  <h1>Sign In</h1>
  <p>Don't have an account? <a href="<?php echo esc_url(site_url('/sign-up')); ?>"><strong>Sign up here.</strong></a></p>

  <div class="auth-form-wrapper">
    <?php echo do_shortcode('[woocommerce_my_account]'); ?>
  </div>
</div>

<?php get_footer(); ?>