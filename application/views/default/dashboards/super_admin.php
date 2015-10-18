<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();
//echo "<pre>";
//print_r($user);
//echo "</pre>";
?>
<link rel="stylesheet" href="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/css/dashboard.css">

<div id="system_content" class="system_content col-sm-12 text-center" style="margin-top: 5px;">

    <div class="system_content col-sm-2 text-center">
        <div class="shadow curved-2">
            <img src="<?php echo site_url('images/dashboard/1-48.png'); ?>" style="width: 48px; height: 48px;" />

            <br>
            <h4><?php echo $this->lang->line('NUMBER_OF_APPROVED_ALL_INSTITUTE');?>( <?php echo Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE')); ?>)</h4>
        </div>
    </div>

    <div class="system_content col-sm-2 text-center">
        <div class="shadow curved-2">
            <img src="<?php echo site_url('images/dashboard/institutional-icon.png'); ?>" style="width: 48px; height: 48px;" />

            <br>
            <h4><?php echo $this->lang->line('NUMBER_OF_APPROVED_GENERAL_INSTITUTE');?>( <?php echo Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'),'','GENERAL'); ?>)</h4>
        </div>
    </div>

    <div class="system_content col-sm-2 text-center">
        <div class="shadow curved-2">
            <img src="<?php echo site_url('images/dashboard/mosque.png'); ?>" style="width: 48px; height: 48px;" />

            <br>
            <h4><?php echo $this->lang->line('NUMBER_OF_APPROVED_MADRASHA_INSTITUTE');?>( <?php echo Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'),'','MADRASHA'); ?>)</h4>
        </div>
    </div>

    <div class="system_content col-sm-2 text-center">
        <div class="shadow curved-2">
            <img src="<?php echo site_url('images/dashboard/2-48.png'); ?>" style="width: 48px; height: 48px;" />

            <br>
            <h4><?php echo $this->lang->line('NUMBER_OF_PRIMARY_LEVEL');?>( <?php echo Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'), "PRIMARY"); ?> )</h4>
        </div>
    </div>

    <div class="system_content col-sm-2 text-center">
        <div class="shadow curved-2">
            <img src="<?php echo site_url('images/dashboard/9-48.png'); ?>" style="width: 48px; height: 48px;" />

            <br>
            <h4><?php echo $this->lang->line('NUMBER_OF_SECONDARY_LEVEL');?> ( <?php echo Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'), "SECONDARY"); ?> )</h4>
        </div>
    </div>

    <div class="system_content col-sm-2 text-center">
        <div class="shadow curved-2">
            <img src="<?php echo site_url('images/dashboard/3-48.png'); ?>" style="width: 48px; height: 48px;" />

            <br>
            <h4><?php echo $this->lang->line('NUMBER_OF_INTERMEDIATE_LEVEL');?>( <?php echo Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_ACTIVE'), "INTERMEDIATE"); ?> )</h4>
        </div>
    </div>

</div>

<br/>
<div id="system_content" class="system_content col-sm-12 text-center" style="margin-top: 5px;">

    <div class="system_content col-sm-7 text-center" style="margin-top: 5px;">
        <div id="container" style="height: 400px"></div>
    </div>

    <div class="system_content col-sm-3 text-center" style="margin-top: 5px;">
        <div id="pie_container" style="height: 400px;"></div>
    </div>

    <div class="system_content col-sm-2 text-center" style="margin-top: 5px;">

        <ul id="dashboard">

            <li colore="red">
                <div class="contenuto">
                    <span class="titolo"><?php echo $this->lang->line('INSTITUTE');?></span>
                    <span class="descrizione"><?php echo $this->lang->line('NUMBER_OF_APPLIED_INSTITUTE');?></span>
                    <span class="valore"><?php echo sprintf($CI->lang->line('TI'), Dashboard_helper::get_all_applied_institute($CI->config->item('STATUS_INACTIVE'), "")); ?></span>
                </div>
            </li>

            <li colore="yellow">
                <div class="contenuto">
                    <span class="titolo"><?php echo $this->lang->line('TOTAL');?></span>
                    <span class="descrizione"><?php echo $this->lang->line('NUMBER_OF_USERS');?></span>
                    <span class="valore"><?php echo sprintf($CI->lang->line('TI'), Dashboard_helper::get_number_of_user()); ?></span>
                </div>
            </li>

            <li colore="lime">
                <div class="contenuto">
                    <span class="titolo"><?php echo $this->lang->line('MMC_TOTAL');?></span>
                    <span class="descrizione"><?php echo $this->lang->line('NUMBER_OF_USERS');?></span>
                    <span class="valore"><?php echo sprintf($CI->lang->line('TI'), Dashboard_helper::get_number_of_mmc_user()); ?></span>
                </div>
            </li>
            <li colore="orange">
                <div class="contenuto">
                    <span class="titolo"><?php echo $this->lang->line('YESTERDAY');?></span>
                    <span class="descrizione"><?php echo $this->lang->line('NUMBER_OF_USERS');?></span>
                    <span class="valore"><?php echo sprintf($CI->lang->line('TI'), Dashboard_helper::get_number_of_mmc_user("YESTERDAY")); ?></span>
                </div>
            </li>

            <!--            <li colore="emerald">-->
            <!--                <div class="contenuto">-->
            <!--                    <span class="titolo">--><?php //echo $this->lang->line('NUMBER_OF_UNION_YESTERDAY');?><!--</span>-->
            <!--                    <span class="descrizione">কলমাকান্দা ডিজিটাল সেন্টার </span>-->
            <!--                    <!-- <span class="valore"></span>	 -->
            <!--                </div>-->
            <!--            </li>-->
        </ul>

    </div>
</div>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>-->
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
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '<?php echo $report_caption;?>'
            },
            xAxis: {
                categories: [<?php
             $index=0;
             foreach($high_chart_info as $element)
             {
                if($index==0)
                {
                    echo "'".$element['element_name']."'";
                }
                else
                {
                    echo ",'".$element['element_name']."'";
                }
                $index++;
             }
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
                    return this.x + this.series.name+ ' এর মোট নিবন্ধিত শিক্ষা প্রতিষ্ঠান ' + this.y + ' হাজার ';
                }
            },
            series:
            [
                {
                    name : ' <?php echo $report_element_caption ?>',
                    data: [<?php
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
            ?>]
            }]
        });

        //////////// PIE CHART ///////////////
        $('#pie_container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: "<?php echo $CI->lang->line('INSTITUTE') ?>"
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
                name: "Brands",
                colorByPoint: true,
                data: [{
                    name: "<?php echo $CI->lang->line('INSTITUTE_GENERAL') ?>",
                    y: <?php echo $pie_chart_info[0]['general'] ?>
                }, {
                    name: "<?php echo $CI->lang->line('INSTITUTE_MADRASHA') ?>",
                    y: <?php echo $pie_chart_info[0]['madrasha'] ?>,
                    sliced: true,
                    selected: true
                }]
            }]
        });

    });

</script>