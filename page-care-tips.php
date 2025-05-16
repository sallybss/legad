<?php
get_header();
?>

<div class="care-tips-page">
  <?php if ($cover_image = get_field('care_tips_cover')): ?>
    <div class="care-cover-image">
      <img src="<?php echo esc_url($cover_image['url']); ?>" alt="Care Tips Cover">
    </div>
  <?php endif; ?>

  <h1><?php the_title(); ?></h1>

  <?php if (have_rows('care_tips_sections')): ?>
    <div class="care-tips-wrapper">
      <?php $i = 0; while (have_rows('care_tips_sections')): the_row(); ?>
        <?php
          $image = get_sub_field('image');
          $text  = get_sub_field('text');
          $is_even = $i % 2 === 0;
        ?>
        <div class="care-tips-block <?php echo $is_even ? 'image-left' : 'image-right'; ?>">
          <?php if ($image): ?>
            <div class="care-tips-image">
              <img src="<?php echo esc_url($image['url']); ?>" alt="">
            </div>
          <?php endif; ?>

          <?php if ($text): ?>
            <div class="care-tips-text">
              <p><?php echo esc_html($text); ?></p>
            </div>
          <?php endif; ?>
        </div>
      <?php $i++; endwhile; ?>
    </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>