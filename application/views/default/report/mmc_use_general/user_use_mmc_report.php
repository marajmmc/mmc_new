<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$pdf_link="http://".$_SERVER['HTTP_HOST'].str_replace("/list","/pdf",$_SERVER['REQUEST_URI']);
//echo "<pre>";
//print_r($reports);
//echo "</pre>";
?>
<html lang="en">
    <head>
        <title>send title from language file</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templates/default/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="main_container">
                <div class="row show-grid hidden-print">
                    <a class="btn btn-primary btn-rect pull-right" href="<?php echo $pdf_link;?>"><?php echo $this->lang->line("BUTTON_PDF"); ?></a>
                    <a class="btn btn-primary btn-rect pull-right" style="margin-right: 10px;" href="javascript:window.print();"><?php echo $this->lang->line("BUTTON_PRINT"); ?></a>
                    <div class="clearfix"></div>
                    <span class="pull-right"><?php echo $this->lang->line('REPORT_CURRENT_DATE_VIEW');?> <br />প্রতিবেদন রিপোট&nbsp;<?php echo System_helper::Get_Eng_to_Bng($_GET["from_date"]).'&nbsp;থেকে &nbsp;'.System_helper::Get_Eng_to_Bng($_GET["to_date"]); ?>&nbsp; পর্যন্ত </span>
                </div>
                <div class="col-lg-12">
                    <div class="col-lg-12 text-center">
                    <h4><?php echo $this->lang->line('REPORT_HEADER_TITLE');?></h4>
                    <h5>
                        <?php echo $title;?>
                        (
                        <?php
                        $type ='';
                        if($report_status==1)
                        {
                            $type = $this->lang->line('LEVEL_PRIMARY');
                        }
                        elseif($report_status==2)
                        {
                            $type = $this->lang->line('LEVEL_SECONDARY');
                        }
                        elseif($report_status==3)
                        {
                            $type = $this->lang->line('LEVEL_HIGHER');
                        }
                        else
                        {
                            $type = $this->lang->line('ALL');
                        }

                        echo $type;
                        ?>
                        )
                    </h5>
                    <hr />
                        <?php
                        if($channel==2)
                        {
                            ?>
                            <div class="col-lg-4 text-center text-danger">
                                <?php echo $this->lang->line('TOTAL_REGISTERED_INSTITUTE').": ".System_helper::Get_Eng_to_Bng(count($number_of_institute));?>
                            </div>
                            <div class="col-lg-4 text-center text-danger">
                                <?php echo $this->lang->line('TOTAL_USING_USER').": ". System_helper::Get_Eng_to_Bng(count($number_of_user));?>
                            </div>
                            <div class="col-lg-4 text-center text-danger">
                                <?php
                                $percent=count($number_of_user)/count($number_of_institute);
                                echo $this->lang->line('TOTAL_PARENTED').": ". System_helper::Get_Eng_to_Bng(number_format($percent*100, 2)).'%';
                                ?>
                            </div>

                            <?php
                        }
                        ?>

                </div>

                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('DIVISION');?></th>
                            <th><?php echo $this->lang->line('ZILLA');?></th>
                            <th><?php echo $this->lang->line('UPAZILLA');?></th>
                            <th><?php echo $this->lang->line('INSTITUTE');?></th>
                            <!--                            --><?php
                            //                            if(empty($report_status))
                            //                            {
                            //                                ?>
                            <!--                                <th>--><?php //echo $this->lang->line('TYPE');?><!--</th>-->
                            <!--                            --><?php
                            //                            }
                            //                            ?>
                            <?php
                            if($channel==2)
                            {
                                ?>
                                <th><?php echo $this->lang->line('DATE');?></th>
                                <th><?php echo $this->lang->line('CLASS_NAME');?></th>
                                <th><?php echo $this->lang->line('SUBJECT');?></th>
                                <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                    if(!empty($reports))
                    {
                        $division_name='';
                        $zilla_name='';
                        $upazilla_name='';
                        $institute_name='';
                        $class_name='';
                        $class_date='';
                        if($channel==1)
                        {
                            foreach($reports as $division) {
                                foreach ($division['zilla'] as $zilla) {
                                    foreach ($zilla['upazilla'] as $upazilla) {
                                        foreach ($upazilla['institute'] as $institute) {
                                        ?>
                                            <tr>
                                            <td>
                                                <?php
                                                if ($division_name == '')
                                                {
                                                    echo $division['division_name'];
                                                    $division_name = $division['division_name'];
                                                    //$currentDate = $preDate;
                                                }
                                                else if ($division_name == $division['division_name'])
                                                {
                                                    //exit;
                                                    echo "&nbsp;";
                                                }
                                                else
                                                {
                                                    echo $division['division_name'];
                                                    $division_name = $division['division_name'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($zilla_name == '')
                                                {
                                                    echo $zilla['zilla_name'];
                                                    $zilla_name = $zilla['zilla_name'];
                                                    //$currentDate = $preDate;
                                                }
                                                else if ($zilla_name == $zilla['zilla_name'])
                                                {
                                                    //exit;
                                                    echo "&nbsp;";
                                                }
                                                else
                                                {
                                                    echo $zilla['zilla_name'];
                                                    $zilla_name = $zilla['zilla_name'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($upazilla_name == '')
                                                {
                                                    echo $upazilla['upazlla_name'];
                                                    $upazilla_name =$upazilla['upazlla_name'];
                                                    //$currentDate = $preDate;
                                                }
                                                else if ($upazilla_name == $upazilla['upazlla_name'])
                                                {
                                                    //exit;
                                                    echo "&nbsp;";
                                                }
                                                else
                                                {
                                                    echo $upazilla['upazlla_name'];
                                                    $upazilla_name = $upazilla['upazlla_name'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($institute_name == '')
                                                {
                                                    echo $institute['institute_name'];
                                                    $institute_name = $institute['institute_name'];
                                                    //$currentDate = $preDate;
                                                }
                                                else if ($institute_name == $institute['institute_name'])
                                                {
                                                    //exit;
                                                    echo "&nbsp;";
                                                }
                                                else
                                                {
                                                    echo $institute['institute_name'];
                                                    $institute_name = $institute['institute_name'];
                                                }
                                                ?>
                                            </td>
                                            <?php
                                        }
                                    }

                                }
                            }
                        }
                        else
                        {
                            foreach($reports as $division)
                            {
                                foreach($division['zilla'] as $zilla)
                                {
                                    foreach($zilla['upazilla'] as $upazilla)
                                    {
                                        foreach($upazilla['institute'] as $institute)
                                        {
                                            foreach($institute['date'] as $date)
                                            {
                                                foreach($date['class'] as $class)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            if ($division_name == '')
                                                            {
                                                                echo $division['division_name'];
                                                                $division_name = $division['division_name'];
                                                                //$currentDate = $preDate;
                                                            }
                                                            else if ($division_name == $division['division_name'])
                                                            {
                                                                //exit;
                                                                echo "&nbsp;";
                                                            }
                                                            else
                                                            {
                                                                echo $division['division_name'];
                                                                $division_name = $division['division_name'];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($zilla_name == '')
                                                            {
                                                                echo $zilla['zilla_name'];
                                                                $zilla_name = $zilla['zilla_name'];
                                                                //$currentDate = $preDate;
                                                            }
                                                            else if ($zilla_name == $zilla['zilla_name'])
                                                            {
                                                                //exit;
                                                                echo "&nbsp;";
                                                            }
                                                            else
                                                            {
                                                                echo $zilla['zilla_name'];
                                                                $zilla_name = $zilla['zilla_name'];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($upazilla_name == '')
                                                            {
                                                                echo $upazilla['upazlla_name'];
                                                                $upazilla_name =$upazilla['upazlla_name'];
                                                                //$currentDate = $preDate;
                                                            }
                                                            else if ($upazilla_name == $upazilla['upazlla_name'])
                                                            {
                                                                //exit;
                                                                echo "&nbsp;";
                                                            }
                                                            else
                                                            {
                                                                echo $upazilla['upazlla_name'];
                                                                $upazilla_name = $upazilla['upazlla_name'];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($institute_name == '')
                                                            {
                                                                echo $institute['institute_name'];
                                                                $institute_name = $institute['institute_name'];
                                                                //$currentDate = $preDate;
                                                            }
                                                            else if ($institute_name == $institute['institute_name'])
                                                            {
                                                                //exit;
                                                                echo "&nbsp;";
                                                            }
                                                            else
                                                            {
                                                                echo $institute['institute_name'];
                                                                $institute_name = $institute['institute_name'];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($class_date == '')
                                                            {
                                                                echo $date['class_date'];
                                                                $class_date = $date['class_date'];
                                                                //$class_date = $preDate;
                                                            }
                                                            else if ($class_date == $date['class_date'])
                                                            {
                                                                //exit;
                                                                echo "&nbsp;";
                                                            }
                                                            else
                                                            {
                                                                echo $date['class_date'];
                                                                $class_date = $date['class_date'];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($class_name == '')
                                                            {
                                                                echo $class['class_name'];
                                                                $class_name = $class['class_name'];
                                                                //$class_date = $preDate;
                                                            }
                                                            else if ($class_name == $class['class_name'])
                                                            {
                                                                //exit;
                                                                echo "&nbsp;";
                                                            }
                                                            else
                                                            {
                                                                echo $class['class_name'];
                                                                $class_name = $class['class_name'];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            for($i=0;$i<count($class['subject_name']);$i++)
                                                            {
                                                                echo $class['subject_name'][$i].", ";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        //                        echo "<pre>";
                        //                        print_r($reports);
                        //                        echo "</pre>";



                        die();
                        foreach($reports as $row)
                        {
                            if (isset($subject_name[$row['divname']][$row['zillaname']][$row['upazilaname']][$row['name']][$row['class_date']]))
                            {
                                $subject_name[$row['divname']][$row['zillaname']][$row['upazilaname']][$row['name']][$row['class_date']] = $subject_name[$row['divname']][$row['zillaname']][$row['upazilaname']][$row['name']][$row['class_date']] . ", " . $row['subject_name'];
                            }
                            else
                            {
                                $subject_name[$row['divname']][$row['zillaname']][$row['upazilaname']][$row['name']][$row['class_date']] = $row['subject_name'];
                            }
                        }
                        foreach($reports as $row)
                        {
                        ?>
                            <tr>
                                <td>
                                    <?php
                                    if ($division_name == '')
                                    {
                                        echo $row['divname'];
                                        $division_name = $row['divname'];
                                        //$currentDate = $preDate;
                                    }
                                    else if ($division_name == $row['divname'])
                                    {
                                        //exit;
                                        echo "&nbsp;";
                                    }
                                    else
                                    {
                                        echo $row['divname'];
                                        $division_name = $row['divname'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($zilla_name == '')
                                    {
                                        echo $row['zillaname'];
                                        $zilla_name = $row['zillaname'];
                                        //$currentDate = $preDate;
                                    }
                                    else if ($zilla_name == $row['zillaname'])
                                    {
                                        //exit;
                                        echo "&nbsp;";
                                    }
                                    else
                                    {
                                        echo $row['zillaname'];
                                        $zilla_name = $row['zillaname'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($upazilla_name == '')
                                    {
                                        echo $row['upazilaname'];
                                        $upazilla_name = $row['upazilaname'];
                                        //$currentDate = $preDate;
                                    }
                                    else if ($upazilla_name == $row['upazilaname'])
                                    {
                                        //exit;
                                        echo "&nbsp;";
                                    }
                                    else
                                    {
                                        echo $row['upazilaname'];
                                        $upazilla_name = $row['upazilaname'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($institute_name == '')
                                    {
                                        echo $row['name'];
                                        $institute_name = $row['name'];
                                        //$currentDate = $preDate;
                                    }
                                    else if ($institute_name == $row['name'])
                                    {
                                        //exit;
                                        echo "&nbsp;";
                                    }
                                    else
                                    {
                                        echo $row['name'];
                                        $institute_name = $row['name'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($class_date == '')
                                    {
                                        echo $row['class_date'];
                                        $class_date = $row['class_date'];
                                        //$class_date = $preDate;
                                    }
                                    else if ($class_date == $row['class_date'])
                                    {
                                        //exit;
                                        echo "&nbsp;";
                                    }
                                    else
                                    {
                                        echo $row['class_date'];
                                        $class_date = $row['class_date'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($class_name == '')
                                    {
                                        echo $row['class_name'];
                                        $class_name = $row['class_name'];
                                        //$class_date = $preDate;
                                    }
                                    else if ($class_name == $row['class_name'])
                                    {
                                        //exit;
                                        echo "&nbsp;";
                                    }
                                    else
                                    {
                                        echo $row['class_name'];
                                        $class_name = $row['class_name'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($class_name == '')
                                    {
                                        echo $row['subject_name'];
                                        $class_name = $row['class_name'];
                                        //$class_date = $preDate;
                                    }
                                    else if ($class_name == $row['class_name'])
                                    {
                                        //exit;
                                        echo "&nbsp;";
                                    }
                                    else
                                    {
                                        echo $row['class_name'];
                                        $class_name = $row['class_name'];
                                    }
                                    ?>
                                </td>
                                <td><?php echo $subject_name[$row['divname']][$row['zillaname']][$row['upazilaname']][$row['name']][$row['class_date']];?></td>
                            <!--                                --><?php
                            //                                if(empty($report_status))
                            //                                {
                            //                                    ?>
                            <!--                                    <td>-->
                            <!--                                        --><?php
                            //                                        if($row['is_primary']==1)
                            //                                        {
                            //                                            echo $this->lang->line('LEVEL_PRIMARY');
                            //                                        }
                            //                                        elseif($row['is_secondary']==1)
                            //                                        {
                            //                                            echo $this->lang->line('LEVEL_SECONDARY');
                            //                                        }
                            //                                        elseif($row['is_higher']==1)
                            //                                        {
                            //                                            echo $this->lang->line('LEVEL_HIGHER');
                            //                                        }
                            //                                        else
                            //                                        {
                            //
                            //                                        }
                            //                                        ?>
                            <!--                                    </td>-->
                            <!--                                --><?php
                            //                                }
                            //                                ?>

                            </tr>
                        <?php
                        }
                    }
                    else
                    {
                       ?>
                        <tr>
                            <th colspan="21" style="text-align: center; color: red"><?php echo $this->lang->line('DO_DATA_FOUND');?></th>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </body>
</html>