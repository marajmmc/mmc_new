<?php
$CI =& get_instance();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/css/bootstrap-wysihtml5.css"></link>
<script src="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/js/wysihtml5-0.3.0.js"></script> 
<script src="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/js/bootstrap-wysihtml5.js"></script> 
<div id="system_content" class="system_content_margin">
    <form id="registration_save_form" action="<?php echo $CI->get_encoded_url('home/communicationsave'); ?>" method="post">
        <div class="division">
           <h3>মন্ত্রণালয়</h3> 
           <input type="checkbox" name="" value="MOE"> <label for="মন্ত্রণালয়">শিক্ষা মন্ত্রণালয়</label>
           
            <input type="checkbox" name="" value="MOPME"> <label for="মন্ত্রণালয়">প্রাথমিক ও গণশিক্ষা মন্ত্রণালয়</label>
            
        </div>
        <div class="division">
        <h3>সংশ্লিষ্ট কর্মকর্তা - বিভাগ</h3>
    <?php
 //   print_r($divisions);
    if(isset($divisions)):
        foreach ($divisions as $divisions):
      //  echo $divisions['divname'];
   //  print_r($divisions);
 echo '<input name="division[]" type="checkbox" value="'.$divisions['divid'].'" /><label for='.$divisions['divname'].'>'.$divisions['divname'].'</label>';
        endforeach;
        
    endif;
    ?>
    </div>
     <div class="zilla">
        <h3>সংশ্লিষ্ট কর্মকর্তা - জেলা</h3>
    <?php
    if(isset($zillas)):
        foreach ($zillas as $zillas):
 echo '<input name="zilla[]" type="checkbox" value="'.$zillas['zillaid'].'" /><label for='.$zillas['zillaname'].'>'.$zillas['zillaname'].'</label>';
        endforeach;
        
    endif;
    ?>
    </div>
    <div class="zilla">
         <h3>সংশ্লিষ্ট কর্মকর্তা - উপজেলা</h3>
       <div class="col-md-3">
    <select name="zilaname" class="form-control" id="zila_id">
      <?php
      $CI->load_view('dropdown',array('drop_down_options'=>$zillasdp,'drop_down_selected'=>''));
      ?>
    </select>
     </div>
         
         <div class="col-md-9">
             <div id="upozilaname"></div> 
             
         </div>
    </div>
    <div class="clearfix"></div>
    
     <div class="perticularinstitute">
         <h3>প্রতিষ্ঠান সমূহ</h3>
     <div class="col-md-2">
    <select name="zilaname" class="form-control" id="zillaid">
      <?php
      $CI->load_view('dropdown',array('drop_down_options'=>$zillasdp,'drop_down_selected'=>''));
      ?>
    </select>
     </div>
         <div class="col-md-2">
   <select name="upozilla" id="upozilla_id" class="selectbox-1 zilla validate[required]">
          <option value=""><?php echo $this->lang->line('SELECT');?></option>
    </select>      
     </div>
         <div class="col-md-8">
             <div id="schools" class="schools"></div>     
             
         </div>    
         
     </div>     
    <div class="clearfix"></div>
    <textarea name="message" class="textarea" placeholder="ম্যাসেজ লিখুন ..." style="width: 810px; height: 200px"></textarea>
<div class="clearfix"></div>
<input type="submit" class="btn btn-primary" name="informationsend" value="প্রেরন করুন" id="informationsend">
    </form>    
</div>
<style>
    .schools label, .zilla label, .division label{ display: inline !important}
    .schools{ margin-left: 10px;}
</style>

<script>
    $(document).on("change","#zila_id",function()
        {
            var zilla_id=$(this).val();

            if(zilla_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/getUpazilacheckbox'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{zilla_id:zilla_id},
                    success: function (data, status)
                    {
                    $('#upozilaname').html(data); 
                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            else
            {
                $("#upozilaname").val('');
            }
        });
   
   
   $(document).on("change","#zillaid",function()
        {
            var zilla_id=$(this).val();

            if(zilla_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/getUpazila'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{zilla_id:zilla_id,},
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
                $("#upozilla_id").val('');
            }
        });
  
   $(document).on("change","#upozilla_id",function()
        {
            var upozilla_id=$(this).val();
            var zillaid = $("#zillaid").val();
            if(upozilla_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/getUpazilaschoolcheckbox'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{zillaid:zillaid, upozilla_id: upozilla_id},
                    success: function (data, status)
                    {
                    $('#schools').html(data); 
                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            else
            {
                $("#upozilaname").val('');
            }
        });
   //  $('.textarea').wysihtml5();
   $( document ).ready(function() {
    $('.textarea').wysihtml5();
    });
 </script>