<?php get_header(); ?>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar Section -->
    <div class="col-3">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h3>Categories</h3>
        </div>
        <div class="card-body">
         <?php get_sidebar(); ?>
        </div>
      </div>
    </div>

    <!-- Blog Posts Section -->
    <div class="col-9 ">
      <h1 class="text-center py-2 fw-bolder mb-0">
        <span class="text-gradient d-inline">Blogs</span>
      </h1>
      
      <div class="col-lg-11 col-xl-9 col-xxl-8">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <!-- Blog Post Card -->
            <div class="card overflow-hidden shadow rounded-4 border-0 mb-5">
              <div class="card-body p-0">
                <div class="d-flex align-items-center">
                  
                  <!-- Content Section -->
                  <div class="p-4 flex-grow-1">
                    <h2 class="fw-bolder"><?php the_title(); ?></h2>
                    <p><strong>Date:</strong> <?php echo get_the_date(); ?></p>
                    <p><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                  </div>

                  <!-- Featured Image -->
                  <?php if (has_post_thumbnail()) : ?>
                    <div class="flex-shrink-0">
                      <img class="img-fluid rounded" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" 
                        alt="<?php the_title_attribute(); ?>" 
                        style="max-width: 300px; height: auto; margin-right: 12px;">
                    </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          <?php endwhile; ?>

          <!-- Pagination -->
          <div class="pagination">
            <?php echo wp_pagenavi(); ?>
          </div>

        <?php else : ?>
          <p>No posts found.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>



<?php get_footer(); ?>