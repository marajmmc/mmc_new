<?php
class Dashboard_helper
{
    // Center Count
    public static function get_all_applied_institute($status=null, $level=null,$type=null)
    {

        $CI = & get_instance();
        $user=User_helper::get_user();
        if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID'))
        {
            //$CI->db->where('','');
        }
        else if($user->user_group_id==$CI->config->item('A_TO_I_GROUP_ID'))
        {
            //$CI->db->where('','');
        }
        else if($user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_4'))
        {
            //$CI->db->where('','');
        }
        else if($user->user_group_id==$CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_3'))
        {
            //$CI->db->where('','');
        }
        else if($user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_3'))
        {
            $CI->db->where('institute.divid',$user->division);
        }
        elseif($user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_4'))
        {
            $CI->db->where('institute.divid',$user->division);
            $CI->db->where('institute.zillaid',$user->zilla);
        }
        elseif($user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_3'))
        {
            $CI->db->where('institute.divid',$user->division);
            $CI->db->where('institute.zillaid',$user->zilla);
            $CI->db->where('institute.upozillaid',$user->upazila);
        }
        else
        {
            //$CI->db->where('','');
        }

        if($level=="PRIMARY")
        {
            $CI->db->where('institute.is_primary', 1);
        }
        elseif($level=="SECONDARY")
        {
            $CI->db->where('institute.is_secondary', 1);
        }
        elseif($level=="INTERMEDIATE")
        {
            $CI->db->where('institute.is_higher', 1);
        }
        else
        {

        }

        if($type=="GENERAL")
        {
            $CI->db->where('institute.education_type_ids', 1);
        }
        elseif($type=="MADRASHA")
        {
            $CI->db->where('institute.education_type_ids', 2);
        }
        else
        {

        }

        if($status==$CI->config->item('STATUS_ACTIVE'))
        {
            $CI->db->where('institute.status', $CI->config->item('STATUS_ACTIVE'));
        }
        elseif($status==$CI->config->item('STATUS_INACTIVE'))
        {
            $CI->db->where('institute.status', $CI->config->item('STATUS_INACTIVE'));
        }
        else
        {

        }

        $CI->db->from($CI->config->item('table_institute').' institute');
        $total=$CI->db->count_all_results();
        return $total;
    }

    public static function get_number_of_user()
    {

        $CI = & get_instance();
        $user=User_helper::get_user();
        $CI->db->from($CI->config->item('table_users').' core_01_users');
        $CI->db->where('core_01_users.user_group_id', $CI->config->item('USER_GROUP_INSTITUTE'));
        $total=$CI->db->count_all_results();
        return $total;
    }

    public static function get_number_of_mmc_user($type=null)
    {
        $CI = & get_instance();
        $user=User_helper::get_user();
        //$CI->db->select('id numrows');
        $CI->db->from($CI->config->item('table_class_details').' institute_class_details');
        if($type=="YESTERDAY")
        {
            $yesterday = date('Y-m-d',strtotime("-1 day"));
            $CI->db->where('institute_class_details.class_date', $yesterday);
        }
        $CI->db->group_by('institute_class_details.institude_id');
        $query = $CI->db->get();
        return $query->num_rows();
    }



}