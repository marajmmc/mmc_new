<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();
//echo "<pre>";
//print_r($user);
//echo "</pre>";
if($user)
{


    //$CI->load_view('sidebar_left');
    $components=User_helper::get_task_module_component($CI->config->item('system_sidebar01'));
    //    echo "<pre>";
    //    print_r($components);
    //    echo "</pre>";
    ?>

<div class="row">
  <div class="col-lg-12">
    <div class="top-nav" style="clear:both; border-bottom:1px solid gray;display:inline-table;width:100%;">
      <ul class="nav1">
        <li><a href="<?php echo base_url();?>home/dashboard">ড্যাশবোর্ড</a></li>
        <?php
                    foreach($components as $component)
                    {

                         foreach($component['modules'] as $module)
                         {
                         ?>
        <li><a class="external" href="#"><?php echo $module['module_name']; ?></a>
          <ul class="subs">
            <?php
                             foreach($module['tasks'] as $task)
                             {
                                 ?>
            <li> <a href="<?php echo $CI->get_encoded_url($task['controller']); ?>"> <i class="<?php echo $task['task_icon']; ?>"></i> <?php echo $task['task_name']; ?> </a> </li>
            <?php
                             }
                             ?>
          </ul>
        </li>
        <?php
                         }
                         ?>
        <?php
                    }
                    ?>
        <li><a href="<?php echo base_url();?>report/report_home/">প্রতিবেদন</a></li>
        <li><a href="<?php echo base_url();?>home/logout/">লগ আউট</a></li>
      </ul>
      <div class="clearfix"> </div>
    </div>
  </div>
  <!--        -->
  <?php
//        $uisc=User_helper::get_uisc_info();
//        if(sizeof($uisc)>0)
//        {
//            ?>
  <!--            <div class="col-lg-12 text-right">--> 
  <!--                <p class="text-primary">--> 
  <!--                    সেবা কেন্দ্রের নাম: -->
  <?php //echo $uisc->uisc_name;?>
  <!--                </p>--> 
  <!--            </div>--> 
  <!--            <div class="clearfix"> </div>--> 
  <!--            <br />--> 
  <!--            -->
  <?php
//        }
//        ?>
</div>
<?php
}
else
{
    ?>

<script>
var resizeElements;

$(document).ready(function() {

  // Set up common variables
  // --------------------------------------------------

  var bar = ".search_bar";
  var input = bar + " input[type='text']";
  var button = bar + " button[type='submit']";
  var dropdown = bar + " .search_dropdown";
  var dropdownLabel = dropdown + " > span";
  var dropdownList = dropdown + " ul";
  var dropdownListItems = dropdownList + " li";


  // Set up common functions
  // --------------------------------------------------

  resizeElements = function() {
    var barWidth = $(bar).outerWidth();

    var labelWidth = $(dropdownLabel).outerWidth()+36;
    $(dropdown).width(labelWidth);

    var dropdownWidth = $(dropdown).outerWidth();
    var buttonWidth	= $(button).outerWidth();
    var inputWidth = barWidth - dropdownWidth - buttonWidth;
    var inputWidthPercent = inputWidth / barWidth * 100 + "%";

    $(input).css({ 'margin-left': dropdownWidth, 'width': inputWidthPercent });
  }

  function dropdownOn() {
    $(dropdownList).fadeIn(25);
    $(dropdown).addClass("active");
  }

  function dropdownOff() {
    $(dropdownList).fadeOut(25);
    $(dropdown).removeClass("active");
  }


  // Initialize initial resize of initial elements 
  // --------------------------------------------------
  resizeElements();


  // Toggle new dropdown menu on click
  // --------------------------------------------------

  $(dropdown).click(function(event) {
    if ($(dropdown).hasClass("active")) {
      dropdownOff();
    } else {
      dropdownOn();
    }

    event.stopPropagation();
    return false;
  });

  $("html").click(dropdownOff);


  // Activate new dropdown option and show tray if applicable
  // --------------------------------------------------

  $(dropdownListItems).click(function() {
    $(this).siblings("li.selected").removeClass("selected");
    $(this).addClass("selected");

    // Focus the input
    $(this).parents("form.search_bar:first").find("input[type=text]").focus();

    var labelText = $(this).text();
    $(dropdownLabel).text(labelText);

    resizeElements();

  });


  // Resize all elements when the window resizes
  // --------------------------------------------------

  $(window).resize(function() {
    resizeElements();
  });
});

// NAVIGATION MENU /// JQUERY UNDERLINE 
$('.main_nav li').hover(function() {
     var x = $(this);
     $('.menuUnderline').stop().animate({
        'width': x.width(),
        'left' : x.position().left
     }, 400);
});

</script>
    <style>
        body {
            background: #e9e9e9;
            background: #FFFFFF;
            font-family: sans-serif;
            text-align: center;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .right_top_box {
            font-family: nikoshBAN;
            font-size: 18px;
            color: #303;
            width: 135px;
            float: right;
        }
        .margin-left-top {
            margin-left: 10px;
            margin-top: 4px;
        }
        .li-tab {
            margin-bottom: 10px !important;
            box-shadow: 1px 1px #CCFFCC;
        }
        .link_cls {
            border-bottom: 1px solid #ccc;
            font-family: kalpurushregular;
            font-size: 16px;
            letter-spacing: 1px;
            list-style: outside none none;
            margin-bottom: 4px;
            padding: 1px 2px;
        }
        .link_cls2 {
            border-bottom: 1px solid #ccc;
            font-family: kalpurushregular;
            font-size: 12px;
            letter-spacing: 0.4px;
            list-style: outside none none;
            margin-bottom: 5px;
            padding: 2px 3px;
        }
        .link_cls a:hover {
            color: #036;
        }
        #dropcap {
            initial-letter: 2;
            color: red;
        }
        .red_col{
            color:#D03820;
        }
    </style>

    <script>
//        function switchsize(state) {
//            if (state.matches) {
//                window.Dropcap.layout(dropcap, 1);
//            } else {
//                window.Dropcap.layout(dropcap, 2); }
//        }
//
//        var dropcap = document.getElementById("dropcap");
//        window.Dropcap.layout(dropcap, 2);
//
//        var narrow = window.matchMedia("screen and (max-width: 600px)");
//        narrow.addListener(switchsize);
//        switchsize(narrow);
    </script>
    <div class="row">
        <div class="col-lg-12">
            <div class="" style="clear:both; z-index:500; position:relative; display:inline-table; width:100%;">
                <div class="col-lg-6" style="padding-left:0px !important;">
                    <form class="search_bar large">
                        <div class="search_dropdown" style="width: 16px;"> <span>সকল</span>
                            <ul>
                                <li class="selected">সকল</li>
                                <li>প্রাথমিক/ ইবতেদায়ী</li>
                                <li>মাধ্যমিক/ দাখিল</li>
                                <li>উচ্চ মাধ্যমিক/ আলীম</li>
                            </ul>
                        </div>
                        <input type="text" placeholder="আপনার কাঙ্খিত তথ্য এখানে খুঁজুন..." />
                        <button type="submit" value="Search">অনুসন্ধান</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div>
                        <ul class="main_nav">
                            <li><a href="<?php echo base_url();?>" class="index_page">প্রথম পাতা</a></li>
                            <li><a href="<?php echo base_url();?>/home/registration" class="home">নিবন্ধন</a></li>
                            <li><a href="<?php echo base_url();?>home/notice" class="about">বিজ্ঞপ্তি</a></li>
                            <li><a href="#" class="products">হেল্প ডেস্ক</a></li>
                            <li><a href="#" class="services">যোগাযোগ</a></li>
                            <li><a href="<?php echo base_url();?>home/login" class="login">লগইন</a></li>
                            <div class="menuUnderline"></div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- start top menu-->
<?php /*?><div class="row">
        <div class="col-lg-12">
            <div class="top-nav" style="clear:both; border-bottom:1px solid #CCC;display:inline-table;">
                <ul class="nav1">
                    <li><a href="<?php echo base_url();?>">প্রথম পাতা</a></li>
                    <li>
                        <a class="external" href="<?php echo base_url().'home/registration';?>">রেজিস্ট্রেশন</a>
                        
                    </li>
                    <li><a class="external" href="#">রেজিষ্ট্রেশন নির্দেশনা</a>
                        <ul class="subs">
                            <li><a class="external" href="<?php echo base_url().'website/registration_direction';?>">রেজিস্ট্রেশন নির্দেশনা</a></li>
                            <li><a class="external" href="<?php echo base_url().'website/registration_form';?>">রেজিস্ট্রেশন ফরম</a></li>
                        </ul>
                    </li>
                    <li><a class="external" href="#">ই-সেবাসমূহ</a>
                        <ul class="subs">
                            <li><a href="<?php echo base_url().'website/eservice_list';?>">সেবাসমূহের তালিকা</a></li>
                        </ul>
                    </li>
                    <li><a class="external" href="#"> হেল্প ডেস্ক</a>
                        <ul class="subs">
                            <li><a class="external" href="<?php echo base_url().'website/user_direction';?>">ব্যবহারকারী নির্দেশনা</a></li>
                            <li><a href="<?php echo base_url().'website/help_desk_contact';?>">হেল্প ডেস্কে যোগাযোগ</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url();?>media/media_corner/">মিডিয়া কর্ণার</a></li>
                    <li><a class="" href="<?php echo base_url();?>notice_management/public_notice/">বিজ্ঞপ্তি</a></li>
                    <li><a class="" href="<?php echo base_url();?>home/login/">লগইন</a></li>

                </ul>

                <div class="clearfix">
                </div>
            </div>
        </div>
    </div><?php */?>
<!--end top menu-->
<?php
}

?>
