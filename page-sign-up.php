<?php
/* Template Name: Sign Up */
get_header();

if ( is_user_logged_in() ) {
  wp_redirect( wc_get_page_permalink('myaccount') );
  exit;
}
?>

<div class="auth-page">
  <h1>Sign Up</h1>
  <p>Already have an account? <a href="<?php echo esc_url(site_url('/sign-in')); ?>"><strong>Sign in here.</strong></a></p>

  <div class="auth-form-wrapper">
    <?php echo do_shortcode('[woocommerce_my_account]'); ?>
  </div>
</div>

<?php get_footer(); ?>