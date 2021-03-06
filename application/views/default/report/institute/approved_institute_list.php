<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();

?>
<div id="system_content" class="system_content_margin">
    <div class="col-lg-4">
        <?php
        $CI->load_view("report/report_menus");
        ?>

    </div>
    <div class="col-lg-8">


        <form class="report_form" id="system_save_form" action="<?php echo $CI->get_encoded_url('report/institute/approved_institute_report/index/list'); ?>" method="get">
            <div class="row widget">
                <div class="widget-header">
                    <div class="title">
                        <?php echo $title; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="row show-grid " id="division_option">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $CI->lang->line('DIVISION_NAME'); ?></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <select name="division" id="user_division_id" class="form-control">
                            <?php
                            $CI->load_view('dropdown',array('drop_down_options'=>$divisions,'drop_down_default_option'=>$default_divisions));
                            ?>
                        </select>
                    </div>
                </div>
                <div style="display: <?php echo $display_zillas?'block':'none'; ?>" class="row show-grid " id="zilla_option">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $CI->lang->line('DISTRICT_NAME'); ?></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <select name="zilla" id="user_zilla_id" class="form-control">
                            <?php
                            $CI->load_view('dropdown',array('drop_down_options'=>$zillas,'drop_down_default_option'=>$default_zillas));
                            ?>
                        </select>
                    </div>
                </div>
                <div style="display: <?php echo $display_upazilas?'block':'none'; ?>" class="row show-grid " id="upazila_option">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $CI->lang->line('UPAZILLA_NAME'); ?></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <select name="upazila" id="user_upazila_id" class="form-control">
                            <?php
                            $CI->load_view('dropdown',array('drop_down_options'=>$upazilas,'drop_down_default_option'=>$default_upazilas));
                            ?>
                        </select>
                    </div>
                </div>
                <!--                <div style="display: --><?php //echo $display_unions?'block':'none'; ?><!--" class="row show-grid " id="union_option">-->
                <!--                    <div class="col-xs-4">-->
                <!--                        <label class="control-label pull-right">--><?php //echo $CI->lang->line('UNION_NAME'); ?><!--</label>-->
                <!--                    </div>-->
                <!--                    <div class="col-sm-4 col-xs-8">-->
                <!--                        <select name="union" id="user_unioun_id" class="form-control">-->
                <!--                            --><?php
                //                            $CI->load_view('dropdown',array('drop_down_options'=>$unions,'drop_down_default_option'=>$default_unions));
                //                            ?>
                <!--                        </select>-->
                <!--                    </div>-->
                <!--                </div>-->
                <div class="row show-grid ">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $CI->lang->line('TYPE'); ?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <select name="status" id="status" class="form-control">
                            <?php
                            $report_type=array
                            (
                                array("value"=>"", "text"=>$this->lang->line('ALL')),
                                array("value"=>"1", "text"=>$this->lang->line('LEVEL_PRIMARY')),
                                array("value"=>"2", "text"=>$this->lang->line('LEVEL_SECONDARY')),
                                array("value"=>"3", "text"=>$this->lang->line('LEVEL_HIGHER')),
                            );
                            $CI->load_view('dropdown',array('drop_down_options'=>$report_type));
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row show-grid ">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $CI->lang->line('FROM_DATE'); ?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="text" required="" name="from_date" class="selectbox-1 form-control report_date" value="" />
                    </div>
                </div>
                <div class="row show-grid ">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $CI->lang->line('TO_DATE'); ?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="text" name="to_date" required="" class="selectbox-1 form-control report_date" value="" />
                    </div>
                </div>
                <div class="row show-grid">
                    <div class="col-xs-4">

                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="submit" class="btn btn-primary" value="<?php echo $CI->lang->line('SEARCH'); ?>">
                    </div>
                </div>

            </div>
        </form>
        <div class="clearfix"></div>

    </div>
    <div class="clearfix"></div>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        turn_off_triggers();
        $( ".report_date" ).datepicker({dateFormat : display_date_format});
        $(document).on("change","#user_division_id",function()
        {
            $("#union_option").hide();
            $("#upazila_option").hide();
            $("#zilla_option").show();

            //$("#user_unioun_id").val("");
            $("#user_upazila_id").val("");
            $("#user_zilla_id").val("");
            var division_id=$(this).val();
            if(division_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('common/get_zilla'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{division_id:division_id},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            else
            {
                $("#zilla_option").hide();

            }
        });
        $(document).on("change","#user_zilla_id",function()
        {
            $("#union_option").hide();
            $("#upazila_option").show();


            //$("#user_unioun_id").val("");
            $("#user_upazila_id").val("");

            var zilla_id=$(this).val();
            if(zilla_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('common/get_upazila'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{zilla_id:zilla_id},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            else
            {

                $("#upazila_option").hide();
            }
        });
        <!--        $(document).on("change","#user_upazila_id",function()-->
        <!--        {-->
        <!--            $("#union_option").show();-->
        <!--            $("#user_union_id").val("");-->
        <!--            var zilla_id=$("#user_zilla_id").val();-->
        <!--            var upazila_id=$(this).val();-->
        <!--            if(upazila_id>0)-->
        <!--            {-->
        <!--                $.ajax({-->
        <!--                    url: '--><?php //echo $CI->get_encoded_url('common/get_union'); ?><!--',-->
        <!--                    type: 'POST',-->
        <!--                    dataType: "JSON",-->
        <!--                    data:{zilla_id:zilla_id, upazila_id:upazila_id},-->
        <!--                    success: function (data, status)-->
        <!--                    {-->
        <!---->
        <!--                    },-->
        <!--                    error: function (xhr, desc, err)-->
        <!--                    {-->
        <!--                        console.log("error");-->
        <!---->
        <!--                    }-->
        <!--                });-->
        <!--            }-->
        <!--            else-->
        <!--            {-->
        <!--                $("#union_option").hide();-->
        <!--            }-->
        <!--        });-->
    });
</script>