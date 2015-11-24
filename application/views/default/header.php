<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
$user = User_helper::get_user();
//$modules=User_helper::get_task_module($CI->config->item('system_sidebar02'));
?>
<style>
    .index_header_slider
    {
        /*margin-left: -23px !important;*/
        /*margin-right: -15px !important;*/
        padding: 0 !important;
    }
    .index_header_slider_12
    {
        margin-left: 5px !important;
        padding: 0 !important;
    }
    .home_page_right_side_box
    {
        float: right !important;
        position: absolute;
        right: 0px;
        height: 100%;
        padding:0px !important;
    }
    .home_page_right_side_box div
    {
        border: 5px solid #F0F0F0;
        background: #FFFFFF;
        opacity: .9 ;
        height: 48%;
        margin-right: 0px !important;
        margin-bottom: 2%;
    }
</style>
<?php

if(isset($page) && $page=="home_page")
{
?>
    <div class="row index_header_slider">
        <div class="col-lg-12 index_header_slider_12">
            <div class="col-lg-3  home_page_right_side_box" >
                <div class="col-lg-12" >
                    <marquee>Multimedia Class Room</marquee>
                </div>
                <div class="col-lg-12" >
                    <marquee>মাল্টিমিডিয়া ক্লাসরুম</marquee>
                </div>
            </div>

            <img src="<?php echo base_url();?>images/home/mmc-bg.png" />
        </div>
    </div>
<?php
}
elseif(isset($page) && $page=="dashboard_page")
{
    ?>
    <div class="row index_header_slider">
        <div class="col-lg-12 index_header_slider_12">
            <!--            <img src="--><?php //echo base_url();?><!--images/home/mmc-header-dashboard.jpg" />-->
            <img src="<?php echo base_url();?>images/home/mmc-header-bg-small.png" />
        </div>
    </div>
<?php
}
else
{
?>
    <div class="row index_header_slider">
        <div class="col-lg-12 index_header_slider_12">
            <img src="<?php echo base_url();?>images/home/mmc-header-bg-small.png" />
        </div>
    </div>
<?php
}
?>

