<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
  public $userdata = array();
  var $notifications = '';
  public $usrperms = array();
  public $userdetails_full = array();
  function __construct()
  {
    parent::__construct();
	  $this->load->model('admcommon', '', TRUE);
    $this->admcommon->hasToRedirect();
    //$this->template->set_template('siteadmintpl');
    $this->userdata = $this->admcommon->currentUser();
    // print_r($this->userdata);
	  if($this->userdata){
	  $notifications ='';	 
	  $this->userdetails_full = $this->admcommon->readuser($this->userdata['Usrid']);
	  $this->template->write_view('topbar','topbar',array('user'=>$this->userdata, 'notifications'=>$this->notifications));
    $menus = $this->admcommon->menu_array_foruser($this->userdata['roleid']);
    //echo "<pre>";print_r($menus);echo "</pre>";

	  $this->template->write_view('leftsection','sidebar',array('user'=>$this->userdetails_full, 'activeclass'=>'dashboard', 'menu'=> $menus));
    }
	$this->template->write('title', 'Dashboard -White Rabbit');
	/*if($this->admcommon->permission_check(1, 'view') == false)
	{
	redirect(site_url('login/logout'));
	}*/
  }  
  public function index()
  {
    $this->template->add_css('Appresources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css', $type = 'link', $media = FALSE);
  $this->template->add_css('Appresources/plugins/datatables-responsive/css/responsive.bootstrap4.min.css', $type = 'link', $media = FALSE); 
  $this->template->add_css('Appresources/plugins/sweetalert2/sweetalert.css', $type = 'link', $media = FALSE); 

  $this->template->add_js('Appresources/plugins/datatables/jquery.dataTables.min.js'); 
  $this->template->add_js('Appresources/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); 
  $this->template->add_js('Appresources/plugins/datatables-responsive/js/dataTables.responsive.min.js'); 
  $this->template->add_js('Appresources/plugins/datatables-responsive/js/responsive.bootstrap4.min.js');
  $this->template->add_js('Appresources/plugins/jquery-validation/jquery.validate.min.js');
  $this->template->add_js('Appresources/plugins/sweetalert2/sweetalert.min.js');
  $this->template->add_js('Appresources/dist/js/pages/files/filelist.js?ver=3');
	 $allusers = $this->admcommon->readusers_exceptadmin();
   $this->template->write('title', 'Dashboard - WR', true);
   $this->template->write_view('content','dashboard-content',array( 'user'=>$this->userdata, 'users'=> $allusers));  
   $this->template->render();
  } 

  public function add_files()
	{
    $adddatetime=date('Y-m-d H:i:s');        
    $inputary = $this->input->post();
    if(isset($inputary['filename']))
   {
    // if($ext!=0)
    // {
    //   $this->session->set_flashdata('error', 'user already exists with this details..!'); 
    //   redirect(site_url('users'));  
    // }

    $filename = $this->input->post('filename');
		$userarray = $this->input->post('users');
		$config['upload_path']          = "uploads";
		$config['allowed_types']        = '*';
		$config['file_name']            = 'WR-files-'.time(); 
		$this->load->library('upload', $config);
    $this->upload->initialize($config);
    
		if ( ! $this->upload->do_upload('file'))
                {
                  $error =  $this->upload->display_errors();
                  $this->session->set_flashdata('error', $error); 
                  redirect(site_url('dashboard'));  
                }
                else
                 {              
                    $imgdata = $this->upload->data();
                    $inputary['fileurl'] = $imgdata['file_name'];
                   if($this->admcommon->saveFiles($inputary))
									 {
										$this->session->set_flashdata('success', "File uploaded successfully"); 
										redirect(site_url('dashboard'));  
									 }
                 } 

  }
   else{
     show_404();
   }

	}

	function readAllfiles()
  {
   if($this->input->post())
    {
			if($_SESSION['roleid'] ==1 || $_SESSION['roleid'] ==2)
			{
				$users =  $this->admcommon->allfiles();
			}else
			{
				$users =  $this->admcommon->allmyfiles($_SESSION['id']);
			}
    $users =  $this->admcommon->allfiles();
   // print_r($users); die();
    $userary = array();  
    $i=1;
    foreach($users['result'] as $file)
    {     
       $statusvar = '';  
       $actionvar = '';   
              
			 $actionvar = '<button class="btn btn-primary btn-sm" data-controller="'.site_url("users/").'" data-id="'.$file['id'].'" id="EditButton" data-toggle="modal"  data-target="#edituser">
			 <i class="fas fa-edit"></i> Edit</button>
			 <button class="btn  btn-danger btn-sm" data-controller="'.site_url("users/").'" data-id="'.$file['id'].'" id="userdeletebutton">
			 <i class="fas fa-trash"></i> Delete</button>';
	
         $userary[]=array(
         'slno'=>$i,
         'filename'=>$file['filename'],
         'fileurl'=>$file['fileurl'],
          'createdby'=>$file['createdby'],        
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


  
}

?>
