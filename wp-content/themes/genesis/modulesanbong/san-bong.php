<?php
/**
 * Tạo posttype Quản lý sân bóng
 *
 * @author Nguyễn Đình Hiếu - ndhieu8x@gmail.com
 *
 * */
function ndh_sanbong_post_type() {

    // Post Type Labels
    $labels = array(
        'name' => _x('Quản lý Sân', 'post type general name', ''),
        'singular_name' => _x('Sân', 'post type singular name', ''),
        'menu_name' => _x('Module Đặt Sân - Quản lý Sân', 'admin menu', ''),
        'name_admin_bar' => _x('Quản Lý Sân', 'add new on admin bar', ''),
        'add_new' => _x('Tạo Mới Sân', 'sanbong', ''),
        'add_new_item' => __('Tạo Mới Sân', ''),
        'new_item' => __('Tạo Mới', ''),
        'edit_item' => __('Sửa', ''),
        'view_item' => __('Xem', ''),
        'all_items' => __('Tất Cả Sân', ''),
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
    register_post_type('sanbong', $args);
}

// Hook into Init and register post type
add_action('init', 'ndh_sanbong_post_type', 2);

// Thêm Custom field Loại Sân
add_action('add_meta_boxes', 'boot_add_sanbong_customfield_meta');
function boot_add_sanbong_customfield_meta()
{
    add_meta_box('loai-san', 'Loại Sân', 'show_loaisan_meta', 'sanbong', 'side', 'core');
}
// Hiện chọn Loại sân trong admin
function show_loaisan_meta()
{
    global $post;
    $feat = get_post_meta($post->ID, 'loai_san', true);
    echo '<label for="loai_san">';
    _e('Loại Sân: ', 'myplugin_textdomain');
    echo '</label>';
    $options = array(
        array('value' => 'sanco', 'text' => 'Sân Cỏ'),
        array('value' => 'sandat', 'text' => 'Sân đất'),
    );
    echo '<select name="loai_san" id="loai_san">';
    foreach ($options as $option) {
        if($option['value']==$feat){
            echo '<option selected value="' . $option['value'] . '">' . $option['text'] . '</option>';
        }else{
            echo '<option value="' . $option['value'] . '">' . $option['text'] . '</option>';
        }
    }
    echo '</select>';
}
// Lưu loại sân khi save
add_action('save_post', 'boot_save_loaisan_meta');
function boot_save_loaisan_meta($post_id)
{
    global $post;
    // Prevent saving Post Meta on Autosaves.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post->ID;
    }
    // Update Each Post Meta Key
    if($post){
        update_post_meta($post->ID, 'loai_san', $_POST["loai_san"]);
    }
}

// Thêm filter Loại sân
add_action( 'restrict_manage_posts', 'wpse45436_admin_posts_filter_restrict_manage_posts' );
function wpse45436_admin_posts_filter_restrict_manage_posts(){
    $type = 'sanbong';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    if ('sanbong' == $type){
        $values = array(
            'Sân cỏ' => 'sanco',
            'Sân đất' => 'sandat',
        );
        ?>
        <select name="ADMIN_FILTER_FIELD_VALUE">
            <option value=""><?php _e('Lọc Loại Sân ', '0'); ?></option>
            <?php
            $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
            foreach ($values as $label => $value) {
                printf
                (
                    '<option value="%s"%s>%s</option>',
                    $value,
                    $value == $current_v? ' selected="selected"':'',
                    $label
                );
            }
            ?>
        </select>
    <?php
    }
}

add_filter( 'parse_query', 'wpse45436_posts_filter' );
function wpse45436_posts_filter( $query ){
    global $pagenow;
    $type = 'sanbong';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if ( 'sanbong' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '') {
        $query->query_vars['meta_key'] = 'loai_san';
        $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
    }
}