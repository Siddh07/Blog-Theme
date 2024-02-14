<?php
/*
Template Name: Author  Form  Template
*/
get_header();

?>


<div class="custom-container">

    <div class="custom-card-wrapper">

        <div class="custom-card">

            <div class="custom-card-image">
                <?php
                // Get the user data of the admin
                $admin_user = wp_get_current_user();
                if ($admin_user) {
                    // Get the admin's avatar
                    $admin_avatar = get_avatar($admin_user->ID);

                    // Display the admin's avatar
                    echo $admin_avatar;
                }
                ?>
            </div>


            <ul class="custom-social-icons">
                <li>
                    <a href="https://www.facebook.com/">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>

                <li>
                    <a href="https://twitter.com/?lang=en">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fab fa-dribbble"></i>
                    </a>
                </li>
            </ul>

            <div class="custom-details">
                <h2><?php
                    $current_user = wp_get_current_user();
                    echo esc_html($current_user->user_login);
                    ?>
                    <br>
                    <span class="custom-job-title"> Developer</span>
                </h2>
            </div>
        </div>
    </div><!-- end custom box wrapper -->
</div><!-- END custom container -->








<div class="fre-head">
    <h2> Frequent Asked Question </h2>
</div>
<?php echo do_shortcode('[sp_easyaccordion id="190"]'); ?>

<div class="fre-head">
    <h3> Connect With Us </h3>
</div>
<?php echo do_shortcode('[cn-social-icon]') ?>



<?php get_footer(); ?>