<?php

get_header();
?>

<main class="container-fluid">
    
    <div class="container">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>
                <h1><?php the_title(); ?></h1> <!-- Page Title -->
                <div class="text-center"><?php the_post_thumbnail(array(500,500)); ?></div>
                <!-- we can use get_the_content(); -->
                <div><?php the_content(); ?></div> <!-- Page Content --> 
                
            <?php endwhile;
        endif;
        ?>
    </div>
    
</main>


<?php

get_footer();


?>