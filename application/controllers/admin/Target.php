
<?php  

class Target extends CI_Controller 
{   
    function __construct()
    {
        parent::__construct();
        $this->admin_info      =  $this->common->__check_session();
        $this->load->model('Target_model');       
        $this->load->helper('form');
        $this->load->library('round');
		$this->load->library('session');
    }
    
    public function index()
    {
		// check user permission
		if(!has_admin_permission_layout('VIEW_TARGET')) { return; }

		$data['IS_ENTRY_ALLOWED'] = is_entry_allowed(1);  // here 1 for target module id

		$data['page_title'] = 'Target';
        
		$State_ID =  intval(trim($this->input->get('State_ID' )));
		if($_SESSION['ADMIN']['State_ID']  != 0) {
			$State_ID = $_SESSION['ADMIN']['State_ID'];
		}
		
		$District_ID   = intval(trim($this->input->get('District_ID')));
		if($_SESSION['ADMIN']['District_ID'] != 0 ) {
			$District_ID = $_SESSION['ADMIN']['District_ID'];
		}
		if(!isDistrict_belongToState($District_ID, $State_ID)){
           die("Error occured. Invalid Input");
        }
		
        $round_id = $this->round->getRound();
			
        if ($District_ID != 0) 
		
        {       $queryWhere = array();	
                $queryWhere[] = " m.District_ID= ". $District_ID;
				$filterArray['WHERE'] = $queryWhere;
				$data['blocks']  = $this->Target_model->getBlockListWithData($filterArray,$round_id);
        }        
		
		$data['State_ID']= $State_ID;
		$data['District_ID'] = $District_ID;
		loadLayout('admin/targetform', $data, 'admin');

    }

  
    public function target_save()
    {
		 // check user permission
		if(!has_admin_permission_layout('EDIT_TARGET')) { return; }
		if(!is_entry_allowed(1)) { return;} // no entry allowed Here 1 is module_id

        $queryWhere  = array(); 

        $State_ID =  intval(trim($this->input->post('State_ID' )));
		if($_SESSION['ADMIN']['State_ID']  != 0) {
			$State_ID = $_SESSION['ADMIN']['State_ID'];
		}
		
		$District_ID   = intval(trim($this->input->post('District_ID')));
		if($_SESSION['ADMIN']['District_ID'] != 0 ) {
			$District_ID = $_SESSION['ADMIN']['District_ID'];
		}

        if(!isDistrict_belongToState($District_ID, $State_ID)){
           die("Error occured. Invalid Input");
       }
	  
        $blocks  = $this->Target_model->getBlockList($District_ID);
		
        if (isset($_POST))
        {
              if($this->Target_model->saveTarget($_POST,$blocks)){
				$this->session->set_flashdata('success', 'Data Saved Successfully!');
				
			  }else {
				$this->session->set_flashdata('error', 'Could not saved data!');
			  }
			 redirect( $_SERVER['HTTP_REFERER']);
        }  
    }
  

  /*------------------ End of Target Functions ----------*/
}
