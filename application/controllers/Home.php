<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Root_Controller
{
    function __construct()
    {
        //
        parent::__construct();
        //     $this->load->model("nstitute/Institute");
        $this->load->model("institute/Institute_model");
        //$this->load->helper('url');

    }
    
    public function index()
    {
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("website","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));

        $ajax['system_page_url']=base_url();
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $this->jsonReturn($ajax);
    }
    public function dashboard()
    {
        $user=User_helper::get_user();
        if($user)
        {
            $this->dashboard_page();
        }
        else
        {
            $this->login_page();
        }

        //        $CI =& get_instance();
        //        $user=User_helper::get_user();
        //        if($user)
        //        {
        //        //    $this->dashboard_page();
        //          $data['userinfo']=$this->Institute_model->get_user_information($user->id);
        //        //     $instituteinfo=$this->Institute_model->get_user_information($user->id);
        //         // print_r($instituteinfo);
        //            $ajax['status']=true;
        //            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        //            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/dashboard",$data,true));
        //            $this->jsonReturn($ajax);
        //        }
        //        else
        //        {
        //            $this->login_page();
        //        }
    }
    public function login()
    {
        $user=User_helper::get_user();
        if($user)
        {
            $this->dashboard_page();
        }
        else
        {
            if($this->input->post())
            {
                if(User_helper::login($this->input->post("username"),$this->input->post("password")))
                {
                    $user=User_helper::get_user();
                    $user_info['user_id']=$user->id;
                    $user_info['login_time']=time();
                    $user_info['ip_address']=$this->input->ip_address();
                    $user_info['request_headers']=json_encode($this->input->request_headers());
                    Query_helper::add($this->config->item('table_user_login_history'),$user_info);
                    $this->dashboard_page($this->lang->line("MSG_LOGIN_SUCCESS"));
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_USERNAME_PASSWORD_INVALID");
                    $this->jsonReturn($ajax);
                }
            }
            else
            {
                $this->login_page();//login page view
            }

        }

    }
    public function logout()
    {
        $this->session->sess_destroy();
        //$this->login_page($this->lang->line("MSG_LOGOUT_SUCCESS"));
        //$this->logout_page();//logout
        //$this->website();
        redirect(base_url());
    }
    public function resetpassword(){
      
      $CI =& get_instance();  
      $this->load->library('form_validation');
        if($this->input->post())
        {
     //$this->form_validation->set_rules('registration[email]',$this->lang->line('SCHOOL_EMAIL'),'trim|required|valid_email|callback_isemailExist');       
     $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_email_checkreset');
            
     if ($this->form_validation->run() == FALSE)
             {
                $this->message=validation_errors();
               $ajax['system_message']=$this->message;
                $this->jsonReturn($ajax); 
            }
     
                else{
                    $passwordLink=md5(uniqid());
                $data =array( 
                'reset_link'=>$passwordLink);
                
        $this->db->where('email', $this->input->post('email'));
        $this->db->update($CI->config->item('table_users'), $data);
        
        $this->load->model("institute/Institute_model");
        $userinfo=$this->Institute_model->get_user_informationbymail($this->input->post('email'));
        $uname=$userinfo['name_en'];
        // Email  library with setting 
        $this->load->library('email');       
        $config['protocol'] = 'sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        
        
        $this->email->initialize($config); 
       
        
        $this->email->from('noreply@mmc.gov.bd', 'MMC Reset Password');
        $this->email->to($this->input->post('email'));

            $passwordrecoverLink = "<a href=\"".$CI->get_encoded_url('home/recover?lnk='.$passwordLink.'')."\">".$CI->get_encoded_url('home/recover?lnk='.$passwordLink.'')."</a>";
            $html = "Dear $uname,\r\n";
            $html .= "Please visit the following link to reset your password:\r\n";
            $html .= "-----------------------\r\n";
            $html .= "$passwordrecoverLink\r\n";
            $html .= "-----------------------\r\n";
            $html .= "Please be sure to copy the entire link into your browser. The link will expire after 3 days for security reasons.\r\n\r\n";
            $html .= "If you did not request this forgotten password email, no action is needed, your password will not be reset as long as the link above is not visited. However, you may want to log into your account and change your security password and answer, as someone may have guessed it.\r\n\r\n";
            $html .= "Thanks,\r\n";
            $html .= "-- MMC team";
            
            $this->email->subject('MMC Reset Password ');
       // $html = $this->input->post('message');
            $this->email->message($html);
            $this->email->send();
        
       $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE_RESET");
       $this->jsonReturn($ajax); 

                }
        }
      $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
      $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/resetpassword",'',true));
      $this->jsonReturn($ajax);
        
      
    }
   
       public function email_checkreset($str)
      {
           $CI =& get_instance();
           $query = $this->db->get_where($CI->config->item('table_users'), array('email' => $str), 1);
 
            if ($query->num_rows()== 1)
            {

                return true;

            }
            else
            {    
             $this->form_validation->set_message('email_checkreset', 'This Email does not exist.');
             return false;
      }
      
   } 
   
   public function recover(){
     //  $this->input->get('lnk');

           $CI =& get_instance();
           $query = $this->db->get_where($CI->config->item('table_users'), array('reset_link' => $this->input->get('lnk')), 1);
           
            if ($query->num_rows()== 1)
            {
            $data['userinfo']=$this->Institute_model->get_user_informationbylink($this->input->get('lnk'));

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/newpassword",$data,true));
            $this->jsonReturn($ajax);

            }
            else
            {    
         $ajax['system_message']=$this->lang->line("INVALIED_LINK");
         $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
         $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/invalied",'',true));
                
         $this->jsonReturn($ajax);
         
      }
      
   }

   public function recoversave(){
       $CI=& get_instance();
       $this->load->library('form_validation');
       if($this->input->post())
        {
     //     $this->input->post('password');
       //   $this->input->post('repassword');
         
         $this->form_validation->set_rules('password', 'New Password', 'required');
         $this->form_validation->set_rules('repassword', 'Re Type New Password', 'required');
          if ($this->form_validation->run() == FALSE)
             {
                $this->message=validation_errors();
                $ajax['system_message']=$this->message;
                $this->jsonReturn($ajax);  
          }
          
          if($this->input->post('password')==$this->input->post('repassword')){
             $datap =array( 
                'password'=>  md5($this->input->post('repassword')));
                
        $this->db->where('id', $this->input->post('userid'));
        $this->db->update($CI->config->item('table_users'), $datap);
         $ajax['system_message']=$this->lang->line("PASSWORD_UPDATED");
         $this->jsonReturn($ajax);
              
          }
          else{
            $ajax['system_message']=$this->lang->line("PASSWORD_NOT_SAME");
            $this->jsonReturn($ajax);
              
          }
              
           
       }
       
   }

   public function registration()
    {
        //    $this->load->library('form');
        $this->load->library('form_validation');
        $ajax['status']=true;
        $data=array();
        $data['title']=$this->lang->line("REGISTRATION_TITLE");
            
        if($this->input->post())
        {
            if(!$this->check_validation())
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->message;
                $this->jsonReturn($ajax);
            }
            else
            {
                //       echo $this->input->post('registration[institute]');
                //    $this->load->model("institute/Institute");
                $data = array
                (
                    'name' => $this->input->post('registration[institute]'),
                    'code' => $this->input->post('registration[em]'),
                    'inipassword' => $this->input->post('registration[password]'),
                    'email' => $this->input->post('registration[email]'),
                    'education_type_ids' => $this->input->post('registration[education_type]'),
                    'divid' => $this->input->post('registration[divid]'),
                    'zillaid' => $this->input->post('registration[zilla]'),
                    'upozillaid' => $this->input->post('registration[upozilla]'),
                    'applied_date' => date('Y-m-d'),
                    'is_primary' => $this->input->post('registration[primary]'),
                    'is_secondary' => $this->input->post('registration[secondary]'),
                    'is_higher' => $this->input->post('registration[higher]'),
                    'user_id' => 999999,
                    'mobile' => $this->input->post('registration[mobile]'),
                    'status' => 1,
                    'approved_by' => NULL,
                    'approved_date' => NULL,
                    'comment' => NULL
                );

                //print_r($data);
                $this->Institute_model->form_insert($data);
                // $data['message'] = 'Data Inserted Successfully';
                $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE");
                //   $this->jsonReturn($ajax);
                //  redirect("/home/registration","refresh");
                $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
                $data['education_type']=Query_helper::get_info($this->config->item('table_education_type'),array('id value', 'name text'), array());
                $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
                $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/registration",$data,true));
                $this->jsonReturn($ajax);
            }
        }
        $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
        $data['education_type']=Query_helper::get_info($this->config->item('table_education_type'),array('id value', 'name text'), array());
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/registration",$data,true));
        $this->jsonReturn($ajax);
    }

    
    public function getZilla()
    {
        $division_id=$this->input->post('division_id');
        $zillas=Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$division_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#zilla_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$zillas),true));
        $this->jsonReturn($ajax);
    }
    
     public function getUpazila()
    {
        $zilla_id=$this->input->post('zilla_id');
        $upazilas=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$zilla_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#upozilla_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$upazilas),true));
        $this->jsonReturn($ajax);
    }
    
   public function education_level(){
        
    $education_level=$this->input->post('education_level');
    $educationlevel=Query_helper::get_info($this->config->item('table_classes'),array('id value', 'name text'), array('education_level_id = '.$education_level));
    $ajax['status']=true;
    $ajax['system_content'][]=array("id"=>"#classes","html"=>$this->load_view("dropdown",array('drop_down_options'=>$educationlevel),true));
    $this->jsonReturn($ajax);   
        
    }
    
    public function education_levelnew()
    {
        
        $education_level=$this->input->post('education_level');
        $num=$this->input->post('num');
        $educationlevel=Query_helper::get_info($this->config->item('table_classes'),array('id value', 'name text'), array('education_level_id = '.$education_level));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#classesid".$num."","html"=>$this->load_view("dropdown",array('drop_down_options'=>$educationlevel),true));
        $this->jsonReturn($ajax);
        
    }
    
     public function education_classes(){
        
    $education_level=$this->input->post('education_level');
    $classes=$this->input->post('classes');
    $education_type_ids=$this->input->post('education_type_ids');
   
    if ($classes) {
             if ($classes < 6) {
                 $education_level = 5;
             }elseif( 5< $classes && $classes< 11){
                 $education_level = 6;
             }elseif( $classes > 10){
                 $education_level = 7 ;
             }
         }
         
        $this->db->where(array('class_id' => $classes, 'education_level_id' => $education_level, 'education_type_id' => $education_type_ids));
        $query = $this->db->get($this->config->item('table_subject'));
        $subjects = array();
        $subjectname = '';
        if($query->result()){
            foreach ($query->result() as $subject) {
            $subjects[$subject->id] = $subject->name;
         
            $subjectname .= '<input name="subject['.$education_level.']['.$classes.'][]" type="checkbox" value="'.$subject->id.'" /><label for='.$subject->name.'>'.$subject->name.'</label>';
         //   $subjectname .= '<input name="subject['.$education_level.']['.$classes.']['.$subject->id.']" type="checkbox" value="'.$subject->id.'" /><label for='.$subject->name.'>'.$subject->name.'</label>';
            }
        //    return $subjects;
            
            $this->jsonReturn($subjectname); 
        }

    }
    
    
    public function education_classesnew()
    {
        
        $education_level=$this->input->post('education_level');
        $classes=$this->input->post('classes');
        $education_type_ids=$this->input->post('education_type_ids');

        if ($classes)
        {
             if ($classes < 6)
             {
                 $education_level = 5;
             }elseif( 5< $classes && $classes< 11)
             {
                 $education_level = 6;
             }
             elseif( $classes > 10)
             {
                 $education_level = 7 ;
             }
        }
         
        $this->db->where(array('class_id' => $classes, 'education_level_id' => $education_level, 'education_type_id' => $education_type_ids));
        $query = $this->db->get($this->config->item('table_subject'));
        $subjects = array();
        $subjectname = '';
        if($query->result())
        {
            foreach ($query->result() as $subject)
            {
                $subjects[$subject->id] = $subject->name;
                $subjectname .= '<input name="subject['.$subject->id.']['.$subject->name.']" type="checkbox" value="'.$subject->id.'" /><label for='.$subject->name.'>'.$subject->name.'</label>';
            }
            //    return $subjects;
            $this->jsonReturn($subjectname); 
        }

    }

    
    public function education_classescollege()
    {
        
        $classes=$this->input->post('classes');
        $educationlevel=Query_helper::get_info($this->config->item('table_classes'),array('id value', 'name text'), array('education_level_id = '.$classes));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#classes","html"=>$this->load_view("dropdown",array('drop_down_options'=>$educationlevel),true));
        $this->jsonReturn($ajax);
        
    }
    
    private function check_validation()
    {

        $this->load->library('form_validation');
       

        $this->form_validation->set_rules('registration[divid]',$this->lang->line('DIVISION_NAME_SELECT'),'required');
        $this->form_validation->set_rules('registration[zilla]',$this->lang->line('ZILLA_NAME_SELECT_BN'),'required');
        $this->form_validation->set_rules('registration[upozilla]',$this->lang->line('UPOZILLA_SELECT'),'required');
        $this->form_validation->set_rules('registration[education_type]',$this->lang->line('EDUCATION_TYPE'),'required');
        $this->form_validation->set_rules('registration[institute]',$this->lang->line('SCHOOL_NAME'),'required');
        $this->form_validation->set_rules('registration[email]',$this->lang->line('SCHOOL_EMAIL'),'trim|required|valid_email|callback_isemailExist');
        $this->form_validation->set_rules('registration[mobile]',$this->lang->line('SCHOOL_MOBILE'),'required');
       // $this->form_validation->set_rules('registration[em]',$this->lang->line('SCHOOL_EM'),'required');
       $this->form_validation->set_rules('registration[em]',$this->lang->line('SCHOOL_EM'),'trim|required|callback_isEMExist');
        $this->form_validation->set_rules('registration[password]',$this->lang->line('SCHOOL_PASSWORD'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }
    
    
    public function isEMExist($key)
    {
        //$this->Institute->EM_exists($key);
        
        $CI =& get_instance();
        $this->db->where('code', $key);
	    $query = $this->db->get($CI->config->item('table_institute'));
        
 
        if ($query->num_rows() > 0)
        {
            $this->form_validation->set_message('isEMExist', 'This %s already registred');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
	
	
	 public function isemailExist($key) {
  //$this->Institute->EM_exists($key);
        
        $CI =& get_instance();
        $this->db->where('email', $key);
	$query = $this->db->get($CI->config->item('table_institute'));
        
 
    if ($query->num_rows() > 0){
        $this->form_validation->set_message('isemailExist', 'এই ইমেইলটি  ইতিপূর্বে  নিবন্ধিত হয়েছে');
        return FALSE;
    }
    else{
        return TRUE;
    }
}

public function communication(){
    
    $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array(),array());
    $data['zillas']=Query_helper::get_info($this->config->item('table_zillas'),array(),array());
    $data['zillasdp']=Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array());
    $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
    $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/communication",$data,true));
    $this->jsonReturn($ajax);
    
    
}

 private function check_validationcommunication()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('message',$this->lang->line('COMMINICATION_MESSAGE'),'required');
        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }
    
public function communicationsave(){
 //   $divisions=$this->input->post('division'); 
  //  print_r($division);
//  if(isset($this->input->post('division'))){
//      
//      echo '';
//  }
    
     if($this->input->post())
        {
            if(!$this->check_validationcommunication())
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->message;
                $this->jsonReturn($ajax);
            }
            
            else{
         $CI =& get_instance();       
         $this->load->library('email');       
        $config['protocol'] = 'sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);    
                
      //     print_r($division);
      if($this->input->post('division')):
          $divisions=$this->input->post('division');
           foreach ($divisions as $key => $value){
          //     echo $value;
            $array = array('user_group_id' => $CI->config->item('USER_GROUP_DIVISION_1'), 'division' => $value, 'status' => 2);
            $this->db->where($array);
            $q = $this->db->get($CI->config->item('table_users'));
            $datadivision = $q->result_array();
        $this->load->model("institute/Institute_model");
        $user=User_helper::get_user();
   //     print_r($user);
        $userinfo=$this->Institute_model->get_user_information($user->id);
     //   print_r($userinfo);
       // echo $userinfo['email'];
        $this->email->from($userinfo['email'], $userinfo['name_en']);
        $this->email->to($datadivision[0]['email']);

        $this->email->subject('Message ');
        $html = $this->input->post('message');
        $this->email->message($html);
        $this->email->send();
        
           }
   //     $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE_DIVISION");
    //    $this->jsonReturn($ajax);
       endif;       
     
      
       if($this->input->post('zilla')):
            $CI =& get_instance(); 
          $zillas=$this->input->post('zilla');
          foreach ($zillas as $key => $value){
        $this->load->model("institute/Institute_model");
        $userinfozila=$this->Institute_model->zilausers($value, $CI->config->item('USER_GROUP_DISTRICT_1'));
        $user=User_helper::get_user();
        $userinfo=$this->Institute_model->get_user_information($user->id);
        $this->email->from($userinfo['email'], $userinfo['name_en']);
        $this->email->to($userinfozila['email']);

        $this->email->subject('Message ');
        $html = $this->input->post('message');
        $this->email->message($html);
        $this->email->send();
        
           }
   //     $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE_ZILLA");
   //     $this->jsonReturn($ajax);
       endif;
     
       
       
        if($this->input->post('upozila')):
            $CI =& get_instance(); 
          $upozilas=$this->input->post('upozila');
          foreach ($upozilas as $key => $value){
        $this->load->model("institute/Institute_model");
        $userinfozila=$this->Institute_model->zilausers($value, $CI->config->item('USER_GROUP_UPOZILA_1'));
        $user=User_helper::get_user();
        $userinfo=$this->Institute_model->get_user_information($user->id);
        $this->email->from($userinfo['email'], $userinfo['name_en']);
        $this->email->to($userinfozila['email']);

        $this->email->subject('Message ');
        $html = $this->input->post('message');
        $this->email->message($html);
        $this->email->send();
        
           }
    //    $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE_UPOZILA");
   //     $this->jsonReturn($ajax);
       endif;
    
       
       if($this->input->post('institute')):
            $CI =& get_instance(); 
          $institutes=$this->input->post('institute');
          foreach ($institutes as $key => $value){
        $this->load->model("institute/Institute_model");
        $userinfozila=$this->Institute_model->zilausers($value, $CI->config->item('USER_GROUP_INSTITUTE'));
        $user=User_helper::get_user();
        $userinfo=$this->Institute_model->get_user_information($user->id);
        $this->email->from($userinfo['email'], $userinfo['name_en']);
        $this->email->to($userinfozila['email']);

        $this->email->subject('Message ');
        $html = $this->input->post('message');
        $this->email->message($html);
        $this->email->send();
        
           }
     //   $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE_INSTITUTE");
   //     $this->jsonReturn($ajax);
       endif;
       $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE_MESSAGE");
       $this->jsonReturn($ajax); 
            }
        }          
}

public function getUpazilacheckbox()
    {
        $zilla_id=$this->input->post('zilla_id');
        
         $this->db->where(array('visible' => 1, 'zillaid' => $zilla_id));
        $query = $this->db->get($this->config->item('table_upazilas'));
        $upazilas = array();
         $upazilaname = '';
        if($query->result())
        {
            foreach ($query->result() as $upazila)
            {
               
                $upazilaname .= '<input name="upozila[]" type="checkbox" value="'.$upazila->upazilaid.'" /><label for='.$upazila->upazilaname.'>'.$upazila->upazilaname.'</label>';
            }
            //    return $subjects;
            $this->jsonReturn($upazilaname); 
        }
        
 
    }
    
    
     public function getUpazilaschoolcheckbox()
    {
        $zilla_id=$this->input->post('zillaid');
        $upozilla_id=$this->input->post('upozilla_id');
        
         $this->db->where(array('status' => 2, 'zillaid' => $zilla_id, 'upozillaid' => $upozilla_id));
        $query = $this->db->get($this->config->item('table_institute'));
        $institutes = array();
        $institutesname = '';
        if($query->result())
        {
            foreach ($query->result() as $institutes)
            {
               
                $institutesname .= '<input name="institute[]" type="checkbox" value="'.$institutes->id.'" /><label for='.$institutes->name.'>'.$institutes->name.'</label>';
            }
            //    return $subjects;
            $this->jsonReturn($institutesname); 
        }
        
 
    }
    
}
