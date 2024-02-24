<?php
/*
Plugin Name: Custom Users List
Description: Displays a list of users with specific custom field on a special page.
Version: 1.0
Author: Your Name
*/

// Shortcode to display the custom users list
function custom_users_list_shortcode($atts) {
    // Get all users with specific custom field
    $users = get_users(array(
        'meta_key' => 'show_in_editorial_page', // Replace 'custom_field_name' with the name of your custom field
        'meta_value' => 'true', // Replace 'custom_field_value' with the value of your custom field
    ));

    // Output the list of users
    $output = '<div class="custom-users-list">';
    foreach ($users as $user) {
        $output .= '<div class="user-profile">';
        // Display user profile photo
        $output .= get_avatar($user->ID);
        // Display user display name
        $output .= '<h2>' . esc_html($user->display_name) . '</h2>';
        // Display user custom field (example: social links)
        $social_links = get_user_meta($user->ID, 'social_links', true); // Replace 'social_links' with the name of your custom field for social links
        $output .= '<p>Social Links: ' . esc_html($social_links) . '</p>';
        // Display user bio
        $output .= '<p>Bio: ' . esc_html(get_user_meta($user->ID, 'description', true)) . '</p>';
        $output .= '</div>';
    }
    $output .= '</div>';

    return $output;
}
add_shortcode('custom_users_list', 'custom_users_list_shortcode');
