<?php

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation'));

    }

    public function index() {
        $this->login();
    }

    public function imagecreate(){
        $data['x']=$_POST['x'];
         $data['y']=$_POST['y'];
          $data['w']=$_POST['w'];
           $data['h']=$_POST['h'];
            $data['img']=$_POST['img'];

  //echo "<img src='".$dst_r."'/>";
 $this->load->view('users/image-crop',$data);
 
    }

    public function register() {

        $this->form_validation->set_rules('firstname','First Name','trim|required');
        $this->form_validation->set_rules('lastname','Last Name','trim|required');
        if ($this->form_validation->run() === FALSE) {
        } else {
        $data['firstname'] = $this->security->xss_clean($this->input->post('firstname'));
        $data['lastname'] = $this->input->post('lastname');
        $data['email'] = $this->input->post('email');
        $data['password'] = md5($this->input->post('password'));
        $data['phone_no'] = $this->input->post('phone_no');
        $data['address'] = $this->input->post('address');
        $data['dob'] = $this->input->post('dob');
        $data['gender'] = $this->input->post('gender');

 
        $config['upload_path'] = './resume/';
        $config['allowed_types'] = 'gif|jpg|png|doc|pdf|docx';
        $config['max_size']     = 2048000;
        $config['max_width'] = 1024;
        $config['max_height'] = 1024;
        $config['file_name']= $this->input->post('resume');
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('resume')) 
        {
        echo $error = $this->upload->display_errors();
          }
        else 
         {
        $filename = $this->upload->data();
        $data['resume']= $filename['file_name'];
        $this->user_model->registerdata($data);
           }
        }
    
        $this->load->view('templates/header');
        $this->load->view('users/register');
        $this->load->view('templates/footer');
    }

    public function login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');

        $data['title'] = 'Login';

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('users/login');
            $this->load->view('templates/footer');

        } else {
            if ($user = $this->user_model->get_user_login($email, $password)) {
                $this->session->set_userdata('email', $email);
                $this->session->set_userdata('user_id', $user['id']);
                $this->session->set_userdata('is_logged_in', true);

                $this->session->set_flashdata('msg_success', 'Login Successful!');
                redirect('news');
            } else {
                $this->session->set_flashdata('msg_error', 'Login credentials does not match!');

                $currentClass = $this->router->fetch_class(); // class = controller
                $currentAction = $this->router->fetch_method(); // action = function

                redirect("$currentClass/$currentAction");
                //redirect('user/login');
            }
        }
    }

    public function logout() {
        if ($this->session->userdata('is_logged_in')) {

            //$this->session->unset_userdata(array('email' => '', 'is_logged_in' => ''));
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('is_logged_in');
            $this->session->unset_userdata('user_id');
        }
        redirect('users/login');
    }
}
