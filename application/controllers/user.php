<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {       
        parent::__construct();
       
        
        $this->load->model('user_model');
        $this->load->helper('url');
       
    }

    public function index()
    {

        $this->userList();
        
    }

    function userList(){

        $this->load->model('user_model');
        $this->load->helper("form");
        $this->load->helper("html");

        $alluserList = $this->user_model->getUserList();
        
        $data['results']            = $alluserList[0];
        $data['record_count']       = $alluserList[1];

        
        $this->load->view('tpl_userList', $data);  
       
    }

    function addUser(){

        $this->load->helper("form");
        $this->load->helper('url');
        $this->load->helper("html");
        
        $this->load->view('tpl_addUser');


    }

    function addUserAjax(){

        $this->load->helper("form");
        $this->load->helper('url');
        $this->load->helper("html");
       
        $this->load->model('user_model');

        $insert_id = $this->user_model->insert_user();
        if($insert_id)
        {
            echo "1";
            exit;   
            
        }else{
        echo "Error in inserting database...";
        }

        exit;
    }

    

    function editUser($u_id='')
    {
        $this->load->helper('url');
        $this->load->helper("form");
        $this->load->helper('url');
        $this->load->helper("html");
        $this->load->model('user_model');
        
        
        if(isset($u_id) and !empty($u_id)){
      
        $result = $this->user_model->getUserById($u_id);
        $records=$result->row();
        
        $data['records'] =  $records;
        $data['user_id'] =  $u_id;
        
        $this->load->view('tpl_editUser', $data);
        }else{
        show_error('<h1 style="font:Verdana, Geneva, sans-serif; font-size:22px;"> Wrong id in url !</h1>');    
        }
       
       
    }

    function editUserAjax(){

        $this->load->helper("form");
        $this->load->helper('url');
        $this->load->helper("html");
        
        $this->load->model('user_model');

        if($this->user_model->edit_user())
        {
            echo "1";
            exit;   
            
        }else{
            echo "Error while updating record to database...";
        }

        exit;
    }



    function deleteUser(){
        $this->load->helper('url');
        $this->load->model('user_model');

        $u_id = $this->input->post('uid');
        
        if($this->user_model->delete_user($u_id)){
            echo "1";
            exit; 
        }
        exit;
        
    }






}//End of controllers

