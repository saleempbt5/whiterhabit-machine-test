<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

function __construct()
	{
        parent::__construct();       
        $this->load->library('template');
	    $this->load->model('admlogin', '', TRUE);	
        $this->template->set_template('logintpl');	
        $this->template->write('title', 'Login - White Rabbit Group');
        $this->load->model('admcommon', '', TRUE); 
		$this->load->model('admusers', '', TRUE);
        $this->config->load('credentials');   
        
      }
	public function index()
	{
	  $this->admcommon->hasToRedirect();
	  $this->form_validation->set_rules('userid', 'User Id', 'required');
      $this->form_validation->set_rules('userpassword', 'Password', 'required|min_length[4]');
      $this->_userid    = $this->input->post('userid');
      $this->_password = $this->input->post('userpassword');
     
      if ($this->form_validation->run() == true) {                      
            if ($this->admlogin->login()) {	
			 //  $this->admcommon->save_action_log('loggedin', 'Login', NULL);
               redirect(site_url('dashboard'));
            } else {                
                $this->template->write_view('content', 'loginform', array('status_msg' => 'Userid and password do not match!', 'data' => $this->input->post()));
            }
            
        } else {           
           
            $this->template->write_view('content', 'loginform', array('status_msg' => validation_errors(), 'data' => $this->input->post()));
        }
        $this->template->render();
    }	
	function logout() {
        $this->admlogin->logout();
    }

	public function createAdmin()
	{
      $admin_details = array(
		'name'=>"Admin",
		'useremail'=>"admin@whiterabbit.com",'username'=>"wrAdmin",'userpassword'=>"admin123",'useradd'=>"xxxxxxxx",'userphone'=>'23323232','userrole'=>1,'status'=>1,'craetedby'=>1
	  );
	  $ins_ref=$this->admusers->createadmin($admin_details);
	  if($ins_ref)
	  {
       echo "Admin created successfully! : username : wrAdmin \n Password : admin123 \n Please remove this function in production";
	  }

	}

    function passwordhashing()
    {
        $string = $this->uri->segment(3,false); 
         // echo  $string;
   if(!$string)
   {
    show_404();
   }else
   {
    echo password_hash($string, PASSWORD_DEFAULT);
   }
        
    }
	
 
}
