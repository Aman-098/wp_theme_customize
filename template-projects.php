<?php
// Template Name:projects

get_header();
?>

<main class="flex-shrink-0">
  <!-- Projects Section-->
  <section class="py-5">
    <div class="container px-5 mb-5">
      <div class="text-center mb-5">
        <h1 class="display-5 fw-bolder mb-0">
          <span class="text-gradient d-inline">Portfolio</span>
        </h1>
      </div>
      <div class="row gx-5 justify-content-center">
        <div class="col-lg-11 col-xl-9 col-xxl-8">
            <?php 
              $args = [
                  'post_type'      => 'portfolio',
                  'posts_per_page' => 3
              ];
              $query = new WP_Query($args);
              
              if ($query->have_posts()):
                  while ($query->have_posts()): $query->the_post();
            ?>

          <!-- Portfolio Card -->
          <div class="card overflow-hidden shadow rounded-4 border-0 mb-5">
            <div class="card-body p-0">
              <div class="d-flex align-items-center">
                <!-- Text Section -->
                <div class="p-5">
                  <h2 class="fw-bolder">
                    <?php the_title(); ?>
                  </h2>
                  <p>
                    <?php the_excerpt(); ?>
                  </p>
                  <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                </div>

                <!-- Image Section -->
                <?php if (has_post_thumbnail()): ?>
                <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                  alt="<?php the_title(); ?>" />
                <?php endif; ?>
              </div>
            </div>
          </div>

          <?php 
            endwhile;
              wp_reset_postdata();
             else:
                echo "<p class='text-center'>No Portfolio Items Found.</p>";
            endif;
          ?>
        </div>
        <!-- Pagination -->
        <div class="pagination">
            <?php echo wp_pagenavi(); ?>
        </div>

      </div>
    </div>
  </section>
  <!-- Call to action section-->
  <section class="py-5 bg-gradient-primary-to-secondary text-white">
    <div class="container px-5 my-5">
      <div class="text-center">
        <h2 class="display-4 fw-bolder mb-4">Let's build something together</h2>
        <a class="btn btn-outline-light btn-lg px-5 py-3 fs-6 fw-bolder" href="contact.html">Contact me</a>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>