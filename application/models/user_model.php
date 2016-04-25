<?php
class User_model extends CI_Model {
    
    function __construct(){
        parent::__construct();

    }
   
    function getUserList(){

        $this->load->database();

        $this->db->select('tbl_user.user_id',false);
        $this->db->from('tbl_user');
        $query = $this->db->get();
        $count = $query->num_rows();
        
        $this->db->select('*');
        $this->db->from('tbl_user');
        $query = $this->db->get();

        $result = $query->result_array();


        //echo "<pre>"."in model - ";echo $this->db->last_query();exit;
        if(count($query)>0)            
        {
            return array($result,$count);
        }
        else
        {
            return 0;
        }



    }

    function insert_user()
    {
           
        $new_user_insert_data = array(
            'user_name' => $this->input->post('user_name'),
            'user_country' => $this->input->post('user_country'),
            'user_email' => strtolower($this->input->post('user_email')),
            'user_mobile'=>$this->input->post('user_mobile'),   
            'user_about'=>$this->input->post('user_about'),   
            'user_bday' => $this->input->post('user_bday')
        );
        
        $this->load->database();
        $insert = $this->db->insert('tbl_user', $new_user_insert_data);
        
        $user_id  =  $this->db->insert_id();
        return $user_id;
    }


    function edit_user(){
            
            $id=$this->input->post('user_id');
            
            $new_member_update_data = array(
                'user_name' => $this->input->post('user_name'),
                'user_country' => $this->input->post('user_country'),
                'user_email' => strtolower($this->input->post('user_email')),
                'user_mobile'=>$this->input->post('user_mobile'),   
                'user_about'=>$this->input->post('user_about'),   
                'user_bday' => $this->input->post('user_bday')
            );
        
        //echo "<pre>"."in after - "; print_r($new_member_update_data);echo "<br>";exit;
            $this->load->database();
            $this->db->where('user_id', $id);
            $flgreturn = $this->db->update('tbl_user', $new_member_update_data); 
            return $flgreturn;
    }

    function getUserById($id)
    {
        $this->load->database();
        $this->db->where('user_id ',$id);
        $query = $this->db->get('tbl_user');
       // $fetch = $query->row();
        return $query;
    }
    
    
    function delete_user($u_id){
        $this->load->database();
        $u = $this->db->delete('tbl_user', array('user_id' => $u_id)); 
        return $u;
    }
    
    
 
    
    
    

    
   
  
    
    
    
}//End of model
?>
