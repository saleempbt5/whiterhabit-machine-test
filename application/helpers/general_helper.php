<?php

 function format_array_of_field($array, $fieldname='')
  { 
     $retary = array();
     if (is_array($array)) {
       foreach ($array as $value) {
         $retary[]= $value[$fieldname];        
       }
       return $retary;
     }else
     {
      return false;
     }

  }  
 
   function read_submenu($id, $menuarray=array())
    {

       $ci= & get_instance();
       $db1=$ci->load->database('default',true);
       $queryr = '';
        if(Isadmin())
        {
         $queryr = $db1->get_where('wh_menu_master', array('parent' => $id, 'status'=>1));
        }
        else
        {
       $db1->select('A.roleid, A.permission AS permission, B.menuname AS menuname, B.link AS link, B.iconclass AS icon, B.id AS id');
       $db1->from('wh_role_permissions A'); 
       $db1->join('wh_menu_master B', 'A.menuid = B.id', 'left');
       $db1->where('B.parent', $id);
       $db1->where('A.roleid', $ci->session->userdata('roleid'));
       $db1->where('A.status', 1);
       $db1->order_by('B.wieght', 'ASC');
       $queryr = $db1->get();
        }
     // $query =  $db1->get();
     if($queryr->num_rows() > 0) 
     {
       $resultary = $queryr->result_array(); 
       foreach($resultary as $menu)
       {              
       $menuarray[] = array('menuname'=>$menu['menuname'], 'link'=> $menu['link'], 'id'=>$menu['id'] ); 
       }
    }else
      {
       return false;    
      }
      
     return $menuarray;

    }    

    function has_childof($id)
     {
       $ci= & get_instance();
       $db1=$ci->load->database('default',true);
       $queryr = '';
       if(Isadmin())
        {
         $queryr = $db1->get_where('wh_menu_master', array('parent' => $id, 'status'=>1));
        }
        else
        { 

       $db1->select('A.roleid, A.permission AS permission, B.menuname AS menuname, B.link AS menulink, B.iconclass AS icon, B.id AS menuid');
       $db1->from('wh_role_permissions A'); 
       $db1->join('wh_menu_master B', 'A.menuid = B.id', 'left');
       $db1->where('B.parent', $id);
       $db1->where('A.roleid', $ci->session->userdata('roleid'));
       $db1->where('B.status', 1);
       $queryr = $db1->get();
      }
       if($queryr->num_rows() > 0) 
       {
        return true;
       }else {
        return false;
       }
     }

     function Isadmin()
        {
          $ci= & get_instance();
          if($ci->session->userdata('logged_in') == TRUE && $ci->session->userdata('superadmin') == TRUE)
            {
              return TRUE;
            }
            return FALSE; 
        }
        
        function array_flatten($array = null) {
    $result = array();

    if (!is_array($array)) {
        $array = func_get_args();
    }

    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
        } else {
            $result = array_merge($result, array($key => $value));
        }
    }

    return $result;
}

