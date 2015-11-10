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

</style>
<?php

if(isset($page) && $page=="home_page")
{
?>
    <div class="row index_header_slider">
        <div class="col-lg-12 index_header_slider_12">
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

