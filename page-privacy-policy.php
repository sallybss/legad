<?php
get_header();
?>

<div class="privacy-wrapper">

  <h1><?php the_title(); ?></h1> 

  <div class="privacy-section">
    <?php if ($intro = get_field('privacy_intro')): ?>
      <p><?php echo esc_html($intro); ?></p>
    <?php endif; ?>
  </div>

  <div class="privacy-section">
    <?php if (have_rows('privacy_sections')): ?>
      <?php while (have_rows('privacy_sections')): the_row(); ?>
        <?php
        $title = get_sub_field('title');
        $text  = get_sub_field('text');
        ?>
        <?php if ($title): ?>
          <h2><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if ($text): ?>
          <p><?php echo esc_html($text); ?></p>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>

</div>

<?php get_footer(); ?>