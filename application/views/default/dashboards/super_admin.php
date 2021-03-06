<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();
//echo "<pre>";
//print_r($user);
//echo "</pre>";
$month_ini = new DateTime("first day of last month");
$month_end = new DateTime("last day of last month");
$from_date=$month_ini->format('Y-m-d');
$to_date=$month_end->format('Y-m-d');


$general_institute=Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'),'','GENERAL');
$madrasha_institute=Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'),'','MADRASHA');
$total_institute=$general_institute+$madrasha_institute;

$general_institute_primary=Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'),'PRIMARY','GENERAL');
$general_institute_secondary=Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'),'SECONDARY','GENERAL');
$general_institute_intermediate=Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'),'INTERMEDIATE','GENERAL');

$madrasha_institute_primary=Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'),'PRIMARY','MADRASHA');
$madrasha_institute_secondary=Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'),'SECONDARY','MADRASHA');
$madrasha_institute_intermediate=Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'),'INTERMEDIATE','MADRASHA');

?>

<link rel="stylesheet" href="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/css/dashboard.css">

<div id="system_content" class="system_content col-sm-12 text-center" style="margin-top: 5px;">

    <div class="system_content col-md-3 text-center">
        <div class="shadow curved-2 bg8175c7">
            <img src="<?php echo site_url('images/dashboard/1-48.png'); ?>" style="" />

            <h4><span><?php echo $this->lang->line('INSTITUTE');?></span>  </h4>
            <?php echo $this->lang->line('NUMBER_OF_APPROVED_ALL_INSTITUTE');?>: <?php echo Dashboard_helper::bn2enNumber($total_institute); ?><br />
            <?php echo $this->lang->line('NUMBER_OF_APPROVED_GENERAL_INSTITUTE');?>: <?php echo Dashboard_helper::bn2enNumber($general_institute); ?><br />
            <?php echo $this->lang->line('NUMBER_OF_APPROVED_MADRASHA_INSTITUTE');?>: <?php echo Dashboard_helper::bn2enNumber($madrasha_institute); ?><br />
        </div>
    </div>


    <div class="system_content col-md-3 text-center">
        <div class="shadow curved-2 bgd9534f">
            <img src="<?php echo site_url('images/dashboard/mmc.png'); ?>" style="" />
            <?php
            $general_primary_level=Dashboard_helper::get_mmc_use_general_level_wise('GENERAL','PRIMARY',$from_date,$to_date);
            $general_secondary_level=Dashboard_helper::get_mmc_use_general_level_wise('GENERAL','SECONDARY',$from_date,$to_date);
            $general_intermediate_level=Dashboard_helper::get_mmc_use_general_level_wise('GENERAL','INTERMEDIATE',$from_date,$to_date);

            ?>
            <h4><span><?php echo $this->lang->line('MMC_USE_GENERAL_LAST_MONTH');?></span>  </h4>
            <?php echo $this->lang->line('NUMBER_OF_PRIMARY_LEVEL');?>: <?php echo System_helper::Get_Eng_to_Bng(number_format(($general_primary_level*100)/$general_institute_primary,2)); ?> %<br />
            <?php echo $this->lang->line('NUMBER_OF_SECONDARY_LEVEL');?>: <?php echo System_helper::Get_Eng_to_Bng(number_format(($general_secondary_level*100)/$general_institute_secondary,2)); ?> %<br />
            <?php echo $this->lang->line('NUMBER_OF_INTERMEDIATE_LEVEL');?>: <?php echo System_helper::Get_Eng_to_Bng(number_format(($general_intermediate_level*100)/$general_institute_intermediate,2)); ?> %<br />
        </div>
    </div>

    <div class="system_content col-md-3 text-center">
        <div class="shadow curved-2 bgd9534f">
            <img src="<?php echo site_url('images/dashboard/mmc.png'); ?>" style="" />
            <?php
            $madrasha_primary_level=Dashboard_helper::get_mmc_use_general_level_wise('MADRASHA','PRIMARY',$from_date,$to_date);
            $madrasha_secondary_level=Dashboard_helper::get_mmc_use_general_level_wise('MADRASHA','SECONDARY',$from_date,$to_date);
            $madrasha_intermediate_level=Dashboard_helper::get_mmc_use_general_level_wise('MADRASHA','INTERMEDIATE',$from_date,$to_date);

            ?>
            <h4><span><?php echo $this->lang->line('MMC_USE_MADRASHA_LAST_MONTH');?></span>  </h4>
            <?php echo $this->lang->line('NUMBER_OF_PRIMARY_LEVEL');?>: <?php echo System_helper::Get_Eng_to_Bng(number_format(($madrasha_primary_level*100)/$madrasha_institute_primary,2)); ?> %<br />
            <?php echo $this->lang->line('NUMBER_OF_SECONDARY_LEVEL');?>: <?php echo System_helper::Get_Eng_to_Bng(number_format(($madrasha_secondary_level*100)/$madrasha_institute_secondary,2)); ?> %<br />
            <?php echo $this->lang->line('NUMBER_OF_INTERMEDIATE_LEVEL');?>: <?php echo System_helper::Get_Eng_to_Bng(number_format(($madrasha_intermediate_level*100)/$madrasha_institute_intermediate,2)); ?> %<br />
        </div>
    </div>
    <?php
    $from_date_day=date('Y-m-d',strtotime("-1 days"));
    $to_date_day=date('Y-m-d',strtotime("-1 days"));
    ?>
    <div class="system_content col-md-3 text-center">
        <div class="shadow curved-2 bg92cf5c">
            <img src="<?php echo site_url('images/dashboard/mmc.png'); ?>" style="" />
            <?php
            $general_primary_level=Dashboard_helper::get_mmc_use_general_level_wise('GENERAL','PRIMARY',$from_date_day,$to_date_day);
            $general_secondary_level=Dashboard_helper::get_mmc_use_general_level_wise('GENERAL','SECONDARY',$from_date_day,$to_date_day);
            $general_intermediate_level=Dashboard_helper::get_mmc_use_general_level_wise('GENERAL','INTERMEDIATE',$from_date_day,$to_date_day);

            ?>
            <h4><span><?php echo $this->lang->line('MMC_USE_GENERAL_LAST_DAY');?></span>  </h4>
            <?php echo $this->lang->line('NUMBER_OF_PRIMARY_LEVEL');?>: <?php echo System_helper::Get_Eng_to_Bng(number_format(($general_primary_level*100)/$general_institute_primary,2)); ?> %<br />
            <?php echo $this->lang->line('NUMBER_OF_SECONDARY_LEVEL');?>: <?php echo System_helper::Get_Eng_to_Bng(number_format(($general_secondary_level*100)/$general_institute_secondary,2)); ?> %<br />
            <?php echo $this->lang->line('NUMBER_OF_INTERMEDIATE_LEVEL');?>: <?php echo System_helper::Get_Eng_to_Bng(number_format(($general_intermediate_level*100)/$general_institute_intermediate,2)); ?> %<br />
        </div>
    </div>

    <div class="system_content col-md-3 text-center">
        <div class="shadow curved-2 bg92cf5c">
            <img src="<?php echo site_url('images/dashboard/mmc.png'); ?>" style="" />
            <?php
            $madrasha_primary_level=Dashboard_helper::get_mmc_use_general_level_wise('MADRASHA','PRIMARY',$from_date_day,$to_date_day);
            $madrasha_secondary_level=Dashboard_helper::get_mmc_use_general_level_wise('MADRASHA','SECONDARY',$from_date_day,$to_date_day);
            $madrasha_intermediate_level=Dashboard_helper::get_mmc_use_general_level_wise('MADRASHA','INTERMEDIATE',$from_date_day,$to_date_day);

            ?>
            <h4><span><?php echo $this->lang->line('MMC_USE_MADRASHA_LAST_DAY');?></span>  </h4>
            <?php echo $this->lang->line('NUMBER_OF_PRIMARY_LEVEL');?>: <?php echo System_helper::Get_Eng_to_Bng(number_format(($madrasha_primary_level*100)/$madrasha_institute_primary,2)); ?> %<br />
            <?php echo $this->lang->line('NUMBER_OF_SECONDARY_LEVEL');?>: <?php echo System_helper::Get_Eng_to_Bng(number_format(($madrasha_secondary_level*100)/$madrasha_institute_secondary,2)); ?> %<br />
            <?php echo $this->lang->line('NUMBER_OF_INTERMEDIATE_LEVEL');?>: <?php echo System_helper::Get_Eng_to_Bng(number_format(($madrasha_intermediate_level*100)/$madrasha_institute_intermediate,2)); ?> %<br />
        </div>
    </div>

</div>

<br/>
<div id="system_content" class="system_content col-sm-12 text-center" style="margin-top: 15px;">

    <div class="system_content col-sm-9 text-center borderradius" style="margin-top: 5px; background: #fef4e5">
        <div id="container" style="height: 400px"></div>
    </div>

    <div class="system_content col-sm-3 text-center " style="margin-top: 5px;">
        <div id="pie_container" class="borderradius" style="height: 400px;"></div>
    </div>


</div>
<div class="clearfix"></div>
<?php
if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_DIVISIONS');
    $report_element_caption=$CI->lang->line('DIVISION');
}
else if($user->user_group_id==$CI->config->item('A_TO_I_GROUP_ID'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_DIVISIONS');
    $report_element_caption=$CI->lang->line('DIVISION');
}
else if($user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_4'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_DIVISIONS');
    $report_element_caption=$CI->lang->line('DIVISION');
}
else if($user->user_group_id==$CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_3'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_DIVISIONS');
    $report_element_caption=$CI->lang->line('DIVISION');
}
else if($user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_3'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_DISTRICTS');
    $report_element_caption=$CI->lang->line('ZILLA');
}
elseif($user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_4'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_UPAZILLA');
    $report_element_caption=$CI->lang->line('UPAZILLA');
}
elseif($user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_3'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_UPAZILLA');
    $report_element_caption=$CI->lang->line('UPAZILLA');
}
elseif($user->user_group_id==$CI->config->item('USER_GROUP_INSTITUTE'))
{
    $report_caption='';
    $report_element_caption='';
}
else
{
    $report_caption='';
    $report_element_caption='';
}
$high_chart_info=Dashboard_helper::get_approved_institute_list();
$pie_chart_info=Dashboard_helper::get_institute_type_list();

?>

<script>
    $(function ()
    {
        //        Highcharts.theme = {
        //            colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
        //            chart: {
        //                backgroundColor: {
        //                    linearGradient: [0, 0, 500, 500],
        //                    stops: [
        //                        [0, 'rgb(255, 255, 255)'],
        //                        [1, 'rgb(240, 240, 255)']
        //                    ]
        //                },
        //            },
        //            title: {
        //                style: {
        //                    color: '#000',
        //                    font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
        //                }
        //            },
        //            subtitle: {
        //                style: {
        //                    color: '#666666',
        //                    font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
        //                }
        //            },
        //
        //            legend: {
        //                itemStyle: {
        //                    font: '9pt Trebuchet MS, Verdana, sans-serif',
        //                    color: 'black'
        //                },
        //                itemHoverStyle:{
        //                    color: 'gray'
        //                }
        //            }
        //        };
        //
        //        // Apply the theme
        //        Highcharts.setOptions(Highcharts.theme);

        $('#container').highcharts({
            chart: {
                type: 'column',
                backgroundColor: '#fef4e5',

            },
            exporting: {
                enabled: true,
            },
            credits: {
                enabled: false
            },
            title: {
                text: '<?php echo $report_caption;?> বিশ্লেষণ'
            },
            xAxis: {
                categories: [<?php
                if($high_chart_info):
             $index=0;
             $total_value=0;
             foreach($high_chart_info as $element)
             {
                $total_value+=$element['element_value'];
                $element_name = Dashboard_helper::get_div_zilla_upazilla($element['element_name']);
                if($index==0)
                {
                    echo "'".$element_name."'";
                }
                else
                {
                    echo ",'".$element_name."'";
                }
                $index++;
             }
             else:
               echo "0";
         endif;
            ?>]
            },
            yAxis : {
                title : {
                    text : '<?php echo $CI->lang->line('NUMBER');?>'
                },
                min : 0
            },
            plotOptions: {
                series: {
                    pointWidth: 35//width of the column bars irrespective of the chart size
                }
            },
            tooltip: {
                formatter: function() {
                    return this.x + this.series.name+ ' এর মোট এম এম সি ব্যবহৃত শিক্ষা প্রতিষ্ঠান ' + this.y;
                }
            },
            series:
                [
                    {
                        name : ' <?php echo $report_element_caption ?>',
                        color: '#542f6c',
                        data: [<?php
                   if($high_chart_info):
                    $index=0;
                    foreach($high_chart_info as $element)
                    {
                    if($index==0)
                    {
                    echo ($element['element_value'] ? $element['element_value'] : 0);
                    }
                    else
                    {
                    echo ",".($element['element_value'] ? $element['element_value'] : 0);
                    }
                    $index++;
                }
                else:
                echo '0';
            endif;
            ?>]
                    }]
        });

        //////////// PIE CHART ///////////////
        $('#pie_container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                backgroundColor: '#fef4e5',
            },
            credits: {
                enabled: false
            },
            title: {
                text: "<?php echo $CI->lang->line('INSTITUTE') ?> বিশ্লেষণ"
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "শিক্ষা প্রতিষ্ঠান ",
                colorByPoint: true,
                data: [{
                    name: "<b><?php echo $CI->lang->line('INSTITUTE_GENERAL') ?></b>",
                    y: <?php if(isset($pie_chart_info[0]['general'])>0) { echo $pie_chart_info[0]['general'];} else echo '0'; ?>
                }, {
                    name: "<b><?php echo $CI->lang->line('INSTITUTE_MADRASHA') ?></b>",
                    y: <?php if(isset($pie_chart_info[0]['madrasha'])>0) { echo $pie_chart_info[0]['madrasha']; } else echo '0'; ?>,
                    sliced: true,
                    selected: true
                }]
            }]
        });

    });

    //$(document).ready(function(){$("#general_primary_level").html("<?php //echo $total_value;?>");})

</script>