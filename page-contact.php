<?php get_header(); ?>

<?php 
$contact_heading = get_field('contact_heading');
$contact_intro   = get_field('contact_intro');
$contact_image   = get_field('contact_image');
$contact_label   = get_field('contact_label');
$contact_email   = get_field('contact_email');
$contact_phone   = get_field('contact_phone');
?>

<div class="contact-page">

  <section class="contact-content">
    <?php if ($contact_heading): ?>
      <h2><?php echo esc_html($contact_heading); ?></h2>
    <?php endif; ?>

    <?php if ($contact_intro): ?>
      <p><?php echo esc_html($contact_intro); ?></p>
    <?php endif; ?>

    <div class="contact-form">
      <?php echo do_shortcode('[contact-form-7 id="f64d47a" title="Contact form 1"]'); ?>
    </div>
  </section>

  <aside class="contact-aside">
    <?php if ($contact_label): ?>
      <small><?php echo esc_html($contact_label); ?></small>
    <?php endif; ?>

    <p>
      <?php if ($contact_email) echo esc_html($contact_email) . '<br>'; ?>
      <?php if ($contact_phone) echo esc_html($contact_phone); ?>
    </p>

    <?php if ($contact_image): ?>
      <img src="<?php echo esc_url($contact_image['url']); ?>" alt="<?php echo esc_attr($contact_image['alt'] ?? 'Contact image'); ?>">
    <?php endif; ?>
  </aside>

</div>

<?php get_footer(); ?>