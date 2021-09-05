<?php 
class Admcommon extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function isLoggedIn(){
		$session_Dta  =  $this->session->userdata();
    if($this->session->userdata('logged_in') == true && $this->session->has_userdata('Usrid') )
		{
		  return TRUE;
		}else{
      return FALSE;
    }
		
	}
	
	function isAdmin()
        {
          if($this->session->userdata('logged_in') == TRUE && $this->session->userdata('superadmin') == TRUE)
            {
              return TRUE;
            }
            return FALSE; 
        }
   
	function currentUser(){

		if($this->isLoggedIn()){
			$data = $this->session->all_userdata();			
		}
		else{
			$data['logged_in'] = false;			
		}
		return $data;
	}
	
 function hasToRedirect(){		    	
    if($this->isLoggedIn())
            {	 			
               //var_dump($this->session->userdata());
                 if($this->router->class == 'login'){
                 redirect('dashboard');
                }
            }
            else{   
                if($this->router->class == 'dashboard'){
                   redirect('login');
                }
                else if($this->router->class == 'users'){
                    redirect('login');
                }
                
            }           
            
        }
        
    function menu_array_foruser($roleid)
    {   
      $queryr = ''; 
      if($this->isAdmin())
      {
       $this->db->order_by('wieght', 'ASC');
       $queryr = $this->db->get_where('wh_menu_master', array('parent' => 0, 'status'=>1));
      }else{
      $this->db->select('A.roleid AS roleid, A.permission AS permission, B.menuname AS menuname, B.link AS link, B.iconclass AS iconclass, B.id AS id');
      $this->db->from('wh_role_permissions A'); 
      $this->db->join('wh_menu_master B', 'A.menuid = B.id', 'right');
      $this->db->where('A.roleid', $roleid);
      $this->db->where('B.parent', 0);
      $this->db->where('A.status', 1);
      $this->db->where('A.permission','view');
      $this->db->order_by('B.wieght', 'ASC');
      $queryr = $this->db->get();
      }
      if($queryr->num_rows() > 0) 
      {
       return $queryr->result_array();              
      }else
      {
       return false;
      }
    }  
 

  function check_current_password($userid, $password)
	{
		$this->db->where('username', $userid);
    //$this->db->where('password', md5($password));
		$query = $this->db->get('wh_users');
		//$result = $query->row_array();
                if($query->num_rows() > 0)
                   {
                    $result = $query->row_array();
                    if(password_verify($password, $result['password']))
                    {
                      return true;
                    }else{
                      return false;
                    }
                   
                   }else
                   {
                    return false;
                   }
	}	
  
  function read_permissions($roleid)
  {
    
  $sql       = 'SELECT * FROM `wh_role_permissions` A WHERE A.roleid='.$roleid.'';        
  $query     = $this->db->query($sql); 
  $resultary = $query->result_array();
 // $flatted_ary  = $this->m_flatten($resultary, 'permission'); 
  return $resultary;
  }
 function permission_check($menuid, $permission){
	  if($this->isAdmin())
	  {		  
	  return true;  		  
	  }else{
	  $currentus  =  $this->currentUser();
	  $perms = $this->read_permissions($currentus['roleid']);
        //  var_dump($perms);
         $find ='ponnoo';
         // echo $find;
          foreach($perms as $perm)
          {
            $permission  =  (string)$permission;
            $tbldt  = preg_replace('/\s+/',' ',$perm['permission']);           
            if($tbldt == $permission && $menuid == $perm['menuid'] )
             {
             return TRUE;
             }	
          } 	  
         
	  }
	}
	function m_flatten($array, $index) {
		$return = array();

        if (is_array($array)) {
                foreach ($array as $row) {
					
                    $return[] = $row[$index];
                }
            }
        return $return;
    }
	function readuser($userid)
	{
    $this->db->select('name, username');
   $this->db->where('status', 1);
   
	 $query = $this->db->get_where('wh_users', array('username' => $userid));
	 $resultary = $query->row_array();	
   return $resultary;
	}
  function readusers_exceptadmin()
	{
    $this->db->select('id, name, username');
   $this->db->where('status', 1);
	 $query = $this->db->get_where('wh_users', array('roleid' => 3));
	 $resultary = $query->result_array();	
   return $resultary;
	}



  function readusergroup_byid($userid)
  {
   $query = $this->db->get_where('wh_user_groups', array('userid'=>$userid));
             if($query->num_rows() > 0)
                    return $query->row_array();  
                else
                    return false;
   
  }

	function save_action_log($action, $module, $moduleid)
	{
	 $userdetails  = $this->session->userdata();
	 $adddatetime=date('Y-m-d H:i:s');	 
	 $data = array();	
	 $data = array(
        'userid' => $userdetails['Usrid'],
        'action_taken' => $action,
	    	'sourceobj' => $module,
		    'sourceobjid'=>$moduleid,
        'actiontime' => $adddatetime,
      );	
    $this->db->insert('wh_user_actionlog', $data);	
    }
  function readallactivemenus()
  {
    $query = $this->db->get_where('wh_menu_master', array('status'=>1));
    return $query->result_array();
  }
  

	function saveFiles($inputary)
	{
		$this->db->trans_start();
	 $adddatetime=date('Y-m-d H:i:s');	    
	 $admary = array(
		'filename'=>$inputary['filename'],
		'fileurl'=>$inputary['fileurl'],
		 'createdat'=>$adddatetime,
		 'updatedat'=>$adddatetime,
		 'createdby'=>$this->session->userdata('id'));
			$this->db->insert('wh_files', $admary);	
			$lastid = '';
			if($this->db->affected_rows() > 0)
        {
        	$lastid = $this->db->insert_id();
        }
				if(is_array($inputary['users']))
				{
         foreach($inputary['users'] as $user)
				 {
          $this->db->insert('file_permissions', array('fileid'=> $lastid, 'userid'=> $user, 'createdat'=>$adddatetime, 'updatedat'=>  $adddatetime));	

				 }
				}


      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
			{
				return false;
			}else
			{
				return true;
			}


	} 


	function allfiles()
    {
      $status=$this->input->post('status');
     
      $sql="SELECT A.id, A.filename, A.fileurl, B.name AS createdby FROM wh_files A LEFT JOIN wh_users B ON B.id = A.createdby WHERE A.status=$status";
		
      $query = $this->db->query($sql); 
     // print_r($query->result_array());     
      $res['num_rows']=$query->num_rows();
      if($_POST['search']['value']!=''):
           $like=$_POST['search']['value'];
           
             $sql.=" AND (A.filename like '%$like%')";
              //  echo $sql;die();
             $qr2=$this->db->query($sql);
                $res['filter_rows']=$qr2->num_rows();
           else:
                $res['filter_rows']=$query->num_rows();
            endif;
         if(isset($_POST['order'])):
                $odr=array(1=>'name',2=>'username');
                $by=$_POST['order'][0]['column'];$dir=$_POST['order'][0]['dir'];
                $sql.=" order by $odr[$by] $dir";
            else:
               $sql.=" order by A.createdat DESC";

            endif;
            if($_POST['length'] != -1):
                $limit=$_POST['length'];
                $start=$_POST['start'];
                 $sql.=" limit $limit offset $start";
                $query=$this->db->query($sql);
                $res['result']=$query->result_array();
            endif;
           // print_r($res);
            return $res;
    }
  
		function allmyfiles($id)
    {
      $status=$this->input->post('status');
     
      $sql="SELECT A.id, A.filename, A.fileurl, B.name AS createdby FROM wh_files A LEFT JOIN wh_users B ON B.id = A.createdby JOIN file_permissions C ON C.fileid = A.id WHERE A.status=$status AND C.userid = $id ";
		 // echo $sql;die();
      $query = $this->db->query($sql); 
     // print_r($query->result_array());     
      $res['num_rows']=$query->num_rows();
      if($_POST['search']['value']!=''):
           $like=$_POST['search']['value'];
           
             $sql.=" AND (A.filename like '%$like%')";
              //  echo $sql;die();
             $qr2=$this->db->query($sql);
                $res['filter_rows']=$qr2->num_rows();
           else:
                $res['filter_rows']=$query->num_rows();
            endif;
         if(isset($_POST['order'])):
                $odr=array(1=>'name',2=>'username');
                $by=$_POST['order'][0]['column'];$dir=$_POST['order'][0]['dir'];
                $sql.=" order by $odr[$by] $dir";
            else:
               $sql.=" order by A.createdat DESC";

            endif;
            if($_POST['length'] != -1):
                $limit=$_POST['length'];
                $start=$_POST['start'];
                 $sql.=" limit $limit offset $start";
                $query=$this->db->query($sql);
                $res['result']=$query->result_array();
            endif;
           // print_r($res);
            return $res;
    }

		
}
