<footer class="site-footer">
  <div class="footer-container">

    <div class="footer-columns">

      <!-- Footer Column: Links -->
      <div class="footer-col">
        <h4><?php echo esc_html(get_field('links_heading', 'option')); ?></h4>
        <ul>
          <?php if (have_rows('links', 'option')): ?>
            <?php while (have_rows('links', 'option')): the_row(); ?>
              <li>
                <a href="<?php echo esc_url(get_sub_field('link_url')); ?>">
                  <?php echo esc_html(get_sub_field('link_text')); ?>
                </a>
              </li>
            <?php endwhile; ?>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Footer Column: Socials -->
      <div class="footer-col">
        <h4><?php echo esc_html(get_field('socials_heading', 'option')); ?></h4>
        <ul>
          <?php if (have_rows('socials', 'option')): ?>
            <?php while (have_rows('socials', 'option')): the_row(); ?>
              <li>
                <a href="<?php echo esc_url(get_sub_field('social_url')); ?>">
                  <?php echo esc_html(get_sub_field('social_name')); ?>
                </a>
              </li>
            <?php endwhile; ?>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Footer Column: Others -->
      <div class="footer-col">
        <h4><?php echo esc_html(get_field('others_heading', 'option')); ?></h4>
        <ul>
          <?php if (have_rows('others', 'option')): ?>
            <?php while (have_rows('others', 'option')): the_row(); ?>
              <li>
                <a href="<?php echo esc_url(get_sub_field('other_url')); ?>">
                  <?php echo esc_html(get_sub_field('other_text')); ?>
                </a>
              </li>
            <?php endwhile; ?>
          <?php endif; ?>
        </ul>
      </div>

    </div>

    <!-- Newsletter Section -->
    <div class="newsletter">
      <h2><?php echo esc_html(get_field('newsletter_heading', 'option')); ?></h2>
      <p><?php echo esc_html(get_field('newsletter_text', 'option')); ?></p>
      <?php echo do_shortcode('[contact-form-7 id="47c4046" title="Newsletter Form"]'); ?>
    </div>

    <!-- Scrolling Marquee -->
    <div class="scroll-marquee">
      <div class="marquee-inner">
        <span>LEGAD STUDIO • LEGAD STUDIO • LEGAD STUDIO • LEGAD STUDIO • </span>
      </div>
    </div>

  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>