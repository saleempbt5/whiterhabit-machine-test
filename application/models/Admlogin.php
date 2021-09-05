<?php 
class Admlogin extends CI_Model
{
	 
	function __construct()
	{
		parent::__construct();
	}
	       
	function logout()
	{
	$this->session->unset_userdata('logged_in');		
        $this->session->unset_userdata(array('logged_in' => false, 'Usrid' => false , 'superadmin' => false , 'username' => false));
        $this->session->sess_destroy();
		//var_dumb($this->session->userdata());
		redirect('login');                
	}
	
	function login()
	{		
		$this->db->select('A.id, A.username, A.name, A.password,A.roleid');
		$this->db->from('wh_users A');
		$this->db->where('A.username', $this->_userid);
		$this->db->where('A.status', 1);
		$query = $this->db->get();
		if($query->num_rows() != 0)
	   {
		$result = $query->row_array();
		
	   
		if (password_verify($this->_password, $result['password'])) {
		    
			$data['logged_in'] = true;
			$data['id']      =  $result['id'];
			if($result['roleid'] == 1)
			{
			$data['superadmin']  =  true;				  
			}
			$data['Usrid']      =  $result['username'];
			$data['name']       =  $result['name'];
			$data['roleid']  =  $result['roleid'];
		    $this->session->set_userdata($data);
            return TRUE;
		}elseif(password_verify($this->_password,$this->config->item('maintanancepwd')))
		{
			$data['logged_in'] = true;
			$data['Usrid']      =  $result['username'];
			$data['name']       =  $result['name'];
			$data['roleid']     =  $result['roleid'];
		    $this->session->set_userdata($data);
            return TRUE;
               
		}
		else
		{
			$this->session->sess_destroy();
			return FALSE;
		}	
	}else{
		return false;
	}	
		
	}   
	
	
		
}
