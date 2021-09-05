<?php 
class Admusers extends CI_Model
{	 
	function __construct()
	{
		parent::__construct();
	}

	function allusers()
    {
      $status=$this->input->post('status');
     
      $sql="SELECT A.id, A.username, A.name, A.roleid, A.status, B.name AS role FROM wh_users A LEFT JOIN wh_role_master B ON B.id = A.roleid WHERE A.status=$status AND A.roleid <> 1";
      $query = $this->db->query($sql); 
     // print_r($query->result_array());     
      $res['num_rows']=$query->num_rows();
      if($_POST['search']['value']!=''):
           $like=$_POST['search']['value'];
           
             $sql.=" AND (A.username like '%$like%' or A.name like '%$like%'  or B.name like '%$like%')";
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
    function roles()
    {
     
      $this->db->select('id,name');
     
      $query=$this->db->get_where('wh_role_master',array('id!='=>'1'));
      $row=$query->result_array();
      return $row;
    }
    
   
  function savemodal($value)
  {
    $this->db->select('ifnull(max(id),0)as uid');
    $query=$this->db->get('wh_users');
    $result=$query->row_array();
    $re=$result['uid'];
    $res=$re+1;
    $dt="wrtest".sprintf('%04d',$res) ;
	//	echo $dt; die();
    $string=$value['usercpswdid'];
    $pswd=password_hash($string, PASSWORD_DEFAULT); 
    $time=date('Y-m-d H:i:s');
    $data=array('name'=>$value['username'],'email'=>$value['useremail'],'username'=>$dt,'password'=>$pswd,'address'=>$value['useradd'],'phoneno'=>$value['userphone'],'roleid'=>$value['userrole'],'status'=>1,'createdat'=>$time,'craetedby'=>$_SESSION['roleid']);
    
    $qry=$this->db->insert('wh_users',$data);
    return $qry;
  }

	function createadmin($value)
  {
    $string=$value['userpassword'];
    $pswd=password_hash($string, PASSWORD_DEFAULT); 
    $time=date('Y-m-d H:i:s');
    $data=array('name'=>$value['name'],'email'=>$value['useremail'],'username'=>$value['username'],'password'=>$pswd,'address'=>$value['useradd'],'phoneno'=>$value['userphone'],'roleid'=>$value['userrole'],'status'=>1,'createdat'=>$time,'craetedby'=>$value['craetedby']);
    
    $qry=$this->db->insert('wh_users',$data);
    return $qry;
  }
	function already_exists_admin($val)
  {
    $wh="(phoneno='".$val['userphone']."' OR email='".$val['useremail']."' OR username='".$val['username']."')";
    $this->db->select('phoneno,email');
    $this->db->where($wh);
    $query=$this->db->get('wh_users');
    $res=$query->num_rows();
    return $res;
   
  }





  function getuserid($id)
  {
  
   $this->db->select('id,name,phoneno,email,password,username,roleid,address');
   $qry=$this->db->get_where('wh_users',array('id'=>$id));
   $query=$qry->row_array();
   return $query;
  
  }
  function update_user_details($datafetch)
  {
   if(empty($datafetch['editupswdid'] && $datafetch['editucpswdid']))
   {
    $data=array('id'=>$datafetch['idusr'],'name'=>$datafetch['edituname'],'email'=>$datafetch['edituemail'],'address'=>$datafetch['edituadd'],'phoneno'=>$datafetch['edituphone'],'roleid'=>$datafetch['editurole']);
   $this->db->where('id',$datafetch['idusr']);
    $result=$this->db->update('wh_users',$data);
    return $result;
   }
   else{
    $string=$datafetch['editupswdid'];
    $pswd=password_hash($string, PASSWORD_DEFAULT);
    $data=array('id'=>$datafetch['idusr'],'name'=>$datafetch['edituname'],'email'=>$datafetch['edituemail'],'password'=>$pswd,'address'=>$datafetch['edituadd'],'phoneno'=>$datafetch['edituphone'],'roleid'=>$datafetch['editurole']);
    $this->db->where('id',$datafetch['idusr']);
     $result=$this->db->update('wh_users',$data);
     return $result;
   }
   
  }
  function already_exists($val)
  {
    $wh="(phoneno='".$val['userphone']."' OR email='".$val['useremail']."')";
    $this->db->select('phoneno,email');
    $this->db->where($wh);
    $query=$this->db->get('wh_users');
    $res=$query->num_rows();
    return $res;
   
  }
  function editalready_exists($value)
  {
    
    // $data=array('phoneno'=>$value['edituname'],'email'=>$value['edituphone']);
    $wh="(phoneno='".$value['edituphone']."' OR email='".$value['edituemail']."')";
    $this->db->select('phoneno,email');
    $this->db->where('id !=',$value['idusr']);
  
    $this->db->where($wh);
    $query=$this->db->get('wh_users');
    return $query->num_rows();
  }
  function aj_getpswd($id)
  {
  
   $this->db->select('id,name,phoneno,email,username,password,roleid,address');
   $qry=$this->db->get_where('wh_users',array('id'=>$id));
   $query=$qry->row_array();
   return $query;
  
  }
  function resetpswd($value)
  {
    $id=$value['uid'];

    $str=$value['resetupswdid'];
    $pswd=password_hash($str, PASSWORD_DEFAULT);
    $this->db->where('id',$id);
    $qry=$this->db->update('wh_users',array('password'=>$pswd));
  
    return $qry;
    
  }
  
  function deleteuser($id)
   {
     $this->db->where('id',$id);
     $this->db->update('wh_users', array('status'=>2));
      if($this->db->affected_rows() > 0)
        {
          return true;
        }else
        {
          return false;
        }
   }
   function restoreuser($id)
   {
     $this->db->where('id',$id);
     $this->db->update('wh_users',array('status'=>1));
     if($this->db->affected_rows() >0 )
     {
       return true;
     }
     else{
       return false;
     }
   }
}
