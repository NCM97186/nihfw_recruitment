
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public function insert_update($data)
    {
        $sql = 'INSERT INTO users (first_name, middel_name, last_name, cand_mob, cand_email, password,otp,currenttime,temppass)
        VALUES (?, ?, ?, ?, ?, ?,?,?,?)
        ON DUPLICATE KEY UPDATE 
            first_name=VALUES(first_name), 
            middel_name=VALUES(middel_name), 
            last_name=VALUES(last_name),
            cand_mob=VALUES(cand_mob),
            cand_email=VALUES(cand_email),
            password=VALUES(password),
            otp=VALUES(otp),
            currenttime=VALUES(currenttime),
            temppass=VALUES(temppass)';
        $query = $this->db->query($sql, $data);

        $user_id = $this->db->insert_id();
        $registration_number = $user_id . random_string('numeric', 5);
        $update_array   =   array(
            "user_id"    =>  $user_id,
            "registration_number"         =>  $registration_number
        );
        $this->db->where("user_id", $user_id);
        $this->db->update("users", $update_array);
        return $registration_number;
    }
    public function getlogin($credentials)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('registration_number', $credentials['registration_number']);
        $res = $this->db->get()->row_array();

        $pass = $res['password'] . $_SESSION['salt'];
        $dbpass   = strtoupper($pass);
        //$credentials['password'];die;

        if ($dbpass == trim($credentials['password'])) {

            //$row            =   $query->row_array();
            $update_array   =   array(
                "last_login"    =>  $res['login'],
                "login"         =>  date("Y-m-d H:i:s")
            );

            $this->db->update("users", $update_array);
            $this->db->where("id", $res['id']);
            $this->setUserLoginSession($res);
            return true;
        } else {
            return false;
        }
    }
    private function setUserLoginSession($row)
    {

        $session_array = array(
            'user_id' => $row['user_id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'cand_mob' => $row['cand_mob'],
            'cand_email' => $row['cand_email']
        );

        $this->session->set_userdata('USER', $session_array);
        return true;
    }
    public function get_basicInfo($user_id)
    {
        return $this->db->get_where('users', array('user_id' => $user_id))->row();
    }
    public function get_user_details($application_id)
    {
        return $this->db->get_where('users_detail', array('application_id' => $application_id))->row();
    }
    public function get_preview_user_details($application_id)
    {
        return $this->db->get_where('users_detail', array('application_id' => $application_id))->row();
    }
    public function get_user_lists($advertise,$postid,$gender_id,$category_id,$status_id,$fromdate, $todate,$export)
    {
        $sqlquery = '';
        $sqlquery .= 
            'select i.*,u.application_id,j.post_name,j.max_age_date,j.min_age_date,a.adver_no,a.adver_title,a.adver_date,
            u.status_id 
        from users i inner join users_detail u
		on u.user_id=i.user_id
        left join jobpost j on u.post_id=j.post_id
        inner join advertisement a on j.adver_id=a.adver_id
where 1'
        ;
        if($advertise){
            $sqlquery .= ' AND a.adver_id = '.$advertise.'';
        }
        if($postid){
           $sqlquery .= ' AND u.post_id = '.$postid.'';
        }
        if($category_id){
            $result = $this->db->select('category')->from('category')->where('id', $category_id)->limit(1)->get()->row();
            $catname= $result->category;
            if($catname){
                $sqlquery .= ' AND u.category_name like "%'.$catname.'%"'; 
            }
           
        }
        if($status_id){
            $sqlquery .= ' AND u.status_id = '.$status_id.'';
        }
        if($gender_id){
            if($gender_id=1){
                $gender="Male";
            }elseif($gender_id=2){
                $gender="Female";
            }else{
                $gender="Other";
            }
            $sqlquery .= ' AND u.gender like "%'.$gender.'%"';
        }
        if($fromdate && $todate){
            $sqlquery .= ' AND u.created_on between "'.$fromdate.' 00:00:00" AND "'.$todate.' 23:59:59"';
        }
        elseif($fromdate ){
            $sqlquery .= ' AND u.created_on like "%'.$fromdate.'%" ';
        }
        elseif($todate){
            $sqlquery .= ' AND u.created_on  like "%'.$todate.'%"';
        }
  
        //echo $sqlquery; die();
        $query = $this->db->query($sqlquery);
        if($export){
            return $query->result_array();
        }else{
            return $query->result();
        }
    }
    public function get_candidate($cand_id)
    {
        $query = $this->db->query(
            'select i.*, j.post_name,j.max_age_date,a.adver_no,a.adver_title,a.adver_date,j.min_age_date,j.last_date 
        from users i inner join users_detail u
		on u.user_id=i.user_id
        left join jobpost j on u.post_id=j.post_id
        inner join advertisement a on j.adver_id=a.adver_id        
        where i.user_id=' . $cand_id
        );
        return $query->row();
    }

    public function get_candidate_dob($dob, $post_id)
    {
        $query = $this->db->query(
            'select  j.post_name,j.max_age_date,a.adver_no,a.adver_title,a.adver_date,j.min_age_date,j.last_date 
        from jobpost j 
        inner join advertisement a on j.adver_id=a.adver_id        
        where j.post_id=' . $post_id . ' and j.max_age_date>"' . $dob . '" and j.min_age_date<"' . $dob . '"'
        );
        return $query->row();
    }
    public function get_user_degree_diploma($application_id)
    {
        $this->db->select('*');
        $this->db->from('users_degree');
        $this->db->where(array("application_id" => $application_id));
        $query = $this->db->get();
        return $query->result();
    }
    public function get_user_work_experience($application_id)
    {
        $this->db->select('*');
        $this->db->from('users_work_experience');
        $this->db->where("application_id", $application_id);
        $query = $this->db->get();
        return  $query->result();
    }
    /*Insert update financial IEC Activities dedicated to NTCP*/
    public function insert_degree_diploma_details($user_id, $post_val, $application_id)
    {
        if ($post_val) {
            //$this->db->where(array('application_id'=>$application_id));
            //$this->db->delete('users_degree');
            foreach ($post_val as $k => $dt) {
                foreach ($dt as $j => $dts) {
                    $data[$j][$k] = $dts;
                }
            }
            foreach ($data as $rec) {
                $rec['application_id'] = $application_id;
                $rec['user_id'] = $user_id;
                if (empty($rec['degree_id'])) {
                    $this->db->insert('users_degree', $rec);
                } else {
                    $this->db->where(array('degree_id' => $rec['degree_id']));
                    $this->db->update('users_degree', $rec);
                }
            }
        }
    }
    public function insert_work_experience_details($user_id, $post_val, $application_id)
    {
        if ($post_val) {
            //$this->db->where(array('application_id'=>$application_id));
            //$this->db->delete('users_degree');
            foreach ($post_val as $k => $dt) {
                foreach ($dt as $j => $dts) {
                    $data[$j][$k] = $dts;
                }
            }
           // echo '<pre>';
            foreach ($data as $rec) {
                $rec['application_id'] = $application_id;
                $rec['user_id'] = $user_id;
               // print_r($rec);
                if (empty($rec['work_experience_id'])) {
                    $this->db->insert('users_work_experience', $rec);
                } else {
                    $this->db->where(array('work_experience_id' => $rec['work_experience_id']));
                    $this->db->update('users_work_experience', $rec);
                }
            }
        }
    }
    public function insert_update_user_details($post_val)
    {
        unset($post_val['org_doc']);
        unset($post_val['edu_doc']);
        if (!empty($post_val)) {
          
            $user_id = $_SESSION['USER']['user_id'];
            $status=array(5,6);
            $id=  $this->db->select('*')->from('users_detail')->where(array('user_id'=>$user_id, 'post_id'=>$post_val['post_id']))->where_in('status_id', $status)->get()->row();
            if($id){
                 unset($post_val['application_id']);
                 ($_SESSION['application_id']);
                 unset($post_val['id']);
                 unset($post_val['status_id']);
              $this->db->where(array('user_id'=>$user_id, 'post_id'=>$post_val['post_id']))->where_in('status_id', $status);
            // $this->db->where('id',$id)
                 $this->db->update('users_detail', $post_val);
                 return $this->db->insert_id();
             } else {
                $this->db->insert('users_detail', $post_val);
              
                return $this->db->insert_id();
            }
        }
    }

    public function get_application_id()
    {
        $user_id = $_SESSION['USER']['user_id'];
        if (empty($_SESSION['application_id'])) {
            $pre = 8 - strlen($user_id);
            $application_id = str_pad($user_id, $pre + strlen($user_id), '0', STR_PAD_LEFT) . '-' . time();
            $_SESSION['application_id'] = $application_id;
        } else {
            $application_id = $_SESSION['application_id'];
        }
        return $application_id;
    }

    public function update_user_details($application_id, $post_val)
    {

        if ($post_val) {
            $this->db->where('application_id', $application_id);
            return $this->db->update('users_detail', $post_val);
            //$user_detail_id;
        }
    }
    public function checkMobile($credentials)
    {
        $sql = "SELECT * FROM users WHERE cand_mob = ? LIMIT 1";
        $query = $this->db->query($sql, $credentials);
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function checkid($credentials)
    {
        $sql = "SELECT * FROM users WHERE id = ? LIMIT 1";
        $query = $this->db->query($sql, $credentials);
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function update_users($cand_mob, $post_val)
    {

        if (isset($post_val['cand_mob'])) {
            $this->db->where('cand_mob', $cand_mob);
        } else {
            $this->db->where('registration_id', $cand_mob);
        }


        return $this->db->update('users', $post_val);
        //$user_detail_id;
    }
    public function update_all_users($user_id, $post_val)
    {

        if (isset($user_id)) {
            $this->db->where('user_id', $user_id);
            return $this->db->update('users', $post_val);
        }


        //$user_detail_id;
    }
    public function get_participant_status($user_id)
    {

        if (isset($user_id)) {
            $sql = "SELECT * FROM cand_profile_status WHERE cand_id = ? order by cand_vari_id  desc LIMIT 1";
            $query = $this->db->query($sql, $user_id);
            return $query->row();
        }


        //$user_detail_id;
    }

    public function makepdf($id)
    {
        $query = $this->db
            ->select('users_detail.*,users.*,jobpost.post_name')
            ->from('users_detail')
            ->where('users_detail.application_id', $id)
            ->join('users', 'users_detail.user_id=users.user_id', 'left')
            ->join('jobpost', 'users_detail.post_id = jobpost.post_id', 'inner')
            ->get();
        return $query->row();
    }
}
