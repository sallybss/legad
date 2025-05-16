<?php
get_header();
?>

<?php 
$about_hero = get_field('about_hero');
$about_title = get_field('about_title');
$about_text = get_field('about_text');
$about_image = get_field('about_image');
?>

<?php if ($about_hero): ?>
  <div class="about-hero">
    <img src="<?php echo $about_hero['url']; ?>" alt="About hero">
  </div>
<?php endif; ?>

<section class="about-content">
  <div class="about-inner">
    <div class="about-text">
      <h2><?php echo $about_title; ?></h2>
      <p><?php echo $about_text; ?></p>
    </div>
    <div class="about-image">
      <img src="<?php echo $about_image['url']; ?>" alt="Crafting photo">
    </div>
  </div>
</section>

<?php get_footer(); ?>