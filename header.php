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

<!-- NAVIGATION -->
<div class="nav">
    <!-- Left: Logo -->
    <div class="nav-left">
        <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?> Logo">
        </a>
    </div>

    <!-- Center: WordPress Menu -->
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

    <!-- Right: Icons + Mobile Burger -->
    <div class="nav-right">
        <img src="<?php echo get_template_directory_uri(); ?>/images/shopping-cart.png" alt="Cart" class="icon">
        <img src="<?php echo get_template_directory_uri(); ?>/images/user.png" alt="User" class="icon">
        <div class="menu-icon" onclick="toggleSideMenu()">&#9776;</div>
    </div>

    <!-- Side Menu for Mobile -->
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