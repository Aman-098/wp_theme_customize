<?php
get_header();
?>

<div class="container text-center py-5">
    <h1 class="display-1 fw-bold text-danger">404</h1>
    <h2 class="fw-bolder">Oops! Page Not Found</h2>
    <p class="lead">The page you're looking for doesn't exist or has been moved.</p>
    
    <!-- Back to Home Button -->
    <a href="<?php echo home_url(); ?>" class="btn btn-primary">Go to Homepage</a>

    
</div>

<?php
get_footer();
?>
