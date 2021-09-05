<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller
{
  public $userdata = array();
  var $notifications = '';
  public $usrperms = array();
  public $userdetails_full = array();
  public $roledata=array();
  function __construct()
  {
    parent::__construct();
	  $this->load->model('admcommon', '', TRUE);
    $this->load->model('admusers', '', TRUE);
    $this->admcommon->hasToRedirect();
    $this->userdata = $this->admcommon->currentUser();
    $this->roledata=$this->admusers->roles();
      
 // print_r($this->roledata); 
 // print_r($this->userdata);
	if($this->userdata){
	  $notifications ='';	 
	  $this->userdetails_full = $this->admcommon->readuser($this->userdata['Usrid']);
	  $this->template->write_view('topbar','topbar',array('user'=>$this->userdata, 'notifications'=>$this->notifications));
    $menus = $this->admcommon->menu_array_foruser($this->userdata['roleid']);
	  $this->template->write_view('leftsection','sidebar',array('user'=>$this->userdetails_full, 'activeclass'=>'3', 'menu'=> $menus));
    }
	$this->template->write('title', 'Users - DES');
	if($this->admcommon->permission_check(3, 'view') == false)
	{
	redirect(site_url('login/logout'));
	}
  }  
  public function index()
  {
  $this->template->add_css('Appresources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css', $type = 'link', $media = FALSE);
  $this->template->add_css('Appresources/plugins/datatables-responsive/css/responsive.bootstrap4.min.css', $type = 'link', $media = FALSE); 
  $this->template->add_css('Appresources/plugins/sweetalert2/sweetalert.css', $type = 'link', $media = FALSE); 
  // $data=$this->admusers->usercode();
  // $re= $data['uid'];
  // $res=$re+1;
  // $dt="NZ".sprintf('%4d',$res) ;
  
  $this->template->add_js('Appresources/plugins/datatables/jquery.dataTables.min.js'); 
  $this->template->add_js('Appresources/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); 
  $this->template->add_js('Appresources/plugins/datatables-responsive/js/dataTables.responsive.min.js'); 
  $this->template->add_js('Appresources/plugins/datatables-responsive/js/responsive.bootstrap4.min.js');
  $this->template->add_js('Appresources/plugins/jquery-validation/jquery.validate.min.js');
  $this->template->add_js('Appresources/plugins/sweetalert2/sweetalert.min.js');
  $this->template->add_js('Appresources/dist/js/pages/users/userlist.js?ver=3');

  $this->template->write_view('contentheader','users/userheader',array()); 
  $this->template->write_view('content','users/userlist',array('roles'=>$this->roledata));  
  $this->template->render();
  }

  function readAllusers()
  {
   if($this->input->post())
    {
    $users =  $this->admusers->allusers();
   // print_r($users); die();
    $userary = array();  
    $i=1;
    foreach($users['result'] as $user)
    {     
       $statusvar = '';  
       $actionvar = '';   
              
       if(isset($user['roleid']))
       {
        if($user['roleid'] == 2 || $user['roleid'] == 1)
        {
            $actionvar =        
            '<button class="btn btn-primary btn-sm" data-controller="'.site_url("users/").'" data-id="'.$user['id'].'" id="EditButton" data-toggle="modal"  data-target="#edituser">
            <i class="fas fa-edit"></i> Edit</button> <button class="btn btn-info btn-sm" data-controller="'.site_url("users/").'" data-id="'.$user['id'].'" id="resetbutton" data-toggle="modal"  data-target="#resetpswd">
            <i class="fas fa-edit"></i> Reset Password</button>'; 
        }else
        {
           if($user['status'] == 1)
           {
            $actionvar = '<button class="btn btn-primary btn-sm" data-controller="'.site_url("users/").'" data-id="'.$user['id'].'" id="EditButton" data-toggle="modal"  data-target="#edituser">
            <i class="fas fa-edit"></i> Edit</button>
            <button class="btn  btn-danger btn-sm" data-controller="'.site_url("users/").'" data-id="'.$user['id'].'" id="userdeletebutton">
            <i class="fas fa-trash"></i> Delete</button>
            <button class="btn  btn-info btn-sm" data-controller="'.site_url("users/").'" data-id="'.$user['id'].'" id="resetbutton" data-toggle="modal" data-target="#resetpswd">
            <i class="fas fa-wrench"></i>  Reset Password</button>'; 

           }else if($user['status'] == 2)
           {
            $actionvar = '<button class="btn btn-danger btn-sm" data-controller="'.site_url("users/").'" data-id="'.$user['id'].'"data-status="'.'1'.'" id="restorebutton">
            <i class="fas fa-trash-restore"></i> Restore</button>'; 

           }

        }


        
       }
         $userary[]=array(
         'slno'=>$i,
         'name'=>$user['name'],
         'username'=>$user['username'],
          'role'=>$user['role'],        
         'actions'=> $actionvar
        );       
     $i=$i+1;
    } 
    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $users['num_rows'],
            "recordsFiltered" => $users['filter_rows'],
            "data" => $userary,
        );
    print json_encode($output);

    }else
    {
     echo show_404();  
    }
    
 }
 

 


 function post_validation()
 {
  
   if($this->input->post('username') && $this->input->post('userphone')&& $this->input->post('useremail')&&$this->input->post('userrole')&& $this->input->post('userpswdid')&& $this->input->post('usercpswdid')&&$this->input->post('useradd'))
   {
    $ext=$this->admusers->already_exists($this->input->post());
    if($ext!=0)
    {
      $this->session->set_flashdata('error', 'user already exists with this details..!'); 
      redirect(site_url('users'));  
    }
    else{
    $ins_ref=$this->admusers->savemodal($this->input->post());
    if($ins_ref)
    {
      $this->session->set_flashdata('success', 'User added Successfully'); 
      redirect(site_url('users')); 
    }
    else{
      $this->session->set_flashdata('error', 'Failed to add user');
      redirect(site_url('users')); 
    }
   }
  }
   else{
     show_404();
   }
 
 
 
 
 
  }
  function editmodal()
  {
   
   if($this->input->post('id'))
   {
     $result=$this->admusers->getuserid($this->input->post('id'));
     
     if($result)
     {
      print json_encode(array('action'=>'success','returnresult'=>$result));
     }
     else{
      print json_encode(array('action'=>'failure'));
     }
   }
   else
   {
     print json_encode(array('action'=>'failure'));
   }  
   
  }
  function editpost_validation()
  {
    if($this->input->post('edituname') && $this->input->post('edituemail'))
    {
      //print_r($this->input->post());die();
      $exte=$this->admusers->editalready_exists($this->input->post());
     
      if($exte!=0)
      {
        $this->session->set_flashdata('error', 'user already exists with this details..!'); 
        redirect(site_url('users'));  
      }
      else{
        $up_ref=$this->admusers->update_user_details($this->input->post());
       if($up_ref)
        {
        $this->session->set_flashdata('success', 'Updated Successfully'); 
        redirect(site_url('users')); 
      
        }
    else{
      $this->session->set_flashdata('error', 'Updation is unsuccessfull');
      redirect(site_url('users')); 
        }
    }
   }
   else{
     show_404();
   }
    
    
}
function reset_pswd()
{
  //print_r($this->input->post('uid')); die();
  //print_r($this->input->post()); die();
  $id=$this->input->post('uid');
  if($this->input->post('resetupswdid') && $this->input->post('resetucpswdid'))
  {
   
    $reset_ref=$this->admusers->resetpswd($this->input->post());
 
    if($id == $_SESSION['Nyid'])
    {
      $this->session->sess_destroy(); 
      redirect(site_url('login/logout'));
    }
    else if($id !== $_SESSION['Nyid'] && $reset_ref)
    {
      $this->session->set_flashdata('success', 'Password has been reset successfully'); 
      redirect(site_url('users')); 
    }
    else{
      $this->session->set_flashdata('error', 'Password not reset'); 
      redirect(site_url('users')); 
    }
  }
  else{
    show_404();
  }
}
function aj_resetpassword()
{
  if($this->input->post('id'))
  {
    $result=$this->admusers->aj_getpswd($this->input->post('id'));
    
    if($result)
    {
     print json_encode(array('action'=>'success','returnresult'=>$result));
    }
    else{
     print json_encode(array('action'=>'failure'));
    }
  }
  else
  {
    print json_encode(array('action'=>'failure'));
  }  
}

function deleteUsr()
 {
  //print_r($this->input->post()); die();
   if($this->input->post('id'))
   {
    if($this->admusers->deleteuser($this->input->post('id')))
    {
      print "success";
    }else
    {
      print "failure";
    }

   }else
   {
     print "failure";
   }  

  //  function dy_list()
  //  {
  //    print_r($this->input->post());die();
  //  }
 }
 function restoreUsr()
 {
   if($this->input->post('id'))
   {
     if($this->admusers->restoreuser($this->input->post('id')))
     {
      print "success";
     }
     else
    {
      print "failure";
    }
   }
   else
   {
     print "failure";
   }  
 }

}

?>
