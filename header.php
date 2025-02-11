<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php bloginfo('name'); ?><?php wp_title(); ?><?php if (is_front_page()){ echo " | "; bloginfo('description'); }?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="<?= get_template_directory_uri()?>/assets/images/favicon.ico" />
        <!-- Custom Google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?= get_template_directory_uri()?>/assets/css/styles.css" rel="stylesheet" />
       
        <?php wp_head(); ?>
    </head>

    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
        <div class="container px-5">
            <?php
            $logoimg = get_header_image(); // Get custom header image
            ?>
            <a class="navbar-brand" href="<?= home_url(); ?>">
                <img src="<?= esc_url($logoimg); ?>" alt="logo" class="img-fluid rounded" width="120" height="auto">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse " style="display:flex;justify-content:end;" id="navbarSupportedContent">
                //primary-menu 
               

            </div>
        </div>
    </nav> -->

    <div class="container bg text-white mt-3 w-50 text-white d-flex justify-content-around  align-items-center">
        <div class="d-flex align-items-center ">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'custom-menu m-0',  
                'fallback_cb'    => false,  
                'depth'          => 2,
            ]);
            ?>
        </div>
        <span class="divider"></span>
        <div class="buttons">
            <a href="<?php echo site_url('/contact'); ?>" class="btn btn-primary ms-3 px-4 py-2">Contact</a>
        </div>

        
    </div>

