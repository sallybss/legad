<?php get_header(); ?>

<main class="homepage">
  <?php
    while ( have_posts() ) : the_post();
      the_content();
    endwhile;
  ?>
</main>

<?php get_footer(); ?>