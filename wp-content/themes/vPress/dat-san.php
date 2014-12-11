<?php
/*
 * Template Name: Đặt Giờ Sân Bóng
 */
?>
<!doctype html>
<html lang="us">
<head>
	<meta charset="utf-8">
	<title>Đặt Giờ Sân Bóng</title>

    <link rel='stylesheet'  href='<?php echo get_template_directory_uri() . '/modulesanbong/css/jquery-ui.css' ?>' type='text/css' media='all' />
    <link rel='stylesheet'  href='<?php echo get_template_directory_uri() . '/modulesanbong/css/custom.css' ?>' type='text/css' media='all' />

    <script src="<?php echo get_template_directory_uri() . '/modulesanbong/js/jquery-1.10.2.js' ?>"></script>
    <script src="<?php echo get_template_directory_uri() . '/modulesanbong/js/jquery-ui.min.js' ?>"></script>

    <script>
        jQuery(function ($)
        {
            $.datepicker.regional["vi-VN"] =
            {
                closeText: "Đóng",
                prevText: "Trước",
                nextText: "Sau",
                currentText: "Hôm nay",
                monthNames: ["Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"],
                monthNamesShort: ["Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín", "Mười", "Mười một", "Mười hai"],
                dayNames: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
                dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
                dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                weekHeader: "Tuần",
                dateFormat: "dd/mm/yy",
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ""
            };

            $.datepicker.setDefaults($.datepicker.regional["vi-VN"]);
        });
    </script>
</head>
<body>
<?php if (have_posts()) : while (have_posts()) : the_post();?>
<div id="datsan-wrapper">
    <div class="col-left">
        <form id="dat-san" action="" method="post">
        <div id="step-stadium">
            <div class="step-content">
                <h1 class="">Mời Bạn Chọn Sân:</h1>
                <div class="list">
                    <?php
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
                    foreach($sans as $san):
                        $loaisan = 'Sân cỏ';
                        $_loai = get_post_meta($san->ID, 'loai_san', true);
                        if($_loai=='sandat'){
                            $loaisan = 'Sân đất';
                        }
                    ?>
                        <a class="btn-box-san" href="javascript:void(0)" value="<?php echo $san->ID ?>" loaisan="<?php echo $loaisan ?>" onclick="chonSan($(this))">
                            <img style="width: 100%; height: 170px" src="<?php echo get_template_directory_uri() . '/modulesanbong/css/images/san-bong.jpg' ?>" alt="" />
                            <span class="san-title"><?php echo $san->post_title .' - '. $loaisan; ?></span>
                        </a>
                    <?php
                    endforeach;
                    endif; ?>
                </div>
                <div class="clear"></div>
                <div class="show-selected" style="display: none;">
                    <span>Sân đã chọn: </span><span id="show-san">Chưa chọn</span>
                </div>
                <input type="hidden" id="so-san" name="so_san" value="0" messerr="Vui lòng chọn Sân để tiếp tục." />
            </div>
<!--            <div class="action">-->
<!--                <button class="btn next-step" type="button" onclick="nextStep($('#so-san'),$('#step-stadium'),$('#step-date'))">Tiếp Tục</button>-->
<!--            </div>-->
            <div class="clear"></div>
        </div>
        <div id="step-date" style="display: none;">
            <div class="step-content">
                <h1 class="">Mời Bạn Chọn Ngày:</h1>
                <div id="dateselect"></div>
                <div class="clear"></div>
                <div class="show-selected">
                    <span>Ngày đã chọn: </span><span id="show-date">Chưa chọn</span>
                </div>
                <input type="hidden" id="ngay-thang" name="ngay_thang" value="" messerr="Vui lòng chọn Ngày để tiếp tục" />
            </div>
            <div class="action">
                <button class="btn prev-step" type="button" onclick="backStep($('#step-stadium'),$('#step-date'))">Quay lại</button>
                <button class="btn next-step" type="button" onclick="nextStep($('#ngay-thang'),$('#step-date'),$('#step-time'))">Tiếp Tục</button>
            </div>
            <div class="clear"></div>
        </div>
        <div id="step-time" style="display: none;">
            <h1 class="">Mời Bạn Chọn Khung Giờ:</h1>
            <div class="step-time-content">
                <a href="javascript:void(0)" id="chon-gio-bd" class="hien-thi-gio" onclick="hienThiGio($('#start-time-wrap'))">
                    Giờ bắt đầu :<br/>
                    <span id="show-bd">Click để chọn</span>
                </a>
                <a href="javascript:void(0)" id="chon-gio-kt" class="hien-thi-gio" onclick="hienThiGio($('#end-time-wrap'))">
                    Giờ kết thúc :<br/>
                    <span id="show-kt">Click để chọn</span>
                </a>
                <div class="clear"></div>
            </div>
            <div id="start-time-wrap" class="select-time-content" style="display: none;">
                <?php
                date_default_timezone_set("Asia/Ho_Chi_Minh");
                $start=strtotime('00:00');
                $end=strtotime('23:30');
                $localtime = localtime(time(),true);
                $nowstr = $localtime['tm_hour'].':'.$localtime['tm_min'];
                $now = strtotime($nowstr);
                for ($i=$start;$i<=$end;$i = $i + 30*60)
                {
                ?>
                    <a class="btn-box-gio" href="javascript:void(0)" value="<?php echo date('H:i',$i) ?>" onclick="chonGio($(this),$('#gio-bd'),$('#start-time-wrap'),$('#show-bd'));">
                    <?php echo date('H:i',$i) ?>
                    </a>
                <?php
                }
                ?>
                <div class="clear"></div>
                <button type="button" class="btn" style="margin: 10px auto;" onclick="closeElement($('#start-time-wrap'))">Đóng</button>
            </div>
            <div id="end-time-wrap" class="select-time-content" style="display: none;">
                <?php
                date_default_timezone_set("Asia/Ho_Chi_Minh");
                $start=strtotime('00:00');
                $end=strtotime('23:30');
                $localtime = localtime(time(),true);
                $nowstr = $localtime['tm_hour'].':'.$localtime['tm_min'];
                $now = strtotime($nowstr);
                for ($i=$start;$i<=$end;$i = $i + 30*60)
                {
                    ?>
                    <a class="btn-box-gio"  href="javascript:void(0)" value="<?php echo date('H:i',$i) ?>" onclick="chonGio($(this),$('#gio-kt'),$('#end-time-wrap'),$('#show-kt'));">
                        <?php echo date('H:i',$i) ?>
                    </a>
                <?php
                }
                ?>
                <div class="clear"></div>
                <button  type="button" class="btn" style="margin: 10px auto;" onclick="closeElement($('#end-time-wrap'))">Đóng</button>
            </div>
            <input type="hidden" id="gio-bd" name="gio_bd" value="" messerr="Vui lòng chọn Khung giờ để tiếp tục" />
            <input type="hidden" id="gio-kt" name="gio_kt" value="" messerr="Vui lòng chọn Khung giờ để tiếp tục" />
            <div class="action">
                <button class="btn prev-step" type="button" onclick="backStep($('#step-date'),$('#step-time'))">Quay lại</button>
                <button class="btn next-step" type="button" onclick="ktraKhungGio()">Tiếp Tục</button>
            </div>
            <div class="clear"></div>
        </div>
        <div id="step-info" style="display: none;">
            <h1>Vui điền thông tin liên hệ của bạn:</h1>
            <div class="info-content">
                <table border="0" style="margin:0 auto;">
                    <tr>
                        <td style="width: 30%;" align="right"><label for="ho_ten">Họ và tên <em>*</em></label></td>
                        <td><input type="text" id="ho_ten" class="form-input" name="ho_ten" placeholder="Họ tên" />
                            <br/><span id="errHT" class="err">Vui lòng nhập họ tên</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 30%;" align="right"><label for="dien_thoai">Số điện thoại <em>*</em></label></td>
                        <td><input type="text" id="dien_thoai" class="form-input" name="dien_thoai" placeholder="Điện thoại" />
                            <br/><span id="errDT" class="err">Vui lòng nhập số điện thoại</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 30%;" align="right"><label for="email">Email</label></td>
                        <td><input type="text" id="email" class="form-input" name="email" placeholder="Email" /></td>
                    </tr>
                    <tr>
                        <td style="width: 30%;" align="right"><label for="dia_chi">Địa chỉ</label></td>
                        <td><input type="text" id="dia_chi" class="form-input" name="dia_chi" placeholder="Địa chỉ" /></td>
                    </tr>
                    <tr>
                        <td style="width: 30%;" align="right"><label for="ghi_chu">Ghi chú</label></td>
                        <td>
                            <textarea class="form-area" id="ghi_chu" name="ghi_chu" cols="50" rows="5"></textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="action">
                <button class="btn prev-step" type="button" onclick="backStep($('#step-time'),$('#step-info'))">Quay lại</button>
                <button class="btn next-step" type="button" onclick="submitForm()">Đặt Sân</button>
            </div>
        </div>
    </form>
    </div>
    <div class="col-right">

    </div>
</div>
<div id="over-loading" style="display: none;">
    <img src="<?php echo get_template_directory_uri() . '/modulesanbong/css/images/loading.gif' ?>" alt="" />
</div>
    <script>
        $(document).ready(function() {
            $( "#dateselect" ).datepicker({
                'dateFormat':'dd/mm/yy',
                'minDate' : 0,
                onSelect: function(selected,evnt) {
                    var date = $(this).datepicker('getDate');
                    var dayOfWeek = date.getUTCDay();
                    var day = getDayVN(dayOfWeek);
                    chonNgay(selected,day);
                }
            });
        }); // End: $(document).ready()

        function submitForm(){

            var checkHT = true;
            var checkDT = true;
            if($('#ho_ten').val()==''){
                checkHT = false;
            }
            if($('#dien_thoai').val()==''){
                checkDT = false;
            }
            if(!checkHT){
                $('#errHT').show('slow');
            }else{
                $('#errHT').hide();
            }
            if(!checkDT){
                $('#errDT').show('slow');
            }else{
                $('#errDT').hide();
            }
            var checkSubmid = checkHT = checkDT;
        }

        function chonSan(el){
            $('#so-san').val(el.attr('value'));
            $('#show-san').html('Sân '+el.attr('value')+' - Loại sân: '+el.attr('loaisan'));
            nextStep($('#so-san'),$('#step-stadium'),$('#step-date'));
        }
        function chonNgay(value,day){
            $('#ngay-thang').val(value);
            $('#show-date').html(day +' - '+value);
        }
        function chonGio(elGet,elSet,elC,elShow){
            $(elSet).val(elGet.attr('value'));
            elShow.html(elSet.val());
            elC.hide();
        }
        function ktraKhungGio(){
            if($('#gio-bd').val()=='' || $('#gio-kt').val()==''){
                alert('Vui chọn khung giờ!');
                return;
            }
            var startT = $('#gio-bd').val().split(":");
            var startE = $('#gio-kt').val().split(":");
            var today = new Date();
            var reservStart = new Date(today.getFullYear(),today.getMonth(),today.getDate(),startT[0],startT[1]);
            var reservEnd = new Date(today.getFullYear(),today.getMonth(),today.getDate(),startE[0],startE[1]);
            var res = reservEnd - reservStart;
            if(reservStart-today<0){
                alert('Thời gian bắt đầu không hợp lệ. Vui lòng chọn lại!');
                return;
            }
            if(res<0){
                alert('Thời gian kết thúc không hợp lệ. Vui lòng chọn lại!');
                return;
            }
            if(res<3600000){
                alert('Thời gian tối thiểu để đặt là 1 giờ. Vui lòng chọn lại!');
                return;
            }
            $('#over-loading').show();
            setTimeout(function(){
                $('#step-time').hide();
                $('#step-info').show('slow');
                $('#over-loading').hide();
            },1000);
        }
        function nextStep(elVal,elHide,elShow){
            if(elVal.val()=='' || elVal.val()==0){
                alert(elVal.attr('messerr'));
                return;
            }
            $('#over-loading').show();
            setTimeout(function(){
                elHide.hide();
                elShow.show('slow');
                $('#over-loading').hide();
            },2000);
        }
        function backStep(elShow,elHide){
            $('#over-loading').show();
            setTimeout(function(){
                elHide.hide();
                elShow.show('slow');
                $('#over-loading').hide();
            },2000);
        }
        function hienThiGio(el){
            $('#over-loading').show();
            setTimeout(function(){
                el.show();
                $('#over-loading').hide();
            },1000);
        }
        function closeElement(el){
            el.hide();
        }

        function getDayVN(val){
            var dayVn = '';
            switch(val){
                case 0:
                    dayVn = 'Thứ hai';
                    break;
                case 1:
                    dayVn = 'Thứ ba';
                    break;
                case 2:
                    dayVn = 'Thứ tư';
                    break;
                case 3:
                    dayVn = 'Thứ năm';
                    break;
                case 4:
                    dayVn = 'Thứ sáu';
                    break;
                case 5:
                    dayVn = 'Thứ bảy';
                    break;
                case 6:
                    dayVn = 'Chủ nhật';
                    break;
                default :
                    dayVn = '';
                    break;
            }
            return dayVn;
        }
    </script>
<?php
endwhile;
endif;
?>
</body>
</html>