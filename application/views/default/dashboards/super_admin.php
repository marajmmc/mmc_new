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

