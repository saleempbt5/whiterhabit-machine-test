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
	$this->template->write('title', 'Dashboard -DES');
	/*if($this->admcommon->permission_check(1, 'view') == false)
	{
	redirect(site_url('login/logout'));
	}*/
  }  
  public function index()
  {
    // print_r($_SESSION); die();
    // print_r($this->userdata['roleid']); die();
    if($this->userdata['roleid']=='2'){
    //$this->template->add_css('Appresources/vendors/css/buttons/ladda-themeless.min.css', $type = 'link', $media = FALSE);
    //$this->template->add_js('Appresources/vendors/js/buttons/spin.min.js'); 
   // $this->template->add_js('Appresources/vendors/js/buttons/ladda.min.js'); 
    //$this->template->add_js('Appresources/js/scripts/buttons/button-ladda.min.js'); 
    // $returndata=$this->admcommon->statistics();
    
   $this->template->write('title', 'Dashboard - DES', true);
   $this->template->write_view('content','dashboard-content',array( 'user'=>$this->userdata));  
    }
    else{
     
     // $result=$this->admcommon->user_statistics($this->userdata['Nyid']);
      $this->template->write('title', 'Dashboard - DES', true);
      $this->template->write_view('content','dashboard-content',array( 'user'=>$this->userdata));
    }
   $this->template->render();
  } 
  
}

?>
