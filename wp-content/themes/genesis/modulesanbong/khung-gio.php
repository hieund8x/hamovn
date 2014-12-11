<?php
/**
 * Tạo posttype Quản lý khung giờ
 *
 * @author Nguyễn Đình Hiếu - ndhieu8x@gmail.com
 *
 * */
function ndh_khunggio_post_type() {

    // Post Type Labels
    $labels = array(
        'name' => _x('Quản lý Khung Giờ', 'post type general name', ''),
        'singular_name' => _x('Khung Giờ', 'post type singular name', ''),
        'menu_name' => _x('Module Đặt Sân - Quản lý Khung Giờ', 'admin menu', ''),
        'name_admin_bar' => _x('Quản Lý Khung Giờ', 'add new on admin bar', ''),
        'add_new' => _x('Tạo Mới Khung Giờ', 'khunggio', ''),
        'add_new_item' => __('Tạo Mới Khung Giờ', ''),
        'new_item' => __('Tạo Mới', ''),
        'edit_item' => __('Sửa', ''),
        'view_item' => __('Xem', ''),
        'all_items' => __('Tất Cả Khung Giờ', ''),
        'search_items' => __('Tìm', ''),
        'parent_item_colon' => __('Parent:', ''),
        'not_found' => __('Không có dữ liệu.', ''),
        'not_found_in_trash' => __('Không có dữ liệu trong Thùng rác.', ''),
    );


    // Remove front from rewrites.
    $rewrites = array('with_front' => true);


    // Main post-type arguments
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'taxonomies' => array(),
        'query_var' => true,
        'rewrite' => $rewrites,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
    );


    // Register post-type with args
    register_post_type('khunggio', $args);
}

// Hook into Init and register post type
add_action('init', 'ndh_khunggio_post_type', 2);
