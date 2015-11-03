<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Institute Controller
 *
 * @author Jibon Bikash Roy <jibon.bikash@gmail.com>
 * copyright SoftBD Ltd
 */
class Institute extends Root_Controller{
    //put your code here
    
    
  //  public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
   //    $this->permissions=Menu_helper::get_permission('institute/Institute');
    //    $this->controller_url='institute/Institute';
        $this->load->model("institute/Institute_model");
   //     $this->permissions['view']='';
   //     $this->permissions['add']='';
        
    }
    public function index($action='list',$id=0)
    {
     //   echo 'sdfdfdf';
        
        $this->current_action=$action;
        
        if($action=='list')
        {
            $this->system_list();
        }
        
      elseif($action=='edit')
        {
            $this->system_edit($id);
        }
        
         elseif($action=='save')
        {
            $this->system_save();
        }
        
         elseif($action=='inactive')
        {
            $this->system_listinactive();
        }
        else
        {
            
            
        }
    }
    private function system_list(){
        
   //     if($this->permissions['list'])
   //     {
            if($this->message)
            {
                $ajax['system_message']=$this->message;
                
            }
           $this->current_action='list';
          $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("institute/list","",true));
            $this->jsonReturn($ajax);
            
  //      }
        
    }
    
    
    private function system_listinactive(){
        
   //     if($this->permissions['list'])
   //     {
            if($this->message)
            {
                $ajax['system_message']=$this->message;
                
            }
           $this->current_action='list';
          $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("institute/listinactive","",true));
            $this->jsonReturn($ajax);
            
  //      }
        
    }
     private function system_edit($id){
         
  /*       if(!$this->permissions['edit'])
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
 */       
  //      else
 //       {
            $this->current_action='edit';

       //     $data['title'] = $this->lang->line('QUESTION_DETAIL');
            $data['institute']=$this->Institute_model->get_institute_data($id);
            $ajax['status']=true;

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("institute/edit",$data,true));
            $this->jsonReturn($ajax);
  //      }
         
     }
    
     public function get_list()
    {
      //   $this->load->model("institute/Institute_model"); 
        $institutes = array();
     //   if($this->permissions['list'])
    //    {
            $institutes = $this->Institute_model->get_listdata();
     //   }
        $this->jsonReturn($institutes);
    }
    
     public function get_listinactive()
    {
      //   $this->load->model("institute/Institute_model"); 
        $institutes = array();
     //   if($this->permissions['list'])
    //    {
            $institutes = $this->Institute_model->get_listinactive();
     //   }
        $this->jsonReturn($institutes);
    }
    
    
    private function system_save(){
         $CI =& get_instance();
        
        $user=User_helper::get_user();
        $user_id = $user->id;
        $id = $this->input->post("instituteid");
       if($id>0)
            {
     
     $data = array(
    'status' => $this->input->post('registration[status]'),
    'approved_by' => $user_id,
    'approved_date' => date("Y-m-d"),
    'comment' => "accepted"   
);

$CI =& get_instance();
$this->db->where('id', $id);
$this->db->update($CI->config->item('table_institute'), $data);

if($this->input->post('registration[status]')==2):
    $CI =& get_instance();
    $this->db->where('id', $id);
//here we select every clolumn of the table
$q = $this->db->get($CI->config->item('table_institute'));
$datainstitute = $q->result_array();
//print_r($datainstitute);
//echo $datainstitute->name;
//$datainstitute[0]['name'];
  $datauser = array(
   'username' => $datainstitute[0]['email'],
        'password' => md5($datainstitute[0]['inipassword']),
        'name_bn' => $datainstitute[0]['name'],
       'name_en' => $datainstitute[0]['name'],
       'table_id' =>'0',
       'uisc_type' => '0',
       'user_group_id' => 20,
       'template_id' =>'1',
       'language_id' => '1',
       'uisc_id' => '1',
       'ques_id' => '1',
       'ques_ans' => '1',
       'division' => $datainstitute[0]['divid'],
       'zilla' => $datainstitute[0]['zillaid'],
       'upazila' => $datainstitute[0]['upozillaid'],
       'unioun' => '0',
       'citycorporation' =>'0',
       'citycorporationward' => '0',
       'municipal' => '0',
       'municipalward' =>'0',
       'designation' => '0',
       'gender' => '1',
       'phone' =>$datainstitute[0]['mobile'],
      'office_phone' => $datainstitute[0]['mobile'],
      'mobile' => $datainstitute[0]['mobile'],
      'email' => $datainstitute[0]['email'],
      'national_id_no' => '0',
      'present_address' => '0',
      'permanent_address' => '0',
      'picture_alt' => '0',
      'picture_name' => '0',
      'notifiacation' => '0',
      'dob' =>'0',
      'first_login' => '',
      'create_by' => $user_id,
      'status' => 2,
      'create_date' => strtotime($datainstitute[0]['applied_date']),
      'approved_date' => time(),
      'update_by' => $user_id,
      'update_date' => strtotime($datainstitute[0]['applied_date'])

      
);
$this->db->insert($CI->config->item('table_users'), $datauser);

$datalast = array(
    'user_id' =>$this->db->insert_id(),

);
$this->db->where('id', $id);
$this->db->update($CI->config->item('table_institute'), $datalast);
endif;

//$ajax['system_message']=$this->lang->line("SUCESS_MESSAGE");
 //$this->message=$this->lang->line("SUCESS_MESSAGE");
 
 //$this->message=$this->lang->line("SUCESS_MESSAGE");

          
    
            }  
            //$ajax['status']=false;
                $this->message=$this->lang->line("MSG_CREATE_SUCCESS");
                //$this->jsonReturn($ajax);
                $this->system_list();
        
    }
    
   public function classadd(){
        
        $user=User_helper::get_user();
     //   print_r($user);
         $user_id = $user->id;
        
        $data['institute']=$this->Institute_model->get_institute_information($user->id);
        
            $ajax['status']=true;

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("institute/classadd",$data,true));
            $this->jsonReturn($ajax);
            
        
    }
    
    public function classsave()
    {
        $CI =& get_instance();

        $institute=$this->input->post('institute');
        $education_level=$this->input->post('education_level');
        $classes=$this->input->post('classesid');
        $classdate=$this->input->post('cladddate');
        $subject=$this->input->post('subject');

        $education_type_ids=$this->input->post('education_type_ids');

        $classname = array();
        $classes_date = array();
        $val_class = array();
        $subject_list=array();
        $subjects = array();
            
       for($i=0; $i < count($education_level); $i++)
       {
           
           if(isset($subject[$education_level[$i]][$classes[$i]]) && !empty($education_level[$i]) && !empty($classes[$i]))
           {
               
               for($s=0; $s<count($subject[$education_level[$i]][$classes[$i]]); $s++)
               {
                  $subjects[] = (int) $subject[$education_level[$i]][$classes[$i]][$s];  
                    if(isset($subject[$education_level[$i]][$classes[$i]][$s]))
                    {
                         $this->db->where('id',$subject[$education_level[$i]][$classes[$i]][$s]);
                         $q = $this->db->get($CI->config->item('table_subject'))->row_array();
                         
                            if($classes[$i]==1)
                            {
                                $class_name='প্রথম শ্রেণী';
                            }
                             elseif($classes[$i]==2){
                                $class_name='দ্বিতীয় শ্রেণী';
                            }
                             elseif($classes[$i]==3){
                                $class_name='তৃতীয় শ্রেণী';
                            }
                             elseif($classes[$i]==4){
                                $class_name='চুতুর্থ শ্রেণী';
                            }

                             elseif($classes[$i]==5){
                                $class_name='পঞ্চম শ্রেণী';
                            }

                             elseif($classes[$i]==6){
                                $class_name='ষষ্ঠ শ্রেণী';
                            }

                             elseif($classes[$i]==7){
                                $class_name='সপ্তম শ্রেণী';
                            }

                            elseif($classes[$i]==8){
                                $class_name='অষ্টম শ্রেণী';
                            }

                            elseif($classes[$i]==9){
                                $class_name='নবম শ্রেণী';
                            }

                            elseif($classes[$i]==10){
                                $class_name='দশম শ্রেণী';
                            }

                            elseif($classes[$i]==11){
                                $class_name='১ম বর্ষ';
                            }

                            else
                            {
                                $class_name='২য় বর্ষ';
                            }
                      
                        $datain = array
                        (
                            'institude_id' => $institute,
                            'class_name' => $class_name,
                            'class_id' => $classes[$i],
                            'subject_id' => $subject[$education_level[$i]][$classes[$i]][$s],
                            'subject_name' => $q['name'],
                            'education_type_id' => $education_type_ids,
                            'class_date' =>$classdate[$i]
                        );
                        $this->Institute_model->form_insertclass($datain);
                       
                   
                    }
        //$subject_list[$classes[$i]] = $subject;
                    
               }
                $subject_list[$classes[$i]] = $subjects; 
               
                $new_array = $subject_list;       
                $itemcount = count($subject_list);

                $dataseri = array
                (
                'education_type_id' => $education_type_ids,
                'class_ids' => $classes[$i],
                'no_of_class' => $itemcount,
                'subject_ids' => serialize($new_array),
                'no_of_subjects' => $itemcount,
                'date' =>$classdate[$i],
                'institude_id' => $institute,
                'education_level_id' =>$education_type_ids,
                );

                $this->Institute_model->form_insertclasssumm($dataseri);
                
                
           }
                          
        

        } // end count loop
        
        $user=User_helper::get_user();
        $user_id = $user->id;    
        $data['institute']=$this->Institute_model->get_institute_information($user->id);  
       $ajax['status']=true;
       $ajax['system_message']=$this->lang->line("SCHOOL_CLASS_INFORMATION_SUBMITED");
       $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
       $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("institute/classadd",$data,true));
     //       $this->jsonReturn($ajax);
            
       $this->jsonReturn($ajax);
      //  redirect('/institute/institute/classadd', 'refresh');

    }
    
}
