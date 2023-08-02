<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Verify_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        }
public  function otp_add(){
  $cand_id=$_SESSION['cand_id'];
  $result=$this->db->query('update cand_profile set otp_no=otp_no+1 where cand_id='.$cand_id);
}
public function mob_varified(){
  $cand_id=$_SESSION['cand_id'];
  $result=$this->db->query('update cand_profile set regis_otp=1 where cand_id='.$cand_id);

}


    }
