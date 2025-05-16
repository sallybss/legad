<?php
get_header();
?>

<div class="my-account-wrapper">
  <div class="my-account-inner">
    
    <aside class="account-sidebar">
      <?php do_action('woocommerce_account_navigation'); ?>
    </aside>

    <main class="account-content">
      <?php do_action('woocommerce_account_content'); ?>
    </main>

  </div>
</div>

<?php get_footer(); ?>