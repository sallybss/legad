<?php
get_header();
?>

<div class="policy-page">

  <?php
  $main_title = get_field('refund_main_title');
  $intro = get_field('refund_intro');
  ?>

  <?php if ($main_title): ?>
    <h1><?php echo esc_html($main_title); ?></h1>
  <?php endif; ?>

  <?php if ($intro): ?>
    <p class="intro"><?php echo esc_html($intro); ?></p>
  <?php endif; ?>

  <?php if (have_rows('refund_sections')): ?>
    <?php while (have_rows('refund_sections')): the_row(); ?>
      <?php
      $section_title = get_sub_field('section_title');
      $section_content = get_sub_field('section_content');
      ?>
      <?php if ($section_title): ?>
        <h3><strong><?php echo esc_html($section_title); ?></strong></h3>
      <?php endif; ?>
      <?php if ($section_content): ?>
        <p><?php echo esc_html($section_content); ?></p>
      <?php endif; ?>
    <?php endwhile; ?>
  <?php endif; ?>

</div>

<?php get_footer(); ?>