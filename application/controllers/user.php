<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {       
        parent::__construct();
        /*if($this->session->IS_LOGED_IN_DEMOATS() == 0){
            redirect(base_url());
        } */

        //error_reporting(E_ALL);
        //ini_set('display_errors', 1);
        
        $this->load->model('user_model');
        $this->load->helper('url');
       
        /*$this->load->library('emailtrigger');
        $this->load->helper("form");
        
        $this->load->helper("html");
        $this->load->library('Ajax');
        $this->load->library('form_validation');
        $this->load->library('sftp');
        $this->load->helper("file");*/
    }

    public function index()
    {

        $this->userList();
        //for addUser css - http://www.sanwebe.com/2014/08/css-html-forms-designs

    }

    function userList(){

        $this->load->model('user_model');
        $this->load->helper("form");
        $this->load->helper("html");

        $alluserList = $this->user_model->getUserList();
        //echo "<pre>"."Hey - "; print_r($alluserList);exit;
        $data['results']            = $alluserList[0];
        $data['record_count']       = $alluserList[1];

        //echo "<pre>"."Hey - "; print_r($data['results']);exit;

        //echo base_url();exit;
        $this->load->view('tpl_userList', $data);  
        //$this->load->view('tpl_userList');  

    }

    function addUser(){

        $this->load->helper("form");
        $this->load->helper('url');
        $this->load->helper("html");
        //$this->load->library('Ajax');
        //echo "<pre>"."Here";exit;
        //$data['userType'] = $this->user_model->getUserTypeList();
        //$this->load->view('tpl_addUser', $data);
        $this->load->view('tpl_addUser');


    }

    function addUserAjax(){

        $this->load->helper("form");
        $this->load->helper('url');
        $this->load->helper("html");
        /*$this->load->library('Ajax');
        $this->load->library('form_validation');*/
        $this->load->model('user_model');

        $insert_id = $this->user_model->insert_user();
        if($insert_id)
        {
            //$this->send_mail_confirmation($insert_id);  //new function to send user confirmation mails
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
       //echo "<pre>"."Here - ";print_r($u_id);exit;
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
        //$this->load->library('Ajax');
        //$this->load->library('form_validation');
        $this->load->model('user_model');

        if($this->user_model->edit_user())
        {
            //$this->send_mail_confirmation($insert_id);  //new function to send user confirmation mails
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

