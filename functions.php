<?php

// load bootstrap only for contact form submissions page 
function enqueue_bootstrap_for_contact_submissions($hook) {
    // Load Bootstrap only for the "Contact Form Submissions" admin page
    if ($hook === 'toplevel_page_contact-form-submissions') {  
        wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
        wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', [], false, true);
    }
}
add_action('admin_enqueue_scripts', 'enqueue_bootstrap_for_contact_submissions');



// register menus
function custom_register_menus() {
    register_nav_menus([
        'primary' => __('Primary Menu', 'custom-theme'), // Main Navigation
        'footer'  => __('Footer Menu', 'custom-theme')   // Footer Navigation
    ]);
}

add_action('after_setup_theme', 'custom_register_menus');

add_theme_support('post-thumbnails'); // to add featured image option in wp admin

add_theme_support('custom-header'); // to add header option in admin

register_sidebar(
    array(
        'name'=>'Sidebar Location',
        'id'=>'sidebar',
        'description'=>"This is Sidebar",
    )
);

add_theme_support('custom-background');

// function to create table in database

function create_contact_form_table(){
    global $wpdb;
    $table_name=$wpdb->prefix . "contact_form";

    $charset_collate=$wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(12) NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
add_action('after_setup_theme', 'create_contact_form_table');

function contact_form_admin_menu() {
    add_menu_page(
        'Contact Form Submissions',  // Page title
        'Contact Submissions',       // Menu title
        'manage_options',            // Capability (only admins can access)
        'contact-form-submissions',  // Menu slug
        'display_contact_form_submissions', // Function to display content
        'dashicons-email',           // Icon for menu
        20                           // Position in the menu
    );
}
add_action('admin_menu', 'contact_form_admin_menu');

// fetch and display the contact details

function display_contact_form_submissions() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form';

    $selected_email = isset($_GET['email']) ? sanitize_text_field($_GET['email']) : '';
    $selected_date = isset($_GET['date']) ? sanitize_text_field($_GET['date']) : '';
    $selected_name = isset($_GET['name']) ? sanitize_text_field($_GET['name']) : '';

    $query = "SELECT * FROM $table_name WHERE 1=1";

    if (!empty($selected_email)) {
        $query .= $wpdb->prepare(" AND email = %s", $selected_email);
    }
    if (!empty($selected_name)) {
        $query .= $wpdb->prepare(" AND name LIKE %s", '%' . $selected_name . '%');
    }    
    if (!empty($selected_date)) {
        $query .= $wpdb->prepare(" AND DATE(created_at) = %s", $selected_date);
    }

    $results = $wpdb->get_results($query);
    // $emails = $wpdb->get_col("SELECT DISTINCT email FROM $table_name");

    ?>
        <div class="wrap container mt-4">
            <h1 class="mb-4">Contact Form Submissions</h1>

            <!-- 🔹 Filter Form -->
            <form method="GET" class="row g-3 mb-4">
                <input type="hidden" name="page" value="contact-form-submissions">
                
                <div class="col-md-4">
                    <label for="name" class="form-label">Filter by Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Filter By Name" 
                            value="<?php echo esc_attr($selected_name); ?>">
                </div>

                <div class="col-md-4">
                    <label for="date" class="form-label">Filter by Date:</label>
                    <input type="date" name="date" class="form-control" value="<?php echo esc_attr($selected_date); ?>">
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-success me-2">Filter</button>
                    <a href="?page=contact-form-submissions" class="btn btn-danger">Reset</a>
                </div>
            </form>

            <!-- 🔹 Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Phone</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($results) : ?>
                            <?php foreach ($results as $row) : ?>
                                <tr>
                                    <td><?php echo esc_html($row->name); ?></td>
                                    <td><?php echo esc_html($row->email); ?></td>
                                    <td><?php echo esc_html($row->message); ?></td>
                                    <td><?php echo esc_html($row->phone); ?></td>
                                    <td><?php echo esc_html($row->created_at); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center">No submissions found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    
}


// add some styling
function admin_custom_styles() {
    echo '<style>
        .wp-list-table th, .wp-list-table td {
            padding: 10px;
        }
    </style>';
}
add_action('admin_head', 'admin_custom_styles');


function load_cdn_jquery() {
    if (!is_admin()) { // Only load jQuery on frontend
        wp_deregister_script('jquery'); // Remove default WordPress jQuery
        wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', [], '3.7.1', false); 
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'load_cdn_jquery');

function enqueue_custom_scripts() {
    wp_enqueue_script(
        'custom-js',
        get_template_directory_uri() . '/assets/js/script.js', // Ensure this path is correct
        ['jquery'], // Ensure jQuery loads first
        null,
        true
    );

    // Pass AJAX URL to script.js
    wp_localize_script('custom-js', 'ajaxurl', admin_url('admin-ajax.php')); // ✅ Correct format
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


// code to submit forms
function submit_contact_form(){
    global $wpdb;

    $name=sanitize_text_field($_POST['name']);
    $email=sanitize_text_field($_POST['email']);
    $phone=sanitize_text_field($_POST['phone']);
    $message=sanitize_text_field($_POST['message']);

    // basic validation
    if(empty($name) || empty($email) || empty($phone) || empty($message)){
        wp_send_json([
            'status'=>'error',
            'data'=>'All fields are required',
        ]);
    }

    $table_name=$wpdb->prefix . "contact_form";
    $wpdb->insert($table_name,[
        'name'=>$name,
        'email'=>$email,
        'phone'=>$phone,
        'message'=>$message,
    ]);

    wp_send_json([
        'status'=>'success',
        'data'=>'Form submitted successfulyy'
    ]);
}
// Register AJAX actions for logged-in and non-logged-in users
add_action('wp_ajax_submit_contact_form', 'submit_contact_form');
add_action('wp_ajax_nopriv_submit_contact_form', 'submit_contact_form');

// custom post type
function custom_portfolio_cpt(){
    $args=[
        'label'=>__('Portfolio','textdomain'),
        'public'=>true,
        'menu_position'=>5,
        'menu_icon'=>'dashicons-portfolio',
        'supports'=>['title','editor','thumbnail','excerpt','custom-fields'],
        'has_archive'=>true,
        'rewrite'=>['slug'=>'portfolio'],
        'show_in_rest'=>true //enable gutengerg editor
    ];

    register_post_type('portfolio',$args);
}
add_action('init','custom_portfolio_cpt');

function create_portfolio_taxonomy(){
    $args=[
        'label'=>__('Portfolio Categories','textdomain'),
        'hierarchical' => true, // True for category-like, false for tag-like
        'public'       => true,
        'rewrite'      => ['slug' => 'portfolio-category'],
        'show_in_rest' => true, // Enables Gutenberg compatibility
    ];
    register_taxonomy('portfolio_category','portfolio',$args);
}

add_action('init','create_portfolio_taxonomy');

// add theme options in admin

function custom_theme_options_page(){
    add_theme_page(
        'Theme Options',          // Page Title
        'Theme Options',          // Menu Title
        'manage_options',         // Capability
        'custom-theme-options',   // Menu Slug
        'custom_theme_options_callback' // Callback function
    );
}
add_action('admin_menu','custom_theme_options_page');

function custom_theme_options_callback() {
    ?>
        <div class="wrap">
            <h1>Theme Options</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('custom_theme_options_group');
                do_settings_sections('custom-theme-options');
                submit_button();
                ?>
            </form>
        </div>
    <?php
}

function custom_theme_settings() {
    register_setting('custom_theme_options_group', 'custom_logo');
    add_settings_section('custom_theme_main', 'Main Settings', null, 'custom-theme-options');
    add_settings_field('custom_logo', 'Logo URL', 'custom_logo_callback', 'custom-theme-options', 'custom_theme_main');
}
add_action('admin_init', 'custom_theme_settings');

function custom_logo_callback() {
    $logo = get_option('custom_logo');
    echo '<input type="text" name="custom_logo" value="' . esc_attr($logo) . '" />';
}






?>