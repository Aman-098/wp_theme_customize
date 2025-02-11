<?php get_header(); ?>
<?php the_post(); ?>


<main>
    <div class="container">
        <h1><?php the_title(); ?></h1> <!-- Page Title -->
        <h6><b>Date: </b><?php echo get_the_date(); ?></h6>          
        <p><b>Author: </b><?php  the_author();; ?></h6>
        <div class="text-center"><?php the_post_thumbnail(array(500,500)); ?></div>
        <!-- we can use get_the_content(); -->
        <div><?php the_content(); ?></div> <!-- Page Content -->
        
         <div><?php comments_template(); ?></div> 
         <!-- above function to show list -->
          <!-- use comment_form() to show only comment form -->

    </div>
</main>

<?php get_footer(); ?>