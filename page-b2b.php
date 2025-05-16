<?php get_header(); ?>

<?php
$hero_heading    = get_field('b2b_hero_heading');
$hero_subheading = get_field('b2b_hero_subheading');
$cta_link        = get_field('b2b_cta_link');
$cta_text        = get_field('b2b_hero_cta_text');
?>

<section class="b2b-hero">
  <?php if ($hero_heading): ?><h1><?php echo esc_html($hero_heading); ?></h1><?php endif; ?>
  <?php if ($hero_subheading): ?><p><?php echo esc_html($hero_subheading); ?></p><?php endif; ?>
  <?php if ($cta_link && $cta_text): ?>
    <a href="<?php echo esc_url($cta_link); ?>" class="btn">
      <?php echo esc_html($cta_text); ?>
    </a>
  <?php endif; ?>
</section>

<section class="b2b-why">
  <?php if ($why_title = get_field('b2b_why_title')): ?>
    <h2><?php echo esc_html($why_title); ?></h2>
  <?php endif; ?>

  <div class="why-grid">
    <?php if (have_rows('b2b_why')): while (have_rows('b2b_why')): the_row(); ?>
      <div class="why-card">
        <?php if ($icon = get_sub_field('icon')): ?>
          <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
        <?php endif; ?>
        <h3><?php echo esc_html(get_sub_field('title')); ?></h3>
        <p><?php echo esc_html(get_sub_field('description')); ?></p>
      </div>
    <?php endwhile; endif; ?>
  </div>
</section>

<section class="b2b-linesheet">
  <?php if ($linesheet_title = get_field('b2b_linesheet_title')): ?>
    <h2><?php echo esc_html($linesheet_title); ?></h2>
  <?php endif; ?>

  <div class="content">
    <?php echo wp_kses_post(get_field('b2b_linesheet_text')); ?>
  </div>
</section>

<section class="b2b-process">
  <?php if ($process_title = get_field('b2b_process_title')): ?>
    <h2><?php echo esc_html($process_title); ?></h2>
  <?php endif; ?>

  <div class="steps">
    <?php if (have_rows('b2b_steps')): while (have_rows('b2b_steps')): the_row(); ?>
      <div class="step">
        <h3><?php echo esc_html(get_sub_field('step_title')); ?></h3>
        <p><?php echo esc_html(get_sub_field('step_description')); ?></p>
      </div>
    <?php endwhile; endif; ?>
  </div>
</section>

<section class="b2b-testimonials">
  <?php if ($testimonials_title = get_field('b2b_testimonials_title')): ?>
    <h2><?php echo esc_html($testimonials_title); ?></h2>
  <?php endif; ?>

  <?php if (have_rows('b2b_testimonials')): while (have_rows('b2b_testimonials')): the_row(); ?>
    <blockquote>
      <p>"<?php echo esc_html(get_sub_field('quote')); ?>"</p>
      <cite>- <?php echo esc_html(get_sub_field('name')); ?>, <?php echo esc_html(get_sub_field('store')); ?></cite>
    </blockquote>
  <?php endwhile; endif; ?>
</section>

<section class="b2b-contact">
  <?php if ($contact_title = get_field('b2b_contact_title')): ?>
    <h2><?php echo esc_html($contact_title); ?></h2>
  <?php endif; ?>

  <div class="form-wrap">
    <?php
    $form_shortcode = get_field('b2b_form_shortcode');
    if ($form_shortcode) {
      echo do_shortcode($form_shortcode);
    }
    ?>
  </div>
</section>

<?php get_footer(); ?>