<?php
get_header();
?>

<div class="faq-wrapper">
  <?php if (have_rows('faq_topics')): ?>
    <?php while (have_rows('faq_topics')): the_row(); ?>
      <?php $topic_title = get_sub_field('topic_title'); ?>
      <div class="faq-topic">
        <?php if ($topic_title): ?>
          <h2><?php echo esc_html($topic_title); ?></h2>
        <?php endif; ?>

        <?php if (have_rows('topic_items')): ?>
          <div class="faq-items">
            <?php while (have_rows('topic_items')): the_row(); ?>
              <?php
              $question = get_sub_field('question');
              $answer   = get_sub_field('answer');
              ?>
              <div class="faq-item">
                <?php if ($question): ?>
                  <button class="faq-question">
                    <?php echo esc_html($question); ?>
                    <span class="icon">+</span>
                  </button>
                <?php endif; ?>
                
                <?php if ($answer): ?>
                  <div class="faq-answer">
                    <p><?php echo esc_html($answer); ?></p>
                  </div>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>

      </div>
    <?php endwhile; ?>
  <?php endif; ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const items = document.querySelectorAll('.faq-item');

  items.forEach(item => {
    const btn = item.querySelector('.faq-question');
    btn.addEventListener('click', () => {
      item.classList.toggle('open');
    });
  });
});
</script>

<?php get_footer(); ?>