<?php
/**
 * Tạo posttype Quản lý danh sách lịch đặt sân
 *
 * @author Nguyễn Đình Hiếu - ndhieu8x@gmail.com
 *
 * */
function ndh_lichdat_post_type() {

    // Post Type Labels
    $labels = array(
        'name' => _x('Quản lý Lịch đặt', 'post type general name', ''),
        'singular_name' => _x('Lịch đặt', 'post type singular name', ''),
        'menu_name' => _x('Module Đặt Sân - Quản lý Lịch đặt', 'admin menu', ''),
        'name_admin_bar' => _x('Quản Lý Lịch đặt', 'add new on admin bar', ''),
        'add_new' => _x('Tạo Mới Lịch đặt', 'sanbong', ''),
        'add_new_item' => __('Tạo Mới Lịch đặt', ''),
        'new_item' => __('Tạo Mới', ''),
        'edit_item' => __('Sửa', ''),
        'view_item' => __('Xem', ''),
        'all_items' => __('Tất Cả Lịch đặt', ''),
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
    register_post_type('lichdat', $args);
}

// Hook into Init and register post type
add_action('init', 'ndh_lichdat_post_type', 2);


if(is_admin()){
    wp_enqueue_script('admin_jquery', get_bloginfo('template_url').'/modulesanbong/js/jquery-1.10.2.js', array('jquery'));
    wp_enqueue_script('admin_jquery_ui', get_bloginfo('template_url').'/modulesanbong/js/jquery-ui.min.js', array('admin_jquery'));
    add_action( 'admin_enqueue_scripts', 'load_admin_styles' );
    function load_admin_styles() {
        wp_enqueue_style('admin_jquery_css', get_template_directory_uri().'/modulesanbong/css/jquery-ui.css', false, '1.0.0');
    }
}

// Thêm Custom field
add_action('add_meta_boxes', 'boot_add_lichdat_customfield_meta');
function boot_add_lichdat_customfield_meta()
{
    add_meta_box('san', 'Thông tin đặt sân', 'show_san_meta', 'lichdat');
}
// Hiện chọn Loại sân trong admin
function show_san_meta()
{
    global $post;
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $options = array();
    $type = 'sanbong';
    $args=array(
        'post_type' => $type,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'caller_get_posts'=> 1,
        'orderby ' => 'ID',
        'order'    => 'ASC'
    );
    $sanbongQuery = new WP_Query($args);
    $sans = $sanbongQuery->posts;
    if(count($sans)>0):
        foreach($sans as $postsan):
            $options[] = array('value' => $postsan->ID, 'text' => $postsan->post_title);
        endforeach;
    endif;
    $sanV = get_post_meta($post->ID, 'san', true);
    $hoten = get_post_meta($post->ID, 'ho_ten', true);
    $dt = get_post_meta($post->ID, 'dien_thoai', true);
    $email = get_post_meta($post->ID, 'email', true);
    $diachi = get_post_meta($post->ID, 'dia_chi', true);
    $ghi_chu = get_post_meta($post->ID, 'ghi_chu', true);
    $ngaydat = get_post_meta($post->ID, 'ngay_dat', true);
    $giobatdau = get_post_meta($post->ID, 'gio_bat_dau', true);
    $gioketthuc = get_post_meta($post->ID, 'gio_ket_thuc', true);
    $tong_tien = get_post_meta($post->ID, 'tong_tien', true);
    $thanh_toan = get_post_meta($post->ID, 'thanh_toan', true);
    echo '<table style="width: 80%;">';
    ?>
    <script type="text/javascript">
        function formatDollar(num) {
            return num.split("").reverse().reduce(function (acc, num, i, orig) {
                return num + (i && !(i % 3) ? "." : "") + acc ;
            }, "");
        }
    </script>
    <?php
    echo '<tr>';
    echo '<td style="width:20%;"><label for="ho_ten">';
    _e('Họ tên: ', 'myplugin_textdomain');
    echo '</label></td>';
    echo '<td><input type="text" id="ho_ten" name="ho_ten" style="width:250px" value="'.$hoten.'" /></td>';
    echo '</tr><tr>';
    echo '<td style="width:20%;"><label for="dien_thoai">';
    _e('Điện thoại: ', 'myplugin_textdomain');
    echo '</label></td>';
    echo '<td><input type="text" id="dien_thoai" name="dien_thoai" style="width:250px" value="'.$dt.'" /></td>';
    echo '</tr><tr>';
    echo '<td style="width:20%;"><label for="email">';
    _e('Email: ', 'myplugin_textdomain');
    echo '</label></td>';
    echo '<td><input type="text" id="email" name="email" style="width:250px" value="'.$email.'" /></td>';
    echo '</tr><tr>';
    echo '<td style="width:20%;"><label for="dia_chi">';
    _e('Địa chỉ: ', 'myplugin_textdomain');
    echo '</label></td>';
    echo '<td><input type="text" id="dia_chi" name="dia_chi" style="width:250px" value="'.$diachi.'" /></td>';
    echo '</tr><tr>';
    echo '<td style="width:20%;"><label for="san">';
    _e('Sân: ', 'myplugin_textdomain');
    echo '</label></td>';
    echo '<td>';
    echo '<select name="san" id="san">';
    foreach ($options as $option) {
        if($option['value']==$sanV){
            echo '<option selected value="' . $option['value'] . '">' . $option['text'] . '</option>';
        }else{
            echo '<option value="' . $option['value'] . '">' . $option['text'] . '</option>';
        }
    }
    echo '</select>';
    echo '</td>';
    echo '</tr><tr>';
    echo '<td style="width:20%;"><label for="ngay_dat">';
    _e('Ngày đặt: ', 'myplugin_textdomain');
    echo '</label></td>';
    echo '<td><input type="text" id="ngay_dat" name="ngay_dat" style="width:250px" value="'.$ngaydat.'" /></td>';
    echo '</tr><tr>';
    echo '<td style="width:20%;"><label for="gio_bat_dau">';
    _e('Giờ bắt đầu: ', 'myplugin_textdomain');
    echo '</label></td>';
    echo '<td>';
    echo '<select name="gio_bat_dau" id="gio_bat_dau">';
        $start=strtotime('00:00');
        $end=strtotime('23:30');
        for ($i=$start;$i<=$end;$i = $i + 30*60)
        {
            if($i==$giobatdau){
                echo '<option selected value="' . $i . '">' . date('H:i',$i) . '</option>';
            }else{
                echo '<option value="' . $i . '">' . date('H:i',$i) . '</option>';
            }
        }
    echo '</select>';
    echo '</td>';
    echo '</tr><tr>';
    echo '<td style="width:20%;"><label for="gio_ket_thuc">';
    _e('Giờ kết thúc: ', 'myplugin_textdomain');
    echo '</label></td>';
    echo '<td>';
    echo '<select name="gio_ket_thuc" id="gio_ket_thuc">';
    $start=strtotime('00:00');
    $end=strtotime('23:30');
    for ($i=$start;$i<=$end;$i = $i + 30*60)
    {
        if($i==$gioketthuc){
            echo '<option selected value="' . $i . '">' . date('H:i',$i) . '</option>';
        }else{
            echo '<option value="' . $i . '">' . date('H:i',$i) . '</option>';
        }
    }
    echo '</select>';
    echo '</td>';
    echo '</tr><tr>';
    echo '<td style="width:20%;"><label for="tong_tien">';
    _e('Tổng tiền: ', 'myplugin_textdomain');
    echo '</label></td>';
    echo '<td><input onkeyup="displayPrice(this.value)" type="text" id="tong_tien" name="tong_tien" style="width:250px" value="'.$tong_tien.'" />';
    echo '<span id="dis_Price" style="font-weight:bold;color:Red;">'.$nombre_format_francais = number_format($tong_tien, 0, ',', '.').'</span><span style="font-weight:bold;color:Red;"> VNĐ</span>';
    echo '</td>';
    ?>
    <script type="text/javascript">
        function displayPrice(val){
            if(val.length>0){
                document.getElementById('dis_Price').innerHTML = formatDollar(val);
            }else{
                document.getElementById('dis_Price').innerHTML = 0;
            }
        }
        $(document).ready(function() {
            $( "#ngay_dat" ).datepicker({
                'dateFormat':'dd/mm/yy'
            });
        });
    </script>
    <?php
    echo '</tr><tr>';
    echo '<td style="width:20%;"><label for="ghi_chu">';
    _e('Ghi chú: ', 'myplugin_textdomain');
    echo '</label></td>';
    echo '<td><textarea type="text" id="ghi_chu" name="ghi_chu" cols="60" rows="10" />'.$ghi_chu.'</textarea></td>';
    echo '</tr><tr>';
    echo '<td style="width:20%;"><label for="thanh_toan">';
    _e('Trạng thái: ', 'myplugin_textdomain');
    echo '</label></td>';
    echo '<td>';
    echo '<select name="thanh_toan" id="thanh_toan">';
    echo $thanh_toan==1 ? '<option selected value="1">Đã thanh toán</option>' : '<option value="1">Đã thanh toán</option>';
    echo $thanh_toan==0 ? '<option selected value="0">Chưa thanh toán</option>' : '<option value="0">Chưa thanh toán</option>';
    echo '</select>';
    echo '</td>';
    echo '</tr><tr>';
    echo '</table>';
}
// Lưu loại sân khi save
add_action('save_post', 'boot_save_san_meta');
function boot_save_san_meta($post_id)
{
    global $post;
    // Prevent saving Post Meta on Autosaves.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post->ID;
    }
    // Update Each Post Meta Key
    if($post){
        update_post_meta($post->ID, 'san', $_POST["san"]);
        update_post_meta($post->ID, 'ho_ten', $_POST["ho_ten"]);
        update_post_meta($post->ID, 'dien_thoai', $_POST["dien_thoai"]);
        update_post_meta($post->ID, 'email', $_POST["email"]);
        update_post_meta($post->ID, 'dia_chi', $_POST["dia_chi"]);
        update_post_meta($post->ID, 'ghi_chu', $_POST["ghi_chu"]);
        update_post_meta($post->ID, 'ngay_dat', $_POST["ngay_dat"]);
        update_post_meta($post->ID, 'gio_bat_dau', $_POST["gio_bat_dau"]);
        update_post_meta($post->ID, 'gio_ket_thuc', $_POST["gio_ket_thuc"]);
        update_post_meta($post->ID, 'tong_tien', $_POST["tong_tien"]);
        update_post_meta($post->ID, 'thanh_toan', $_POST["thanh_toan"]);
    }
}