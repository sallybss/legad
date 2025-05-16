<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Legad is a handcrafted jewelry brand offering unique, modern pieces with a personal touch.">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
$use_dark_nav = is_page([
    'contact', 'cart', 'faq', 'size-guide', 'my-account', 'checkout',
    'privacy-policy', 'refund_returns', 'care-tips', 'b2b', 'shop'
  ]) || is_singular('product');?>

<div class="nav <?php echo $use_dark_nav ? 'dark-nav' : 'light-nav'; ?>">

    <div class="nav-left">
        <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $use_dark_nav ? 'logo.png' : 'logo-white.png'; ?>" alt="<?php bloginfo('name'); ?> Logo">
        </a>
    </div>

    <div class="nav-center">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary-menu',
            'container' => false,
            'items_wrap' => '<ul class="menu">%3$s</ul>',
            'fallback_cb' => function () {
                echo '<ul class="menu"><li><a href="#">Menu not assigned</a></li></ul>';
            },
        ));
        ?>
    </div>

<div class="nav-right">
    <a href="<?php echo esc_url(wc_get_cart_url()); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $use_dark_nav ? 'shopping-cart.png' : 'white-cart.png'; ?>" alt="Cart" class="icon">
    </a>

<?php if (is_user_logged_in()): ?>
  <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
    <img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $use_dark_nav ? 'user.png' : 'profile-white.png'; ?>" alt="Account" class="icon">
  </a>
<?php else: ?>
  <a href="<?php echo esc_url(site_url('/sign-in')); ?>">
    <img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $use_dark_nav ? 'user.png' : 'profile-white.png'; ?>" alt="Login" class="icon">
  </a>
<?php endif; ?>

    <div class="menu-icon" onclick="toggleSideMenu()">&#9776;</div>
</div>

<!-- Side Menu -->
    <div id="side-menu" class="side-menu">
        <a href="javascript:void(0)" class="closebtn" onclick="toggleSideMenu()">&times;</a>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary-menu',
            'container' => false,
            'items_wrap' => '<ul class="menu">%3$s</ul>',
            'fallback_cb' => function () {
                echo '<ul class="menu"><li><a href="#">Menu not assigned</a></li></ul>';
            },
        ));
        ?>
    </div>
</div>

<?php wp_footer(); ?>

<script>
    function toggleSideMenu() {
        const sideMenu = document.getElementById('side-menu');
        sideMenu.style.width = sideMenu.style.width === '250px' ? '0' : '250px';
    }
</script>

</body>
</html> 